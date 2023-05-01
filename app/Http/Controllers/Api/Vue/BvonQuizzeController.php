<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Model\AttendExam;
use App\Model\QuizzeAnswer;
use App\Model\QuizzeExam;
use App\Model\QuizzeQuestion;
use App\Model\QuizzeRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BvonQuizzeController extends Controller
{
    public function addQuizzeExam(Request $request){
        $exam = new QuizzeExam();
        $exam->user_id =Auth::id();
        $exam->exam_title = $request->exam_title;
        $exam->exam_date = $request->exam_date;
        $exam->exam_free = $request->exam_free;
        $exam->start_time = $request->exam_start;
        $exam->end_time = $request->exam_end;
        $exam->duration = $request->exam_duration;
        $exam->save();
        return response()->json(['message'=> 'Exam Successfully Added!', 'type' => 'success']);
    }


    public function viewQuizzeExam(){
        return QuizzeExam::where('user_id', Auth::id())->get();
    }

    public function addQuizzeExamQuestion(Request $request){
        $question = new QuizzeQuestion();
        $question->quizze_exam_id = $request->exam_id;
        $question->user_id = Auth::id();
        $question->question_name = $request->question_title;
        $question->option1 = $request->answer_option1;
        $question->option2 = $request->answer_option2;
        $question->option3 = $request->answer_option3;
        $question->option4 = $request->answer_option4;

        $question->answer = $request->right_answer;
        $question->type = $request->type;
        $question->duration = $request->duration;
        $question->node = $request->node;
        $question->save();
        return response()->json(['message'=> 'Exam Question Added Successfully Added!', 'type'=> 'success']);
    }




    public function viewQuizzeExamQuestion($id){
        return QuizzeQuestion::where(['quizze_exam_id'=> $id, 'user_id'=> Auth::id()])->with('exam')->get();
    }
    public function deleteQuizeExam($id){
        QuizzeExam::where('id', $id)->delete();
        return response()->json(['message' => 'Quizze Exam Delete Successfully', 'type' => 'error']);
    }

    public function getQuizzeExamSingle($id){
        return QuizzeExam::where('id', $id)->first();
    }


    public function editQuizzeExam(Request $request, $id){
//        \Log::info($request->exam_date);
        QuizzeExam::where(['id'=> $id, 'user_id'=> Auth::id()])->update(['exam_title'=> $request->exam_title, 'exam_date' => $request->exam_date, 'duration'=> $request->exam_duration, 'exam_free' => $request->exam_free, 'start_time' => $request->exam_start, 'end_time' => $request->exam_end]);
        return response()->json(['message'=> 'Exam Updated Successfully done', 'type' => 'success']);
    }



    public function addGeneralQuizzeQuestion(Request $request ){
        $question = new QuizzeQuestion();
        $question->quizze_exam_id = null;
        $question->user_id = Auth::id();
        $question->question_name = $request->question_title;
        $question->option1 = $request->answer_option1;
        $question->option2 = $request->answer_option2;
        $question->option3 = $request->answer_option3;
        $question->option4 = $request->answer_option4;

        $question->answer = $request->right_answer;
        $question->type = $request->type;
        $question->duration = $request->duration;
        $question->node = $request->node;
        $question->save();
        return response()->json(['message'=> 'General Question Added Successfully Added!', 'type'=> 'success']);
    }


    public function viewGeneralQuizzeQuestion(){
        return QuizzeQuestion::where(['quizze_exam_id'=> NULL, 'user_id'=> Auth::id()])->get();
    }

    public function viewGeneralSingleQuizzeQuestion($id){
        return QuizzeQuestion::where(['id'=> $id, 'user_id' => Auth::id()])->first();
    }

    public function editGeneralQuizzeQuestion(Request $request, $id){

        QuizzeQuestion::where(['id'=> $id, 'user_id'=> Auth::id()])->update(['question_name'=> $request->question_title, 'option1'=> $request->answer_option1, 'option2' => $request->answer_option2, 'option3' => $request->answer_option3, 'option4' => $request->answer_option4, 'duration' => $request->duration, 'node' => $request->node, 'answer' => $request->right_answer]);
        return response()->json(['message' => 'General Question Updated Successfully Done !', 'type' => 'success']);
    }




    public function deleteGeneralQuizzeQuestion($id){
        QuizzeQuestion::where(['id'=> $id, 'user_id' => Auth::id()])->delete();

        return response()->json(['message' => 'General Question Delete Successfully', 'type' => 'error']);
    }

    public  function getSingleExamQuestion($id, $examId){
        return QuizzeQuestion::where(['id'=> $id, 'quizze_exam_id' => $examId, 'user_id' => Auth::id()])->first();
    }


    public function getExamQuestionUpdate(Request $request, $id, $examId){
        QuizzeQuestion::where(['id'=> $id, 'user_id'=> Auth::id(), 'quizze_exam_id' => $examId])->update(['question_name'=> $request->question_title, 'option1'=> $request->answer_option1, 'option2' => $request->answer_option2, 'option3' => $request->answer_option3, 'option4' => $request->answer_option4, 'duration' => $request->duration, 'node' => $request->node, 'answer' => $request->right_answer]);
        return response()->json(['message' => 'General Question Updated Successfully Done !', 'type' => 'success']);
    }


    public function deleteBvonQuizzeExamQuestion($id){
        QuizzeQuestion::where(['id' => $id, 'user_id' => Auth::id()])->first();
        return response()->json(['message' => 'Delete Exam Question Successfully!', 'type' => 'error']);
    }





    public function bvonGeneralQuizzeSingle(){
        $allAnswer = QuizzeAnswer::where('user_id', Auth::id())->get();
            $result = QuizzeQuestion::where('quizze_exam_id',null);
        foreach ($allAnswer as $ans){
            $result->where('id', '!=', $ans->question_id);
        }
        $result = $result->inRandomOrder()->first();
        return $result;

    }

    public function bvonGeneralQuizzeSingleSubmit(Request $request){

        if($request->option1 != null){
            $ans = $request->option1;
        }elseif ($request->option2 != null){
            $ans = $request->option2;
        }elseif ($request->option3 != null){
            $ans = $request->option3;
        }elseif ($request->option4 != null){
            $ans = $request->option4;
        }else{
            $ans = null;
        }

        $answer = new QuizzeAnswer();
        $answer->exam_id = null;
        $answer->question_id = $request->id;
        $answer->user_id = Auth::id();
        $answer->answers = $ans;
        $answer->right_answers = $request->answer;
        $answer->types = $request->type;
        $answer->save();

        $answer = QuizzeAnswer::where(['question_id'=> $request->id, 'user_id'=> Auth::id(), 'exam_id' => NULL])->first();
        $right = 0;
        $wrong = 0;
        if($answer->answers == $answer->right_answers){
            $right = 1;
        }else{
            $wrong = 1;
        }

        $rattingC = QuizzeRating::where(['user_id'=> Auth::id(), 'exam_id' => NULL])->count();
        $rattingd = QuizzeRating::where(['user_id'=> Auth::id(), 'exam_id' => NULL])->first();
        if($rattingC > 0){
            $percentage = (($rattingd->right + $right) *100) / ($rattingd->wrong+$rattingd->right+$wrong+$right);
            QuizzeRating::where(['user_id'=> Auth::id(), 'exam_id' => NULL])->update(['right' => $rattingd->right+$right, 'wrong' => $rattingd->wrong+$wrong, 'ratting' => $percentage]);
        }else{
            $percentage = ($right * 100) /1;
            $ratting = new QuizzeRating();
            $ratting->user_id = Auth::id();
            $ratting->exam_id = NULL;
            $ratting->right = $right;
            $ratting->wrong = $wrong;
            $ratting->ratting = $percentage;
            $ratting->save();
        }

        return response()->json(['message' => 'Successfully done!', 'type' => 'success']);

    }


    public function bvonGeneralQuizzeRankShow(){
        return  $generalRatting = QuizzeRating::with('user')->orderByDesc('ratting')->get();
    }


    public function bvonExamQuizzeSingle($id){

        $question = QuizzeQuestion::where(['quizze_exam_id' => $id])->get();
        $exam = QuizzeExam::where(['id' => $id])->first();
        return response()->json(['questions' => $question, 'exam' => $exam]);
    }

    public function bvonExamQuizzeSubmit(Request $request){

        $attendExamCount = AttendExam::where(['exam_id'=> $request->exam_id, 'user_id' => Auth::id()])->count();

        if($attendExamCount == 0){

            $examQuestion = QuizzeQuestion::where('quizze_exam_id', $request->exam_id)->get();

            foreach ($examQuestion as $key => $item){
                if($request->option[$key] != null){
                    $answer = new QuizzeAnswer();
                    $answer->exam_id = $request->exam_id;
                    $answer->question_id = $item->id;
                    $answer->user_id = Auth::id();
                    $answer->answers = $request->option[$key];
                    $answer->right_answers = $item->answer;
                    $answer->types = $item->type;
                    $answer->save();


                }

            }

            $answers = QuizzeAnswer::where(['user_id'=> Auth::id(), 'exam_id' =>  $request->exam_id])->get();

            foreach ($answers as $answer) {
                $right = 0;
                $wrong = 0;
                if($answer->answers == $answer->right_answers){
                    $right = 1;
                }else{
                    $wrong = 1;
                }

                $rattingC = QuizzeRating::where(['user_id'=> Auth::id(), 'exam_id' => $request->exam_id])->count();
                $rattingd = QuizzeRating::where(['user_id'=> Auth::id(), 'exam_id' => $request->exam_id])->first();
                if($rattingC > 0){
                    $percentage = (($rattingd->right + $right) *100) / ($rattingd->wrong+$rattingd->right+$wrong+$right);
                    QuizzeRating::where(['user_id'=> Auth::id(), 'exam_id' => $request->exam_id])->update(['right' => $rattingd->right+$right, 'wrong' => $rattingd->wrong+$wrong, 'ratting' => $percentage]);
                }else{
                    $percentage = ($right * 100) /1;
                    $ratting = new QuizzeRating();
                    $ratting->user_id = Auth::id();
                    $ratting->exam_id = $request->exam_id;
                    $ratting->right = $right;
                    $ratting->wrong = $wrong;
                    $ratting->ratting = $percentage;
                    $ratting->save();
                }
            }

            $attend = new AttendExam();
            $attend->user_id = Auth::id();
            $attend->exam_id = $request->exam_id;
            $attend->attend_date = date('dd-mm-yyyy');
            $attend->save();


            return response()->json(['message' => 'Your exam successfully done !!', 'type' => 'success']);


        }else{

            return response()->json(['message' => 'Your are already attend this exam !!', 'type' => 'error']);
        }

    }

    public function bvonAllExamQuizzeGet(){
//        $wonAllExam =  AttendExam::where('user_id', Auth::id())->with('exam', 'examine')->with()->get();
//        foreach ($wonAllExam as $item){
//            $count = AttendExam::where('exam_id', $item->exam_id)->count();
//        }

        $users = AttendExam::where('user_id', Auth::id())->with('exam')
            ->select('*')
            ->selectRaw('count(*) as user_count, exam_id')
            ->groupBy('exam_id')
            ->get();

     return $users;


    }


    public function bvonExamQuizzeRank($id){
        return QuizzeRating::where('exam_id', $id)->with('exam', 'user')->orderByDesc('ratting')->get();
    }


    public function bvonExamQuizzeAllQuestion($id){
        return QuizzeQuestion::where('quizze_exam_id', $id)->get();
    }

    public function bvonExamQuizzeOwnDetails($id){
//         AttendExam::where(['exam_id' => $id, 'user_id' => Auth::id()])->with('exam', 'answer', 'question')->get();
        $ownAnsQuestion = QuizzeAnswer::where(['exam_id' => $id, 'user_id' => Auth::id()])->with('questions')->get();

        return $ownAnsQuestion;
    }










}
