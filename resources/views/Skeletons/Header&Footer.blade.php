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
        <link rel="stylesheet" href="{{ asset('css/Header&Footer.css') }}">
        @yield('styles')
    </head>
    <div class ="nav">
        
            <a id="BusName"class="navbar-brand" href="{{ route('dashboard') }}"> <img id="Logo" src="{{asset('images/Lancaster_logo.png') }}" alt="Lancaster Oaks Residential"></a> 
            {{-- <!-- {{$date}} --> --}}
            <ul class="navbar-nav">
            @auth
            
            
            
            @if(isset($isEmployee))
            <li class="nav-item"><a class="nav-link" href ="{{ route('RosterCreate')}}" >Schedule</a></li>
            
            @if((int)($isEmployee->RoleID ?? 0)===1)
            <!-- Admin -->
             <li class="nav-item"><a class="nav-link" href ="{{ route('admin.approvalPage')}}">Approvals</a></li>
             {{-- <!-- <li class="nav-item"><a class="nav-link" href ="{{ route('Users.RosterCreate')}}">Roster</a></li> --> --}}
            @endif
            @if((int)($isEmployee->RoleID ?? 0)===2)
            <!--Supervisor -->
            {{-- <!-- <li class="nav-item"><a class="nav-link" href ="{{ route('RosterCreate')}}">Roster</a></li> --> --}}
            
            @endif
            @if((int)($isEmployee->RoleID ?? 0)===3)
            <!-- Doctor -->
             
            @endif
            @if((int)($isEmployee->RoleID ?? 0)===4)
            <!-- Caregiver -->
             
            @endif
            @endif
            <li class="nav-item"><a class="nav-link" href ="{{ route('CalendarView')}}" >Calendar</a></li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    <button type="submit" class=" btn">Logout</button>
                </form>
            </li>
            
            </ul>
            @endauth
    </div>
    <body class="Main">
        @yield('content')
    </body>
    @yield('scripts')
</html>
