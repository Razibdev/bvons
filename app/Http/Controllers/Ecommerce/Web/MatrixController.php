<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use App\Modal\CommissionRelation;
use App\Model\DailyHistory;
use App\Model\DesignationStatus;
use App\Model\MachHistory;
use App\Model\Maching;
use App\Model\Matrix;
use App\Model\Transaction\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatrixController extends Controller
{
    public function addMatrix(Request $request){
        $users = User::where("type", '!=', 'GU')->get();
        $userm =  User::with('matrices')->where("type", '!=', 'GU')->get();
        if($request->isMethod('post')){
            $data = $request->all();
            $user = explode("-", $request->user_name);
            $this->insert_into_matrix($user[0], $user[1]);
           $parent_id= $this->find_parent_id($data['parent_name']);
           $this->place_under_placement_id($parent_id, $user[1]);
            return redirect()->back();

        }
        return view('matrix.matrix', compact('users', 'userm'));
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



























    public function upViewMatrix($account){

        $data_fetch = Matrix::where('referral_id', $account)->first();
        $query = $data_fetch->parent_id;
        return view('matrix.up_view_matrix', compact('query'));
    }




    public function deleteDefaultMatrix($id){
        Matrix::where('left_position', $id)->update(['left_position'=>NULL]);
        Matrix::where('middle_position', $id)->update(['middle_position'=>NULL]);
        Matrix::where('right_position', $id)->update(['right_position'=>NULL]);
        Matrix::where('referral_id', $id)->delete();
        return redirect()->back();

    }

    public function viewDefaultMatrix($id){
        $query = $id;
        return view('matrix.search_matrix', compact('query'));
    }






    public function viewMatrix(){

        return view('matrix.view_matrix');
    }

    public function searchMatrix(Request $request){
        $data = $request->all();
        $query = $data['query'];
        return view('matrix.search_matrix', compact('query'));
    }


    public function viewMatrixLine(){
        $level_sponsor ='050920200000';
        $matrices = Matrix::query();
        if(request()->has('users')){
            $matrices->where('parent_id', request('users'));
        }else{
            $matrices->where('parent_id', $level_sponsor);
        }
        $matrices = $matrices->with("user")->get();
        return view('matrix.line_matrix', compact('matrices'));
    }


    function check_my_downline($user_id, $login_id){
        $data = Matrix::where('referral_id', $user_id)->get();
        $spon_id = $data->parent_id;

        while($spon_id != null){
            if($spon_id == $login_id){
                return true;
            }else{
                $data = Matrix::where('referral_id', $user_id)->get();
                $spon_id = $data->parent_id;
            }
        }

        if($spon_id == 0){
            return false;
        }
    }


    public function viewMatrixPosition(){
        $matrixs = Matrix::get();
        return view('matrix.matrix_position', compact('matrixs'));
    }


    public function viewMatrixHistory($id){
        $allHistories = MachHistory::where('user_id', $id)->leftJoin('users', 'users.id', 'mach_histories.user_id')->select('mach_histories.left_position', 'mach_histories.middle_position', 'mach_histories.right_position', 'mach_histories.minimum', 'mach_histories.total', 'mach_histories.created_at', 'users.name', 'users.referral_id', 'users.type', 'users.id')->groupBy('user_id')->get();
        $historiess = DailyHistory::where('user_id',$id)->with('user')->get();
        $allTransaction = Transaction::where([ 'user_id' => $id, 'category'=> 'level_match_bonus'])->pluck('amount')->sum();
        return view('matrix.matrix_history', compact( 'allHistories', 'historiess','allTransaction'));
    }


    public function viewMatrixDesignationHistory($id){
        $designation = Matrix::with('user')->where('user_id', $id)->first();
        $status = DesignationStatus::where('user_id', $id)->first();
        return view('matrix.admin_matrix_designation', compact('designation', 'status'));
    }

    public function viewMatrixDesignationSalary($id, $type){
        $type = strtolower($type).'_package_bonus';
        $transactions = Transaction::where(['user_id'=> $id, 'category' => $type])->get();
        return view('matrix.admin_matrix_designation_salary', compact('transactions', 'type'));
    }


    public function moDesignationComment(Request $request){
        $checkdesc = DesignationStatus::where(['user_id' => $request->user_id, 'matrix_id' => $request->id])->count();
        if($checkdesc > 0){
            if($request->type == 'MO'){
                DesignationStatus::where(['user_id' => $request->user_id, 'matrix_id' => $request->id])->update(['MO' => $request->value]);
            }
            else if($request->type == 'SMO'){
                DesignationStatus::where(['user_id' => $request->user_id, 'matrix_id' => $request->id])->update(['SMO' => $request->value]);
            }else if($request->type == 'MEx'){
                DesignationStatus::where(['user_id' => $request->user_id, 'matrix_id' => $request->id])->update(['Mex' => $request->value]);
            }else if($request->type == 'SMEx'){
                DesignationStatus::where(['user_id' => $request->user_id, 'matrix_id' => $request->id])->update(['SMex' => $request->value]);
            }else if($request->type == 'RMM'){
                DesignationStatus::where(['user_id' => $request->user_id, 'matrix_id' => $request->id])->update(['RMM' => $request->value]);
            }else if($request->type == 'MM'){
                DesignationStatus::where(['user_id' => $request->user_id, 'matrix_id' => $request->id])->update(['MM' => $request->value]);
            }else if($request->type == 'SMM'){
                DesignationStatus::where(['user_id' => $request->user_id, 'matrix_id' => $request->id])->update(['SMM' => $request->value]);
            }else if($request->type == 'AGM'){
                DesignationStatus::where(['user_id' => $request->user_id, 'matrix_id' => $request->id])->update(['AGM' => $request->value]);
            }else if($request->type =='GM'){
                DesignationStatus::where(['user_id' => $request->user_id, 'matrix_id' => $request->id])->update(['GM' => $request->value]);
            }
        }else{
            $status = new DesignationStatus();
            $status->user_id = $request->user_id;
            $status->matrix_id = $request->id;
            $status->MO = $request->value;
            $status->save();
        }
        return response()->json(['message'=> 'done']);
    }




}
