@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Book a Meeting Room</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('bookings.storePublic') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Meeting Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label for="organizer">Organizer</label>
            <select class="form-control" id="organizer" name="organizer" required>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('organizer') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="room">Room</label>
            <input type="text" class="form-control" id="room" name="room" value="{{ old('room') }}" required>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
        </div>
        <div class="form-group">
            <label for="participants">Participants</label>
            <select class="form-control" id="participants" name="participants[]" multiple required>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ (collect(old('participants'))->contains($employee->id)) ? 'selected' : '' }}>{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Book Room</button>
    </form>
</div>
@endsection
