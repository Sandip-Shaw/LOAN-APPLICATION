<?php

namespace App\Http\Controllers\Backend\Hr_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HrManagement;
use App\Models\EmployeeAttendence;
use App\Models\EmployeeLeaveAdjustment;

use DB;

class EmpAttendenceController extends Controller
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
    public function index(Request $request)
    { 
        // $leave = EmployeeLeaveAdjustment::select('leave_date','leave_type')->where('status','=','Approved')->get();
        // dd($leave);
         $hrmanagements= HrManagement::select('hrmanagement_id','name','emp_code')->get();

        $attendence = EmployeeAttendence::select('month_year','employee','date','attendence_type')
                    ->orderBy('employee')    
                    ->where('month_year','=',$request->month_year)
                    ->get();

        // $attendence = DB::table('employee_attendences as ea')
        // ->select('month_year', 'ea.employee', 'date')
        // ->selectRaw('CASE WHEN ela.leave_type IS NOT NULL THEN ela.leave_type ELSE attendence_type END AS attendence_type')
        // ->leftJoin('employee_leave_adjustments as ela', function ($join) {
        //     $join->on('ea.employee', '=', 'ela.employee')
        //          ->on('ea.date', '=', 'ela.leave_date');
        // })
        // ->get();
              // dd($attendence);
        $emp_attendence = [];
        $lastemp=0;
        $emp_attendence_group = [];
        $i=1;
        $count= count($attendence);
        //dd(count($attendence));
        foreach($attendence as $employee_attendence){
            if($lastemp==$employee_attendence['employee'] ||  $lastemp==0){
                $temp= [
                    "date" => $employee_attendence['date'],
                    "attendence_type"=>$employee_attendence['attendence_type'],
                ];
                   // $employee_attendence['date'];
                 array_push($emp_attendence_group, $temp);
            }
           
          //  echo $emp_attendence;
                
          if($lastemp!=$employee_attendence['employee'] || $i==$count ){
          
          if($lastemp!=0){
            array_push($emp_attendence,[$lastemp=>$emp_attendence_group]);
            $temp = [
                "date" => $employee_attendence['date'],
                "attendence_type"=>$employee_attendence['attendence_type'],
            ];
            $emp_attendence_group =[];
            array_push($emp_attendence_group, $temp);


          }
            $lastemp = $employee_attendence['employee'];
          }
          $i++;
        }
      // dd($emp_attendence);

        return view('backend.pages.attendence.index',compact('hrmanagements','emp_attendence'));
        
    }


    // public function filter(Request $request)
    // {
    //     $hrmanagements= HrManagement::select('hrmanagement_id','name','emp_code')->get();

    //     $attendence = EmployeeAttendence::select('month_year','employee','date','attendence_type')
    //     ->where('month_year','=',$request->month_year)
    //     ->orderBy('employee')    
    //     ->get();
    //     $emp_attendence = [];
    //     $lastemp=0;
    //     $emp_attendence_group = [];
    //     $i=1;
    //     $count= count($attendence);
        
    //     foreach($attendence as $employee_attendence){
    //         if($lastemp==$employee_attendence['employee'] ||  $lastemp==0){
    //             $temp= [
    //                 "date" => $employee_attendence['date'],
    //                 "attendence_type"=>$employee_attendence['attendence_type'],
    //             ];
                   
    //              array_push($emp_attendence_group, $temp);
    //         }
           
          
                
    //       if($lastemp!=$employee_attendence['employee'] || $i==$count ){
           
    //       if($lastemp!=0){
    //         array_push($emp_attendence,[$lastemp=>$emp_attendence_group]);
    //         $temp = [
    //             "date" => $employee_attendence['date'],
    //             "attendence_type"=>$employee_attendence['attendence_type'],
    //         ];
    //         $emp_attendence_group =[];
    //         array_push($emp_attendence_group, $temp);


    //       }
    //         $lastemp = $employee_attendence['employee'];
    //       }
    //       $i++;
    //     }
    

    //     return view('backend.pages.attendence.index',compact('hrmanagements','emp_attendence'));

    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $hrmanagements= HrManagement::select('hrmanagement_id','name','emp_code')->get();

      return view('backend.pages.attendence.create',compact('hrmanagements'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attendence = new EmployeeAttendence();

        $TableData_JSON = json_decode($request->code_data, true);
      //  dd($TableData_JSON);
        $attendence->month_year = $TableData_JSON['month_year'];
        $attendence->employee = $TableData_JSON['employee'];
        $attendence->date = $TableData_JSON['date'];
        $attendence->attendence_type = $TableData_JSON['buttonName'];

        $attendence->save();
        session()->flash('success', 'Employee Attendence has been successfully added!!');
        return redirect()->route('admin.attendence.index');
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
}
