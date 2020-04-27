<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8c17ca260b.js" crossorigin="anonymous" defer></script>


    <!-- Styles -->
    {{-- <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="{{ $mainBgColor ?? "bg-gray-100" }} text-black">
    <div id="app">
        <header class="lg:px-16 px-6 bg-white flex flex-wrap items-center lg:py-0 py-2">
            <div class="flex-1 flex justify-between items-center">
              <a href="/">
                <img class="rounded-full w-10 h-10 border-2 border-transparent" src="img/fashion_logo.png">
            </a>
          </div>
        
           <label for="menu-toggle" class="pointer-cursor lg:hidden block"><i class="fas fa-bars"></i><title>menu</title></label>
          <input class="hidden" type="checkbox" id="menu-toggle" />
        
          <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
            <nav>
              <ul class="lg:flex items-center justify-between text-base text-gray-700 pt-4 lg:pt-0">
                <li><a id="light" class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="#">Light</a></li>
                <li><a id="solar" class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="#">Solar</a></li>
                <li><a id="color" class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="#">Color</a></li>
                <li><a id="dark" class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="#">Dark</a></li>
                <li><a id="solarDark" class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400 lg:mb-0 mb-2" href="#">Solar Dark</a></li>
              </ul>
            </nav>
            <a href="#" class="lg:ml-4 flex items-center justify-start lg:mb-0 mb-4 pointer-cursor">
              <img class="rounded-full w-10 h-10 border-2 border-transparent hover:border-indigo-400" src="img/fashion_logo.png">
            </a>
        
          </div>
        
          </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>