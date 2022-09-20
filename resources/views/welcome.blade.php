<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Coronatime</title>
</head>
<body>
    <h1 class="text-center">hello</h1>

    <form action="{{ route('logout') }}" method="post" class="text-center">
        @csrf
        <button type="submit">logout</button>
    </form>
</body>
</html>