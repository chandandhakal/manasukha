<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class TherapistAppointmentController extends Controller
{
    public function index()
    {
        // Ensure only therapists can access this
        if (!auth()->user()->hasRole('therapist')) {
            abort(403);
        }

        $appointments = Appointment::where('therapist_id', auth()->id())
            ->with('user')
            ->orderBy('date', 'asc')
            ->get();

        return view('therapist.appointments.index', compact('appointments'));
    }

    public function updateStatus(Appointment $appointment, Request $request)
    {
        // Verify the therapist owns this appointment
        if ($appointment->therapist_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:confirmed,cancelled'
        ]);

        $appointment->update([
            'status' => $validated['status']
        ]);

        return redirect()->back()
            ->with('success', 'Appointment status updated successfully.');
    }
} 