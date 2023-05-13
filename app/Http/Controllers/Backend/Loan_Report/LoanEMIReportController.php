<?php

namespace App\Http\Controllers\Backend\Loan_Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyBranch;
use App\Models\LoanDisbursement;
use App\Models\LoanApplication;
use App\Exports\LoanAccountReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class LoanEMIReportController extends Controller
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

        $emi_report= LoanApplication::select(
            // 'emi_details.emi_no',
            // 'emi_details.emi_date',
            // 'emi_details.emi_due_date',
            // 'emi_details.principal_amt',
            // 'emi_details.interest',
            // 'emi_details.emi_amt',
            // 'emi_details.status',

            // 'emi_details.loan_disbursement_id',
            'loan_schemas.schema_name',

            'member_management.member_id',
            'member_management.first_name',
            'member_management.mobile',
            'company_branches.branch_name',
            'loan_applications.*',

        )
        ->leftjoin('loan_schemas', 'loan_schemas.loanSchema_id', '=', 'loan_applications.loan_schema')

        ->leftjoin('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
        //->leftjoin('emi_details', 'emi_details.loan_disbursement_id', '=', 'loan_disbursements.id')
        ->leftjoin('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->leftjoin('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->where([
            ['loan_applications.status', '=', "Disbursed"],
            // ['loan_applications.branch', '=',$request->branch],

            ])
        ->get();
        //dd($emi_report);
        return view('backend.pages.loan_EMI_report.index',compact('branch'));
        
    }

    public function searchByDate(Request $request)
    {
        $accnt_report= LoanApplication::select(
            
            'loan_schemas.schema_name',

            'member_management.member_id',
            'member_management.first_name',
            'member_management.mobile',
            'company_branches.branch_name',
            'loan_applications.*',
            'loan_disbursements.*',

        )
        ->leftjoin('loan_schemas', 'loan_schemas.loanSchema_id', '=', 'loan_applications.loan_schema')

        ->leftjoin('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
        //->leftjoin('emi_details', 'emi_details.loan_disbursement_id', '=', 'loan_disbursements.id')
        ->leftjoin('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->leftjoin('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->where([
            ['loan_applications.status', '=', $request->accnt_status],
            ['loan_applications.branch', '=',$request->branch],

            ])

        ->whereBetween('loan_disbursements.loan_disburse_date', array($request->from_date, $request->to_date))
       
        ->get();
        
        return $accnt_report->toJson();
        
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

    public function export($branch,$from_date, $to_date,$accnt_status)
    {
    //    $from_date='2022-10-20';
    //     $to_date='2023-03-15';
        return Excel::download(new LoanAccountReportExport($branch,$from_date,$to_date,$accnt_status),'LoanAccount-report.xlsx');
    }
}
