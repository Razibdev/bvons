<?php
/**
 * Created by PhpStorm.
 * User: Kajal
 * Date: 8/2/2021
 * Time: 6:18 PM
 */

namespace App\Modal;


use App\App\Model\ComisionBonus;
use App\App\Model\CommissionRegister;
use App\DesignationSalary;
use App\Model\DailyHistory;
use App\Model\Dashboard\AdminSetting\AdminSetting;
use App\Model\Designation;
use App\Model\DesignationHistory;
use App\Model\DesignationSalaryAchievement;
use App\Model\DesignationSetting;
use App\Model\DesignationUsercount;
use App\Model\Ecommerce\Api\EcoOrder;
use App\Model\MachHistory;
use App\Model\Maching;
use App\Model\Matrix;
use App\Model\Post\Post;
use App\Model\Transaction\Transaction;
use App\ReseveFundUpdate;
use App\User;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use function Sodium\increment;

class CommissionRelation
{
    public  function postLikeCommissionSetting() {
        $setting = ComisionBonus::where([ 'daily_date' => date('Y-m-d', strtotime("-1 day"))])->pluck('post_like')->sum();
        return $setting;
    }

    public  function postCommentCommissionSetting() {
        $setting = ComisionBonus::where([ 'daily_date' => date('Y-m-d', strtotime("-1 day"))])->pluck('post_comment')->sum();
        return $setting;
    }

    public  function postShareCommissionSetting() {
        $setting = ComisionBonus::where([ 'daily_date' => date('Y-m-d', strtotime("-1 day"))])->pluck('post_share')->sum();
        return $setting;
    }

    public  function postCount() {
        $setting = Post::where([ 'now_date' => date('Y-m-d'), 'premium_post'=> 1])->count();
        return $setting;
    }


    public  function userCount() {
        $setting = User::where( 'type', '!=', 'GU')->count();
        return $setting;
    }

    // Daily Total Like commission buy total package
    public function totalLikeCommission(){
        $reserve = ReseveFundUpdate::where('id',1)->pluck('post_like_reserve')->sum();
        if($reserve == 0){
            if($this->postLikeCommissionSetting() != 0 &&  $this->postCount() != 0){
                return $this->postLikeCommissionSetting() / $this->postCount();
            }else{
                return $this->postLikeCommissionSetting();
            }
        }else{
            if($this->postLikeCommissionSetting() != 0 &&  $this->postCount() != 0){
                $amount = $reserve + $this->postLikeCommissionSetting();
                return $amount / $this->postCount();
            }else{
                return $reserve + $this->postLikeCommissionSetting();
            }
        }

    }
    //user daily like commission
    public function perUserLikePerDayCommission(){
        if($this->totalLikeCommission() != 0){
            $setting = $this->totalLikeCommission() / $this->userCount();
            return round($setting,2);
        }else{
            return 0;
        }
    }



    // Daily Total comment commission buy total package
    public function totalCommentCommission(){

        $reserve = ReseveFundUpdate::where('id',1)->pluck('post_comment_reserve')->sum();
        if($reserve == 0){
            if($this->postCommentCommissionSetting() != 0 &&  $this->postCount() != 0){
                return $this->postCommentCommissionSetting() / $this->postCount();
            }else{
                return $this->postCommentCommissionSetting();
            }
        }else{
            if($this->postCommentCommissionSetting() != 0 &&  $this->postCount() != 0){
                $amount = $reserve + $this->postCommentCommissionSetting();
                return $amount / $this->postCount();
            }else{
                return $reserve + $this->postCommentCommissionSetting();
            }
        }


    }
    //user comment per day commission
    public function perUserCommentPerDayCommission(){
        if($this->totalCommentCommission() != 0){
            $setting = $this->totalCommentCommission() / $this->userCount();
            return round($setting,2);
        }else{
            return 0;
        }
    }

    // Daily share commission buy total package
    public function totalShareCommission(){
        $reserve = ReseveFundUpdate::where('id',1)->pluck('post_share_reserve')->sum();
        if($reserve == 0) {
            if ($this->postShareCommissionSetting() != 0 && $this->postCount() != 0) {
                return $this->postShareCommissionSetting() / $this->postCount();
            } else {
                return $this->postShareCommissionSetting();
            }
        }else{
            if ($this->postShareCommissionSetting() != 0 && $this->postCount() != 0) {
                $amount = $reserve +  $this->postShareCommissionSetting() ;
                return $amount / $this->postCount();
            } else {
                return $reserve + $this->postShareCommissionSetting();
            }
        }
    }

    // per user share commission per day
    public function perUserSharePerDayCommission(){
        if($this->totalShareCommission() != 0){
            $setting = $this->totalShareCommission() / $this->userCount();
            return round($setting,2);
        }else{
            return 0;
        }
    }

    // *******
    // per day total like commission hit
    public function totalPerDateLikeCommissionHit(){
        return Transaction::where(['check_date'=> date('Y-m-d'), 'category'=> 'bp_like_bonus'])->pluck('amount')->sum();
    }

    //Per day like commission save
    public function totalPerDateLikeCommissionNotHit(){
        $amount = $this->totalLikeCommission() - $this->totalPerDateLikeCommissionHit();
        return round($amount,2);
    }

    // add save commission for next day in like
//    public function addLikeCommission(){
//        $amount = $this->totalLikeCommission() + ReseveFundUpdate::where('id', 1)->pluck('post_like_reserve')->sum();
//        return round($amount,2);
//    }
//******

    public function updateReservedFun($value){
       $count =  ReseveFundUpdate::count();
//       return $count;
       if($count > 0){
           ReseveFundUpdate::where('id', 1)->update(['post_like_reserve' => $value]);
       }else{
           ReseveFundUpdate::create(['post_like_reserve' => $value]);
       }
    }



// per day total like commission hit
    public function totalPerDateCommentCommissionHit(){
        return Transaction::where(['check_date'=> date('Y-m-d'), 'category'=> 'bp_comment_bonus'])->pluck('amount')->sum();
    }

    //Per day like commission save
    public function totalPerDateCommentCommissionNotHit(){
        $amount = $this->totalCommentCommission() - $this->totalPerDateCommentCommissionHit();
        return round($amount,2);
    }


    public function updateReservedFunComment($value){
        $count =  ReseveFundUpdate::count();
//       return $count;
        if($count > 0){
            ReseveFundUpdate::where('id', 1)->update(['post_comment_reserve' => $value]);
        }else{
            ReseveFundUpdate::create(['post_comment_reserve' => $value]);
        }
    }




    // *******
    // per day total like commission hit
    public function totalPerDateShareCommissionHit(){
        return Transaction::where(['check_date'=> date('Y-m-d'), 'category'=> 'bp_share_bonus'])->pluck('amount')->sum();
    }

    //Per day like commission save
    public function totalPerDateShareCommissionNotHit(){
        $amount = $this->totalCommentCommission() - $this->totalPerDateShareCommissionHit();
        return round($amount,2);
    }

    // add save commission for next day in like
//    public function addLikeCommission(){
//        $amount = $this->totalLikeCommission() + ReseveFundUpdate::where('id', 1)->pluck('post_like_reserve')->sum();
//        return round($amount,2);
//    }
//******

    public function updateReservedFunShare($value){
        $count =  ReseveFundUpdate::count();
//       return $count;
        if($count > 0){
            ReseveFundUpdate::where('id', 1)->update(['post_share_reserve' => $value]);
        }else{
            ReseveFundUpdate::create(['post_share_reserve' => $value]);
        }
    }



    public  function dailyTopSellerCommissionSetting() {
        $setting = ComisionBonus::where([ 'daily_date' => date('Y-m-d')])->pluck('daily_top_seller_bonus')->sum();
        return $setting;
    }


    public  function weeklyTopSellerCommissionSetting() {
        $setting = ComisionBonus::where( 'daily_date', '>=', date('Y-m-d', strtotime("-7 day")))->pluck('weakly_top_seller_bonus')->sum();
        return $setting;
    }


    public  function monthlyTopSellerCommissionSetting() {
        $setting = ComisionBonus::where( 'daily_date', '>=', date('Y-m-d', strtotime("-30 day")))->pluck('monthly_top_seller_bonus')->sum();
        return $setting;
    }

    public  function dailyTopCountSellerCommissionSetting() {
        $setting = DB::table('comision_bonuses')->where('daily_date', date('Y-m-d'))
            ->select('referrel_id')
            ->groupBy('referrel_id')
            ->orderBy(DB::raw('COUNT(referrel_id)'), 'DESC')
            ->take(5)
            ->get();
//        return $setting;
        foreach ($setting as  $item) {
//             print_r($item);
            foreach ($item as $value) {
                static $key = 0;
                $user = User::where('referral_id', $value)->first();
                $subscription_bonus_string = AdminSetting::getSetting('Daily Top Seller Bonus');
                $subscription_bonus_array = explode(",", $subscription_bonus_string);
                $limit = count($subscription_bonus_array);
                $level_bonus = $subscription_bonus_array;
                $amountss =  ((int)$this->dailyTopSellerCommissionSetting()/100);
                $amounts = $level_bonus[$key];
                $amount = $amountss * $amounts;

                if( $key >= $limit ) return "end";
                    Transaction::create([
                    "user_id" => $user->id,
                    "category" => "daily_top_seller_bonus",
                    "amount_type" => "c",
                    "amount" => $amount,
                    "data" => "",
                    "message" => ucfirst("You Get Daily Top Seller Bonus")
                ]);
                $key++;
            }
        }
       return "done";
    }



    public  function weeklyTopCountSellerCommissionSetting() {
        $setting = DB::table('comision_bonuses')->where('daily_date','>=', date('Y-m-d', strtotime("-7 day")))
            ->select('referrel_id')
            ->groupBy('referrel_id')
            ->orderBy(DB::raw('COUNT(referrel_id)'), 'DESC')
            ->take(5)
            ->get();
//        return $setting;
        foreach ($setting as  $item) {
//             print_r($item);
            foreach ($item as $value) {
                static $key = 0;
                $user = User::where('referral_id', $value)->first();
                $subscription_bonus_string = AdminSetting::getSetting('Weekly Top Seller Bonus');
                $subscription_bonus_array = explode(",", $subscription_bonus_string);
                $limit = count($subscription_bonus_array);
                $level_bonus = $subscription_bonus_array;
               $amountss =  ((int)$this->weeklyTopSellerCommissionSetting()/100);
               $amounts = $level_bonus[$key];
                $amount = $amountss * $amounts;

                if( $key >= $limit ) return "end";
                Transaction::create([
                    "user_id" => $user->id,
                    "category" => "weekly_top_seller_bonus",
                    "amount_type" => "c",
                    "amount" => $amount,
                    "data" => "",
                    "message" => ucfirst("You Get Weekly Top Seller Bonus")
                ]);
                $key++;
            }
        }
        return "done";
    }


    public  function monthlyTopCountSellerCommissionSetting() {
        $setting = DB::table('comision_bonuses')->where('daily_date','>=', date('Y-m-d', strtotime("-30 day")))
            ->select('referrel_id')
            ->groupBy('referrel_id')
            ->orderBy(DB::raw('COUNT(referrel_id)'), 'DESC')
            ->take(5)
            ->get();
//        return $setting;
        foreach ($setting as  $item) {
//             print_r($item);
            foreach ($item as $value) {
                static $key = 0;
                $user = User::where('referral_id', $value)->first();
                $subscription_bonus_string = AdminSetting::getSetting('Monthly Top Seller Bonus');
                $subscription_bonus_array = explode(",", $subscription_bonus_string);
                $limit = count($subscription_bonus_array);
                $level_bonus = $subscription_bonus_array;
                $amountss =  ((int)$this->monthlyTopSellerCommissionSetting()/100);
                $amounts = $level_bonus[$key];
                $amount = $amountss * $amounts;

                if( $key >= $limit ) return "end";
                Transaction::create([
                    "user_id" => $user->id,
                    "category" => "monthly_top_seller_bonus",
                    "amount_type" => "c",
                    "amount" => $amount,
                    "data" => "",
                    "message" => ucfirst("You Get Monthly Top Seller Bonus")
                ]);
                $key++;
            }
        }
        return "done";
    }


    public  function monthlyLeaderBonusCommissionSetting() {
        $setting = ComisionBonus::where( 'daily_date', '>=', date('Y-m-d', strtotime("-30 day")))->pluck('leader_bonus')->sum();
        return $setting;
    }


    public  function BPTOAMCount()
    {
        $setting = DB::table('users')
            ->where('type', 'BP')
            ->select('referred_by', DB::raw('count(referred_by) as total'))
            ->groupBy('referred_by')
            ->orderBy(DB::raw('COUNT(referred_by)'), 'DESC')
            ->get();

        foreach ($setting as $item) {

            if($item->total >= 30){
               User::where('referral_id', $item->referred_by)->update(['type'=> 'AM']);
            }

        }

    }



    public  function AMToDisMCount()
    {
        $setting = DB::table('users')
            ->where('type', 'AM')
            ->select('referred_by', DB::raw('count(referred_by) as total'))
            ->groupBy('referred_by')
            ->orderBy(DB::raw('COUNT(referred_by)'), 'DESC')
            ->get();

        foreach ($setting as $item) {

            if($item->total >= 3){
                User::where('referral_id', $item->referred_by)->update(['type'=> 'DisM']);
            }

        }

    }


    public  function DisMToDivMCount()
    {
        $setting = DB::table('users')
            ->where('type', 'DisM')
            ->select('referred_by', DB::raw('count(referred_by) as total'))
            ->groupBy('referred_by')
            ->orderBy(DB::raw('COUNT(referred_by)'), 'DESC')
            ->get();

        foreach ($setting as $item) {

            if($item->total >= 4){
                User::where('referral_id', $item->referred_by)->update(['type'=> 'DivM']);
            }

        }

    }



    public  function DivMToBDMCount()
    {
        $setting = DB::table('users')
            ->where('type', 'DivM')
            ->select('referred_by', DB::raw('count(referred_by) as total'))
            ->groupBy('referred_by')
            ->orderBy(DB::raw('COUNT(referred_by)'), 'DESC')
            ->get();

        foreach ($setting as $item) {

            if($item->total >= 5){
                User::where('referral_id', $item->referred_by)->update(['type'=> 'BDM']);
            }
        }
    }





    public  function leaderAmDisMDivMBDMCommissionSetting() {
        $setting = DB::table('comision_bonuses')->where('daily_date','>=', date('Y-m-d', strtotime("-30 day")))->pluck('leader_bonus')->count();
//        return $setting;

        $subscription_bonus_string = AdminSetting::getSetting('Leader AM DisM Div BDM');
        $subscription_bonus_array = explode(",", $subscription_bonus_string);
        $level_bonus = $subscription_bonus_array;


            // Am Section Bonus
            $userAm = User::where('type', 'AM')->get();
            $userAmCount = User::where('type', 'AM')->count();
            foreach ($userAm as $am){
                $buyProduct = EcoOrder::where('user_id', $am->id)->where('daily_date','>=', date('Y-m-d', strtotime("-30 day")))->where('order_status', 'complete')->pluck('order_amount')->sum();
                if($buyProduct >= 200){
                    $amounts = $level_bonus[0] * $setting;
                    $amount = $amounts / $userAmCount;
                    Transaction::create([
                        "user_id" => $am->id,
                        "category" => "monthly_leader_am_bonus",
                        "amount_type" => "c",
                        "amount" => $amount,
                        "data" => "",
                        "message" => ucfirst("You Get Monthly Leader AM Bonus")
                    ]);
                }

            }


        //Dis Section Bonus
        $userDisM = User::where('type', 'DisM')->get();
        $userDisMCount = User::where('type', 'DisM')->count();
        foreach ($userDisM as $dism) {
            $buyProduct = EcoOrder::where('user_id', $dism->id)->where('daily_date', '>=', date('Y-m-d', strtotime("-30 day")))->where('order_status', 'complete')->pluck('order_amount')->sum();
            if ($buyProduct >= 250){
                $amounts = $level_bonus[1] * $setting;
            $amount = $amounts / $userDisMCount;
            Transaction::create([
                "user_id" => $dism->id,
                "category" => "monthly_leader_DisM_bonus",
                "amount_type" => "c",
                "amount" => $amount,
                "data" => "",
                "message" => ucfirst("You Get Monthly Leader Dis M Bonus")
            ]);
           }
        }


        //Dis Section Bonus
        $userDivM = User::where('type', 'DivM')->get();
        $userDivMCount = User::where('type', 'DivM')->count();
        foreach ($userDivM as $divm){

            $buyProduct = EcoOrder::where('user_id', $divm->id)->where('daily_date', '>=', date('Y-m-d', strtotime("-30 day")))->where('order_status', 'complete')->pluck('order_amount')->sum();
            if ($buyProduct >= 300) {
                $amounts = $level_bonus[2] * $setting;
                $amount = $amounts / $userDivMCount;
                Transaction::create([
                    "user_id" => $divm->id,
                    "category" => "monthly_leader_DivM_bonus",
                    "amount_type" => "c",
                    "amount" => $amount,
                    "data" => "",
                    "message" => ucfirst("You Get Monthly Leader Div M Bonus")
                ]);
            }
        }


        //Dis Section Bonus
        $userBDM = User::where('type', 'BDM')->get();
        $userBDMCount = User::where('type', 'BDM')->count();
        foreach ($userBDM as $bdm){
            $buyProduct = EcoOrder::where('user_id', $bdm->id)->where('daily_date', '>=', date('Y-m-d', strtotime("-30 day")))->where('order_status', 'complete')->pluck('order_amount')->sum();
            if ($buyProduct >= 350) {
                $amounts = $level_bonus[3] * $setting;
                $amount = $amounts / $userBDMCount;
                Transaction::create([
                    "user_id" => $bdm->id,
                    "category" => "monthly_leader_BDM_bonus",
                    "amount_type" => "c",
                    "amount" => $amount,
                    "data" => "",
                    "message" => ucfirst("You Get Monthly Leader BDM Bonus")
                ]);
            }
        }

        return "done";
    }


    public function userActivationCheck(){
       $users =  User::where('activation_date', '<=', date('Y-m-d', strtotime("-365 day")))->get();

       foreach ($users as $user){
           User::where('id', $user->id)->update(['active' => 0]);
       }
       return 'done';
    }


    public function postAction(){
        Post::where('now_date', date('Y-m-d'))->update(['premium_post'=> 0, 'action_page' => 0]);
        return "done";
    }




    public function designationChange(){
        $uers = Matrix::orderBy('id', 'desc')->get();
        foreach ($uers as $user){
        $left = $user->left_count;
        $middle = $user->middle_count;
        $right = $user->right_count;

            $time = strtotime(date('Y-m-d'));
            $final = date("Y-m-d", strtotime("+1 month", $time));
            $last_date = new DateTime(date('F jS Y', strtotime('last day of ' . date('Y-m', strtotime($final)))));

         if($left >= 10 && $middle >= 10 && $right >= 10){
             User::where('id', $user->user_id)->update(['type' => 'MO', 'designation_active_date' => Carbon::now()]);
         }else if($left >= 30 && $middle >= 30 && $right >= 30){
             User::where('id', $user->user_id)->update(['type' => 'SMO', 'designation_active_date' => Carbon::now(), 'd_salary_date'=> $last_date]);

         }else if($left >= 150 && $middle >= 150 && $right >= 150){
             User::where('id', $user->user_id)->update(['type' => 'MEx', 'designation_active_date' => Carbon::now(), 'd_salary_date'=> $last_date]);

         }else if($left >= 400 && $middle >= 400 && $right >= 400){
             User::where('id', $user->user_id)->update(['type' => 'SMEx', 'designation_active_date' => Carbon::now(), 'd_salary_date'=> $last_date]);

         }else if($left >= 1500 && $middle >= 1500 && $right >= 1500){
             User::where('id', $user->user_id)->update(['type' => 'RMM', 'designation_active_date' => Carbon::now(), 'd_salary_date'=> $last_date]);

         }else if($left >= 4000 && $middle >= 4000 && $right >= 4000){
             User::where('id', $user->user_id)->update(['type' => 'MM', 'designation_active_date' => Carbon::now(), 'd_salary_date'=> $last_date]);

         }else if($left >= 20000 && $middle >= 20000 && $right >= 20000){
             User::where('id', $user->user_id)->update(['type' => 'SMM', 'designation_active_date' => Carbon::now(), 'd_salary_date'=> $last_date]);
         }else if($left >= 40000 && $middle>= 40000 && $right >= 40000){
             User::where('id', $user->user_id)->update(['type' => 'AGM', 'designation_active_date' => Carbon::now(), 'd_salary_date'=> $last_date]);

         }else if($left >= 60000 && $middle>= 60000 && $right >= 60000){
             User::where('id', $user->user_id)->update(['type' => 'GM', 'designation_active_date' => Carbon::now(), 'd_salary_date'=> $last_date]);

         }


//            if($left >= $middle && $right >= $middle){
//                $lmr = $middle;
//            }else if($left >= $right && $middle >= $right){
//                $lmr = $right;
//            }else if($right >= $left && $middle >= $left){
//                $lmr = $left;
//            }
//            if($lmr > 30){
//                $total = 30;
//            }else{
//                $total = $lmr * 1;
//            }
//
//
////            return $lmr.$left.$middle.$right;
//
//         $matchCount = Maching::where('user_id', $user->user_id)->count();
//             if($matchCount > 0){
//
//                 $matchCount = Matrix::where('user_id', $user->user_id)->first();
//                 $minimums = MachHistory::where('user_id', $user->user_id)->pluck('minimum')->sum();
//                 $lefts = $matchCount->left_count - $minimums;
//                 $middles =  $matchCount->middle_count - $minimums;
//                 $rights = $matchCount->right_count - $minimums;
//
//                 if($lefts >= $middles && $rights >= $middles){
//                     $lmr = $middles;
//                 }else if($lefts >= $rights && $middles >= $rights){
//                     $lmr = $rights;
//                 }else if($rights >= $lefts && $middles >= $lefts){
//                     $lmr = $lefts;
//                 }
//
//                 if($lmr >30){
//                     $total = 30;
//                 }else{
//                     $total = $lmr * 1;
//                 }
//
//                 if($lmr > 0) {
//                     Transaction::where('user_id', $user->user_id)->create([
//                         'user_id' => $user->user_id,
//                         'category' => 'level_match_bonus',
//                         'amount_type' => 'c',
//                         'amount' => $total,
//                         'data' => '',
//                         'message' => 'Team performance bonus ',
//                         'check_date' => date('Y-m-d')
//                     ]);
//                     Maching::where('user_id', $user->user_id)->update(['left_position' => $lefts, 'middle_position' => $middles, 'right_position' => $rights, 'minimum' => $lmr, 'p_m_amount' => 1, 'total' => $total, 'minimum_count' => `minimum_count` + $lmr]);
//                 }
//
//                 }else{
//                 $maching = new Maching();
//                 $maching->user_id = $user->user_id;
//                 $maching->left_position = $left - $lmr;
//                 $maching->middle_position = $middle - $lmr;
//                 $maching->right_position = $right - $lmr;
//                 $maching->minimum = $lmr;
//                 $maching->p_m_amount = 1;
//                 $maching->total = $total;
//                 $maching->minimum_count = $lmr;
//                 $maching->save();
//                 if($lmr > 0){
//                     Transaction::where('user_id', $user->user_id)->create([
//                         'user_id' => $user->user_id,
//                         'category' => 'level_match_bonus',
//                         'amount_type' => 'c',
//                         'amount' => $total,
//                         'data' => '',
//                         'message' => 'Team performance bonus ',
//                         'check_date' => date('Y-m-d')
//                     ]);
//                 }
//
//             }

//                $designationCount = MachHistory::where('user_id', $user->user_id)->count();
//                if($designationCount > 0){
//
//                    $left_position = MachHistory::where('user_id', $user->user_id)->pluck('left_position')->sum();
//                    $middle_position = MachHistory::where('user_id', $user->user_id)->pluck('middle_position')->sum();
//                    $right_position = MachHistory::where('user_id', $user->user_id)->pluck('right_position')->sum();
//                    $lefts = $left - $left_position;
//                    $middles = $middle - $middle_position;
//                    $rights = $right - $right_position;
//
//                    if($lefts >= $middles && $rights >= $middles){
//                        $lmr = $middles;
//                    }else if($lefts >= $rights && $middles >= $rights){
//                        $lmr = $rights;
//                    }else if($rights >= $lefts && $middles >= $lefts){
//                        $lmr = $lefts;
//                    }
//
//                    if($lmr >30){
//                        $total = 30;
//                    }else{
//                        $total = $lmr * 1;
//                    }
//
//                    if($lmr > 0){
//                        $designation = new MachHistory();
//                        $designation->user_id = $user->user_id;
//                        $designation->left_position = $lefts;
//                        $designation->middle_position = $middles;
//                        $designation->right_position = $rights;
//                        $designation->designation = $user->type;
//                        $designation->minimum = $lmr;
//                        $designation->total = $total;
//                        $designation->save();
//                    }
//
//                }else{
//                    $designation = new MachHistory();
//                    $designation->user_id = $user->user_id;
//                    $designation->left_position = $left;
//                    $designation->middle_position = $middle;
//                    $designation->right_position = $right;
//                    $designation->designation = $user->type;
//                    $designation->minimum = $lmr;
//                    $designation->total = $total;
//                    $designation->save();
//
//                }



        }
    }



    public function totalCommissionSellNow(){
        $revenueMonth= ComisionBonus::whereMonth('created_at', '>=', Carbon::now()->subMonth()->month)->count();
        return $revenueMonth;

    }


    public function userCheck($type , $date){
        $user = User::where('type', $type)->where('d_salary_date', '<=', $date)->count();
        return $user;
    }

    public function designationCommissionDesignation(){
        $users = User::where('type', '!=', 'GU')->where('type', '!=', 'MO', 'd_salary_date','<=', date('Y-m-d'))->get();

        foreach ($users as $user) {

             if($user->type = 'SMO' && $user->d_salary_date <= date('Y-m-d')){
                $moAmount = $this->totalCommissionSellNow() * 15;
                $moDesAmount = $moAmount / $this->userCheck('SMO', date('Y-m-d'));
                    Transaction::create([
                        'user_id'=> $user->id,
                        'category'=> 'smo_package_bonus',
                        'amount_type' => 'c',
                        'amount' => $moDesAmount,
                        'data' => '',
                        'message' => 'you get smo package bonus',
                        'check_date' => date('Y-m-d')

                    ]);
                    $month = new DesignationSalary();
                    $month->user_id = $user->user_id;
                    $month->categories = 'designation_monthly_salary';
                    $month->amount = $moDesAmount;
                    $month->designation = $user->type;
                    $month->now_date = date('Y-m-d');
                    $month->save();


            }else if($user->type == 'MEx' && $user->d_salary_date <= date('Y-m-d')){
                $moAmount = $this->totalCommissionSellNow() * 10;
                $moDesAmount = $moAmount / $this->userCheck('MEx', date('Y-m-d'));
                    Transaction::create([
                        'user_id'=> $user->id,
                        'category'=> 'mex_package_bonus',
                        'amount_type' => 'c',
                        'amount' => $moDesAmount,
                        'data' => '',
                        'message' => 'you get mex package bonus',
                        'check_date' => date('Y-m-d')
                    ]);
                    $month = new DesignationSalary();
                    $month->user_id = $user->user_id;
                    $month->categories = 'designation_monthly_salary';
                    $month->amount = $moDesAmount;
                    $month->designation = $user->type;
                    $month->now_date = date('Y-m-d');
                    $month->save();

            }else if($user->type = 'SMEx' && $user->d_salary_date <= date('Y-m-d')){
                $moAmount = $this->totalCommissionSellNow() * 10;
                $moDesAmount = $moAmount / $this->userCheck('SMEx', date('Y-m-d'));
                    Transaction::create([
                        'user_id'=> $user->id,
                        'category'=> 'smex_package_bonus',
                        'amount_type' => 'c',
                        'amount' => $moDesAmount,
                        'data' => '',
                        'message' => 'you get smex package bonus',
                        'check_date' => date('Y-m-d')
                    ]);
                    $month = new DesignationSalary();
                    $month->user_id = $user->user_id;
                    $month->categories = 'designation_monthly_salary';
                    $month->amount = $moDesAmount;
                    $month->designation = $user->type;
                    $month->now_date = date('Y-m-d');
                    $month->save();

            }else if($user->type == 'RMM' && $user->d_salary_date <= date('Y-m-d')){

                $moAmount = $this->totalCommissionSellNow() * 8;
                $moDesAmount = $moAmount / $this->userCheck('RMM', date('Y-m-d'));
                    Transaction::create([
                        'user_id'=> $user->id,
                        'category'=> 'rmm_package_bonus',
                        'amount_type' => 'c',
                        'amount' => $moDesAmount,
                        'data' => '',
                        'message' => 'you get rmm package bonus',
                        'check_date' => date('Y-m-d')
                    ]);
                    $month = new DesignationSalary();
                    $month->user_id = $user->user_id;
                    $month->categories = 'designation_monthly_salary';
                    $month->amount = $moDesAmount;
                    $month->designation = $user->type;
                    $month->now_date = date('Y-m-d');
                    $month->save();

            }else if($user->type == 'MM' && $user->d_salary_date <= date('Y-m-d')){
                $moAmount = $this->totalCommissionSellNow() * 7;
                $moDesAmount = $moAmount / $this->userCheck('MM', date('Y-m-d'));
                    Transaction::create([
                        'user_id'=> $user->id,
                        'category'=> 'mm_package_bonus',
                        'amount_type' => 'c',
                        'amount' => $moDesAmount,
                        'data' => '',
                        'message' => 'you get mm package bonus',
                        'check_date' => date('Y-m-d')
                    ]);
                    $month = new DesignationSalary();
                    $month->user_id = $user->user_id;
                    $month->categories = 'designation_monthly_salary';
                    $month->amount = $moDesAmount;
                    $month->designation = $user->type;
                    $month->now_date = date('Y-m-d');
                    $month->save();

            }else if($user->type == 'SMM' && $user->d_salary_date <= date('Y-m-d')){
                $moAmount = $this->totalCommissionSellNow() * 6;
                $moDesAmount = $moAmount / $this->userCheck('SMM', date('Y-m-d'));
                     Transaction::create([
                         'user_id'=> $user->id,
                         'category'=> 'smm_package_bonus',
                         'amount_type' => 'c',
                         'amount' => $moDesAmount,
                         'data' => '',
                         'message' => 'you get smm package bonus',
                         'check_date' => date('Y-m-d')
                     ]);
                     $month = new DesignationSalary();
                     $month->user_id = $user->user_id;
                     $month->categories = 'designation_monthly_salary';
                     $month->amount = $moDesAmount;
                     $month->designation = $user->type;
                     $month->now_date = date('Y-m-d');
                     $month->save();

            }else if($user->type == 'AGM' && $user->d_salary_date <= date('Y-m-d')){
                $moAmount = $this->totalCommissionSellNow() * 5;
                $moDesAmount = $moAmount / $this->userCheck('AGM', date('Y-m-d'));
                    Transaction::create([
                        'user_id'=> $user->id,
                        'category'=> 'agm_package_bonus',
                        'amount_type' => 'c',
                        'amount' => $moDesAmount,
                        'data' => '',
                        'message' => 'you get agm package bonus',
                        'check_date' => date('Y-m-d')
                    ]);
                    $month = new DesignationSalary();
                    $month->user_id = $user->user_id;
                    $month->categories = 'designation_monthly_salary';
                    $month->amount = $moDesAmount;
                    $month->designation = $user->type;
                    $month->now_date = date('Y-m-d');
                    $month->save();

            }else if($user->type == 'GM' && $user->d_salary_date <= date('Y-m-d')){
                $moAmount = $this->totalCommissionSellNow() * 4;
                $moDesAmount = $moAmount / $this->userCheck('GM', date('Y-m-d'));
                    Transaction::create([
                        'user_id'=> $user->id,
                        'category'=> 'gm_package_bonus',
                        'amount_type' => 'c',
                        'amount' => $moDesAmount,
                        'data' => '',
                        'message' => 'you get gm package bonus',
                        'check_date' => date('Y-m-d')
                    ]);
                    $month = new DesignationSalary();
                    $month->user_id = $user->user_id;
                    $month->categories = 'designation_monthly_salary';
                    $month->amount = $moDesAmount;
                    $month->designation = $user->type;
                    $month->now_date = date('Y-m-d');
                    $month->save();


            }

        }
    }



    public function matrixHistory(){
        $allhistory = MachHistory::groupBy('user_id')->get();
        if(count($allhistory) > 0){
            foreach ($allhistory as $histories ) {
                $matrix = Matrix::where('user_id', $histories->user_id)->first();
                $left_position = MachHistory::where('user_id', $histories->user_id)->pluck('left_position')->sum();
                $middle_position = MachHistory::where('user_id', $histories->user_id)->pluck('middle_position')->sum();
                $right_position = MachHistory::where('user_id', $histories->user_id)->pluck('right_position')->sum();
                $l_add_new = $matrix->left_count - $left_position;
                $m_add_new = $matrix->middle_count - $middle_position;
                $r_add_new = $matrix->right_count - $right_position;

                $maching = Maching::where('user_id', $histories->user_id)->first();
                $total_left = $maching->left_position + $l_add_new;
                $total_middle = $maching->middle_position + $m_add_new;
                $total_right = $maching->right_position + $r_add_new;

                if ($total_left >= $total_middle && $total_right >= $total_middle) {
                    $lmr = $total_middle;
                } else if ($total_middle >= $total_left && $total_right >= $total_left) {
                    $lmr = $total_left;
                } else if ($total_middle >= $total_right && $total_left >= $total_right) {
                    $lmr = $total_right;

                }

                if($l_add_new >= $m_add_new && $r_add_new >= $m_add_new){
                    $ls = $m_add_new;
                }else if($m_add_new >= $l_add_new && $r_add_new >= $l_add_new){
                    $ls = $l_add_new;
                }else if($m_add_new >= $r_add_new && $l_add_new >= $r_add_new){
                    $ls = $r_add_new;
                }

                $l_left_over = $total_left - $lmr;
                $m_left_over = $total_middle - $lmr;
                $r_left_over = $total_right - $lmr;

                if($ls > 0){
                    $history = new DailyHistory();
                    $history->user_id = $histories->user_id;
                    $history->l_add_new = $l_add_new;
                    $history->m_add_new = $m_add_new;
                    $history->r_add_new = $r_add_new;
                    $history->total_left = $total_left;
                    $history->total_middle = $total_middle;
                    $history->total_right = $total_right;
                    $history->l_left_over = $l_left_over;
                    $history->l_middle_over = $m_left_over;
                    $history->l_right_over = $r_left_over;
                    $history->minimum = $lmr;
                    $history->match_limit = 30;
                    $history->amount = $lmr;
                    $history->now_date = date('Y-m-d');
                    $history->save();
                }

            }
        }else{
            $matries = Matrix::get();
            foreach ($matries as $matrix) {

                $l_add_new = $matrix->left_count ;
                $m_add_new = $matrix->middle_count;
                $r_add_new = $matrix->right_count;

                $total_left =  $l_add_new;
                $total_middle =  $m_add_new;
                $total_right = $r_add_new;

                if ($total_left >= $total_middle && $total_right >= $total_middle) {
                    $lmr = $total_middle;
                } else if ($total_middle >= $total_left && $total_right >= $total_left) {
                    $lmr = $total_left;
                } else if ($total_middle >= $total_right && $total_left >= $total_right) {
                    $lmr = $total_right;

                }

                $l_left_over = $total_left - $lmr;
                $m_left_over = $total_middle - $lmr;
                $r_left_over = $total_right - $lmr;

                if($lmr > 0){
                    $history = new DailyHistory();
                    $history->user_id = $matrix->user_id;
                    $history->l_add_new = $l_add_new;
                    $history->m_add_new = $m_add_new;
                    $history->r_add_new = $r_add_new;
                    $history->total_left = $total_left;
                    $history->total_middle = $total_middle;
                    $history->total_right = $total_right;
                    $history->l_left_over = $l_left_over;
                    $history->l_middle_over = $m_left_over;
                    $history->l_right_over = $r_left_over;
                    $history->minimum = $lmr;
                    $history->match_limit = 30;
                    $history->amount = $lmr;
                    $history->now_date = date('Y-m-d');
                    $history->save();
                }
            }
        }

    }


    public function designationDailyUpdateInfo(){
        $designation = AdminSetting::where('setting_name', 'Designation Setting')->first();
        $designation = explode(',', $designation->setting_value);
        $packageCount = ComisionBonus::whereDate('created_at', Carbon::today())->count();

        $data = [
            'package'   =>  $packageCount,
            'MO'        =>  0,
            'SMO'       =>  $designation[0] * $packageCount,
            'MEx'       =>  $designation[1] * $packageCount,
            'SMEx'      =>  $designation[2] * $packageCount,
            'RMM'       =>  $designation[3] * $packageCount,
            'MM'        =>  $designation[4] * $packageCount,
            'SMM'       =>  $designation[5] * $packageCount,
            'AGM'       =>  $designation[6] * $packageCount,
            'GM'        =>  $designation[7] * $packageCount
        ];

       $dsmo = Designation::forceCreate($data);
       DesignationHistory::forceCreate($data);

        $testCount = DesignationSetting::count();
        if($testCount > 0){
            $designationCount = DesignationSetting::whereMonth('created_at', date('m'))->count();
            if($designationCount > 0){

                $total =  DesignationSetting::whereMonth('created_at', date('m'))->first();
                $total->SMO = $total->SMO+$dsmo->SMO;
                $total->MEx = $total->MEx+$dsmo->MEx;
                $total->SMEx = $total->SMEx+$dsmo->SMEx;
                $total->RMM = $total->RMM+$dsmo->RMM;
                $total->MM = $total->MM+$dsmo->MM;
                $total->SMM = $total->SMM+$dsmo->SMM;
                $total->AGM = $total->AGM+$dsmo->AGM;
                $total->GM = $total->GM+$dsmo->GM;
                $total->save();

            }else{
                $designationTotal = new DesignationSetting();
                $designationTotal->MO = $dsmo->MO;
                $designationTotal->SMO = $dsmo->SMO;
                $designationTotal->MEx = $dsmo->MEx;
                $designationTotal->SMEx = $dsmo->SMEx;
                $designationTotal->RMM = $dsmo->RMM;
                $designationTotal->MM = $dsmo->MM;
                $designationTotal->SMM = $dsmo->SMM;
                $designationTotal->AGM = $dsmo->AGM;
                $designationTotal->GM = $dsmo->GM;
                $designationTotal->save();

            }

        }else{
            $designationTotal = new DesignationSetting();
            $designationTotal->MO = $dsmo->MO;
            $designationTotal->SMO = $dsmo->SMO;
            $designationTotal->MEx = $dsmo->MEx;
            $designationTotal->SMEx = $dsmo->SMEx;
            $designationTotal->RMM = $dsmo->RMM;
            $designationTotal->MM = $dsmo->MM;
            $designationTotal->SMM = $dsmo->SMM;
            $designationTotal->AGM = $dsmo->AGM;
            $designationTotal->GM = $dsmo->GM;
            $designationTotal->save();
        }
    }


    public function designationMonthlyUpdateInfo(){
        $userMO = User::where('type', 'MO')->count();
        $userSMO = User::where('type', 'SMO')->count();
        $userMEx = User::where('type', 'MEx')->count();
        $userSMEx = User::where('type', 'SMEx')->count();
        $userRMM = User::where('type', 'RMM')->count();
        $userMM = User::where('type', 'MM')->count();
        $userSMM = User::where('type', 'SMM')->count();
        $userAGM = User::where('type', 'AGM')->count();
        $userGM = User::where('type', 'GM')->count();

//        $userCount = DesignationUsercount::whereMonth('created_at', date('m'))->count();
        $data = [
          'MO'         => $userMO,
          'SMO'         => $userSMO,
          'MEx'         => $userMEx,
          'SMEx'        => $userSMEx,
          'RMM'         => $userRMM,
          'MM'          => $userMM,
          'SMM'         => $userSMM,
          'AGM'         => $userAGM,
          'GM'          => $userGM
        ];

       $user = DesignationUsercount::forceCreate($data);

        $designation = DesignationSetting::whereMonth('created_at', date('m'))->first();
        $designation = json_decode(json_encode($designation));
//        print_r($designation);die;
        if($user->SMO > 0){
            $smo = $designation->SMO/ $user->SMO;
        }else{
            $smo = 0;
        }

        if($user->MEx > 0){
            $mex = $designation->MEx/ $user->MEx;
        }else{
            $mex = 0;
        }
        if($user->SMEx > 0){
            $smex = $designation->SMEx / $user->SMEx;
        }else{
            $smex = 0;
        }
        if($user->RMM > 0){
            $rmm = $designation->RMM / $user->RMM;
        }else
            $rmm =0;
        if($user->MM > 0)
            $mm = $designation->MM / $user->MM;
        else
            $mm = 0;
        if($user->SMM > 0)
            $smm = $designation->SMM / $user->SMM;
        else
            $smm = 0;
        if($user->AGM > 0)
            $agm = $designation->AGM / $user->AGM;
        else
            $agm = 0;
        if($user->GM > 0)
            $gm =  $designation->GM / $user->GM;
        else
            $gm = 0;

        $adata = [
            'SMO'         => $smo,
            'MEx'         => $mex,
            'SMEx'        => $smex,
            'RMM'         => $rmm,
            'MM'          => $mm,
            'SMM'         => $smm,
            'AGM'         => $agm,
            'GM'          => $gm
        ];

        DesignationSalaryAchievement::forceCreate($adata);


        $hudata = [
            'MO' => 'Total User',
            'SMO'=> $user->SMO,
            'MEx' => $user->MEx,
            'SMEx' => $user->SMEx,
            'RMM' => $user->RMM,
            'MM' => $user->MM,
            'SMM' => $user->SMM,
            'AGM' => $user->AGM,
            'GM' => $user->GM
        ];

        DesignationHistory::forceCreate($hudata);
        $asdata = [
            'MO'         => 'Salary Per User',
            'SMO'         => $smo,
            'MEx'         => $mex,
            'SMEx'        => $smex,
            'RMM'         => $rmm,
            'MM'          => $mm,
            'SMM'         => $smm,
            'AGM'         => $agm,
            'GM'          => $gm
        ];

        DesignationHistory::forceCreate($asdata);




    }
}