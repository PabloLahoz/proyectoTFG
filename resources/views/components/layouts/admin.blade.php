<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $titulo ?? 'Palets Épila' }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div class="flex flex-col h-screen">
        <x-layouts.adminHeader/>
        <div class="flex flex-1">
            <x-layouts.aside />

            <main class="flex-1 bg-blue-50 p-6 overflow-y-auto shadow-xl z-10">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
