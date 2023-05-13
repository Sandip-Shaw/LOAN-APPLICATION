<?php

namespace App\Http\Controllers\Backend\Hr_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HrManagement;
use App\Models\EmployeeLeaveAdjustment;
use App\Models\EmployeeLeave;
use App\Models\EmployeeAttendence;

use DB;
use Response;

class LeaveAdjustmentController extends Controller
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
        $leave =EmployeeLeaveAdjustment::all();
        return view('backend.pages.leave_adjustment.index',compact('leave'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hrmanagements= HrManagement::select('hrmanagement_id','name','emp_code')->get();

        return view('backend.pages.leave_adjustment.create',compact('hrmanagements'));
        
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
            'employee' => 'required',  
            'doj' => 'required',        
            'leave_date' => 'required',        
            'purpose' => 'required',        
            'leave_type' => 'required',   
            'total_leave' => 'required',        
               
        ]);

        $implode_leave_type=implode(",",$request->leave_type);

        $leave = new EmployeeLeaveAdjustment();
        $leave->employee = $request->employee;
        $leave->doj = $request->doj;
        $leave->leave_date = $request->leave_date;
        $leave->purpose = $request->purpose;
        $leave->leave_type = $implode_leave_type ;
        $leave->total_leave = $request->total_leave;
       
        $leave->save();

        session()->flash('success', 'Leave has been created and waiting for approval!!');
        return redirect()->route('admin.leave_adjustment.index');
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

    public function approval()
    {
    //    if (is_null($this->user) || !$this->user->can('loan_application.approve')) {
    //        abort(403, 'Sorry !! You are Unauthorized to approve Loan Application !');
    //    }
       $approval = EmployeeLeaveAdjustment::where('status','Pending')->get();
       //dd($application);
       return view('backend.pages.leave_adjustment.approval',compact('approval'));
    }

    public function updateStatus(Request $request, $id)
    {
       $approval=EmployeeLeaveAdjustment::findOrFail($id);
       
       $approval->status = $request->status;
       $approval->remarks = $request->remarks;
       $approval->save();

       if($request->status == 'Approved'){
        $approval_id = $approval->id;
        $leaveDate = $request->l_date;
        $leaveType = $request->l_type;

        dd($leaveType );
         DB::table('employee_attendences')
         ->where([
            ['id', '=', $approval_id],      
            ['date', '=',$leaveDate],

            ])
        ->update(['attendence_type' => $leaveType]);
        
       }
  
    }



    public function getLeave($emp_id)
    {
    
     $get_all_leave_master = EmployeeLeave::select(
        '*'
     )->first();

    //  $query = DB::table('employee_leave_adjustments')
    //     ->select('*')
    //     ->groupBy('leave_type')
    //     ->selectRaw('count(*) as total_count')
    //     ->where('employee','=',10)
    //     ->get();
    // $query = DB::raw("SELECT leave_type,COUNT(*) from employee_leave_adjustments WHERE employee = 10 GROUP BY leave_type") ;
    $results = DB::select("SELECT leave_type,COUNT(*) as l from employee_leave_adjustments WHERE employee =".$emp_id." GROUP BY leave_type");
    // SELECT leave_type,COUNT(*) from employee_leave_adjustments WHERE employee = 10 GROUP BY leave_type;
    //  dd($results) ;

    $leaves=[];

    foreach($results as $leave){

        if($leave->leave_type=='cl')
            $leaves['cl'] = $get_all_leave_master->cl - $leave->l;

            if($leave->leave_type=='sl')
            $leaves['sl'] = $get_all_leave_master->sl - $leave->l;

            if($leave->leave_type=='el')
            $leaves['el'] = $get_all_leave_master->el - $leave->l;
        }
    
        return Response::json($leaves, 200);
    
 
 //   dd($leaves);
    }
}
