<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentalHealthAssessment extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'total_score',
        'answers',
        'severity_level'
    ];

    protected $casts = [
        'answers' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getSeverityLevel($type, $score)
    {
        if ($type === 'PHQ9') {
            return match(true) {
                $score >= 20 => 'Severe depression',
                $score >= 15 => 'Moderately severe depression',
                $score >= 10 => 'Moderate depression',
                $score >= 5 => 'Mild depression',
                default => 'None-minimal'
            };
        }

        if ($type === 'GAD7') {
            return match(true) {
                $score >= 15 => 'Severe anxiety',
                $score >= 10 => 'Moderate anxiety',
                $score >= 5 => 'Mild anxiety',
                default => 'None-minimal'
            };
        }

        return 'Unknown';
    }
} 