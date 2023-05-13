<?php

namespace App\Http\Controllers\Backend\Hr_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HrManagement;
use App\Models\CompanyBranch;
use App\Models\EmployeeSalaryRelease;
use App\Models\EmployeeAttendence;




class SalaryPaymentController extends Controller
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
        $pay = EmployeeSalaryRelease::all();
        return view('backend.pages.emp_salary_payment.index',compact('pay'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hrmanagements= HrManagement::select('hrmanagement_id','name','emp_code')->get();
        $branch= CompanyBranch::pluck('id','branch_name');

        return view('backend.pages.emp_salary_payment.create',compact('hrmanagements','branch'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'month_year' => 'required',        
            'working_day' => 'required',        
            'pay_branch' => 'required',
            'pay_date' => 'required',        
            'payment_by' => 'required',        

           
        ]);
        //dd($request);
        $salary_pay = new EmployeeSalaryRelease();
        $salary_pay->employee  =  $request->employee_id;
        $salary_pay->month_year  =  $request->month_year;
        $salary_pay->basic  =  $request->basic;
        $salary_pay->others  =  $request->others;
        $salary_pay->HRA   = $request->HRA;
        $salary_pay->fuel  =  $request->fuel;
        $salary_pay->DA  = $request->DA;
        $salary_pay->allowance = $request->allowance;
        $salary_pay->TA = $request->TA;
        $salary_pay->gross_pay = $request->gross_pay;
        $salary_pay->PF  = $request->PF;
        $salary_pay->ESI  = $request->ESI;
        $salary_pay->net_pay = $request->net_pay;
        $salary_pay->working_day = $request->working_day;
        $salary_pay->amt_to_pay = $request->amt_to_pay;
        $salary_pay->pay_branch = $request->pay_branch;
        $salary_pay->pay_date = $request->pay_date;
        $salary_pay->payment_by = $request->payment_by;
        $salary_pay->status = 'Paid';

        $salary_pay->save();

        session()->flash('success', 'Salary  has been Released !!');
        return redirect()->route('admin.salary_payment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function attendenceForMonth($employee_id,$month_year){
        // $employee_id= 8;
        // $month_year= "2022-12";

        $attendence = EmployeeAttendence::select('date','attendence_type')
                    ->where('employee','=',$employee_id)
                    ->where('month_year','=',$month_year)
                    ->get();
        $count=0;

        foreach( $attendence as $atten){
           // dd($atten->attendence_type);
            if($atten->attendence_type == "FD" || $atten->attendence_type == "CL" || $atten->attendence_type == "SL" || $atten->attendence_type == "EL"){
                $count=$count+1;
                        
        }elseif($atten->attendence_type == "HD"){
            $count=$count+0.5;
                
        }
    }
       // return $count->toJson();
        return response()->json(['success' => true, 'count' => $count]);

    }
}
