<?php

namespace App\Http\Controllers\Dashboard\Quizze;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class QuizzeSectionController extends Controller
{
    public function addTeacher(Request $request){
        $users = User::where('type', '!=', 'GU')->get();

;        if($request->isMethod('post')){
            $user = explode('-', $request->referred_id);
//            \Log::info($user[0]);

            User::where('id', $user[0])->update(['quizze'=> 1]);
            return redirect('dashboard/bvon-quizze/view-quizze-teacher');
        }
        return view('dashboard.quizze.teacher.add_teacher', compact('users'));
    }

    public function viewTeacher(){
        $users = User::where('quizze',1)->get();
        return view('dashboard.quizze.teacher.view_teacher', compact('users'));

    }


    public function deleteTeacherFromQuizze(Request $request){
        User::where('id', $request->id)->update(['quizze'=> 0]);
        return response()->json();
    }
}
