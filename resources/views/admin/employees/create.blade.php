@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Employee</h1>
    <form action="{{ route('admin.employees.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="department">Department</label>
            <input type="text" class="form-control" id="department" name="department" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Employee</button>
    </form>
</div>
@endsection
