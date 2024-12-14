@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $typeName }}</h1>
    <div class="progress mb-4">
        <div class="progress-bar" role="progressbar" 
             style="width: {{ ($questionNumber / $totalQuestions) * 100 }}%">
            Question {{ $questionNumber }} of {{ $totalQuestions }}
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Question {{ $questionNumber }}</h5>
            <p class="card-text">{{ $question }}</p>

            <form action="{{ route('assessment.save-answer', ['type' => $type, 'number' => $questionNumber]) }}" 
                  method="POST">
                @csrf
                <div class="form-group">
                    <div class="btn-group-vertical w-100" role="group">
                        <button type="submit" name="answer" value="0" 
                                class="btn btn-outline-primary mb-2 {{ $previousAnswer === 0 ? 'active' : '' }}">
                            Not at all
                        </button>
                        <button type="submit" name="answer" value="1" 
                                class="btn btn-outline-primary mb-2 {{ $previousAnswer === 1 ? 'active' : '' }}">
                            Several days
                        </button>
                        <button type="submit" name="answer" value="2" 
                                class="btn btn-outline-primary mb-2 {{ $previousAnswer === 2 ? 'active' : '' }}">
                            More than half the days
                        </button>
                        <button type="submit" name="answer" value="3" 
                                class="btn btn-outline-primary {{ $previousAnswer === 3 ? 'active' : '' }}">
                            Nearly every day
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        @if($questionNumber > 1)
            <a href="{{ route('assessment.question', ['type' => $type, 'number' => $questionNumber - 1]) }}" 
               class="btn btn-secondary">Previous</a>
        @else
            <div></div>
        @endif

        @if($questionNumber < $totalQuestions)
            <a href="{{ route('assessment.question', ['type' => $type, 'number' => $questionNumber + 1]) }}" 
               class="btn btn-primary">Skip</a>
        @endif
    </div>
</div>
@endsection 