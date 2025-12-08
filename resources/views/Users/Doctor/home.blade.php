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
            <div style="display: flex; flex-direction: row; justify-content: space-between;"><h2 class="container-title">Today's Appointment</h2> <h2 class="container-title">{{ \Carbon\Carbon::now()->format('m-d-Y') }}</h2></div>
            <div class="today-containter">
                    <div class="view-container">
                      @forelse ($todaysAppointments as $appointment)
                        <div class="apointment-view">
                            <div class="small-pfp">
                                <img src="{{ $appointment->ProfileImage }}" alt="" class="small-pfp">
                            </div>
                            <div class="app-view-info">
                                <h2>{{ $appointment->PatientName }}</h2>
                                <h2>{{ \Carbon\Carbon::parse($appointment->Date)->format('g:iA') }}</h2>
                            </div>
                        </div>
                    @empty
                        <p class="appt-info">No appointments today.</p>
                    @endforelse
                    </div>
            </div>
        </div>
    @endsection

    @section('Middle-Bottom')
        <div class="container-div">
            <h2 class="container-title">Schedule Appointment / Write notes for patient</h2>
            <div class="today-containter-bottom">
                <form action="{{ route('doctor.appointments.create') }}" method="POST">
                    @csrf

                    <div class="shedule-app">
                        <select name="patient_id" id="patient-select">
                            <option value="">Select Patient</option>
                            @foreach ($patients as $p)
                                <option value="{{ $p->PatientID }}">
                                    {{ $p->PatientName }}
                                </option>
                            @endforeach
                        </select>

                        <input type="datetime-local" name="date">

                        <input type="text" name="note" placeholder="Appointment note">

                        <button type="submit">Apply</button>
                    </div>
                </form>                
            </div>
            
        </div>
    @endsection

    {{-- Section below shows the patient of the doctor --}}
@section('Right-Column')
    <h3>Today's Patients</h3>
    @forelse ($todaysAppointments as $appointment)
        <div class="pfp">
            <img src="{{ $appointment->ProfileImage }}" alt="Profile Picture" class="pfp">
        </div>
        <p>{{ $appointment->PatientName }}</p>
        <p>Note: {{ $appointment->Notes }}</p>
        <hr>
    @empty
        <p class="appt-info">No appointments today.</p>
    @endforelse
@endsection




