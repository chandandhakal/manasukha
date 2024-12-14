<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AssessmentController extends Controller
{
    private $assessmentTypes = [
        'gad7' => [
            'name' => 'GAD-7',
            'description' => 'Generalized Anxiety Disorder Assessment',
            'total_questions' => 7
        ],
        'phq9' => [
            'name' => 'PHQ-9',
            'description' => 'Patient Health Questionnaire',
            'total_questions' => 9
        ]
    ];

    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (auth()->user()->is_therapist) {
            return redirect()->route('home')->with('error', 'Therapists cannot access assessments.');
        }

        $user = auth()->user();
        $completedAssessments = Assessment::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->pluck('type')
            ->toArray();

        $assessmentStatus = [];
        foreach ($this->assessmentTypes as $type => $details) {
            $assessmentStatus[$type] = [
                'name' => $details['name'],
                'description' => $details['description'],
                'completed' => in_array($type, $completedAssessments),
            ];
        }

        return view('assessments.index', compact('assessmentStatus'));
    }

    public function showQuestion($type, $number)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (auth()->user()->is_therapist) {
            return redirect()->route('home')->with('error', 'Therapists cannot access assessments.');
        }

        if (!array_key_exists($type, $this->assessmentTypes)) {
            return redirect()->route('assessment.index')->with('error', 'Invalid assessment type.');
        }

        $totalQuestions = $this->assessmentTypes[$type]['total_questions'];
        
        if ($number < 1 || $number > $totalQuestions) {
            return redirect()->route('assessment.index')->with('error', 'Invalid question number.');
        }

        $question = $this->getQuestion($type, $number);
        $previousAnswer = session()->get("assessment.{$type}.{$number}");

        return view('assessments.question', [
            'type' => $type,
            'typeName' => $this->assessmentTypes[$type]['name'],
            'question' => $question,
            'questionNumber' => $number,
            'totalQuestions' => $totalQuestions,
            'previousAnswer' => $previousAnswer
        ]);
    }

    public function saveAnswer(Request $request, $type, $number)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (auth()->user()->is_therapist) {
            return redirect()->route('home')->with('error', 'Therapists cannot submit answers.');
        }

        $request->validate([
            'answer' => 'required|integer|between:0,3'
        ]);

        session()->put("assessment.{$type}.{$number}", $request->answer);

        $totalQuestions = $this->assessmentTypes[$type]['total_questions'];
        
        if ($number < $totalQuestions) {
            return redirect()->route('assessment.question', ['type' => $type, 'number' => $number + 1]);
        }
        // return redirect()->route('assessment.results')->with('success', 'Assessment completed successfully!');

        return redirect()->route('assessment.submit', ['type' => $type]);
    }

    private function getQuestion($type, $number)
    {
        // Define questions for each assessment type
        $questions = [
            'gad7' => [
                1 => 'Feeling nervous, anxious, or on edge',
                2 => 'Not being able to stop or control worrying',
                3 => 'Worrying too much about different things',
                4 => 'Trouble relaxing',
                5 => 'Being so restless that it\'s hard to sit still',
                6 => 'Becoming easily annoyed or irritable',
                7 => 'Feeling afraid as if something awful might happen'
            ],
            'phq9' => [
                1 => 'Little interest or pleasure in doing things',
                2 => 'Feeling down, depressed, or hopeless',
                3 => 'Trouble falling or staying asleep, or sleeping too much',
                4 => 'Feeling tired or having little energy',
                5 => 'Poor appetite or overeating',
                6 => 'Feeling bad about yourself',
                7 => 'Trouble concentrating on things',
                8 => 'Moving or speaking so slowly that other people could have noticed',
                9 => 'Thoughts that you would be better off dead or of hurting yourself'
            ]
        ];

        return $questions[$type][$number];
    }

    public function submitQuestionnaire($type)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        if (auth()->user()->is_therapist) {
            return redirect()->route('home')->with('error', 'Therapists cannot submit assessments.');
        }

        $answers = session()->get("assessment.{$type}");
        
        if (!$answers || count($answers) !== $this->assessmentTypes[$type]['total_questions']) {
            return redirect()->route('assessment.question', ['type' => $type, 'number' => 1])
                ->with('error', 'Please complete all questions.');
        }


        // Save assessment results to database
        $assessment = new Assessment();
        $assessment->user_id = auth()->id();
        $assessment->type = $type;
        $assessment->answers = json_encode($answers);
        $assessment->score = array_sum($answers);
        $assessment->save();

        // Clear session data for this assessment
        session()->forget("assessment.{$type}");

        return redirect()->route('assessment.results')->with('success', 'Assessment completed successfully!');
    }

    public function showResults()
    {
        // Get the authenticated user
        $user = auth()->user();
        
    
        $phq9 = Assessment::where('user_id', $user->id)
            ->where('type', 'phq9')
            ->latest()
            ->first();

            if($phq9){
                $severity_level = $this->getSeverityLevel($phq9->score);
            }
            else{
                $severity_level = 'No assessment data available.';
            }

        $gad7 = Assessment::where('user_id', $user->id)
            ->where('type', 'gad7')
            ->latest()
            ->first();

            if($gad7){
                $gad7_severity_level = $this->getSeverityLevel($gad7->score);
            }
            else{
                $gad7_severity_level = 'No assessment data available.';
            }

            
        return view('assessments.results', [
            'phq9' => $phq9,
            'gad7' => $gad7,
            'user' => $user,
            'severity_level' => $severity_level,
            'gad7_severity_level' => $gad7_severity_level,
        ]);
    }

    private function getSeverityLevel($score)
    {
        if ($score <= 4) {
            return 'Minimal';
        } elseif ($score <= 9) {
            return 'Mild';
        } else {
            return 'Moderate';
        }
    }
} 