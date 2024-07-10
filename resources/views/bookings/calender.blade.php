@extends('layouts.app')

@section('styles')
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css' rel='stylesheet' />
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">Meeting Room Calendar</h1>
    <div id="calendar"></div>
</div>
@endsection

@section('scripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/bookings/data',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                }
            });
            calendar.render();
        });
    </script>
@endsection
