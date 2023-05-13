<?php

namespace App\Http\Controllers\Backend\Hr_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyBranch;
use App\Models\HrManagement;
use App\Models\EmployeeSalaryRelease;
use App\Models\CompanyProfile;
use Barryvdh\DomPDF\PDF as DomPDF;


use App\Exports\SalaryReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use PDF;


class SalaryReportController extends Controller
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
        $branch= CompanyBranch::pluck('id','branch_name');

        //dd($report);

        return view('backend.pages.salary_report.index',compact('branch'));
        
    }

    public function searchBy(Request $request)
    {
        $report= HrManagement::select(
         
            'hr_management.name',
            'hr_management.emp_code',
            'hr_management.email',
            'hr_management.mobile',
            'add_designations.designation_name',
            'company_branches.branch_name',
            'employee_salary_releases.month_year',
            'employee_salary_releases.amt_to_pay',
            'employee_salary_releases.payment_by',
            'employee_salary_releases.status',

        )
        ->leftjoin('add_designations', 'hr_management.designation', '=', 'add_designations.id')
        ->leftjoin('company_branches', 'company_branches.id', '=', 'hr_management.branch')

        ->leftjoin('employee_salary_releases', 'hr_management.hrmanagement_id', '=', 'employee_salary_releases.employee')
   
        ->where([
            ['employee_salary_releases.status', '=', "Paid"],
            ['employee_salary_releases.pay_branch', '=',$request->branch],
            ['employee_salary_releases.month_year', '=',$request->month_year],

            ])
    
        ->get();

        return Response::json($report, 200);
        
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

    public function export($month_year,$branch)
    {
        dd($month_year);
    
        return Excel::download(new SalaryReportExport($month_year,$branch),'salaryReport-report.xlsx');
    }

    public function pdf_export($month_year,$branch )
    {
    
        return Excel::download(new SalaryReportExport($month_year,$branch),'salaryReport-report.pdf');
    }

    public function pay_slip_pdf($id)
    {
        $slip = EmployeeSalaryRelease::select(
                 'hr_management.*',
                 'employee_salary_releases.*'

                )
                ->leftjoin('hr_management', 'hr_management.hrmanagement_id', '=', 'employee_salary_releases.employee')
                 ->where('employee_salary_releases.id', '=', $id)
                ->get();
               // dd($slip);
         $company_details = CompanyProfile::select('company_name','address','cin_no')->get();

        //  $pdf= PDF::loadView('backend.pages.emp_salary_payment.pay_slip',compact('slip','company_details'));
        // //dd($pdf);
        //  return $pdf->stream("salary-slip.pdf",array("Attachment" => false));
           return view('backend.pages.emp_salary_payment.pay_slip',compact('slip','company_details'));
        
    }

}
