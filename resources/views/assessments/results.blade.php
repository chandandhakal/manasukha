@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Your Assessment Results</h1>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- PHQ-9 Results -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-semibold mb-4">Depression Screening (PHQ-9)</h2>
                @if($phq9)
                    <div class="space-y-4">
                        <div>
                            <p class="text-gray-600">Total Score:</p>
                            <p class="text-2xl font-bold">{{ $phq9->score }}/27</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Severity Level:</p>
                            <p class="text-lg font-semibold">{{ $severity_level }}</p>
                        </div>
                    </div>
                @else
                    <p>No assessment data available.</p>
                @endif
            </div>

            <!-- GAD-7 Results -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-semibold mb-4">Anxiety Screening (GAD-7)</h2>
                @if($gad7)
                    <div class="space-y-4">
                        <div>
                            <p class="text-gray-600">Total Score:</p>
                            <p class="text-2xl font-bold">{{ $gad7->total_score }}/21</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Severity Level:</p>
                            <p class="text-lg font-semibold">{{ $gad7_severity_level }}</p>
                        </div>
                    </div>
                @else
                    <p>No assessment data available.</p>
                @endif
            </div>
        </div>

        <div class="mt-8 text-center">
            <p class="text-gray-600 mb-4">
                These results are for screening purposes only and do not constitute a medical diagnosis.
                Please consult with a mental health professional for proper evaluation and treatment.
            </p>
            <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700">
                Continue to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection 