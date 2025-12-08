@extends('Skeletons/Header&Footer')
@section('title','Pending Approvals')
@section('content')
@csrf

<h1>Admin Approval Panel</h1>

<h2>Pending Patients</h2>
<table border="1" cellpadding="6">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

    @foreach ($pendingPatients as $p)
        <tr>
            <td>{{ $p->FirstName }} {{ $p->LastName }}</td>
            <td>{{ $p->Email }}</td>
            <td>
                <form action="/admin/approve/patient/{{ $p->PatientID }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Approve</button>
                </form>

                <form action="/admin/reject/patient/{{ $p->PatientID }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="color:red;">Reject</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<br><br>

<h2>Pending Family Members</h2>
<table border="1" cellpadding="6">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

    @foreach ($pendingFamily as $f)
        <tr>
            <td>{{ $f->FirstName }} {{ $f->LastName }}</td>
            <td>{{ $f->Email }}</td>
            <td>
                <form action="/admin/approve/family/{{ $f->FamilyMemberID }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Approve</button>
                </form>

                <form action="/admin/reject/family/{{ $f->FamilyMemberID }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="color:red;">Reject</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

@endsection

