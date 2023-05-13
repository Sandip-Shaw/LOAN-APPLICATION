<?php

namespace App\Http\Controllers\Backend\Hr_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmployeeHolidayMaster;

class HolidayMasterController extends Controller
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
        $holiday = EmployeeHolidayMaster::all();
        return view('backend.pages.holiday_master.index',compact('holiday'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.holiday_master.create');
        
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
            'title' => 'required',
            'holiday_date' => 'required',        
            'holiday_day' => 'required',        

        ]);

        $holiday = new EmployeeHolidayMaster();
        $holiday->title   =  $request->title;
        $holiday->holiday_date  =   $request->holiday_date;
        $holiday->holiday_day  = $request->holiday_day;

           
        $holiday->save();

        session()->flash('success', 'Holiday has been created !!');
        return redirect()->route('admin.holiday_master.index');

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
        $holiday = EmployeeHolidayMaster::find($id);
 
        return view('backend.pages.holiday_master.edit',compact('holiday'));  
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
        $holiday=EmployeeHolidayMaster::find($id);

        $request->validate([
            'title' => 'required',
            'holiday_date' => 'required',        
            'holiday_day' => 'required',        

        ]);

        
        $holiday->title   =  $request->title;
        $holiday->holiday_date  =   $request->holiday_date;
        $holiday->holiday_day  = $request->holiday_day;

           
        $holiday->save();

        session()->flash('success', 'Holiday has been updated !!');
        return redirect()->route('admin.holiday_master.index');
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
