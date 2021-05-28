<?php $general_setting = DB::table('general_settings')->find(1); ?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$general_setting->site_title}}</title>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('public/css/custom.css') ?>" type="text/css">
</head>
<body>
    <div id="app">
        <nav class="relative flex flex-wrap items-center content-between py-3 px-4  text-black navbar-laravel">
            <div class="container mx-auto sm:px-4">
                <a class="inline-block pt-1 pb-1 mr-4 text-lg whitespace-no-wrap" href="{{ url('/') }}" style="color: #7c5cc4; font-size: 18px; font-weight: bold;">
                    {{$general_setting->site_title}}
                </a>
                <button class="py-1 px-2 text-md leading-normal bg-transparent border border-transparent rounded" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="px-5 py-1 border border-gray-600 rounded"></span>
                </button>

                <div class="hidden flex-grow items-center" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="flex flex-wrap list-reset pl-0 mb-0 mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="flex flex-wrap list-reset pl-0 mb-0 ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="inline-block py-2 px-4 no-underline" href="{{ route('login') }}" style="color: #7c5cc4;">{{ __('Login') }}</a></li>
                            <li><a class="inline-block py-2 px-4 no-underline" href="{{ route('register') }}" style="color: #7c5cc4;">{{ __('Register') }}</a></li>
                        @else
                            <li class=" relative">
                                <a id="navbarDropdown" class="inline-block py-2 px-4 no-underline  inline-block w-0 h-0 ml-1 align border-b-0 border-t-1 border-r-1 border-l-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #7c5cc4;">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class=" absolute left-0 z-50 float-left hidden list-reset	 py-2 mt-1 text-base bg-white border border-gray-300 rounded" aria-labelledby="navbarDropdown">
                                    <a class="block w-full py-1 px-6 font-normal text-gray-900 whitespace-no-wrap border-0" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
<script type="text/javascript">
    

</script>
