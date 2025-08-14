<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titulo ?? ""}}</title>
    @vite (["resources/css/app.css","resources/js/app.js"])
    @livewireStyles
</head>
<body class="flex flex-col min-h-screen">
<x-layouts.header/>
<div class="flex flex-1">
    @auth
        @if(auth()->user()->rol === 'administrador')
            <x-layouts.aside />
        @endif
    @endauth

    <main class="flex-1 bg-[#F7FAF7]">
        {{ $slot }}
    </main>
</div>
<x-layouts.footer/>
@livewireScripts
</body>
</html>
