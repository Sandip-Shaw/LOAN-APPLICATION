<?php

namespace App\Http\Controllers\Backend\Hr_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HrManagement;
use App\Models\EmployeeSalaryDetail;
use Illuminate\Support\Facades\Auth;




class SalaryDetailsController extends Controller
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
        $detail= EmployeeSalaryDetail::all();
        return view('backend.pages.emp_salary_detail.index',compact('detail'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hrmanagements= HrManagement::select('hrmanagement_id','name','emp_code')->get();

        return view('backend.pages.emp_salary_detail.create',compact('hrmanagements'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'basic' => 'required',
            'others' => 'required',        
            'HRA' => 'required',        
            'fuel' => 'required',        
            'DA' => 'required',        
            'allowance' => 'required',        
            'TA' => 'required',        
            'gross_pay' => 'required',        
            'PF' => 'required',        
            'ESI' => 'required',        
            'net_pay' => 'required',        
           
        ]);

        $detail = new EmployeeSalaryDetail();
        $detail->employee  =  $request->employee_id;
        $detail->basic  =  $request->basic;
        $detail->others  =  $request->others;
        $detail->HRA   = $request->HRA;
        $detail->fuel  =  $request->fuel;
        $detail->DA  = $request->DA;
        $detail->allowance = $request->allowance;
        $detail->TA = $request->TA;
        $detail->gross_pay = $request->gross_pay;
        $detail->PF  = $request->PF;
        $detail->ESI  = $request->ESI;
        $detail->net_pay = $request->net_pay;
     
        $detail->save();

        session()->flash('success', 'Salary Details has been created !!');
        return redirect()->route('admin.salary_details.index');
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
        $salary = EmployeeSalaryDetail::find($id);

        $hrmanagements= HrManagement::select('hrmanagement_id','name','emp_code')->get();

        return view('backend.pages.emp_salary_detail.edit',compact('hrmanagements','salary'));
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
            'basic' => 'required',
            'others' => 'required',        
            'HRA' => 'required',        
            'fuel' => 'required',        
            'DA' => 'required',        
            'allowance' => 'required',        
            'TA' => 'required',        
            'gross_pay' => 'required',        
            'PF' => 'required',        
            'ESI' => 'required',        
            'net_pay' => 'required',        
           
        ]);

    
        $detail=EmployeeSalaryDetail::find($id);
        $detail->employee  =  $request->employee_id;
        $detail->basic  =  $request->basic;
        $detail->others  =  $request->others;
        $detail->HRA   = $request->HRA;
        $detail->fuel  =  $request->fuel;
        $detail->DA  = $request->DA;
        $detail->allowance = $request->allowance;
        $detail->TA = $request->TA;
        $detail->gross_pay = $request->gross_pay;
        $detail->PF  = $request->PF;
        $detail->ESI  = $request->ESI;
        $detail->net_pay = $request->net_pay;
     
        $detail->save();

        session()->flash('success', 'Salary Details has been Updated !!');
        return redirect()->route('admin.salary_details.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $design = EmployeeSalaryDetail::find($id);
        if (!is_null($design)) {
            $design->delete();
        }

        session()->flash('success', 'Salary Details of Employee has been deleted !!');
        return back();
    }


    public function salarydetail($hrmanagement_id)
    {
        $salary = EmployeeSalaryDetail::select(
            'hr_management.hrmanagement_id',   
            'employee_salary_details.*', 
        )
        ->join('hr_management', 'hr_management.hrmanagement_id', '=', 'employee_salary_details.employee')
        ->where('hr_management.hrmanagement_id', '=', $hrmanagement_id)

        ->get();
       // dd($salary);
       return $salary->toJson();
 
    }
}
