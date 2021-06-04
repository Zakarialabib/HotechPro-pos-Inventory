<?php $general_setting = DB::table('general_settings')->find(1); ?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $general_setting->site_title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="all,follow">
    <link rel="manifest" href="{{ url('manifest.json') }}">
    <link rel="icon" type="image/png" href="{{ url('public/logo', $general_setting->site_logo) }}" />
    <!-- CSS-->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet"
        href="<?php echo asset('public/css/custom-' . $general_setting->theme); ?>"
        type="text/css">
</head>


<body>
 <div id="app">
    <main class="py-4">
        @yield('content')
    </main>

 </div>
</body>
</html>

