<?php

namespace App\Http\Controllers\Backend\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Image;
use PDF;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\MemberManagement;
use App\Models\CompanyBranch;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Http;
use App\Models\LoanSchema;
use App\Models\LoanApplication;
use App\Models\HrManagement;
use App\Models\LoanDisbursement;
use App\Models\LoanDocumentUpload;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Symfony\Contracts\Service\Attribute\Required;

class LoanApplicationController extends Controller
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
        if (is_null($this->user) || !$this->user->can('loan_application.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view Loan Application !');
        }

        if(!count($request->all()) >= 1){
            $application = [];
            $branch= CompanyBranch::pluck('id','branch_name');
            $hrmanagements= HrManagement::pluck('hrmanagement_id','name');
            return view('backend.pages.loan_application.index',compact('branch','hrmanagements'))->withApplications($application);
        
        }

        $branch = $request->branch;
        $associate = $request->associate;
        $phone_no = $request->phone_no;
        $member_code = $request->member_code;
        $member_name = $request->member_name;
        $application = $request->application;
        $application_date = $request->application_date;
        
        $where = [];
        $branch = $request->branch;
        if ($branch) {
            $where[] = ['company_branches.id', '=', $branch];
        }

        $associate = $request->associate;

        if ($associate) {
            $where[] = ['hr_management.hrmanagement_id', '=', $associate];
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

        $application = $request->application;
        if ($application) {
            $where[] = ['loan_applications.loanApplication_id', '=', $application];
        }

        $application_date = $request->application_date;
        if ($application_date) {
            $where[] = ['loan_applications.application_date', '=', $application_date];
        }



        $application = LoanApplication::select(
            'loan_applications.*',
            'member_management.mobile',
            'member_management.first_name',
            'member_management.member_id_code',

            'hr_management.name as employee_name',
            'company_branches.branch_name',

            )->leftjoin('member_management','member_management.member_id','=','loan_applications.member')
            ->leftjoin('hr_management','hr_management.hrmanagement_id','=','loan_applications.associate')
            
            ->leftjoin('company_branches','company_branches.id','=','loan_applications.branch')

             ->where($where)
            ->get();

   
        $branch= CompanyBranch::pluck('id','branch_name');
        $hrmanagements= HrManagement::pluck('hrmanagement_id','name');

        return view('backend.pages.loan_application.index',compact('branch','hrmanagements'))->withApplications($application);

       
    }

    public function filterSearch(Request $request)
    {
       // dd($request);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('loan_application.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create Loan Application !');
        }

        $branch= CompanyBranch::pluck('id','branch_name');
        //dd($branch);
        //$member= MemberManagement::pluck('member_id','first_name','last_name');
        $member = MemberManagement::select('*')->where('status', '=', "Active")->get();
        $schema= LoanSchema::select('*')->where('active','=',"yes")->get();
        $hrmanagement= HrManagement::select('name','hrmanagement_id','emp_code')->get();
       // dd($hrmanagement);
       
        return view('backend.pages.loan_application.create')->withBranches($branch)->withMembers($member)->withSchemas($schema)->withHrmanagements($hrmanagement);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('loan_application.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create Loan Application !');
        }
      //  dd($request);
        $check_status = MemberManagement::select('status','mobile','first_name')->where('member_id', '=', $request->member)->get();
        
        if($check_status[0]->status == "Active"){
       
            $application = new LoanApplication();
            $application->application_date            =       $request->application_date;
            $application->member                      =       $request->member;
            $application->member_name                 =       $request->member_name;
            $application->branch                      =       $request->branch;
            $application->associate                   =       $request->associate;
            $application->coapplicant_member1         =       $request->coapplicant_member1;
            $application->guarantor_member1           =       $request->guarantor_member1;
            $application->coapplicant_member2         =       $request->coapplicant_member2;
            $application->guarantor_member2           =       $request->guarantor_member2;
            // $application->sec_type                    =       $request->sec_type;
            $application->loan_schema                 =       $request->loan_schema;
                        
            $application->tenure_type                 =       $request->tenure_type;
            $application->tenure_months               =       $request->tenure_months;
            $application->emi_collection              =       $request->emi_collection;
            $application->credit_period               =       $request->credit_period;
            $application->loan_requested              =       $request->loan_requested;
            $application->status                      =       'RequestForApproval';
            $application->amt_approved                =        $request->amt_approved;
            $application->interest_amount             =        $request->interest_amount;
            $application->other_charges               =        $request->other_charges;
            $application->total_amount_coll           =        $request->total_amount_coll;
            $application->emi_amount_total            =        $request->emi_amount_total;
            $application->no_of_emis                  =        $request->no_of_emis;
            $application->processing_charges          =        $request->processing_charges;
        
            $application->save();

            if($application->save()){

                $member_mobile = $check_status[0]->mobile;
                $member_name = $check_status[0]->first_name;
                $application_no = $application->loanApplication_id;
                $amount = $application->amt_approved;
                // $response = Http::get('message.neodove.com/sendsms.jsp?user=BOUNDPAR&password=7c51237a44XX&senderid=BPTOPE&mobiles=+91'.$member_mobile.'&sms=Dear '.$member_name.' your Loan application no'.$application->loanApplication_id.' successfully generated . Your loan amount '.$application->amt_approved .'. BOUNDPARIVAR');

                 $dlt = app('App\Http\Controllers\Backend\SetSmsGatewayController')->loanAppliCreate($member_mobile,$member_name,$application_no,$amount);

            }

            session()->flash('success', 'Approval request has been made for business loan application and is pending for approval !!');
            return redirect()->route('admin.loan_application.index');
        }
        else{
            session()->flash('error', 'Member is not Active !!');
            return redirect()->route('admin.loan_application.create');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($loanApplication_id)
    {
        $application = LoanApplication::findOrFail($loanApplication_id);
        //dd($application);
        $doc = LoanDocumentUpload::select('*')->where('loanApplication_id', '=', $loanApplication_id)->get();
 
        return view('backend.pages.loan_application.show', compact('doc'))->withApplications($application);
    }

    public function loan_appli_details($loanApplication_id)
    {
        $application = LoanApplication::select('*')->join('loan_schemas','loan_schemas.loanSchema_id', '=', 'loan_applications.loan_schema')->where('loanApplication_id', '=', $loanApplication_id)->get();
        //dd($application);
       return $application->toJson();
 
       // return $schema->toJson(JSON_PRETTY_PRINT);
        // return response()->json([
        //     'name' => 'Abigail',
        //     'state' => 'CA',
        // ]);
       
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function approval()
     {
        if (is_null($this->user) || !$this->user->can('loan_application.approve')) {
            abort(403, 'Sorry !! You are Unauthorized to approve Loan Application !');
        }
        $application = LoanApplication::where('status','RequestForApproval')->get();
        //dd($application);
        return view('backend.pages.loan_application_approval.show')->withApplications($application);
     }

     public function updateStatus(Request $request, $loanApplication_id)
     {
        $loan_application=LoanApplication::findOrFail($loanApplication_id);

        
        if($request->status == 'Approved' || $request->status == 'NotApproved') {

            $request->validate([
                'amt_approved' => 'required',
                'status' => 'required',
            ]);
            $loan_application->amt_approved = $request->amt_approved;
            $loan_application->status = $request->status;
            $loan_application->remarks = $request->remarks;
           
            $loan_application->save();

            if($request->status == 'Approved'){
                $loan_application_id = $loan_application->loanApplication_id;
                $response = Http::get('message.neodove.com/sendsms.jsp?user=BOUNDPAR&password=7c51237a44XX&senderid=BPTCPE&mobiles=+91'.$request->mobile.'&sms=Dear Customer , Your Loan application '.$loan_application_id.' is approved. BOUNDPARIVAR');

            }
            if($request->status == 'NotApproved'){
                $mobile_no = $request->mobile;
                $loan_application_id = $loan_application->loanApplication_id;
                // $response = Http::get('message.neodove.com/sendsms.jsp?user=BOUNDPAR&password=7c51237a44XX&senderid=BPTCPE&mobiles=+91'.$request->mobile.'&sms=Dear Customer , Your Loan application '.$loan_application_id.' is rejected. BOUNDPARIVAR');
                $dlt = app('App\Http\Controllers\Backend\SetSmsGatewayController')->loanRejected($mobile_no,$loan_application_id);

            }

        
        }
        elseif($request->status == 'Pending' || $request->status == 'Disbursed') {
        
            $loan_application->status = $request->status;
            $loan_application->remarks = $request->remarks;
           
            $loan_application->save();
            // if($loan_application->save()){
            //     $mobile_no = $request->mobile;
            //     $loan_application_id = $loan_application->loanApplication_id;
            //     // $response = Http::get('message.neodove.com/sendsms.jsp?user=BOUNDPAR&password=7c51237a44XX&senderid=BPTCPE&mobiles=+91'.$request->mobile.'&sms=Dear Customer, your Loan application '.$loan_application_id.' is successfully disbursement. BOUNDPARIVAR');
            //     $dlt = app('App\Http\Controllers\Backend\SetSmsGatewayController')->loanDisburseApprove($mobile_no,$loan_application_id);

            // }
        }
        
 
     }

     public function disbursement_approval()
    {
        if (is_null($this->user) || !$this->user->can('loan_disbursement.approve')) {
            abort(403, 'Sorry !! You are Unauthorized to Approve Loan Disbursement !');
        }
        $loan_disbursement = LoanDisbursement::select(
            'company_branches.branch_name',
            'member_management.first_name',
            'member_management.member_id',
            'member_management.mobile',

            'loan_disbursements.*'
            )
        ->join('loan_applications', 'loan_applications.loanApplication_id', '=', 'loan_disbursements.loanApplication_id')
        ->join('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->join('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->where('loan_applications.status', '=', "Approved")
        ->get();

        //$loan_disbursement = MemberManagement::with('loanApplication')->get();
        
        //dd($loan_disbursement);
        return view('backend.pages.loan_application_approval.index', compact('loan_disbursement'));
    }


    public function edit($loanApplication_id)
    {
        $application = LoanApplication::find($loanApplication_id);
        $branch= CompanyBranch::pluck('id','branch_name');
        //dd($branch);
        //$member= MemberManagement::pluck('member_id','first_name','last_name');
        $member = MemberManagement::select('*')->where('status', '=', "Active")->get();
        $schema= LoanSchema::select('*')->where('active','=',"yes")->get();
        $hrmanagement= HrManagement::select('name','hrmanagement_id','emp_code')->get();
       // dd($hrmanagement);
 
        return view('backend.pages.loan_application.edit',compact('application'))->withBranches($branch)->withMembers($member)->withSchemas($schema)->withHrmanagements($hrmanagement); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Responsedisbursement_approval
     */
    public function update(Request $request, $id)
    {
       
        
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

    public function uploadDoc(Request $request)
    {
        $loan_application=LoanApplication::findOrFail($request->id);
        //dd( $loan_application);
        return view('backend.pages.loan_application.uploadDoc', compact('loan_application'));
    }

    public function loan_doc_upload(Request $request )
    {
   
    $files= [];
        if($request->hasfile('doc_file'))
        {
    
           foreach ($request->file('doc_file') as $index => $file)
           {

                // $group_filename='Group_photo_'.$request->group_name.time().'.'.$group_file->getClientOriginalExtension();
                // $destinationPath = public_path('images/Group_photo');
                // $group_file->move($destinationPath,$group_filename);

            $name = $request->doc_name[$index].$file->getClientOriginalExtension();
            $destinationPath=public_path('/images/loanApplicationDocUpload');
            $file->move($destinationPath,$name);
            $doc = new LoanDocumentUpload();
            $doc->doc_name = $request->doc_name[$index];
            $doc->doc_file = $name;
            $doc->loanApplication_id= $request->loan_id;
            $doc->save();
           }
        }
        return redirect('/admin/loan_application/'.$request->loan_id);
    }

    public function del_doc($loan_id)
    {
        $loan_doc = LoanDocumentUpload::find($loan_id);
        $loan_doc->delete();

        return back();
    }

    public function promissory_letter_pdf($loanApplication_id)
    {
        $application = LoanApplication::findorfail($loanApplication_id);
        $company_details = CompanyProfile::select('company_name','address','cin_no')->get();

        $pdf= PDF::loadView('backend.pages.loan_pdf.promissory_letter',compact('application','company_details'));

        return $pdf->stream("promissory-letter.pdf",array("Attachment" => false));
        dd($company_details);
 
    }

    public function undertaking_letter_pdf($loanApplication_id)
    {
        $applications = LoanApplication::findorfail($loanApplication_id);
        $company_details = CompanyProfile::select('company_name','address','cin_no')->get();

        $pdf= PDF::loadView('backend.pages.loan_pdf.undertaking_letter',compact('applications','company_details'));
        return $pdf->stream("promissory-letter.pdf",array("Attachment" => false));
 
    }

    public function sanction_letter_pdf($loanApplication_id)
    {
        $applications = LoanApplication::findorfail($loanApplication_id);
        $company_details = CompanyProfile::select('company_name','address','cin_no')->get();

        $pdf= PDF::loadView('backend.pages.loan_pdf.sanction_letter',compact('applications','company_details'));
       return $pdf->stream("sanction-letter.pdf",array("Attachment" => false));
 
    }

    public function application_letter_pdf($loanApplication_id)
    {

        $applications = LoanApplication::select(
            'member_management.member_id_code',
            'member_management.first_name',
            'loan_disbursements.id',
            'loan_applications.loanApplication_id',
            'loan_disbursements.loan_disburse_date',
            'loan_disbursements.first_emi_date',
            'loan_schemas.schema_name',
            'loan_disbursements.final_disburse_amt',
            'company_branches.branch_name',
            'loan_schemas.ann_rate_int',
            'loan_schemas.grace_period',
            'loan_schemas.int_type',
            'loan_applications.tenure_type',
            'loan_applications.tenure_months',
            'loan_applications.amt_approved',

            'loan_schemas.max_tanure',
            'loan_applications.processing_charges',
            'member_management.nominee_name',
            'member_management.nominee_relation',
            'member_management.mobile',
            'member_management.address',
            'loan_disbursements.loan_disburse_date',
            'loan_schemas.schema_code',

   
            )
        ->leftjoin('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
        ->leftjoin('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->leftjoin('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->leftjoin('loan_schemas', 'loan_schemas.loanSchema_id', '=', 'loan_applications.loan_schema')
        ->where('loan_applications.loanApplication_id', '=', $loanApplication_id)
        ->get();
    //    dd($applications);

        $company_details = CompanyProfile::select('company_name','address','cin_no')->first();

        // dd($company_details);
         $pdf= PDF::loadView('backend.pages.loan_pdf.application_letter',compact('applications','company_details'));
       return $pdf->stream("application_letter.pdf",array("Attachment" => false));
    // return view('backend.pages.loan_pdf.application_letter');
      
 
    }

}
