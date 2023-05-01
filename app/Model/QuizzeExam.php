<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QuizzeExam extends Model
{
    protected $dates = ['start_time', 'end_time', 'exam_date'];
    protected $casts = [
        'created_at'  => 'date:Y-m-d',
//        'exam_date'  => 'date:Y-m-d',
//        'start_time'  => 'date: H:i:s',
//        'end_time'  => 'date: H:i:s a',
        'updated_at' => 'datetime:Y-m-d',
    ];
    public function attend(){
        return $this->hasMany(AttendExam::class, 'exam_id');
    }
}
