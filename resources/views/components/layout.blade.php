<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://free.bboxtype.com/embedfonts/?family=FiraGO:400,500,600,700,800,900" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Coronatime</title>
</head>

<body class="box-border m-auto pt-5 lg:mx-6 xl:mx-24 {{ Config::get('app.locale') == 'en' ? 'font-inter' : 'font-firago' }}">
    {{ $slot }}
</body>
</html>