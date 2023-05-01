<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use App\Model\Charity;
use App\Model\CharityTransaction;
use App\User;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    public function addCharity(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'event_name' => 'required',
                'sub_admin_id' => 'required',
                'address' => 'required',
                'contact' => 'required',
                'open_date' => 'required',
                'closing_date' => 'required',
            ]);
            $sub_admin_id = implode(",", $data['sub_admin_id']);
            $event = new Charity();
            $event->sub_admin_id = $sub_admin_id;
            $event->event_name = $data['event_name'];
            $event->address = $data['address'];
            $event->contact = $data['contact'];
            $event->open_date = $data['open_date'];
            $event->closing_date = $data['closing_date'];
            $event->save();
            return redirect()->back();
        }
        $users = User::all();
        return view('admin.charity.add_event', compact('users'));
    }


    public function viewCharity(){

        $events = Charity::all();
        return view('admin.charity.view_event', compact('events'));
    }

    public function editCharity(Request $request, $id){
        if ($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'event_name' => 'required',
                'sub_admin_id' => 'required',
                'address' => 'required',
                'contact' => 'required',
                'open_date' => 'required',
                'closing_date' => 'required',
            ]);
            $sub_admin_id = implode(",", $data['sub_admin_id']);

            Charity::where('id', $id)->update(['event_name'=>$data['event_name'], 'sub_admin_id'=>$sub_admin_id, 'address' => $data['address'], 'contact' => $data['contact'], 'open_date' => $data['open_date'], 'closing_date' => $data['closing_date']]);
            return redirect('/charity/view-event');
        }
        $event = Charity::where('id', $id)->first();
        $users = User::all();
        return view('admin.charity.edit_event', compact('event', 'users'));
    }



    public function deleteCharity($id){
        Charity::where('id', $id)->delete();
        return redirect()->back();
    }

    public function transactionCharity($id){
        $transactions = CharityTransaction::where('charity_id', $id)->get();
        return view('admin.charity.transaction', compact('transactions'));
    }




}
