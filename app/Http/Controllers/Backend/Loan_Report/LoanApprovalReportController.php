<?php

namespace App\Http\Controllers\Backend\Loan_Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyBranch;
use App\Models\LoanApplication;
use Maatwebsite\Excel\Facades\Excel;
use Response;
use App\Exports\ApprovalReportExport;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class LoanApprovalReportController extends Controller
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
        if (is_null($this->user) || !$this->user->can('report.loanApproval.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view Loan Approval Report !');
        }
        $branch= CompanyBranch::pluck('id','branch_name');

        return view('backend.pages.approval_report.index',compact('branch'));
    }

    public function searchByDate(Request $request)
    {
        $approval= LoanApplication::select(
            'loan_applications.loanApplication_id',
            'member_management.member_id_code',
            'member_management.first_name',
            'loan_applications.application_date',
            'company_branches.branch_name',
            'loan_schemas.schema_name',

            'loan_applications.amt_approved',
            'loan_applications.tenure_months',
            'loan_applications.tenure_type',
            'loan_schemas.ann_rate_int',
            'loan_applications.emi_amount_total',
            'loan_applications.status',


        )
        ->leftjoin('loan_schemas', 'loan_schemas.loanSchema_id', '=', 'loan_applications.loan_schema')
        //->leftjoin('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
         ->leftjoin('member_management', 'member_management.member_id', '=', 'loan_applications.member')
         ->leftjoin('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
         ->where([
             ['loan_applications.status', '=', "Approved"],      
             ['loan_applications.branch', '=',$request->branch],

             ])
    
         ->whereBetween('loan_applications.application_date', array($request->from_date, $request->to_date))
     
        ->get();
        //dd($application);
       // return $approval->toJson();
       return Response::json($approval, 200);
        
    }

    public function export($branch,$from_date, $to_date)
    {
    
        return Excel::download(new ApprovalReportExport($branch,$from_date,$to_date),'Approval-report.xlsx');
    }
    public function pdf_export($branch,$from_date, $to_date)
    {
    
        return Excel::download(new ApprovalReportExport($branch,$from_date,$to_date),'Approval-report.pdf');
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
}
