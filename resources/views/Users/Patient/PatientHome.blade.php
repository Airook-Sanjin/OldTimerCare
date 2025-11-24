@extends('Skeletons.Homebase')
<!-- extends('Skeletons/Header&Footer') -->
@section('title','FamilyHome')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/UserCSS/Homebase.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('app/resources/family/family.css') }}"> --}}
@endsection

    @section('Left-Column')
        <p>LEFT</p>
    @endsection

    @section('Middle-Top')
        <div class="container-div">
            <h2 class="container-title">Daily Checklist</h2>
            <div class="container-checklist">
                <ul>
                    <li class="box"> 
                        <div>
                            <span>Breakfast</span>
                            <input type="checkbox">
                        </div>                       
                    </li>
                    <li class="box"> 
                        <div>
                            <span>Lunch</span>
                            <input type="checkbox">
                        </div>                       
                    </li>
                    <li class="box"> 
                        <div>
                            <span>Dinner</span>
                            <input type="checkbox">
                        </div>                       
                    </li>
                </ul>
            </div>
        </div>
    @endsection

    @section('Middle-Bottom')
        <div class="container-div">
            <h2 class="container-title">Medicine</h2>
            <div class="container-checklist">
                <ul>
                    <li class="box"> 
                        <div>
                            <span>Breakfast</span>
                            <input type="checkbox">
                        </div>                       
                    </li>
                    <li class="box"> 
                        <div>
                            <span>Lunch</span>
                            <input type="checkbox">
                        </div>                       
                    </li>
                    <li class="box"> 
                        <div>
                            <span>Dinner</span>
                            <input type="checkbox">
                        </div>                       
                    </li>
                </ul>
            </div>
        </div>
    @endsection

    @section('Right-Column')
        <p>Right</p>
    @endsection



