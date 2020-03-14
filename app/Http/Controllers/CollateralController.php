<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
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
    public function searchById(Request $request)
    {
        $collateral = Collateral::find($request->id);

        if($collateral)
        {
            return view('collaterals.show')->with('collateral', $collateral);
        }
        else 
        {
            return redirect()->back()->withErrors(['searchIdError' => 'There is no such collateral with this ID.']);
        }
    }
    public function searchByCustomerName(Request $request)
    {
        $collaterals = Collateral::where('customer_name', 'LIKE', "%$request->name%")->paginate(10);

        if($collaterals->count() > 0)
        {
            return view('collaterals.index')
            ->with('collaterals', $collaterals)
            ->with('msg', $request->name);
        }
        else
        {
            return redirect()->back()->withErrors(['searchCustomerNameError' => 'There is no such collaterals belong to this customer.']);
        }
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
        $collateral['expired_date'] = Carbon::now()->addMonths($request->expired_date);
        // var_dump($collateral);
        Collateral::create($collateral);
        return redirect()->route('collaterals.index')
                          ->with('success', 'Added successfully.');
    }
    // add interest
    public function addInterest(Request $request)
    {
        $collateral_interest_form = $request->all();

        $ci = CollateralInterest::create($collateral_interest_form);
        
        if($ci) 
        {
            $collateral = Collateral::find($ci->collateral_id);
            $newExpiredDate = $collateral->expired_date->addMonths($ci->paid_month);
            //var_dump($newExpiredDate);
            $collateral->expired_date = $newExpiredDate;
            $collateral->save();
            //reduce month on delete
        }

        return redirect()->route('collaterals.showCollateralInterest', $ci)
                       ->with('collateralInterest', $ci);
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
    // show interest invoice
    // collaterals.showCollateralInterest
    // get Invoice
    public function showCollateralInterest($id)
    {
        $ci = CollateralInterest::find($id);
        if($ci)
        {
            return view('Collaterals.invoice')
                        ->with('collateralInterest', $ci);
        }
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
