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
            <h2 class="container-title">Daily Checklist</h2>

            <form action="{{ route('meals.update') }}" method="POST">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $patient->PatientID }}">

                <div class="container-checklist">
                    <ul>

                        @foreach ($meals as $meal)
                        <li class="box">
                            <div>
                                <span>{{ $meal->MealType }}</span>
                                <input type="checkbox"
                                    name="meals[{{ $meal->MealID }}]"
                                    {{ $meal->Taken ? 'checked' : '' }}>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>

                <button type="submit" class="update-btn">Update</button>

            </form>

        </div>
    @endsection


    @section('Middle-Bottom')
        <div class="container-div">
                <h2 class="container-title">Medicine</h2>

            <form action="{{ route('meds.update') }}" method="POST">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $patient->PatientID }}">

                <div class="container-checklist">
                    <ul>

                        @foreach ($meds as $med)
                        <li class="box">
                            <div>
                                <span>{{ $med->TimeOfDay }}</span>
                                <input type="checkbox"
                                    name="meds[{{ $med->MedID }}]"
                                    {{ $med->Taken ? 'checked' : '' }}>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>

                <button type="submit" class="update-btn">Update</button>

            </form>

        </div>
    @endsection


    @section('Right-Column')
        <h3>Patients</h3>
        @foreach ($patients as $patient)
            <div class="pfp">
                <img src="{{ $patient->ProfileImage }}" alt="Profile Picture" class="pfp">
            </div>

            <p>{{ $patient->FirstName }} {{ $patient->LastName }}</p>
            <hr>
        @endforeach
    @endsection


