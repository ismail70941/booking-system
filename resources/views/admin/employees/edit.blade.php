@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Employee</h1>
    <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}" required>
        </div>
        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" class="form-control" id="department" name="department" value="{{ $employee->department }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Employee</button>
    </form>
</div>
@endsection
