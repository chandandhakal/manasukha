<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mental_health_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'PHQ9' or 'GAD7'
            $table->integer('total_score');
            $table->json('answers');
            $table->text('severity_level');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mental_health_assessments');
    }
}; 