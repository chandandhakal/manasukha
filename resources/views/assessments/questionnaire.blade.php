@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Mental Health Assessment</h1>
        
        <form action="{{ route('assessment.submit') }}" method="POST" class="space-y-8">
            @csrf
            
            <!-- PHQ-9 Section -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-semibold mb-4">PHQ-9: Depression Screening</h2>
                <p class="mb-4 text-gray-600">Over the last 2 weeks, how often have you been bothered by any of the following problems?</p>

                @php
                $phq9_questions = [
                    'Little interest or pleasure in doing things',
                    'Feeling down, depressed, or hopeless',
                    'Trouble falling or staying asleep, or sleeping too much',
                    'Feeling tired or having little energy',
                    'Poor appetite or overeating',
                    'Feeling bad about yourself or that you are a failure or have let yourself or your family down',
                    'Trouble concentrating on things, such as reading the newspaper or watching television',
                    'Moving or speaking so slowly that other people could have noticed. Or the opposite being so fidgety or restless that you have been moving around a lot more than usual',
                    'Thoughts that you would be better off dead, or of hurting yourself'
                ];
                @endphp

                @foreach($phq9_questions as $index => $question)
                <div class="mb-6">
                    <p class="mb-2">{{ $index + 1 }}. {{ $question }}</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach(['Not at all' => 0, 'Several days' => 1, 'More than half the days' => 2, 'Nearly every day' => 3] as $label => $value)
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="phq9_answers[{{ $index }}]" value="{{ $value }}" required
                                class="text-blue-600 focus:ring-blue-500">
                            <span class="text-sm">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <!-- GAD-7 Section -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-2xl font-semibold mb-4">GAD-7: Anxiety Screening</h2>
                <p class="mb-4 text-gray-600">Over the last 2 weeks, how often have you been bothered by the following problems?</p>

                @php
                $gad7_questions = [
                    'Feeling nervous, anxious, or on edge',
                    'Not being able to stop or control worrying',
                    'Worrying too much about different things',
                    'Trouble relaxing',
                    'Being so restless that it\'s hard to sit still',
                    'Becoming easily annoyed or irritable',
                    'Feeling afraid as if something awful might happen'
                ];
                @endphp

                @foreach($gad7_questions as $index => $question)
                <div class="mb-6">
                    <p class="mb-2">{{ $index + 1 }}. {{ $question }}</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach(['Not at all' => 0, 'Several days' => 1, 'More than half the days' => 2, 'Nearly every day' => 3] as $label => $value)
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="gad7_answers[{{ $index }}]" value="{{ $value }}" required
                                class="text-blue-600 focus:ring-blue-500">
                            <span class="text-sm">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Submit Assessment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 