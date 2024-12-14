<?php

namespace App\Http\Controllers;

use App\Models\MentalHealthAssessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function showQuestionnaire()
    {
        return view('assessments.questionnaire');
    }

    public function submitQuestionnaire(Request $request)
    {
        $request->validate([
            'phq9_answers' => 'required|array|size:9',
            'phq9_answers.*' => 'required|integer|between:0,3',
            'gad7_answers' => 'required|array|size:7',
            'gad7_answers.*' => 'required|integer|between:0,3',
        ]);

        // Process PHQ-9
        $phq9_score = array_sum($request->phq9_answers);
        MentalHealthAssessment::create([
            'user_id' => auth()->id(),
            'type' => 'PHQ9',
            'total_score' => $phq9_score,
            'answers' => $request->phq9_answers,
            'severity_level' => MentalHealthAssessment::getSeverityLevel('PHQ9', $phq9_score)
        ]);

        // Process GAD-7
        $gad7_score = array_sum($request->gad7_answers);
        MentalHealthAssessment::create([
            'user_id' => auth()->id(),
            'type' => 'GAD7',
            'total_score' => $gad7_score,
            'answers' => $request->gad7_answers,
            'severity_level' => MentalHealthAssessment::getSeverityLevel('GAD7', $gad7_score)
        ]);

        return redirect()->route('assessment.results');
    }

    public function showResults()
    {
        $phq9 = auth()->user()->mentalHealthAssessments()
            ->where('type', 'PHQ9')
            ->latest()
            ->first();

        $gad7 = auth()->user()->mentalHealthAssessments()
            ->where('type', 'GAD7')
            ->latest()
            ->first();

        return view('assessments.results', compact('phq9', 'gad7'));
    }
} 