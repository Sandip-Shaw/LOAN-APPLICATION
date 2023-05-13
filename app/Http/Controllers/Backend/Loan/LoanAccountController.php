<?php

namespace App\Http\Controllers\Backend\Loan;

use App\Http\Controllers\Controller;
use App\Models\EmiDetails;
use App\Models\LoanApplication;
use App\Models\LoanDisbursement;
use App\Models\MemberManagement;
use App\Models\CompanyProfile;
use App\Models\CompanyBranch;
use App\Models\HrManagement;
use Carbon\Carbon;
use PDF;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Http\Request;
use DB;

class LoanAccountController extends Controller
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
        if (is_null($this->user) || !$this->user->can('loan_account.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view Loan Account !');
        }

        if(!count($request->all()) >= 1){
            $loan_account = [];
            $branch= CompanyBranch::pluck('id','branch_name');
            $hrmanagements= HrManagement::pluck('hrmanagement_id','name');
            return view('backend.pages.loan_appli_accnt.index',compact('branch','hrmanagements','loan_account'));

        }

        $branch = $request->branch;
        $phone_no = $request->phone_no;
        $member_code = $request->member_code;
        $member_name = $request->member_name;
        $account = $request->account;
        $open_date = $request->open_date;

        $where = [];
        $branch = $request->branch;
        if ($branch) {
            $where[] = ['company_branches.id', '=', $branch];
        }

        $phone_no = $request->phone_no;
        if ($phone_no) {
            $where[] = ['member_management.mobile', '=', $phone_no];
        }

        $member_code = $request->member_code;
        if ($member_code) {
            $where[] = ['member_management.member_id_code', '=', $member_code];
        }

        $member_name = $request->member_name;
        if ($member_name) {
            $where[] = ['member_management.first_name', '=', $member_name];
        }

        $account = $request->account;
        if ($account) {
            $where[] = ['loan_disbursements.id', '=', $account];
        }

        $open_date = $request->open_date;
        if ($open_date) {
            $where[] = ['loan_disbursements.loan_disburse_date', '=', $open_date];
        }

        $loan_account = LoanApplication::select(
            'member_management.group',
            'loan_disbursements.id',
            'member_management.member_id_code',
            'member_management.member_id',

            'member_management.first_name',
            'member_management.mobile',

            'company_branches.branch_name',
            'loan_schemas.schema_name',
            'loan_applications.tenure_type',
            'loan_applications.amt_approved',
            'loan_disbursements.loan_disburse_date',
            'loan_disbursements.final_disburse_amt',
            'loan_disbursements.loan_status',

            'loan_applications.loanApplication_id',
            )
        ->join('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
        ->join('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->join('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->join('loan_schemas', 'loan_schemas.loanSchema_id', '=', 'loan_applications.loan_schema')
        ->where('loan_applications.status', '=', "Disbursed")
        ->where($where)
        ->get();
        //dd($loan_account);
        $branch= CompanyBranch::pluck('id','branch_name');
        $hrmanagements= HrManagement::pluck('hrmanagement_id','name');
        return view('backend.pages.loan_appli_accnt.index', compact('loan_account','branch','hrmanagements'));
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
        if (is_null($this->user) || !$this->user->can('loan_account.show')) {
            abort(403, 'Sorry !! You are Unauthorized to show Loan Account !');
        }

        $loan_account = LoanApplication::select(
            'member_management.member_id',

            'member_management.member_id_code',
            'member_management.first_name',
            'loan_disbursements.id',
            'loan_applications.loanApplication_id',
            'loan_disbursements.loan_disburse_date',
            'loan_disbursements.first_emi_date',
            'loan_schemas.schema_name',
            'loan_disbursements.final_disburse_amt',
            'loan_disbursements.insurance_charge',
            'loan_disbursements.stamp_fee',
            'company_branches.branch_name',
            'loan_schemas.ann_rate_int',
            'loan_schemas.grace_period',
            'loan_schemas.int_type',
            'loan_applications.tenure_type',
            'loan_applications.tenure_months',
            'loan_applications.amt_approved',

            'loan_schemas.max_tanure',
            'loan_applications.processing_charges',
            'loan_disbursements.loan_status',
            'loan_disbursements.loan_close_date',
            // 'loan_disbursements.loan_status',
            )
        ->join('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
        ->join('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->join('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->join('loan_schemas', 'loan_schemas.loanSchema_id', '=', 'loan_applications.loan_schema')
        ->where('loan_applications.loanApplication_id', '=', $id)
        ->get();
        //dd($loan_account);

        $emi_details = EmiDetails::select('*')->where('loan_disbursement_id', '=', $loan_account[0]->id)->get();

        return view('backend.pages.loan_appli_accnt.show', compact('loan_account', 'emi_details'));
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

    public function emiPay(Request $request){
        $emi = EmiDetails::select(
            'emi_details.emi_id',
            'loan_applications.loanApplication_id',
            'emi_details.emi_amt',
            'emi_details.status as emi_status' ,
            'loan_disbursements.id',
            'member_management.first_name',
            'loan_schemas.schema_name',
            'loan_schemas.ann_rate_int',
            'loan_schemas.int_type',
            'loan_schemas.panulty_type',
            'loan_schemas.penalty',
            'loan_applications.tenure_type',
            'loan_disbursements.loan_disburse_date',
            'loan_disbursements.final_disburse_amt',
            )
        ->join('loan_disbursements', 'loan_disbursements.id', '=', 'emi_details.loan_disbursement_id')
        ->join('loan_applications', 'loan_applications.loanApplication_id', '=', 'loan_disbursements.loanApplication_id')
        ->join('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->join('loan_schemas', 'loan_schemas.loanSchema_id', '=', 'loan_applications.loan_schema')
        ->where([
            ['emi_details.status', '!=', "Paid"],
            ['emi_details.emi_id', '=', $request->id],
            ])
        ->get();
       // dd($emi);
        return view('backend.pages.loan_appli_accnt.emi_pay',compact('emi'));
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

    public function emiPrint($id)
    {
        $emi_det = EmiDetails::select(
            'emi_details.*',
            'member_management.first_name',
            'member_management.member_id_code',
            'company_branches.branch_name',
            )
        ->leftjoin('loan_disbursements', 'loan_disbursements.id', '=', 'emi_details.loan_disbursement_id')
        ->leftjoin('loan_applications', 'loan_applications.loanApplication_id', '=', 'loan_disbursements.loanApplication_id')
        ->leftjoin('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->leftjoin('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->where('emi_details.emi_id', '=', $id)
        ->get();

        $company_details = CompanyProfile::select('company_name','address','cin_no')->get();

        $pdf= PDF::loadView('backend.pages.loan_appli_accnt.print_slip',compact('emi_det','company_details'));
        return $pdf->stream("pay-slip.pdf",array("Attachment" => false));
    }

    public function paynow(Request $request, $id)
    {
        if($request->other_charges == null){
            $other_charges = 0;
        } else {
            $other_charges = $request->other_charges;
        }
        EmiDetails::where('emi_id', '=', $id)->update([
            'status' => "Paid",
            'paid_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'paid_amt' => $request->amt_to_collect,
            'fine_amt' => $request->fine_amt,
            'round_off' => $other_charges,
            'total_amt' => $request->total_amt,
            'amt_collect' => $request->amt_collect,
            'remarks' => $request->remarks,
            'pay_mode' => $request->disburse_transaction,
            'cheque_bank_name' => $request->cheque_bank_name,
            'cheque_no' => $request->cheque_no,
            'cheque_date' => $request->cheque_date,
            'onl_transfer_date' => $request->onl_transfer_date,
            'onl_transaction_no' => $request->onl_transaction_no,
            'onl_transfer_mode' => $request->onl_transfer_mode,
        ]);

        return redirect('/admin/loan_appli_accnt/'.$request->loan_id);
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

    public function overdue_notice_pdf($loanApplication_id)
    {
        $loan_account = LoanApplication::select(

            'member_management.first_name',
            'member_management.member_id_code',
            'member_management.address',
            'member_management.state',
            'member_management.pincode',
            'loan_disbursements.id as loanId',
            'company_branches.branch_name',
            'loan_disbursements.loan_disburse_date',
            'loan_disbursements.loan_amount',          
            )
        ->join('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
        ->join('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->join('company_branches', 'company_branches.id', '=', 'loan_applications.branch')

        ->where('loan_applications.loanApplication_id', '=', $loanApplication_id)
        ->get();

        $company_details = CompanyProfile::select('company_name','address','cin_no')->get();       

        $sum = DB::table('emi_details')
        ->select(DB::raw('SUM(emi_amt) as total_emi_amount, emi_date'))
        ->where('status', '=', 'overdue')
        ->where('loan_disbursement_id', '=', $loan_account[0]->loanId)
        ->get();

        $pdf= PDF::loadView('backend.pages.print_doc_loan.overdueNotice',compact('company_details','loan_account','sum'));
        return $pdf->stream("overdue-notice.pdf",array("Attachment" => false)); 

    }

    public function repayment_pdf($loanApplication_id)
    {
        $loan_account = LoanApplication::select(

            'member_management.first_name',
            'loan_disbursements.id',
            'loan_applications.loanApplication_id',
            'loan_disbursements.first_emi_date',          
            'company_branches.branch_name',
            'loan_applications.tenure_type',
            'loan_applications.tenure_months',
            'loan_applications.amt_approved',
            )
        ->join('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
        ->join('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->join('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->join('loan_schemas', 'loan_schemas.loanSchema_id', '=', 'loan_applications.loan_schema')
        ->where('loan_applications.loanApplication_id', '=', $loanApplication_id)
        ->get();

        $emi_details = EmiDetails::select('*')->where('loan_disbursement_id', '=', $loan_account[0]->id)->get();

       $company_details = CompanyProfile::select('company_name','address','cin_no')->get();
        
        $pdf= PDF::loadView('backend.pages.print_doc_loan.repayment',compact('company_details','loan_account','emi_details'));
        return $pdf->stream("Repayment.pdf",array("Attachment" => false)); 
    }



    public function loanClosingLetter_pdf($loanApplication_id)
    {
        $loan_account = LoanApplication::select(

            'member_management.first_name',
            'loan_disbursements.id as loanId',
            
            )
        ->join('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
        ->join('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->where('loan_applications.loanApplication_id', '=', $loanApplication_id)
        ->get();
       $company_details = CompanyProfile::select('company_name','address','cin_no')->get();

        $pdf= PDF::loadView('backend.pages.print_doc_loan.closing_req_letter',compact('company_details','loan_account'));
        return $pdf->stream("Closing-Req-letter.pdf",array("Attachment" => false)); 

    }

    public function loanStatus_pdf($loanApplication_id)
    {
       $company_details = CompanyProfile::select('company_name','address','cin_no')->get();
       $loan = LoanApplication::select(
        'member_management.member_id',
        'member_management.member_id_code',
        'member_management.first_name',
        'loan_disbursements.id as loanID',
        'loan_applications.loanApplication_id',
        'loan_applications.no_of_emis',

        'loan_disbursements.loan_disburse_date',
        'loan_disbursements.loan_amount',       
        'loan_disbursements.final_disburse_amt',      
        'company_branches.branch_name',     
        'loan_disbursements.loan_status',

        )
    ->leftjoin('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
    ->leftjoin('member_management', 'member_management.member_id', '=', 'loan_applications.member')
    ->leftjoin('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
    ->where('loan_applications.loanApplication_id', '=', $loanApplication_id)
    ->get();

    $emiCounts = DB::table('emi_details')
    ->select(
        DB::raw('COUNT(CASE WHEN status = "overdue" THEN 1 END) AS overdue_count'),
        DB::raw('COUNT(CASE WHEN status = "due" THEN 1 END) AS due_count'),
        DB::raw('COUNT(CASE WHEN status = "paid" THEN 1 END) AS paid_count')
    )
    ->where('loan_disbursement_id', $loan[0]->loanID)
    ->first();
   
        $pdf= PDF::loadView('backend.pages.print_doc_loan.loanStatus',compact('company_details','loan','emiCounts'));
        return $pdf->stream("loanStatus.pdf",array("Attachment" => false));
    }

    public function loan_agreement_pdf($loanApplication_id)
    {
        $application1 = LoanApplication::findorfail($loanApplication_id);
        $company_details = CompanyProfile::select('company_name','address','cin_no')->get();

        $pdf= PDF::loadView('backend.pages.loan_pdf.loan_agreement',compact('application1','company_details'));
        return $pdf->stream("Agreement-letter.pdf",array("Attachment" => false));

    }
    public function guaranty_letter_pdf($loanApplication_id)
    {
        $application = LoanApplication::findorfail($loanApplication_id);
        $company_details = CompanyProfile::select('company_name','address','cin_no')->get();


       // dd($application);
        $pdf= PDF::loadView('backend.pages.loan_pdf.guaranty_letter',compact('application','company_details'));
        return $pdf->stream("guaranty-letter.pdf",array("Attachment" => false));

    }
    public function receipt_letter_pdf($loanApplication_id)
    {
        $application = LoanApplication::findorfail($loanApplication_id);
        $company_details = CompanyProfile::select('company_name','address','cin_no')->get();


       // dd($application);
       $pdf= PDF::loadView('backend.pages.loan_pdf.loan_receipt',compact('application','company_details'));
        return $pdf->stream("loan_receipt.pdf",array("Attachment" => false));
    }


    public function closedLoan($id)
    {
       // dd("hii");
        $loan_id = LoanDisbursement::find($id);
        $count_loan_id =DB::select("SELECT COUNT(`emi_no`) as emi FROM `emi_details` WHERE `loan_disbursement_id` = ".$loan_id->id."")[0]->emi;
        $t_date = Carbon::now();
        $count = DB::select("SELECT COUNT(`emi_no`) as emi FROM `emi_details` WHERE `loan_disbursement_id` = ".$loan_id->id." AND `status` = 'Paid'")[0]->emi;
        //dd($count_loan_id);
        if ($loan_id) {
            if($count_loan_id ==  $count){
            $loan_id->update(['loan_status' => 'Closed','loan_close_date'=>$t_date]);

            session()->flash('success', 'Loan has been Closed !!');
            return redirect()->back();
            }else{
            session()->flash('error', 'It has not paid Emis please check !!');
            return redirect()->back();
            }
        }
    }
 

}
