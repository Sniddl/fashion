<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FASHION</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

        <script src="{{ mix('js/app.js') }}" crossorigin="anonymous" defer></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content" id="app">
                <div class="title m-b-md">
                    FASHION
                </div>
                <div>
                    <button @click="testing = !testing" class="p-3 border">click</button>
                </div>


                <h1>Money: {{ money(5.129, "usd")-> to("cny") }}</h1>

                <div class="p-3 bg-blue-300 w-1/5 overflow-hidden">
                    <vue-transition-slide direction="right" duration="600">
                        <div class="slide-item p-3 m-2 border" v-if="testing" :key="1">A</div>
                        <div class="slide-item p-3 m-2 border" v-if="!testing" :key="2">B</div>
                    </vue-transition-slide>
                </div>

                <div class="p-3 bg-blue-300 w-1/5 overflow-hidden">
                    <vue-transition-slide direction="left">
                        <div class="slide-item p-3 m-2 border" v-if="testing" :key="1">C</div>
                        <div class="slide-item p-3 m-2 border" v-if="!testing" :key="2">D</div>
                    </vue-transition-slide>
                </div>
                
            </div>
        </div>
    </body>
</html>
