<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::where('employee_id', Auth::id())->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bookings.create');
    }

    public function createPublic()
    {
        $employees = Employee::all();
        return view('bookings.createPublic', compact('employees'));
    }

    /**
 * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'room' => 'required',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
            ]);
    
            Booking::create([
                'employee_id' => Auth::id(),
                'title' => $request->title,
                'room' => $request->room,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
    
            return redirect()->route('bookings.index');           
        } catch (\Throwable $th) {
            return redirect()->back()->with($th->getMessage());
        }        
    }

    public function storePublic(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'organizer' => 'required|exists:employees,id',
            'room' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'participants' => 'required|array',
        ]);
        
        $conflict = Booking::where('room', $request->room)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('start_time', '<', $request->start_time)
                                ->where('end_time', '>', $request->end_time);
                      });
            })->exists();

        if ($conflict) {
            return redirect()->back()->withErrors(['conflict' => 'The selected time slot is already booked. Please choose a different time.'])->withInput();
        }

        $booking = Booking::create([
            'employee_id' => $request->organizer,
            'title' => $request->title,
            'room' => $request->room,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        $booking->participants()->sync($request->participants);

        return redirect()->route('calendar');
    }

    public function calendar()
    {
        return view('bookings.calendar');
    }

    public function data()
    {
        $bookings = Booking::with('employee')->get(['room', 'start_time', 'end_time', 'title', 'employee_id']);
        $events = $bookings->map(function ($booking) {
            return [
                'title' => $booking->title . ' (' . $booking->employee->name . ')',
                'start' => $booking->start_time,
                'end' => $booking->end_time,
                'room' => $booking->room,
            ];
        });

        return response()->json($events);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
