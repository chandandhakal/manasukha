@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-3">Dashboard</h1>
        <p class="text-lg text-gray-600">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        @if(auth()->user()->hasRole('therapist'))
            <h2 class="text-2xl font-semibold mb-4">Your Therapy Practice</h2>
            <!-- Add therapist-specific dashboard content here -->
        @else
            <h2 class="text-2xl font-semibold mb-4">Your Mental Health Journey</h2>
            <!-- Add user-specific dashboard content here -->
        @endif
    </div>
</div>
@endsection 