@extends('Skeletons.Header&Footer')

@section('content')
<h1>Payment Management</h1>

{{-- SEARCH PATIENT FORM --}}
<h3>Search Patient</h3>
<form method="GET" action="{{ route('payment.page') }}">
    <label>Patient ID:</label>
    <input type="number" name="search_id" value="{{ request('search_id') }}" required>
    <button type="submit">Search</button>
</form>

<hr>

{{-- SHOW PATIENT DETAILS IF FOUND --}}
@if(isset($selectedPatient))
    <h3>Patient Info</h3>
    <p><strong>Name:</strong> {{ $selectedPatient->FirstName }} {{ $selectedPatient->LastName }}</p>
    <p><strong>Current Balance:</strong> ${{ number_format($selectedPatient->Total, 2) }}</p>

    {{-- PAYMENT FORM --}}
    <h3>Make a Payment</h3>
    <form method="POST" action="{{ route('payment.make') }}">
        @csrf
        <input type="hidden" name="patient_id" value="{{ $selectedPatient->PatientID }}">

        <label>Payment Amount:</label>
        <input type="number" step="0.01" name="amount" required>

        <button type="submit">Submit Payment</button>
    </form>

@endif

<hr>

{{-- LIST ALL PATIENTS --}}
<h3>All Patients</h3>
<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Balance</th>
    </tr>
    @foreach ($patients as $p)
        <tr>
            <td>{{ $p->PatientID }}</td>
            <td>{{ $p->FirstName }} {{ $p->LastName }}</td>
            <td>${{ number_format($p->Total, 2) }}</td>
        </tr>
    @endforeach
</table>

@endsection
