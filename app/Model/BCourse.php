<?php

namespace App\Model;

use App\BLearningCategory;
use Illuminate\Database\Eloquent\Model;

class BCourse extends Model
{
    public function category(){
        return $this->belongsTo(BLearningCategory::class, 'category_id');
    }



    public function subjects(){
        return $this->hasMany(BSubject::class,  'course_id');

    }
}
