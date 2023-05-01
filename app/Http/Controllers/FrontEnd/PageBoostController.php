<?php

namespace App\Http\Controllers\FrontEnd;

use App\BoostType;
use App\Http\Controllers\Controller;
use App\Model\Area\District;
use App\Model\CreatePage;
use App\Model\PageBoost;
use App\Model\Transaction\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageBoostController extends Controller
{
    public function addPageBoost(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'boost_type' => 'required',
                'age' => 'required',
                'budget' => 'required',
                'page_name' => 'required'
            ]);

            if(empty($data['gender'])){
                $data['gender'] = null;
            }
            if(empty($data['profession'])){
                $data['profession'] = null;
            }

            if(empty($data['device'])){
                $data['device'] = null;
            }

            if(empty($data['operator'])){
                $data['operator'] = null;
            }
            if(empty($data['hobby'])){
                $data['hobby'] = null;
            }

            if(empty($data['institution'])){
                $data['institution'] = null;
            }

            if(empty($data['company_name'])){
                $data['company_name'] = null;
            }

            if(empty($data['team'])){
                $data['team'] = null;
            }

            if(empty($data['s_user'])){
                $data['s_user'] = null;
            }

            if(empty($data['interested'])){
                $data['interested'] = null;
            }
            if(empty($data['people'])){
                $data['people'] = null;
            }

            if(empty($data['start_time'])){
                $data['start_time'] = null;
            }

            if(empty($data['end_time'])){
                $data['end_time'] = null;
            }
            if(empty($data['day'])){
                $data['day'] = null;
            }

            if(empty($data['budget'])){
                $data['budget'] = 0;
            }
            if (empty($data['audience'])){
                $data['audience'] = 0;
            }

            if (empty($data['age'])){
                $data['age'] = null;
            }

            $pageBoost = new PageBoost();
            $pageBoost->user_id = Auth::id();
            $pageBoost->page_id = $data['page_name'];
            $pageBoost->boost_type_id = $data['boost_type'];
            $pageBoost->gender = $data['gender'];
            $pageBoost->customer_age = $data['gender'];
            $pageBoost->district_id = $data['district'];
            $pageBoost->thana_id = $data['thana'];
            $pageBoost->device_id = $data['device'];
            $pageBoost->number_operator = $data['operator'];
            $pageBoost->hobby = $data['hobby'];
            $pageBoost->education_institution = $data['institution'];
            $pageBoost->company_job_type = $data['company_name'];
            $pageBoost->team_id = $data['team'];
            $pageBoost->page_people_in_not = $data['people'];
            $pageBoost->start_time = $data['start_time'];
            $pageBoost->end_time = $data['end_time'];
            $pageBoost->start_date = $data['day'];
            $pageBoost->budget = $data['budget'];
            $pageBoost->audience_number = $data['audience'];
            $pageBoost->save();

            Transaction::create([
                'user_id'=> Auth::id(),
                'category' => 'page_boost_package_buy',
                'amount_type' => 'd',
                'amount' => $data['budget'],
                'message' => 'You buy boost package',
                'check_date' => date('Y-m-d')
            ]);
            return redirect()->back();



        }

        $pages = CreatePage::all();
        $page = array();
        foreach ($pages as $pag){
            $admin_id = explode(",", $pag->admin_id);

            for ($i = 0; $i<count($admin_id); $i++){
                if($admin_id[$i] == Auth::id()){
                    $page[] = CreatePage::where('admin_id',$pag->admin_id)->get();
                }else{
                    continue;
                }
            }

            $subAdmin_id = explode(",", $pag->sub_admin_id);
            for ($j = 0; $j < count($subAdmin_id); $j++){
                if($subAdmin_id[$j] == Auth::id()){
                    $page[] = CreatePage::where('sub_admin_id',$pag->sub_admin_id)->get();
                }else{
                    continue;
                }
            }
        }

        $boostType = BoostType::all();
        $district = District::all();
        return view('boost.boost_page_add', compact('page', 'boostType','district'));
    }



    public function viewPageBoost(){
        $boosts = PageBoost::where('user_id', Auth::id())->with('user', 'page','boost')->get();
//        $boosts = json_decode(json_encode($boosts));
//        echo "<pre>"; print_r($boosts);die;
        return view('boost.boost_page_view', compact('boosts'));
    }






}
