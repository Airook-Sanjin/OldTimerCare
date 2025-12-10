@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Employee List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Salary</th>
            </tr>
        </thead>

        <tbody>
        @foreach($employees as $emp)
            <tr>
                <td>{{ $emp->EmployeeID }}</td>
                <td>{{ $emp->Name }}</td>
                <td>{{ $emp->RoleName }}</td>
                <td>${{ number_format($emp->Salary, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <hr>

    <h3>Update Salary</h3>

    <form method="POST" action="{{ route('employees.updateSalary') }}">
        @csrf

        <div class="form-group">
            <label>Employee ID</label>
            <input type="number" name="employee_id" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label>New Salary</label>
            <input type="number" step="0.01" name="salary" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Salary</button>
    </form>

</div>
@endsection
