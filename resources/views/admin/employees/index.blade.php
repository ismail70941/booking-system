@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employees</h1>
    <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">Add Employee</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->department }}</td>
                    <td>
                        <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection