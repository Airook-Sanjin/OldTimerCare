@extends('Skeletons.Homebase')
<!-- extends('Skeletons/Header&Footer') -->
@section('title','FamilyHome')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/UserCSS/Homebase.css') }}">
    
@endsection

    @section('Left-Column')
        <div class="upcoming-container">
            <div class="upcoming-header">
                <h3>Upcoming</h3>
                
            </div>

            <label class="till-label">Till</label>

        @forelse ($appointments as $appointment)
            <p class="appt-info">
                Appointment with: {{ $appointment->PatientName ?? 'N/A' }} <br>

                <fieldset class="date-fieldset">
                    <legend>Appointment Date</legend>
                    <div class="date-wrapper">
                        <input type="date"
                            value="{{ \Carbon\Carbon::parse($appointment->Date)->format('Y-m-d') }}">
                    </div>
                </fieldset>
            </p>
        @empty
            <p class="appt-info">No upcoming appointments.</p>
        @endforelse
        </div>
    @endsection

    @section('Middle-Top')
        <div class="container-div">
            <h2 class="container-title">Caregiver Daily Checklist</h2>
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
        <h3>Patients</h3>
        @foreach ($patients as $patient)
            <div class="pfp">
                <img src="{{ $patient->ProfileImage }}" alt="Profile Picture" class="pfp">
            </div>

            <p>{{ $patient->FirstName }} {{ $patient->LastName }}</p>
            {{-- <p>Total Due: ${{ $patient->Total }}</p> --}}
            <hr>
        @endforeach
    @endsection


