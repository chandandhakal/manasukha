<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TherapistController extends Controller
{
    public function index()
    {
        $therapistRoleId = \TCG\Voyager\Models\Role::where('name', 'therapist')->first()->id;
        $therapists = User::where('role_id', $therapistRoleId)->get();

        return view('therapists.index', compact('therapists'));
    }
} 