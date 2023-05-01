<?php

namespace App\Http\Controllers\FrontEnd;

use App\DesignationSalary;
use App\Http\Controllers\Controller;
use App\Model\DailyHistory;
use App\Model\DesignationStatus;
use App\Model\MachHistory;
use App\Model\Maching;
use App\Model\Matrix;
use App\Model\Transaction\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function history(){
//        $maches = MachHistory::where('user_id', Auth::id())->get();
//        $machefirst = Maching::where('user_id', Auth::id())->get();

        $allHistories = MachHistory::where('user_id', Auth::id())->leftJoin('users', 'users.id', 'mach_histories.user_id')->select('mach_histories.left_position', 'mach_histories.middle_position', 'mach_histories.right_position', 'mach_histories.minimum', 'mach_histories.total', 'mach_histories.created_at', 'users.name', 'users.referral_id', 'users.type', 'users.id')->groupBy('user_id')->get();
        $historiess = DailyHistory::where('user_id', Auth::id())->with('user')->get();
        $allTransaction = Transaction::where([ 'user_id' => Auth::id(), 'category'=> 'level_match_bonus'])->pluck('amount')->sum();
        return view('history.mach_history', compact('allTransaction', 'allHistories', 'historiess'));
    }

    public function historySalary(){
        $designation = Matrix::with('user')->where('user_id', Auth::id())->first();
        $status = DesignationStatus::where('user_id', Auth::id())->first();
//        $designations = json_decode(json_encode($designations));
//        echo "<pre>"; print_r($designations); die;
        return view('history.designation_month_salary', compact('designation', 'status'));
    }

    public function historyDesignationSalary($type){
        $type = strtolower($type).'_package_bonus';
//        echo $type;die;

        $transactions = Transaction::where(['user_id'=> Auth::id(), 'category' => $type])->get();
        return view('history.designation_transactions', compact('transactions'));
    }


    public function addMatrixGeneral(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            $user = explode("-", $request->user_name);
            $this->insert_into_matrix($user[0], $user[1]);
            $parent_id= $this->find_parent_id($data['parent_name']);
            $this->place_under_placement_id($parent_id, $user[1]);
            return redirect()->back();
        }
        $placements = User::with('matrices')->where('referred_by', Auth::user()->referral_id)->where('type', '!=', 'GU')->get();
        $placementu = User::where('id', Auth::id())->where('type', '!=', 'GU')->first();
        $userm =  User::with('matrices')->where("type", '!=', 'GU')->where('referred_by',  Auth::user()->referral_id)->get();
//        $userm = json_decode(json_encode($placements));
//        echo "<pre>"; print_r($userm); die;
        return view('history.add_matrix', compact('placements', 'placementu', 'userm'));
    }







    protected  function place_under_placement_id($parent_id, $agent_id){
        $data = Matrix::where('referral_id', $parent_id)->first();
        $position = ($data->left_position == null) ? 'left_position':(($data->middle_position == null)? 'middle_position': 'right_position');
        $posCount = ($data->left_position == null) ? 'left':(($data->middle_position == null)? 'middle': 'right');
        Matrix::where('referral_id', $agent_id)->update(['parent_id'=> $parent_id, 'position' =>$posCount]);
        Matrix::where('referral_id', $parent_id)->update([$position=> $agent_id]);
//      echo $parent_id;die;
        $this->binary_count($parent_id,$posCount);
    }


    protected function insert_into_matrix($agent_id1, $agent_id2){
        $matrix = new Matrix();
        $matrix->user_id =$agent_id1;
        $matrix->referral_id = $agent_id2;
        $matrix->save();
    }

    protected  function find_parent_id($my_id){
        $arr = [$my_id];
        while (!empty($arr)){
            $temp_array = [];

            for ($i = 0; $i < count($arr); $i++){
                if($this->check_place_available_or_not($arr[$i])){
                    return $arr[$i];
                }else{
                    $id = $arr[$i];
                    $data = Matrix::where('referral_id', $id)->first();

                    $left_id = $data->left_position;
                    $middle_id = $data->middle_position;
                    $right_id = $data->right_position;
                    array_push($temp_array, $left_id, $middle_id, $right_id);
                }
            }
            $arr = $temp_array;
        }
    }



    protected function check_place_available_or_not($agent_id){
        $data = Matrix::where('referral_id', $agent_id)->first();
        if($data->left_position == null || $data->middle_position == null || $data->right_position == null){
            return true;
        }else{
            return false;
        }
    }



    function binary_count($spons, $pos){
        if($pos == 'left'){
            $pos = "left_count";
        }else if($pos == 'middle'){
            $pos = "middle_count";

        }else if($pos == 'right'){
            $pos = "right_count";
        }
        Matrix::where('referral_id', $spons)->update([$pos => 1]);
        while(true){
            if($spons != 50920200000) {
                $pos = $this->position($spons);
                $spons = $this->sponserId($spons);
                if ($pos == 'left_count') {
                    $fect = Matrix::where('referral_id', $spons)->first();
                    $post = $fect->left_count + 1;
                } else if ($pos == 'middle_count') {
                    $fect = Matrix::where('referral_id', $spons)->first();
                    $post = $fect->middle_count + 1;
                } else if ($pos == 'right_count') {
                    $fect = Matrix::where('referral_id', $spons)->first();
                    $post = $fect->right_count + 1;
                }

                Matrix::where('referral_id', $spons)->update([$pos => $post]);
            }
            if($spons == 50920200000)break;
        }
    }

    protected function sponserId($spid){
        $data = Matrix::where('referral_id', $spid)->first();
        return $data->parent_id;
    }


    function position($s_id){

        $data = Matrix::where('referral_id', $s_id)->first();
        $pos =  $data->position;
        if($pos == 'left'){
            $pos = "left_count";
        }else if($pos == 'middle'){
            $pos = "middle_count";

        }else if($pos == 'right'){
            $pos = "right_count";
        }
        return $pos;

    }





    public function viewMatrixGeneral(){
        return view('history.view_matrix');
    }


    public function viewMatrixGeneralSearch(Request $request){
        $data = $request->all();
        $maxtrix =  Matrix::where('referral_id', $data['query'])->first();
        if(auth()->user()->matrix->id <= $maxtrix->id){
            $query = $data['query'];
        }else{
            $query = Auth::user()->referral_id;
        }

        return view('history.view_search_matrix', compact('query'));
    }


    public function viewMatrixGeneralView($id){
        $maxtrix =  Matrix::where('referral_id', $id)->first();
        if(auth()->user()->matrix->id <= $maxtrix->id){
            $query = $id;
        }else{
            $query = Auth::user()->referral_id;
        }

        return view('history.view_matrix_view', compact('query'));
    }






}
