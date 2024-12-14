@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-3">Mental Health Assessments</h1>
        <p class="text-lg text-gray-600">Complete these assessments to track your mental well-being</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-6">
        @foreach($assessmentStatus as $type => $assessment)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden 
                {{ $assessment['completed'] ? 'border-l-4 border-green-500' : 'border-l-4 border-gray-300' }}">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-xl font-semibold mb-1 
                                {{ $assessment['completed'] ? 'text-green-600' : 'text-gray-800' }}">
                                {{ $assessment['name'] }}
                            </h2>
                            <p class="text-gray-600">{{ $assessment['description'] }}</p>
                        </div>
                        @if($assessment['completed'])
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-600">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Completed
                            </span>
                        @endif
                    </div>
                    
                    <div class="flex space-x-6 mb-6">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm">5-10 minutes</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm">{{ $type === 'gad7' ? '7' : '9' }} questions</span>
                        </div>
                    </div>
                    
                    @if($assessment['completed'])
                        <button disabled 
                            class="w-full py-3 px-4 bg-green-50 text-green-600 rounded-lg font-medium flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Completed Today
                        </button>
                    @else
                        <a href="{{ route('assessment.question', ['type' => $type, 'number' => 1]) }}" 
                           class="w-full py-3 px-4 bg-indigo-600 text-white rounded-lg font-medium flex items-center justify-center hover:bg-indigo-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                            </svg>
                            Start Assessment
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 