@extends('Skeletons/Header&Footer')
@section('title','Home')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/UserCSS/Homebase.css') }}">
@endsection
@section('content')
@csrf  <!--This is hidden input field with a unique token So no cross-site  attacks  -->
<!-- Put the html in here for homebase -->

<div class="welcome">
    <h1 class="name">
        Welcome {{$user->FirstName}}
    </h1>
</div>
<div class="Dashboard">
    <div class="Column -left">
        @yield('Left-Column')
    </div>
    <div class="Middle-dash">
        <div class="Middle -top">
            @yield('Middle-Top') </div>

        <div class="Middle -bottom">
            @yield('Middle-Bottom')   
        </div>
    </div>
    <div class="Column -right">
        @yield('Right-Column')
        {{-- <div class="pfp"></div> --}}
        
    </div>
</div>

@endsection
