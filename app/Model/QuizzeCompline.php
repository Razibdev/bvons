<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class QuizzeCompline extends Model
{
    public function question(){
        return $this->belongsTo(QuizzeQuestion::class, 'question_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'sender');
    }

    public function receive(){
        return $this->belongsTo(User::class, 'receiver');
    }
}
