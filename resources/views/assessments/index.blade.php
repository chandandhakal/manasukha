@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Available Assessments</h1>
    
    <div class="row">
        @foreach($assessmentStatus as $type => $assessment)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $assessment['name'] }}</h5>
                        <p class="card-text">{{ $assessment['description'] }}</p>
                        
                        @if($assessment['completed'])
                            <div class="alert alert-success">
                                Completed today
                            </div>
                        @else
                            <a href="{{ route('assessment.question', ['type' => $type, 'number' => 1]) }}" 
                               class="btn btn-primary">
                                Start Assessment
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 