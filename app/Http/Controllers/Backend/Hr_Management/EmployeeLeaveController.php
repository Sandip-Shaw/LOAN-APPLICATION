<?php

namespace App\Http\Controllers\Backend\Hr_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyBranch;
use App\Models\EmployeeLeave;
use Illuminate\Support\Facades\Auth;




class EmployeeLeaveController extends Controller
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
        $leave = EmployeeLeave::all();
        return view('backend.pages.emp_leave.index',compact('leave'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches= CompanyBranch::pluck('id','branch_name');

        return view('backend.pages.emp_leave.create',compact('branches'));
        
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
            'financial_year' => 'required', 
           // 'branch_id' => 'required',        
            'cl' => 'required',        
            'sl' => 'required',        
            'el' => 'required',        

        ]);

        $leave = new EmployeeLeave();
        $leave->financial_year   =    $request->financial_year;
        $leave->branch_id        =    $request->branch;
        $leave->cl   =    $request->cl;
        $leave->sl   =    $request->sl;
        $leave->el   =    $request->el;
        $leave->lop   =    $request->lop;
    
        $leave->save();

        session()->flash('success', 'Employee Leave has been created !!');
        return redirect()->route('admin.employee_leave.index');
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
        $leave = EmployeeLeave::find($id);
        $branches= CompanyBranch::pluck('id','branch_name');
 
        return view('backend.pages.emp_leave.edit',compact('leave','branches')); 
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
            'financial_year' => 'required', 
           // 'branch_id' => 'required',        
            'cl' => 'required',        
            'sl' => 'required',        
            'el' => 'required',        

        ]);

        $leave = EmployeeLeave::find($id);
        $leave->financial_year   =    $request->financial_year;
        $leave->branch_id        =    $request->branch;
        $leave->cl   =    $request->cl;
        $leave->sl   =    $request->sl;
        $leave->el   =    $request->el;
        $leave->lop   =    $request->lop;
    
        $leave->update();

        session()->flash('success', 'Employee Leave has been created !!');
        return redirect()->route('admin.employee_leave.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $design = EmployeeLeave::find($id);
        if (!is_null($design)) {
            $design->delete();
        }

        session()->flash('success', 'Designation has been deleted !!');
        return back();
    }
}
