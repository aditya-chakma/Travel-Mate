<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <style>
        body {
            background-image: url("back1.jpg");
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Travel-Mate</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>


<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light  shadow-sm" style="background-color: #a9a9a9;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h1><b>Travel-Mate</b></h1>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ url('/home') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(Auth::user()->role == "admin")
                                <img src="{{ asset('images/admin.png') }}" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:50px;">

                                @else
                                <img src="{{asset('images/'.Auth::user()->file_name)}}" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:50px;">
                                @endif
                                <b><i>{{ Auth::user()->name }}</i></b>
                                <span class="caret">
                                    @if(Auth::user()->role == "service_provider")
                                    <?php
                                    $provider = DB::table('service_providers')->where('auth_id', Auth::user()->id)->first();
                                    ?>
                                    @if($provider->verified == 1)
                                    <small>[Verified User]</small>
                                    @else
                                    <small>[Uncorroborated User]</small>
                                    @endif
                                    @endif
                                </span>

                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <ul>

                                    <li><a class="dropdown-item" href="{{ url('/home') }}">
                                            {{ __('Home') }}
                                        </a>
                                    </li>

                                    @if(Auth::user()->enable_access)
                                    <li><a class="dropdown-item" href="{{ url('/profile') }}">
                                            {{ __('My Profile') }}
                                        </a>
                                    </li>
                                    @endif

                                    @if(Auth::user()->role == 'service_provider')
                                    <li><a class="dropdown-item" href="{{ url('/company') }}">
                                            {{ __('Update Company Details') }}
                                        </a>
                                    </li>
                                    @endif

                                    @if(Auth::user()->role == 'service_provider')
                                    <li><a class="dropdown-item" href="{{ url('/service') }}">
                                            {{ __('Add Service') }}
                                        </a>
                                    </li>
                                    @endif

                                    @if(Auth::user()->role == 'service_provider')

                                    @if($provider->verified == 0)
                                    <li><a class="dropdown-item" href="{{ url('/verification') }}">
                                            {{ __('Requst for Verification') }}
                                        </a>
                                    </li>
                                    @endif

                                    @endif

                                    @if(Auth::user()->role == 'admin')
                                    <li><a class="dropdown-item" href="{{ url('/location') }}">
                                            {{ __('Add Location') }}
                                        </a>
                                    </li>
                                    @endif

                                    @if(Auth::user()->role == 'employee')
                                    <li><a class="dropdown-item" href="{{ url('/verification_request_list') }}">
                                            {{ __('Verification Request List') }}
                                        </a>
                                    </li>
                                    @endif

                                    @if(Auth::user()->role == 'customer')
                                    <li><a class="dropdown-item" href="{{ url('/booked_service') }}">
                                            {{ __('Booked Services') }}
                                        </a>
                                    </li>
                                    @endif

                                    @if(Auth::user()->role == 'service_provider')
                                    <li><a class="dropdown-item" href="{{ url('approve_book') }}">
                                            {{ __('Booked Services') }}
                                        </a>
                                    </li>
                                    @endif

                                    @if(Auth::user()->role == 'admin')
                                    <li><a class="dropdown-item" href="#">
                                            {{ __('Report Generation') }}
                                        </a>
                                    </li>
                                    @endif



                                    @if(Auth::user()->role != 'admin')
                                    <li><a class="dropdown-item" href="{{ url('/update_profile') }}">
                                            {{ __('Update Profile') }}
                                        </a>
                                    </li>
                                    @endif

                                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>


                                </ul>




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