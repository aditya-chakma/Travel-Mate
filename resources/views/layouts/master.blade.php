<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">


        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Travel-Mate</title>

        <!-- Scripts -->

<style>
body {
  background-image: url("back.jpg");
}
</style>


        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/mxcdn.js') }}" ></script>
        <script src="{{ asset('js/newjs.js') }}" ></script>
        <link rel="stylesheet" href="{{ asset('js/mxcdn.css') }}">
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


        <title>Travel-Mate</title>
            @include('partials.style')
    </head>
    <body>
        @include('partials.nav')
        
        @yield('content')

        @include('partials.footer')
        
        @include('partials.script')
       
    </body>
</html>