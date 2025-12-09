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
                <a href="#" class="see-all">See All</a>
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
            <h2 class="container-title">Patient: {{ $patient->PatientName }}</h2>
            <div class="container-checklist-top">
                <div class="pfp">
                    <img src="{{ $patient->ProfileImage }}" alt="Profile Picture" class="pfp">
                </div>
                <h2>Total due: ${{ number_format($patient->Total ?? 0, 2) }}</h2>
                
            </div>
        </div>
    @endsection

    @section('Middle-Bottom')
<div class="container-div">
    <h2 class="container-title">Daily Checklist</h2>

    <div class="container-checklist">

        {{-- FOOD --}}
        <div style="display: flex; flex-direction: row; justify-content: space-around;">
            <h3>FOOD:</h3>
            <ul>
                @foreach ($meals as $meal)
                <li class="box">
                    <div>
                        <span>{{ $meal->MealType }}</span>
                        <input type="checkbox" disabled {{ $meal->Taken ? 'checked' : '' }}>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        {{-- MEDICINE --}}
        <div style="display: flex; flex-direction: row; justify-content: space-around;">
            <h3>MEDICINE:</h3>
            <ul>
                @foreach ($meds as $med)
                <li class="box">
                    <div>
                        <span>{{ $med->TimeOfDay }}</span>
                        <input type="checkbox" disabled {{ $med->Taken ? 'checked' : '' }}>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
@endsection


    @section('Right-Column')
        <h3>CareGivers</h3>
        @foreach ($caregivers as $c)
            <div class="pfp">
                <img src="{{ $c->ProfileImage }}" alt="Profile Picture" class="pfp">
            </div>

            <p>{{ $c->CaregiverName }}</p>
            <hr>
        @endforeach
    @endsection
   


