@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Book a Meeting Room</h1>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Meeting Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="room">Room</label>
            <input type="text" class="form-control" id="room" name="room" required>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
        </div>
        <button type="submit" class="btn btn-primary">Book Room</button>
    </form>
</div>
@endsection
