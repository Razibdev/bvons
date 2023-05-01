<?php

namespace App\Http\Controllers\Ecommerce;

use App\Model\Ecommerce\Api\EcoOrder;
use Illuminate\Http\Request;

trait OrderCommon
{
    public function changeStatus(EcoOrder $order_id, Request $request)
    {

        $is_bdealer = auth()->user()->b_dealer ? true : false;
        if ($is_bdealer) {
            if ($order_id->assign_bdealer_id !== auth()->user()->b_dealer->id) {
                return response()->json(['error' => "invalid bdealer"]);
            }
        }

        $dbStatusId = $this->getStatusId($order_id->order_status);
        if($is_bdealer) {
            if($request->status === 'complete' || $request->status === 'cancel') {
                return response()->json(["error" => "Cannot change status " . $request->status]);
            }
        }



        $reqStatusId = $this->getStatusId($request->status);
        if($reqStatusId === 0) return $is_bdealer ?  response()->json(["error" => "Invalid status"]) : back()->with(["error" => "Invalid status"]);
        if($dbStatusId === $reqStatusId) return $is_bdealer ? response()->json(["error" => "Status already: {$order_id->order_status}"]) : back()->with(["error" => "Status already: {$order_id->order_status}"]);
        if(in_array($dbStatusId, [4,5])) return $is_bdealer ?  response()->json(["error" => "Cannot change status"]) : back()->with(["error" => "Cannot change status"]);
        if($dbStatusId > $reqStatusId) return $is_bdealer ?  response()->json(["error" => "Status cannot be reversed"]) : back()->with(["error" => "Status cannot be reversed"]);


        $updated = $order_id->update([
            'order_status' => $request->query('status')
        ]);


        if ($updated) {
            if ($is_bdealer) {
                return response()->json(['success' => "Order {$request->query('status')} successful"]);
            } else {
                return back()->with(['success' => "Order {$request->query('status')} successful"]);
            }
        }
    }
    protected function getStatusId($status)
    {
        switch ($status) {
            case 'pending'      :
                return 1;
                break;
            case 'processing'   :
                return 2;
                break;
            case 'shipped'      :
                return 3;
                break;
            case 'cancel'       :
                return 4;
                break;
            case 'complete'     :
                return 5;
                break;
            default :
                return 0;
        }

    }

}
