<?php

namespace App\Http\Controllers\Bcourier\Web;

use App\Http\Controllers\Controller;
use App\Model\Bcourier\BcoPercelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BcoPercelTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        return view('bcourier.percel-type.index');
    }

    public function indexDatatables()
    {
        $percel_type = BcoPercelType::get(['bco_percel_types.*', DB::raw('@rownum  := @rownum  + 1 AS rownum')]);

        return Datatables::of($percel_type)->addColumn('action', function($p_type){
            return '
                <div class="btn-group" role="group">
                    <a class="btn btn-alt-info text-link cu-popover" data-content="Edit Details" href="'. route('bco.percel_type.edit', ['bcoPercelType' => $p_type->id]) .'" >
                        <i class="fal fa-pencil-alt mr-5"></i>
                    </a>
                </div>
                ';
        })->rawColumns(['action'])->make(true);
    }


    public function create()
    {
        return view('bcourier.percel-type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => "required"
        ]);
        BcoPercelType::create($request->all());
        return back()->with(['success' => 'Percel Type created successfull']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Bcourier\BcoPercelType  $bcoPercelType
     * @return \Illuminate\Http\Response
     */
    public function show(BcoPercelType $bcoPercelType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Bcourier\BcoPercelType  $bcoPercelType
     * @return \Illuminate\Http\Response
     */
    public function edit(BcoPercelType $bcoPercelType)
    {
        return view('bcourier.percel-type.edit', compact('bcoPercelType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Bcourier\BcoPercelType  $bcoPercelType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BcoPercelType $bcoPercelType)
    {
        $request->validate([
            'name' => "required"
        ]);
        $bcoPercelType->update($request->all());
        return back()->with(['success' => 'Percel Type created successfull']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Bcourier\BcoPercelType  $bcoPercelType
     * @return \Illuminate\Http\Response
     */
    public function destroy(BcoPercelType $bcoPercelType)
    {
        //
    }
}
