<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collateral;
use App\CollateralInterest;
use Illuminate\Pagination\Paginator;

class CollateralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collaterals = Collateral::latest()->paginate(10);
        return view('collaterals.index')->with('collaterals', $collaterals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('collaterals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $collateral = $request->all();
        // var_dump($collateral);
        Collateral::create($collateral);
        return redirect()->route('collaterals.index')
                          ->with('success', 'Added successfully.');
    }
    // add interest
    public function addInterest(Request $request)
    {
        $collateral_interest = $request->all();
        // var_dump($request['collateral_id']);
        CollateralInterest::create($collateral_interest);
        //get the collateral to return to view
        $collateral = Collateral::find($request->collateral_id);
        return view('collaterals.show')
                        ->with('collateral', $collateral);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collateral = Collateral::find($id);
        return view('collaterals.show')->with('collateral', $collateral);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function destroyCollateralInterest($id)
    {
        $ci = CollateralInterest::find($id);
        $ci->delete();
        return redirect()->back()->with('success', 'Successfully Deleted');
    }
    public function withdrawCollateral($id)
    {
        var_dump($id);
        $collateral = Collateral::find($id);
        if($collateral AND $collateral->status == 0)
        {
            $collateral->status = 1;
            $collateral->save();
        }
        return redirect()->back()->with('success', 'Successfully Withdrawn');
    }
}