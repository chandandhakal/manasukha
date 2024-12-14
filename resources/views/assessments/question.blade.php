@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">{{ $typeName }}</h1>
        <span class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium">
            Question {{ $questionNumber }}/{{ $totalQuestions }}
        </span>
    </div>

    <div class="w-full bg-gray-200 rounded-full h-2 mb-8">
        <div class="bg-indigo-600 h-2 rounded-full transition-all duration-300"
             style="width: {{ ($questionNumber / $totalQuestions) * 100 }}%">
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ $question }}</h2>

            <p class="text-gray-600 mb-6">
                Over the last 2 weeks, how often have you been bothered by this problem?
            </p>

            <form action="{{ route('assessment.save-answer', ['type' => $type, 'number' => $questionNumber]) }}" 
                  method="POST">
                @csrf
                <div class="space-y-3">
                    @foreach([
                        ['value' => 0, 'label' => 'Not at all'],
                        ['value' => 1, 'label' => 'Several days'],
                        ['value' => 2, 'label' => 'More than half the days'],
                        ['value' => 3, 'label' => 'Nearly every day']
                    ] as $option)
                        <button type="submit" 
                                name="answer" 
                                value="{{ $option['value'] }}" 
                                class="w-full text-left px-6 py-4 rounded-lg border-2 transition-all duration-200
                                    {{ $previousAnswer === $option['value'] 
                                        ? 'bg-indigo-600 text-white border-indigo-600' 
                                        : 'border-gray-200 text-gray-700 hover:border-indigo-600 hover:bg-indigo-50 hover:translate-x-2' }}">
                            {{ $option['label'] }}
                        </button>
                    @endforeach
                </div>
            </form>
        </div>
    </div>

    <div class="flex justify-between mt-6">
        @if($questionNumber > 1)
            <a href="{{ route('assessment.question', ['type' => $type, 'number' => $questionNumber - 1]) }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 
                      bg-white hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Previous
            </a>
        @else
            <div></div>
        @endif

        @if($questionNumber < $totalQuestions)
            <a href="{{ route('assessment.question', ['type' => $type, 'number' => $questionNumber + 1]) }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 
                      bg-white hover:bg-gray-50 transition-colors">
                Skip
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @endif
    </div>
</div>
@endsection 