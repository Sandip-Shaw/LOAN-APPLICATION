<?php

namespace App\Http\Controllers\Backend\Investment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InvestmentCreate;
use App\Models\InvestmentPayDetails;



class InvestmentAccountController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investment= InvestmentCreate::select('*')->where('status','=',"Completed")->get();

        return view('backend.pages.investmentAccnt.index',compact('investment'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $investment= InvestmentCreate::select('*')->where('id','=',$id)->get();
        $pay_details = InvestmentPayDetails::select('*')->where('createInvestment_id', '=', $investment[0]->id)->get();
        //dd($pay_details);
        return view('backend.pages.investmentAccnt.show',compact('pay_details'));
        
    }


    public function Pay($id)
    {
       $pay = InvestmentPayDetails::select('*')->where('id','=',$id)->get();
        return view('backend.pages.investmentAccnt.pay',compact('pay'));
        
    }

    public function paynow(Request $request, $id)
    {
        InvestmentPayDetails::where('id', '=', $id)->update([
            'status' => "Paid",
            'paid_date' => $request->transaction_date,
            'paid_amt' => $request->int_amt,
        
            'total_amt' => $request->total_amt,
            'remarks' => $request->remarks,
            'pay_mode' => $request->disburse_transaction,
            'cheque_bank_name' => $request->cheque_bank_name,
            'cheque_no' => $request->cheque_no,
            'cheque_date' => $request->cheque_date,
            'onl_transfer_date' => $request->onl_transfer_date,
            'onl_transaction_no' => $request->onl_transaction_no,
            'onl_transfer_mode' => $request->onl_transfer_mode,
        ]);

        return redirect('/admin/investment_accnt'); 
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
}
