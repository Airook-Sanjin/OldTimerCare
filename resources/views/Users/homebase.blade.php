@extends('Header&Footer')
@section('title','Home')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/UserCSS/Homebase.css') }}">
@endsection

@section('content')
@csrf  <!--This is hidden input field with a unique token So no cross-site  attacks  -->
<!-- Put the html in here for homebase -->

<div class="Appointment">
    <p>Hello</p> 
</div>
<div class="Checklist"> </div>
<div class="Current">   </div>
<div class="Medicine"></div>

@endsection
