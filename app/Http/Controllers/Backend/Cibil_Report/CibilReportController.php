<?php

namespace App\Http\Controllers\Backend\Cibil_Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\SalaryReportExport;
use App\Exports\CibilReportExport;
use App\Exports\CibilReportHifxExport;


use Maatwebsite\Excel\Facades\Excel;



class CibilReportController extends Controller
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
        return view('backend.pages.cibil_report.index');
        
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
        //dd($request);
       // $branch = 2;
        //$month_year ="2023-01";

       // return Excel::download(new CibilReportExport($month_year,$branch),'salaryReport-report.xlsx');
       //$filePath = null;

    //    dd($request);

       if($request->format_type=='Crif Highmark') {

        
           $branch = 2;
           $month_year ="2023-01";
           return Excel::download(new CibilReportHifxExport($month_year,$branch),'salaryReport-report.xlsx');
       }
           else {

            $branch = 2;
            $month_year ="2023-01";
            return Excel::download(new SalaryReportExport($month_year,$branch),'salaryReport-report.xlsx');
            
       //dd($request);
        //    return redirect()->back()->with('error','gvhjnk');
       }



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
    public function openFile($filename)
    {
   }
}
