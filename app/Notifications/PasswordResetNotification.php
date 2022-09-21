<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PasswordResetNotification extends Notification
{
	/**
	 * The password reset token.
	 *
	 * @var string
	 */
	public $token;

	/**
	 * The callback that should be used to create the reset password URL.
	 *
	 * @var (\Closure(mixed, string): string)|null
	 */
	public static $createUrlCallback;

	/**
	 * The callback that should be used to build the mail message.
	 *
	 * @var (\Closure(mixed, string): \Illuminate\Notifications\Messages\MailMessage)|null
	 */
	public static $toMailCallback;

	/**
	 * Create a notification instance.
	 *
	 * @param string $token
	 *
	 * @return void
	 */
	public function __construct($token)
	{
		$this->token = $token;
	}

	/**
	 * Get the notification's channels.
	 *
	 * @param mixed $notifiable
	 *
	 * @return array|string
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	/**
	 * Build the mail representation of the notification.
	 *
	 * @param mixed $notifiable
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		if (static::$toMailCallback)
		{
			return call_user_func(static::$toMailCallback, $notifiable, $this->token);
		}

		return $this->buildMailMessage($this->resetUrl($notifiable));
	}

	/**
	 * Get the reset password notification mail message for the given URL.
	 *
	 * @param string $url
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	protected function buildMailMessage($url)
	{
		return (new MailMessage)
			->subject(Lang::get('mail-message.reset_password_notification'))
			->greeting(Lang::get('mail-message.recover_password'))
			->line(Lang::get('mail-message.click_to_recover_password'))
			->action(Lang::get('mail-message.recover_password'), $url);
	}

	/**
	 * Get the reset URL for the given notifiable.
	 *
	 * @param mixed $notifiable
	 *
	 * @return string
	 */
	protected function resetUrl($notifiable)
	{
		if (static::$createUrlCallback)
		{
			return call_user_func(static::$createUrlCallback, $notifiable, $this->token);
		}

		return url(route('password.reset', [
			'token' => $this->token,
			'email' => $notifiable->getEmailForPasswordReset(),
		], false));
	}

	/**
	 * Set a callback that should be used when creating the reset password button URL.
	 *
	 * @param  \Closure(mixed, string): string  $callback
	 *
	 * @return void
	 */
	public static function createUrlUsing($callback)
	{
		static::$createUrlCallback = $callback;
	}

	/**
	 * Set a callback that should be used when building the notification mail message.
	 *
	 * @param  \Closure(mixed, string): \Illuminate\Notifications\Messages\MailMessage  $callback
	 *
	 * @return void
	 */
	public static function toMailUsing($callback)
	{
		static::$toMailCallback = $callback;
	}
}
