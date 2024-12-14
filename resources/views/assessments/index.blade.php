@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5 justify-content-center">
        <div class="col-lg-8 text-center">
            <h1 class="display-4 mb-2">Mental Health Assessments</h1>
            <p class="text-muted lead">Complete these assessments to track your mental well-being</p>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row g-4">
                @foreach($assessmentStatus as $type => $assessment)
                    <div class="col-md-6">
                        <div class="card assessment-card h-100 {{ $assessment['completed'] ? 'completed' : '' }}">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h5 class="card-title h4 mb-1 {{ $assessment['completed'] ? 'text-success' : '' }}">
                                            {{ $assessment['name'] }}
                                        </h5>
                                        <p class="card-subtitle text-muted">{{ $assessment['description'] }}</p>
                                    </div>
                                    @if($assessment['completed'])
                                        <div class="status-badge">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Completed</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="assessment-info mb-4">
                                    <div class="info-item">
                                        <i class="far fa-clock text-muted"></i>
                                        <span>5-10 minutes</span>
                                    </div>
                                    <div class="info-item">
                                        <i class="far fa-question-circle text-muted"></i>
                                        <span>{{ $type === 'gad7' ? '7' : '9' }} questions</span>
                                    </div>
                                </div>
                                
                                @if($assessment['completed'])
                                    <button class="btn btn-success btn-lg w-100 disabled">
                                        <i class="fas fa-check me-2"></i>Completed Today
                                    </button>
                                @else
                                    <a href="{{ route('assessment.question', ['type' => $type, 'number' => 1]) }}" 
                                       class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-play-circle me-2"></i>Start Assessment
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .assessment-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        max-width: 500px;
        margin: 0 auto;
    }

    .assessment-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .assessment-card.completed {
        background: linear-gradient(to right bottom, #f8fff9, #ffffff);
        border-left: 5px solid #28a745;
    }

    .status-badge {
        background-color: #e8f5e9;
        color: #28a745;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .assessment-info {
        display: flex;
        gap: 20px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #4361ee;
        border-color: #4361ee;
    }

    .btn-primary:hover {
        background-color: #3a53d0;
        border-color: #3a53d0;
        transform: translateY(-2px);
    }

    .btn-success.disabled {
        background-color: #e8f5e9;
        border-color: #e8f5e9;
        color: #28a745;
        opacity: 1;
    }

    .display-4 {
        font-weight: 600;
        color: #2d3748;
    }

    .lead {
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .container {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        
        .display-4 {
            font-size: 2rem;
        }
        
        .assessment-info {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>
@endpush
@endsection 