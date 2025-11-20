<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="resources/css/Header&Footer.css">
        @yield('styles')
    </head>
    <div class ="nav">
        <div class="container">
    <a id="BusName"class="navbar-brand" href="/">Lancaster Oaks Residence</a>
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link">Home</a></li>
      <li class="nav-item"><a class="nav-link">Appointment</a></li>
    </ul>
</div>
    </div>
    <body class="Main">
        @yield('content')
    </body>
</html>
