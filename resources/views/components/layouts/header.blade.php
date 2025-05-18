<header class="md:h-15v bg-blue-500
    flex flex-col md:flex-row justify-between px-3 items-center">
    <img class="w-40 h-32 ml-1" src="{{asset("images/logo.jpg")}}" alt="logo">
    <h1 class="text-5xl text-white text-">{{__("PALETS ÉPILA")}}</h1>
    <div class="flex flex-col items-end space-y-2 mt-3">
        @auth()
            <span class="text-white">{{auth()->user()->name}}</span>
            <form action="{{route("logout")}}" method="post">
                @csrf
                <input class="px-4 py-2 text-black bg-gray-300 rounded hover:bg-gray-200" type="submit" value="{{__("Log Out")}}">
            </form>
        @endauth

        @guest()
            <a class="px-4 py-2 text-black bg-gray-300 rounded hover:bg-gray-200" href="{{route("login")}}">{{__("Log in")}}</a>
            <a class="px-4 py-2 text-black bg-gray-300 rounded hover:bg-gray-200" href="{{route("register")}}">{{__("Registrarse")}}</a>
        @endguest
        <x-layouts.lang/>
    </div>
</header>
