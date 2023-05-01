<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Model\AttendExam;
use App\Model\ExamFree;
use App\Model\QuizzeAnswer;
use App\Model\QuizzeCompline;
use App\Model\QuizzeExam;
use App\Model\QuizzeQuestion;
use App\Model\QuizzeRating;
use App\Model\Transaction\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function Sodium\compare;

class QuizzeController extends Controller
{

    public function __construct() { $this->middleware('prevent-back-history'); $this->middleware('auth'); }

    public function viewQuizzeComplainReport(){
        $complains = QuizzeCompline::where('receiver', Auth::id())->with('user', 'question')->get();
//        $complains = json_decode(json_encode($complains));
//        echo "<pre>"; print_r($complains);die;
        return view('quizze.quizze_complain', compact('complains'));
    }


    public function add_quizze(Request $request){

        return view('quizze.add_quizze');
    }

    public function view_quizze(){
        $quizzes = QuizzeQuestion::where('user_id', Auth::id())->get();
        return view('quizze.quizze', compact('quizzes'));
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

            $mcq = new QuizzeQuestion();
            $mcq->user_id = Auth::id();
            $mcq->question_name = $data['question_name'];
            $mcq->option1 = $data['option1'];
            $mcq->option2 = $data['option2'];
            $mcq->option3 = $data['option3'];
            $mcq->option4 = $data['option4'];
            $mcq->answer = $data['answer'];
            $mcq->type = $data['type'];
            $mcq->node = $data['node'];
            $mcq->duration = $data['duration'];
            $mcq->save();
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

            $mcq = new QuizzeQuestion();
            $mcq->user_id = Auth::id();
            $mcq->question_name = $data['question_name'];
            $mcq->option1 = $data['option1'];
            $mcq->option2 = $data['option2'];
            $mcq->answer = $data['answer'];
            $mcq->type = $data['type'];
            $mcq->node = $data['node'];
            $mcq->duration = $data['duration'];
            $mcq->save();
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

            $mcq = new QuizzeQuestion();
            $mcq->user_id = Auth::id();
            $mcq->question_name = $data['question_name'];
            $mcq->answer = $data['answer'];
            $mcq->type = $data['type'];
            $mcq->node = $data['node'];
            $mcq->duration = $data['duration'];
            $mcq->save();
            return redirect()->back();
        }
    }




    public function viewQuizzeExam(){
        $exams = QuizzeExam::where('user_id', Auth::id())->get();
        return view('quizze.exam.exam_quizze', compact('exams'));
    }

    public function addQuizzeExam(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'exam_title' => 'required',
                'exam_date' => 'required'
            ]);

            $exam = new QuizzeExam();
            $exam->user_id = Auth::id();
            $exam->exam_title = $data['exam_title'];
            $exam->exam_date = $data['exam_date'];
            $exam->start_time = $exam['start_time'];
            $exam->end_time = $data['end_time'];
            $exam->duration = $data['duration'];
            $exam->save();
            return redirect()->back();

        }
        return view('quizze.exam.add_exam_quizze');
    }

    public function addQuizzeExamQuestionUser($id){
        return view('quizze.exam.question.add_exam_question', compact('id'));
    }

    public function userEditExam(Request $request, $id){
        $exam = QuizzeExam::where('id', $id)->first();
        if ($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'exam_title' => 'required',
                'exam_date' => 'required'
            ]);

            QuizzeExam::where('id', $id)->update(['exam_title' => $data['exam_title'], 'exam_date' => $data['exam_date'], 'start_time' => $data['start_time'], 'end_time' => $data['end_time'], 'duration' => $data['duration']]);
            return redirect()->back();
        }

        return view('quizze.exam.edit_exam_quizze', compact('exam'));
    }

    public function userDeleteExam($id){
        QuizzeExam::where('id', $id)->delete();
        $questions = QuizzeQuestion::where('quizze_exam_id', $id)->get();

        foreach ($questions as $question) {
            $question->delete();
        }
        return redirect()->back();
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

            $mcq = new QuizzeQuestion();
            $mcq->quizze_exam_id = $data['id'];
            $mcq->user_id = Auth::id();
            $mcq->question_name = $data['question_name'];
            $mcq->option1 = $data['option1'];
            $mcq->option2 = $data['option2'];
            $mcq->option3 = $data['option3'];
            $mcq->option4 = $data['option4'];
            $mcq->answer = $data['answer'];
            $mcq->type = $data['type'];
            $mcq->node = $data['node'];
            $mcq->duration = $data['duration'];
            $mcq->save();
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

            $mcq = new QuizzeQuestion();
            $mcq->quizze_exam_id = $data['id'];
            $mcq->user_id = Auth::id();
            $mcq->question_name = $data['question_name'];
            $mcq->option1 = $data['option1'];
            $mcq->option2 = $data['option2'];
            $mcq->answer = $data['answer'];
            $mcq->type = $data['type'];
            $mcq->node = $data['node'];
            $mcq->duration = $data['duration'];
            $mcq->save();
            return redirect()->back();
        }
    }




    public function writtenExam(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'question_name' => 'required',
                'answer' => 'required',
            ]);

            $mcq = new QuizzeQuestion();
            $mcq->quizze_exam_id = $data['id'];
            $mcq->user_id = Auth::id();
            $mcq->question_name = $data['question_name'];
            $mcq->answer = $data['answer'];
            $mcq->type = $data['type'];
            $mcq->node = $data['node'];
            $mcq->duration = $data['duration'];
            $mcq->save();
            return redirect()->back();
        }
    }


    public function viewQuizzeExamQuestionUser($id){
        $quizzes = QuizzeQuestion::where('quizze_exam_id', $id)->get();
        return view('quizze.exam.question.view_exam_question', compact('quizzes'));
    }

    public function deleteExamQuestion($id){
        QuizzeQuestion::where('id', $id)->delete();
        return redirect()->back();
    }





    public function bvonQuizze(){
        $ans = QuizzeAnswer::where('user_id', Auth::id())->get();
        $questions = QuizzeQuestion::where('quizze_exam_id', NULL)->inRandomOrder()->limit(1)->get();
        foreach ($ans as $an) {
            $questions = QuizzeQuestion::where('quizze_exam_id', NULL)->where('id', '!=', $an->question_id)->inRandomOrder()->limit(1)->get();
        }
//        $questions = json_decode(json_encode($questions));
//        echo "<pre>"; print_r($questions); die;
        return view('quizze.user.quizze', compact('questions'));
    }

    public function bvonQuizzeSubmit(Request $request){

//        if($request->isMethod('post')){
            $question = QuizzeQuestion::where('id', $request->id)->first();
            $answer = new QuizzeAnswer();
            $answer->question_id = $request->id;
            $answer->user_id = Auth::id();
            $answer->answers = $request->ans;
            $answer->types = $question->type;
            $answer->right_answers = $question->answer;
            $answer->save();

            $answer = QuizzeAnswer::where(['question_id'=> $request->id, 'user_id'=> Auth::id()])->first();
            $right = 0;
            $wrong = 0;
            if($answer->answers == $answer->right_answers){
                $right = 1;
            }else{
                $wrong = 1;
            }

            $rattingC = QuizzeRating::where(['user_id'=> Auth::id()])->count();
            $rattingd = QuizzeRating::where(['user_id'=> Auth::id()])->first();
            if($rattingC > 0){
                $percentage = (($rattingd->right + $right) *100) / ($rattingd->wrong+$rattingd->right+$wrong+$right);

                QuizzeRating::where('user_id',Auth::id())->update(['right' => $rattingd->right+$right, 'wrong' => $rattingd->wrong+$wrong, 'ratting' => $percentage]);
            }else{
                $percentage = ($right * 100) /1;
                $ratting = new QuizzeRating();
                $ratting->user_id = Auth::id();
                $ratting->right = $right;
                $ratting->wrong = $wrong;
                $ratting->ratting = $percentage;
                $ratting->save();
            }


            return response()->json();
//        }

    }



    public function bvonQuizzeExam(){
        $exams = QuizzeExam::where('exam_date', '>=', date('Y-m-d'))->leftJoin('exam_frees', 'exam_frees.exam_id', 'quizze_exams.id')->select('quizze_exams.id','quizze_exams.exam_title', 'quizze_exams.exam_date', 'quizze_exams.start_time', 'quizze_exams.end_time', 'quizze_exams.duration', 'quizze_exams.exam_free', 'exam_frees.user_id', 'exam_frees.exam_id')->get();
//        $exams = json_decode(json_encode($exams));
//        echo "<pre>"; print_r($exams);die;
//        $ans = ExamFree::where('user_id', Auth::id())->get();
//        foreach ($ans as $an) {
//            $exams = QuizzeExam::where('exam_date', '>=', date('Y-m-d'))->where('id', '!=', $an->exam_id)->get();
//        }
        return view('quizze.exam.exam.add_quizze_exam', compact('exams'));
    }

    public function bvonQuizzeExamFree(Request $request){
        if($request->isMethod('post')){
            if(Auth::user()->balance() >= $request->free){
                $free = new ExamFree();
                $free->exam_id = $request->id;
                $free->user_id = Auth::id();
                $free->exam_frees = $request->free;
                $free->save();

                Transaction::create([
                    'user_id' => Auth::id(),
                    'category' => 'quizze_exam_free',
                    'amount_type' => 'd',
                    'amount' => $request->free,
                    'data' => '',
                    'message' => 'Quizze Exam Free',
                    'check_date'=> date('Y-m-d')
                ]);

                return response()->json([
                    'message'=> 'Successfully Done'
                ]);


            }else{
                return response()->json([
                    'message'=> 'Insufficient balance'
                ]);
            }


        }
    }


    public function bvonQuizzeExamStart($id){
        $questions = QuizzeQuestion::where('quizze_exam_id', $id)->get();
        $exam = QuizzeExam::where('id',$id)->first();
       return view('quizze.exam.exam.start.exam_start', compact('questions', 'exam'));
    }


    public function bvonQuizzeExamStartSubmit(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
//            echo "<pre>"; print_r($data);die;
            for($i=0; $i <= $data['key']; $i++){
                $question = QuizzeQuestion::where('id', $data['question_id'.$i])->first();
                $answer = new QuizzeAnswer();
                $answer->exam_id = $data['exam_id'];
                $answer->question_id = $data['question_id'.$i];
                $answer->answers = $data['answer'.$i];
                $answer->user_id = Auth::id();
                $answer->right_answers = $question->answer;
                $answer->types = $question->type;
                $answer->save();
            }
            $attend = new AttendExam();
            $attend->exam_id = $data['exam_id'];
            $attend->user_id = Auth::id();
            $attend->attend_date = date('Y-m-d');
            $attend->save();
            $exam_id = $data['exam_id'];
            return redirect('/bvon/quizze/start/exam/start/ok/thanks/'.$exam_id);
        }

    }



    public function bvonQuizzeExamStartThanks($id){
        $questions = QuizzeQuestion::where('quizze_exam_id', $id)->leftJoin('quizze_answers', 'quizze_answers.question_id', 'quizze_questions.id')->get();
        $exam = QuizzeExam::where('id',$id)->first();
        $rightans = QuizzeAnswer::where('exam_id', $id)->where('user_id', Auth::id())->get();
        $i = 0;

        foreach ($rightans as $rightan) {
            if($rightan->answers == $rightan->right_answers){
                $i++;
            }
        }
        $rightcount = $i;
        $countQuestion =  QuizzeQuestion::where('quizze_exam_id', $id)->count();
//        $questions = json_decode(json_encode($questions));
//        echo "<pre>"; print_r($rightcount); die;
        return view('quizze.exam.exam.start.exam_result', compact('questions', 'exam', 'rightcount', 'countQuestion'));
    }




    public function bvonQuizzExamRatting(){
        $exams = QuizzeExam::with('attend')->get();
//        $exams = json_decode(json_encode($exams));
//        echo "<pre>"; print_r($exams); die;

        return view('quizze.exam.ratting.exam_ratting', compact('exams'));
    }


    public function bvonQuizzExamRattingQuestion($id){
        $questions = QuizzeQuestion::where('quizze_exam_id', $id)->get();
        return view('quizze.exam.ratting.question_view', compact('questions'));
    }


    public function bvonQuizzExamUserRattingQuestion($id){

        $ansers = QuizzeAnswer::where('exam_id', $id)
            ->whereRaw('answers = right_answers')->with('user')
            ->select('*',DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->orderBy('total', 'desc')
            ->orderBy('created_at', 'asc')
            ->get();
        return view('quizze.exam.ratting.user_ratting', compact('ansers'));
    }




        public function bvonQuizzExamRattingG(){
            $generalRatting = QuizzeRating::with('user')->orderByDesc('ratting')->get();
//            $generalRatting = json_decode(json_encode($generalRatting));
//            echo "<pre>"; print_r($generalRatting); die;

            return view('quizze.exam.ratting.general_ratting', compact('generalRatting'));
        }

        public function bvonStartQuestionComplainSubmit(Request $request){
            $complain = new QuizzeCompline();
            $complain->question_id = $request->id;
            $complain->receiver = $request->receiver;
            $complain->sender = Auth::id();
            $complain->message = $request->message;
            $complain->save();
            return response()->json();

        }















}
