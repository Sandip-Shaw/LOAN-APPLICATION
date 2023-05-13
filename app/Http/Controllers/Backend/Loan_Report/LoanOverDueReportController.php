<?php

namespace App\Http\Controllers\Backend\Loan_Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyBranch;
use App\Models\LoanApplication;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\OverDueReportExport;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Response;
class LoanOverDueReportController extends Controller
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
        if (is_null($this->user) || !$this->user->can('report.loanOverdue.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view Loan OverDue Report !');
        }
        $branch= CompanyBranch::pluck('id','branch_name');

        return view('backend.pages.loan_overDue_report.index',compact('branch'));
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

    public function searchByDate(Request $request)
    {
        $due_report= LoanApplication::select(
            'emi_details.emi_no',
            'emi_details.emi_date',
            'emi_details.emi_due_date',
            'emi_details.principal_amt',
            'emi_details.interest',
            'emi_details.emi_amt',
            'emi_details.status',

            'emi_details.loan_disbursement_id',
            'member_management.member_id_code',
            'member_management.first_name',
            'member_management.mobile',
            'company_branches.branch_name',

        )
        ->leftjoin('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
        ->leftjoin('emi_details', 'emi_details.loan_disbursement_id', '=', 'loan_disbursements.id')
        ->leftjoin('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->leftjoin('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->where([
            ['emi_details.status', '=', "OverDue"],
            ['loan_applications.branch', '=',$request->branch],

            ])
    
        ->whereBetween('emi_details.emi_due_date', array($request->from_date, $request->to_date))
     
        ->get();
       // dd($due_report);
        // return $due_report->toJson();
        return Response::json($due_report, 200);
        
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

    public function export($branch,$from_date, $to_date)
    {
    
        return Excel::download(new OverDueReportExport($branch,$from_date,$to_date),'overDueEmi-report.xlsx');
    }

    public function pdf_export($branch,$from_date, $to_date)
    {
    
        return Excel::download(new OverDueReportExport($branch,$from_date,$to_date),'overDueEmi-report.pdf');
    }
}
