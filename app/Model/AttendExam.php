<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class AttendExam extends Model
{
    public function exam(){
        return $this->belongsTo(QuizzeExam::class, 'exam_id');
    }

    public function answer(){
        return $this->hasMany(QuizzeAnswer::class, 'exam_id', 'exam_id');
    }

    public function question(){
        return $this->hasMany(QuizzeQuestion::class, 'quizze_exam_id', 'exam_id');
    }




//    public function examine(){
//        return $this->belongsTo(QuizzeExam::class, 'exam_id');
//    }


}
