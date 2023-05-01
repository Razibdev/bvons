<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BSubject extends Model
{
    protected $fillable =['course_id', 'teacher_id'];
    public function course(){
        return $this->hasOne(BCourse::class, 'id', 'course_id');
    }

    public function teacher(){
        return $this->hasOne(BTeacher::class, 'id', 'teacher_id');
    }

    public function teachers(){
        return $this->hasMany(BTeacher::class, 'subject_id');
    }
}
