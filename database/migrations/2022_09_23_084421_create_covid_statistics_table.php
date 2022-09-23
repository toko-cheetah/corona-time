<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('covid_statistics', function (Blueprint $table) {
			$table->id();
			$table->json('country');
			$table->string('code');
			$table->integer('confirmed');
			$table->integer('deaths');
			$table->integer('recovered');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('covid_statistics');
	}
};
