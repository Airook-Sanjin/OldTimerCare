@extends('Skeletons.Homebase')
<!-- extends('Skeletons/Header&Footer') -->
@section('title','FamilyHome')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/UserCSS/Homebase.css') }}">
@endsection


    @section('Left-Column')
        <p>LEFT</p>
    @endsection

    @section('Middle-Top')
        <p>Top</p>
    @endsection

    @section('Middle-Bottom')
        <p>Bottom</p>
    @endsection

    @section('Right-Column')
        <p>Right</p>
    @endsection



