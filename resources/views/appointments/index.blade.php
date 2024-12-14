@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-3">My Appointments</h1>
        <p class="text-lg text-gray-600">Manage your upcoming therapy sessions</p>
    </div>

    @if(session('success'))
        <div class="mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        @if($appointments->isEmpty())
            <div class="p-8 text-center">
                <p class="text-gray-500 text-lg">You don't have any appointments scheduled.</p>
                <a href="{{ route('therapists.index') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Book an Appointment
                </a>
            </div>
        @else
            <ul role="list" class="divide-y divide-gray-200">
                @foreach($appointments as $appointment)
                    <li>
                        <div class="px-6 py-4 flex items-center justify-between">
                            <div class="flex items-center">
                                <img class="h-12 w-12 rounded-full object-cover" 
                                     src="{{ $appointment->therapist->profile->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($appointment->therapist->name) }}" 
                                     alt="{{ $appointment->therapist->name }}">
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">
                                        Dr. {{ $appointment->therapist->name }}
                                    </h3>
                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($appointment->date)->format('l, F j, Y') }} at 
                                        {{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="px-3 py-1 rounded-full text-sm font-medium 
                                    @if($appointment->status === 'confirmed') 
                                        bg-green-100 text-green-800
                                    @elseif($appointment->status === 'pending')
                                        bg-yellow-100 text-yellow-800
                                    @else
                                        bg-gray-100 text-gray-800
                                    @endif
                                ">
                                    {{ ucfirst($appointment->status ?? 'Pending') }}
                                </span>
                                <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                        Cancel
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection 