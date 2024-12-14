@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 mb-0">{{ $typeName }}</h1>
                <span class="badge bg-primary px-3 py-2">Question {{ $questionNumber }}/{{ $totalQuestions }}</span>
            </div>

            <div class="progress mb-5" style="height: 8px;">
                <div class="progress-bar" role="progressbar" 
                     style="width: {{ ($questionNumber / $totalQuestions) * 100 }}%"
                     aria-valuenow="{{ ($questionNumber / $totalQuestions) * 100 }}"
                     aria-valuemin="0" 
                     aria-valuemax="100">
                </div>
            </div>

            <div class="card question-card">
                <div class="card-body p-4">
                    <h2 class="card-title h4 mb-4">{{ $question }}</h2>

                    <p class="text-muted mb-4">Over the last 2 weeks, how often have you been bothered by this problem?</p>

                    <form action="{{ route('assessment.save-answer', ['type' => $type, 'number' => $questionNumber]) }}" 
                          method="POST">
                        @csrf
                        <div class="answer-options">
                            @foreach([
                                ['value' => 0, 'label' => 'Not at all'],
                                ['value' => 1, 'label' => 'Several days'],
                                ['value' => 2, 'label' => 'More than half the days'],
                                ['value' => 3, 'label' => 'Nearly every day']
                            ] as $option)
                                <button type="submit" 
                                        name="answer" 
                                        value="{{ $option['value'] }}" 
                                        class="btn answer-btn {{ $previousAnswer === $option['value'] ? 'active' : '' }}">
                                    {{ $option['label'] }}
                                </button>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                @if($questionNumber > 1)
                    <a href="{{ route('assessment.question', ['type' => $type, 'number' => $questionNumber - 1]) }}" 
                       class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Previous
                    </a>
                @else
                    <div></div>
                @endif

                @if($questionNumber < $totalQuestions)
                    <a href="{{ route('assessment.question', ['type' => $type, 'number' => $questionNumber + 1]) }}" 
                       class="btn btn-outline-primary">
                        Skip<i class="fas fa-arrow-right ms-2"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .question-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .progress {
        border-radius: 10px;
        background-color: #e9ecef;
    }

    .progress-bar {
        background-color: #4361ee;
        transition: width 0.3s ease;
    }

    .badge {
        font-weight: 500;
        font-size: 0.9rem;
        border-radius: 8px;
    }

    .answer-options {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .answer-btn {
        text-align: left;
        padding: 16px 20px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        background-color: white;
        transition: all 0.2s ease;
        font-size: 1rem;
        color: #495057;
    }

    .answer-btn:hover {
        border-color: #4361ee;
        background-color: #f8f9ff;
        transform: translateX(5px);
    }

    .answer-btn.active {
        border-color: #4361ee;
        background-color: #4361ee;
        color: white;
    }

    .btn-outline-secondary,
    .btn-outline-primary {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-outline-secondary:hover,
    .btn-outline-primary:hover {
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .container {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .h2 {
            font-size: 1.5rem;
        }

        .answer-btn {
            padding: 12px 16px;
        }
    }
</style>
@endpush
@endsection 