<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use App\Model\QuizzeCompline;
use App\Model\QuizzeExam;
use App\Model\QuizzeQuestion;
use App\User;
use Illuminate\Http\Request;

class QuizzeController extends Controller
{
    public function addQuiuzzeUser(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $request->validate([
                'user' => 'required',
                'quizze' => 'required',
            ]);


            if(empty($data['quizze_exam'])){
                $data['quizze_exam'] = 0;
            }else{
                $data['quizze_exam'] = 1;
            }

            User::where('id', $data['user'])->update(['quizze'=> $data['quizze'], 'quizze_exam' => $data['quizze_exam']]);

            return redirect()->back();
        }
        $users = User::where('type', '!=', 'GU')->get();
        return view('admin.quizze.add_quizze', compact('users'));
    }


    public function viewQuizzeUser(){
        $users = User::where('quizze', 1)->get();
        return view('admin.quizze.view_quizze', compact('users'));
    }


    public function editQuiuzzeUser(Request $request, $id){
        $userd = User::where('id', $id)->first();
            if($request->isMethod('post')){
                $data = $request->all();
                if(empty($data['quizze'])){
                    $data['quizze'] = 0;
                }else{
                    $data['quizze'] = 1;
                }

                if(empty($data['quizze_exam'])){
                    $data['quizze_exam'] = 0;
                }else{
                    $data['quizze_exam'] = 1;
                }
                User::where('id', $id)->update(['quizze' => $data['quizze'], 'quizze_exam' => $data['quizze_exam']]);

                return redirect()->back();
            }
        return view('admin.quizze.edit_quizze', compact('userd'));

    }




    public function addQuizzeQuestion(){

        return view('admin.quizze.add_quizze_question');
    }

    public function viewQuizzeQuestion(){

        $quizzes = QuizzeQuestion::orderByDesc("id")->get();
        return view('admin.quizze.quizze_question', compact('quizzes'));

    }


    public function mcq(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $request->validate([
                'question_name' => 'required',
                'option1' => 'required',
                'option2' => 'required',
                'option3' => 'required',
                'option4' => 'required',
                'answer' => 'required',
            ]);

            $quizze = new QuizzeQuestion();
            $quizze->question_name = $data['question_name'];
            $quizze->user_id = 21;
            $quizze->option1 = $data['option1'];
            $quizze->option2 = $data['option2'];
            $quizze->option3 = $data['option3'];
            $quizze->option4 = $data['option4'];
            $quizze->answer = $data['answer'];
            $quizze->type = $data['type'];
            $quizze->duration = $data['duration'];
            $quizze->node = $data['node'];
            $quizze->save();
            return redirect()->back();
        }
    }


    public function boolean(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $request->validate([
                'question_name' => 'required',
                'option1' => 'required',
                'option2' => 'required',
                'answer' => 'required',
            ]);

            $quizze = new QuizzeQuestion();
            $quizze->question_name = $data['question_name'];
            $quizze->user_id = 21;
            $quizze->option1 = $data['option1'];
            $quizze->option2 = $data['option2'];
            $quizze->answer = $data['answer'];
            $quizze->type = $data['type'];
            $quizze->duration = $data['duration'];
            $quizze->node = $data['node'];
            $quizze->save();
            return redirect()->back();
        }
    }



    public function written(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'question_name' => 'required',
                'option1' => 'required',
                'answer' => 'required',
            ]);

            $quizze = new QuizzeQuestion();
            $quizze->question_name = $data['question_name'];
            $quizze->user_id = 21;
            $quizze->option1 = $data['option1'];
            $quizze->answer = $data['answer'];
            $quizze->type = $data['type'];
            $quizze->duration = $data['duration'];
            $quizze->node = $data['node'];
            $quizze->save();
            return redirect()->back();
        }
    }

    public function addQuizzeExam(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'exam_title' => 'required',
                'exam_date' => 'required',
            ]);

            $exam = new QuizzeExam();
            $exam->user_id = 21;
            $exam->exam_title = $data['exam_title'];
            $exam->exam_date = $data['exam_date'];
            $exam->start_time = $data['start_time'];
            $exam->end_time = $data['end_time'];
            $exam->duration = $data['duration'];
            $exam->save();
            return redirect()->back();
        }
        return view('admin.quizze.exam.add_quizze_exam');
    }

    public function viewQuizzeExam(){
        $exams = QuizzeExam::all();
        return view('admin.quizze.exam.quizze_exam', compact('exams'));
    }

    public function editQuizzeExam(Request $request, $id){
        $exam = QuizzeExam::where('id', $id)->first();
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'exam_title' => 'required',
                'exam_date' => 'required',
            ]);

            QuizzeExam::where('id', $id)->update(['exam_title'=> $data['exam_title'], 'exam_date' => $data['exam_date'], 'start_time' => $data['start_time'], 'end_time' => $data['end_time'], 'duration' => $data['duration']]);
            return redirect()->back();
        }

        return view('admin.quizze.exam.edit_quizze_exam', compact('exam'));
    }


    public function deleteQuizzeExam($id){
        QuizzeExam::where('id', $id)->delete();
        $questions = QuizzeQuestion::where('quizze_exam_id', $id)->get();
        foreach ($questions as $question){
            $question->delete();
        }

        return redirect()->back();
    }


    public function addQuizzeExamQuestion($id){

     return view('admin.quizze.exam.question.add_quizze_question', compact('id'));
    }


    public function viewQuizzeExamQuestion($id){
        $quizzes = QuizzeQuestion::where('quizze_exam_id', $id)->get();
        return view('admin.quizze.exam.question.view_quizze_question', compact('quizzes'));
    }

    public function mcqExam(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'question_name' => 'required',
                'option1' => 'required',
                'option2' => 'required',
                'option3' => 'required',
                'option4' => 'required',
                'answer' => 'required',
            ]);

            $quizze = new QuizzeQuestion();
            $quizze->quizze_exam_id = $data['id'];
            $quizze->question_name = $data['question_name'];
            $quizze->user_id = 21;
            $quizze->option1 = $data['option1'];
            $quizze->option2 = $data['option2'];
            $quizze->option3 = $data['option3'];
            $quizze->option4 = $data['option4'];
            $quizze->answer = $data['answer'];
            $quizze->type = $data['type'];
            $quizze->duration = $data['duration'];
            $quizze->node = $data['node'];
            $quizze->save();
            return redirect()->back();
        }
    }


    public function booleanExam(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'question_name' => 'required',
                'option1' => 'required',
                'option2' => 'required',
                'answer' => 'required',
            ]);

            $quizze = new QuizzeQuestion();
            $quizze->quizze_exam_id = $data['id'];
            $quizze->question_name = $data['question_name'];
            $quizze->user_id = 21;
            $quizze->option1 = $data['option1'];
            $quizze->option2 = $data['option2'];
            $quizze->answer = $data['answer'];
            $quizze->type = $data['type'];
            $quizze->duration = $data['duration'];
            $quizze->node = $data['node'];
            $quizze->save();
            return redirect()->back();
        }
    }


    public function writtenExam(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'question_name' => 'required',
                'option1' => 'required',
                'answer' => 'required',
            ]);

            $quizze = new QuizzeQuestion();
            $quizze->quizze_exam_id = $data['id'];
            $quizze->question_name = $data['question_name'];
            $quizze->user_id = 21;
            $quizze->option1 = $data['option1'];
            $quizze->answer = $data['answer'];
            $quizze->type = $data['type'];
            $quizze->duration = $data['duration'];
            $quizze->node = $data['node'];
            $quizze->save();
            return redirect()->back();
        }

    }

    public function deleteExamQuestion($id){
        QuizzeQuestion::where('id', $id)->delete();
        return redirect()->back();
    }


    public function viewQuizzeComplain(){

        $complains = QuizzeCompline::with('question', 'user', 'receive')->get();
//        $complains = json_decode(json_encode($complains));
//        echo "<pre>"; print_r($complains);die;
        return view('admin.quizze.quizze_complain', compact('complains'));
    }












}
