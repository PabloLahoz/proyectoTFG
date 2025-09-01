<!doctype html>
<html lang="en">
<head>
    <script src="https://js.stripe.com/v3/"></script>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titulo ?? ""}}</title>
    <link rel="icon" href="{{asset('img/logo.png')}}" type="image/x-icon">
    @vite (["resources/css/app.css","resources/js/app.js"])
    @livewireStyles
</head>
<body>
@livewireScripts
    <div class="flex flex-col h-screen">
        <x-layouts.header/>
        <div class="flex flex-1">
            <main class="flex-1 bg-[#F7FAF7]">
                {{ $slot }}
            </main>
        </div>
        <x-layouts.footer/>
    </div>
</body>
</html>
