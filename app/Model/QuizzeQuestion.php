<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QuizzeQuestion extends Model
{
    public function exam(){
        return $this->belongsTo(QuizzeExam::class, 'quizze_exam_id')->select('id', 'exam_title');
    }

    public function quizze_ans(){
        return $this->hasMany(QuizzeAnswer::class, 'question_id');
    }
}
