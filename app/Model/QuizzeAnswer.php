<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class QuizzeAnswer extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function questions(){
        return $this->belongsTo(QuizzeQuestion::class, 'question_id');
    }


}
