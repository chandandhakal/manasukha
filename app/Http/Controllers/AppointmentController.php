<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'therapist_id' => 'required|exists:users,id',
            'date' => 'required|date|after:today',
            'time' => 'required'
        ]);

        $appointment = Appointment::create([
            'user_id' => auth()->id(),
            'therapist_id' => $validated['therapist_id'],
            'date' => $validated['date'],
            'time' => $validated['time'],
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment booked successfully!');
    }

    public function index()
    {
        $appointments = Appointment::where('user_id', auth()->id())
            ->with('therapist')
            ->orderBy('date', 'asc')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            abort(403);
        }

        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment cancelled successfully.');
    }
} 