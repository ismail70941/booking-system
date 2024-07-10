@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Book a Meeting Room</h1>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Book a Room</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->room }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
