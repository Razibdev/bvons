<?php

namespace App\Http\Controllers\Bcourier\Web;

use App\Http\Controllers\Controller;

use App\Model\Bcourier\BcoPercel;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class BcoPercelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        return view('bcourier.percel.index');
    }
    public function indexDatatables()
    {
        $percel = BcoPercel::orderBy('id', 'desc')->get(['bco_percels.*', DB::raw('@rownum  := @rownum  + 1 AS rownum')]);

        return Datatables::of($percel)
            ->addColumn('user_name', function($percel){
                return $percel->user->name;
            })
            ->addColumn('percel_type', function($percel){
                return $percel->type->name;
            })
            ->addColumn('action', function($percel){
                return '
                <div class="btn-group" role="group">
                    <a class="btn btn-alt-info text-link cu-popover" data-content="View Details" href="'. route('bco.parcel.show', ["parcel" => $percel->id]) .'">
                        <i class="fal fa-info-circle mr-5"></i>
                    </a>
                </div>
                ';
            })
            ->addColumn('created_at', function($percel){
                return $percel->created_at ? with(new Carbon($percel->created_at))->format('d/m/Y - h:i a') : '';
            })
            ->rawColumns(['action'])->make(true);
    }
    public function show(BcoPercel $parcel)
    {
        return view('bcourier.percel.show', compact('parcel'));
    }

}
