<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class QuizzeRating extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public function exam(){
        return $this->belongsTo(QuizzeExam::class, 'exam_id');
    }
}
