<?php

namespace App\Http\Controllers\Backend\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\EmiDetails;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\LoanApplication;
use App\Models\LoanDisbursement;
use DateTime;

class LoanDisbursementController extends Controller
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
        if (is_null($this->user) || !$this->user->can('loan_disbursement.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view Loan Disbursement !');
        }

        $application = LoanApplication::where('status','Approved')->get();
        //dd($application);
        return view('backend.pages.loan_disbursements.index')->withApplications($application);
    }

    public function cancelLoan($loanApplication_id)
    {
        $cancel_loan = LoanApplication::find($loanApplication_id);
        // $cancel_loan->status = "Cancelled";

        if ($cancel_loan) {
            $cancel_loan->update(['status' => 'Cancelled']);
        }

        return redirect()->back();

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
       
        $loan_status = LoanApplication::select('status')->where('loanApplication_id', '=', $request->loanApplication_id)->get();
        //dd($loan_status);
        if($loan_status[0]->status == 'Approved'){
            $check_disburse = LoanDisbursement::select('*')->where('loanApplication_id', '=', $request->loanApplication_id)->count();
            //dd($check_disburse);
            if($check_disburse == 0){
                $disburse = new LoanDisbursement();
                $disburse->loan_amount            =       $request->loan_amount;
                $disburse->processing_fee         =       $request->processing_fee;
                $disburse->insurance_charge       =       $request->insurance_charge;

                $disburse->stamp_fee              =       $request->stamp_fee_charge;

                $disburse->final_disburse_amt     =       $request->final_disburse_amt;
                $disburse->loan_disburse_date     =       $request->loan_disburse_date;
                $disburse->first_emi_date         =       $request->first_emi_date;
                $disburse->disburse_amt           =       $request->disburse_amt;
                $disburse->disburse_transaction   =       $request->disburse_transaction;
                $disburse->cheque_bank_name       =       $request->cheque_bank_name;
                $disburse->cheque_no              =       $request->cheque_no;
                $disburse->cheque_date            =       $request->cheque_date;
                $disburse->onl_transfer_date      =       $request->onl_transfer_date;
                $disburse->onl_transaction_no     =       $request->onl_transaction_no;
                $disburse->onl_transfer_mode      =       $request->onl_transfer_mode;
                $disburse->loanApplication_id     =       $request->loanApplication_id;
                $disburse->loan_status            =    'Active';

                $disburse->save();

                if($disburse->save()){
                    $name = $request->member_name;
                    $mobile = $request->member_mobile;
                    $amount = $request->loan_amount;

                    $dlt = app('App\Http\Controllers\Backend\SetSmsGatewayController')->loanDisburse($name,$mobile,$amount);

                }


                if($disburse->save()) {
                    $emiJSON = json_decode($request->emi_details, true);
                    $emi = $emiJSON['emi'];
                    foreach ($emi as $val)
                    {
                        //echo $val['Emi_No'];
                        $emi_details = new EmiDetails();        
                        $emi_details->loan_disbursement_id = $disburse->id;
                        $emi_details->emi_no = $val['Emi_No'];
                        $emi_details->emi_date = DateTime::createFromFormat('d-m-Y', $val['EMI_DATE'])->format('Y-m-d'); 
                        $emi_details->emi_due_date = DateTime::createFromFormat('d-m-Y', $val['DUE_DATE'])->format('Y-m-d');
                        $emi_details->principal_amt = $val['PRINCIPAL'];
                        $emi_details->interest = $val['INTEREST'];
                        $emi_details->other_charges = $val['OTHER_CHRG'];
                        $emi_details->emi_amt = $val['EMI'];
                        $emi_details->bal_principal = $val['BAL_PRINCIPAL'];
                        $emi_details->status = "Pending";

                        $emi_details->save();
                    }
                }
                session()->flash('success', 'Loan Amount  has been Disburse !!');
                return redirect()->route('admin.disbursement_approval');
            } else {
                session()->flash('error', 'Loan Amount is waiting for Disburse !!');
                return redirect()->route('admin.disbursement_approval');
            }    
        }
        
        elseif($loan_status[0]->status == 'RequestForApproval') {
            session()->flash('error', 'Please approve the loan request first !!');
            return redirect()->route('admin.loan_approval.index');
        }
        elseif($loan_status[0]->status == 'Disbursed') {
            session()->flash('error', 'Loan Amount has already Disburse !!');
            return redirect()->route('admin.loan_approval.index');
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
        if (is_null($this->user) || !$this->user->can('loan_disbursement.show')) {
            abort(403, 'Sorry !! You are Unauthorized to show Loan Disbursement !');
        }

        $application = LoanApplication::findOrFail($loanApplication_id);
        //dd($application);
        return view('backend.pages.loan_disbursements.show')->withApplications($application);   
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
    public function update(Request $request, $loanApplication_id)
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
