<?php

namespace App\Http\Controllers\Blearning;

use App\Http\Controllers\Controller;
use App\Model\BCourse;
use Illuminate\Http\Request;

class BlearningController extends Controller
{
    public function index(){

        $course = BCourse::where('top_course', 1)->latest()->first();
        $courses = BCourse::where('top_course', 0)->inRandomOrder()->limit(4)->get();

        return view('blearning.blearning', compact('course', 'courses'));
    }

    public function singlePageShow($url){
        $course = BCourse::where('course_url', $url)->with('subjects')->first();
//        $course = json_decode(json_encode($course));
//        echo "<pre>"; print_r($course);die;
        return view('blearning.single_blearning', compact('course'));
    }









}
