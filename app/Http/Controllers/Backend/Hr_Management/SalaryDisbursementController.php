<?php

namespace App\Http\Controllers\Backend\Hr_Management;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\HrManagement;
use App\Models\HrSalaryDisbursement;
class SalaryDisbursementController extends Controller
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
        $salary= HrSalaryDisbursement::all();
        return view('backend.pages.hr_salary_disbursement.index')->withSalarys($salary);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hrmanagement= HrManagement::pluck('hrmanagement_id','name');
        return view('backend.pages.hr_salary_disbursement.create')->withHrmanagements($hrmanagement);

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
       $salary = new HrSalaryDisbursement();
       $salary->disburse_salary     = $request->disburse_salary;
       $salary->remarks             = $request->remarks;
       $salary->trans_date          = $request->trans_date;
       $salary->paymode             = $request->paymode;
       $salary->bank_name_cheque    = $request->bank_name_cheque;
       $salary->cheque_no           = $request->cheque_no;
       $salary->cheque_date         = $request->cheque_date;
       $salary->transfer_date_onlineTrans = $request->transfer_date_onlineTrans;
       $salary->transaction_no      = $request->transaction_no;
       $salary->transfer_mode       = $request->transfer_mode;
       $salary->employee_id         = $request->employee_id;
        $salary->save();
        session()->flash('success', 'Salary Disbursement has been created !!');
        return redirect()->route('admin.salary_disbursement.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salary = HrSalaryDisbursement::findOrFail($id);
        return view('backend.pages.hr_salary_disbursement.show',compact('salary'));
        
    }

    public function approval()
    {
       $salary = HrSalaryDisbursement::where('status','Pending')->get();
       //dd($application);
       return view('backend.pages.hr_salary_disbursement.approval',compact('salary'));
    }

    public function updateStatus(Request $request, $id)
    {
       $salary=HrSalaryDisbursement::findOrFail($id);
       //dd($loan_application);
   
       $salary->status = $request->status;
       $salary->comment = $request->comment;
       $salary->save();
  
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
