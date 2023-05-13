<?php

namespace App\Http\Controllers\Backend\Investment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InvestmentScheme;

class SchemeController extends Controller
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
        $investment = InvestmentScheme::orderBy('id', 'DESC')->get();

        return view('backend.pages.investment.index',compact('investment'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.pages.investment.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request);
        $request->validate([
            'scheme_name' => 'required',
            'scheme_code' => 'required|max:12',
            'min_amt' => 'required',
            'int_rate' => 'required',
            'term' => 'required',
            'int_pay_mode' => 'required', 
            
            'active' => 'required',
             
        ]);

        $investment = new InvestmentScheme();
        $investment->scheme_name  =  $request->scheme_name;
        $investment->scheme_code  =  $request->scheme_code;
        $investment->min_amt = $request->min_amt;
        $investment->int_rate  = $request->int_rate;
        $investment->term  =  $request->term;
        $investment->int_pay_mode = $request->int_pay_mode;
        $investment->fore_close_chrge  =   $request->fore_close_chrge;
        $investment->active = $request->active;
        $investment->save();
     
        session()->flash('success', 'Investment Scheme has been created !!');
        return redirect()->route('admin.investment_scheme.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $investment = InvestmentScheme::findOrFail($id);
       // $profile = LoanSchema::all();
 
         return view('backend.pages.investment.show',compact('investment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $investment = InvestmentScheme::find($id);
 
        return view('backend.pages.investment.edit',compact('investment')); 
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
        $request->validate([
            'scheme_name' => 'required',
            'scheme_code' => 'required|max:12',
            'min_amt' => 'required',
            'int_rate' => 'required',
            'term' => 'required',
            'int_pay_mode' => 'required', 
            
            'active' => 'required',
             
        ]);

        
       $investment=InvestmentScheme::findOrFail($id);

        $investment->scheme_name  =  $request->scheme_name;
        $investment->scheme_code  =  $request->scheme_code;
        $investment->min_amt = $request->min_amt;
        $investment->int_rate  = $request->int_rate;
        $investment->term  =  $request->term;
        $investment->int_pay_mode = $request->int_pay_mode;
        $investment->fore_close_chrge  =   $request->fore_close_chrge;
        $investment->active = $request->active;
        $investment->update();
     
        session()->flash('success', 'Investment Scheme has been updated !!');
        return redirect()->route('admin.investment_scheme.index');

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
