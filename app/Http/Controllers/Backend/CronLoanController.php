<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanDisbursement;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\EmiDetails;
use App\Models\AccountDebitCredit;
use App\Models\MembersPayment;
use App\Models\EmployeeSalaryRelease;
use DB;
use Carbon\Carbon;


class CronLoanController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    

    //processing fee revenue
    public static function processingFee()
    {
        $ledger_account = "PROCESSING CHARGES";
        $runtime = Carbon::now()->format('Y-m-d H:i:s');
       //resolution to be add default 
        $fetchData = DB::table('last_log_run_accounts')->where('ledger_accounts','PROCESSING CHARGES')->orderBy('id','desc')->first();

        $createData = DB::table('last_log_run_accounts')->insertGetId([
            'ledger_accounts' => $ledger_account,
            'run_time' =>$runtime,

        ]);
    

         $list_processing_fee = LoanDisbursement::select(
             'loan_disbursements.id',
             'loan_disbursements.processing_fee',
             'loan_disbursements.created_at',
             'loan_applications.member',
             'member_management.first_name',
             'member_management.member_id_code',
             'company_branches.branch_name',
             'company_branches.id as BranchId',

             )->leftjoin('loan_applications','loan_applications.loanApplication_id','=','loan_disbursements.loanApplication_id')
             ->leftjoin('member_management','member_management.member_id','=','loan_applications.member')
             ->leftjoin('company_branches','company_branches.id','=','loan_applications.branch')
             ->orderBy('loan_disbursements.created_at')
             ->where('loan_disbursements.created_at','>',$fetchData->run_time)
             ->get();
        
            //PROCESSING CHARGES CODE 121
             $results = DB::table('ledger_accounts as la')
                ->select('la.id as account_id')
                ->where('la.name', '=', 'PROCESSING CHARGES')
                ->first();

            
            $lastEntry = DB::table('account_debit_credits')->where('ledger_account_id','=',$results->account_id)->orderBy('id','desc')->first();

             if($lastEntry){  
                 
             $sumprocfees = $lastEntry->closing_acc_balance;  
             
             foreach($list_processing_fee as $key=>$fees){

                $fees['description'] ='Other loan a/c '.$fees->id." ".$fees->first_name." ".$fees->member_id_code." debit to cash";

                $fees['credit'] = $fees->processing_fee;
                // $fees['obalance'] = $key==0?$fees->processing_fee:$sumprocfees;
                $fees['obalance'] = $key==0?$lastEntry->closing_acc_balance:$sumprocfees;

                $sumprocfees = $sumprocfees+$fees->processing_fee;

                $fees['close_balance'] = $key==0?$lastEntry->closing_acc_balance+$fees['credit']:$fees['obalance'] + $fees['credit'];
                $fees['branch'] = $fees->branch_name;
                $fees['is_system'] = 'Yes';

             }
             
             foreach($list_processing_fee as $store){

                $account = new AccountDebitCredit();
                $account->opening_acc_balance = $store->obalance;
                $account->amount = $store->credit;
                $account->description = $store->description;
                $account->closing_acc_balance = $store->close_balance;
                $account->branch_id = $store->BranchId;
                $account->ledger_account_id = $results->account_id;
                $account->type = 'credit';
                $account->save();
              
             }
           
            }elseif($lastEntry == null){
                $sumprocfees = 0;
                $cummulative_data = [];
                $test = [];
                foreach($list_processing_fee as $key=>$fees){
   
                   $fees['description'] ='Other loan a/c '.$fees->id." ".$fees->first_name." ".$fees->member_id_code." debit to cash";
   
                   $fees['credit'] = $fees->processing_fee;
                   $fees['obalance'] = $key==0?0:$sumprocfees;
                   $sumprocfees = $sumprocfees+$fees->processing_fee;
                   $fees['close_balance'] = $key==0?0+$fees['credit']:$fees['obalance'] + $fees['credit'];
                   $fees['branch'] = $fees->branch_name;
                   $fees['is_system'] = 'Yes';
   
                }
   
                // return $list_processing_fee;
                foreach($list_processing_fee as $store){
   
                   $account = new AccountDebitCredit();
                   $account->opening_acc_balance = $store->obalance;
                   $account->amount = $store->credit;
                   $account->description = $store->description;
                   $account->closing_acc_balance = $store->close_balance;
                   $account->branch_id = $store->BranchId;
                   $account->ledger_account_id = $results->account_id;
                   $account->type = 'credit';
                   $account->save();
                 
                }     
            }
            return $list_processing_fee;

           
    }




    //insurance charge liability
    public function insuranceCharge()
    {
        $ledger_account = "INSURANCE FEE";
        $runtime = Carbon::now()->format('Y-m-d H:i:s');
       //resolution to be add default 
        $fetchData = DB::table('last_log_run_accounts')->where('ledger_accounts','INSURANCE FEE')->orderBy('id','desc')->first();

        $createData = DB::table('last_log_run_accounts')->insertGetId([
            'ledger_accounts' => $ledger_account,
            'run_time' =>$runtime,

        ]);
        $list_insurance_charge = LoanDisbursement::select(
            'loan_disbursements.id',
            'loan_disbursements.insurance_charge',
            'loan_disbursements.created_at',
            'loan_applications.member',
            'member_management.first_name',
            'member_management.member_id_code',
            'company_branches.branch_name',
            'company_branches.id as BranchId',


            )->leftjoin('loan_applications','loan_applications.loanApplication_id','=','loan_disbursements.loanApplication_id')
            ->leftjoin('member_management','member_management.member_id','=','loan_applications.member')
            ->leftjoin('company_branches','company_branches.id','=','loan_applications.branch')
            ->orderBy('loan_disbursements.created_at')
            ->where('loan_disbursements.insurance_charge','!=',0)
            ->where('loan_disbursements.created_at','>',$fetchData->run_time)
            ->get();
           // dd($list_insurance_charge);
            //INSURANCE FEE CODE 4100
            $results = DB::table('ledger_accounts as la')
                ->select('la.id as account_id')
                ->where('la.name', '=', 'INSURANCE FEE')
                ->first();

            $lastEntry = DB::table('account_debit_credits')->where('ledger_account_id','=',$results->account_id)->orderBy('id','desc')->first();
            
            if($lastEntry){  
                 
                $sum_insfees = $lastEntry->closing_acc_balance;  
                
                foreach($list_insurance_charge as $key=>$fees){
   
                   $fees['description'] ='Other loan a/c '.$fees->id." ".$fees->first_name." ".$fees->member_id_code." debit to cash";
   
                   $fees['credit'] = $fees->insurance_charge;
                   // $fees['obalance'] = $key==0?$fees->processing_fee:$sumprocfees;
                   $fees['obalance'] = $key==0?$lastEntry->closing_acc_balance:$sum_insfees;
   
                   $sum_insfees = $sum_insfees+$fees->insurance_charge;
   
                   $fees['close_balance'] = $key==0?$lastEntry->closing_acc_balance+$fees['credit']:$fees['obalance'] + $fees['credit'];
                   $fees['branch'] = $fees->branch_name;
                   $fees['is_system'] = 'Yes';
   
                }
                
                foreach($list_insurance_charge as $store){
   
                   $account = new AccountDebitCredit();
                   $account->opening_acc_balance = $store->obalance;
                   $account->amount = $store->credit;
                   $account->description = $store->description;
                   $account->closing_acc_balance = $store->close_balance;
                   $account->branch_id = $store->BranchId;
                   $account->ledger_account_id = $results->account_id;
                   $account->type = 'credit';
                   $account->save();
                 
                }
              
        }elseif($lastEntry == null){
            $sum_ins_fees = 0;

            foreach($list_insurance_charge as $key=>$fees){
           
               $fees['description'] ='Other loan a/c '.$fees->id." ".$fees->first_name." ".$fees->member_id_code." debit to cash";
               $fees['credit'] = $fees->insurance_charge;
               $fees['obalance'] = $key==0?0:$sum_ins_fees;
               $sum_ins_fees = $sum_ins_fees+$fees->insurance_charge;
               $fees['close_balance'] = $key==0?0+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['branch'] = $fees->branch_name;
               $fees['is_system'] = 'Yes';

            }
             foreach($list_insurance_charge as $store){
                $account = new AccountDebitCredit();
                $account->opening_acc_balance = $store->obalance;
                $account->amount = $store->credit;
                $account->description = $store->description;
                $account->closing_acc_balance = $store->close_balance;
                $account->branch_id = $store->BranchId;
                $account->ledger_account_id = $results->account_id;

                $account->type = 'credit';
                $account->save();
              
             }
        }
             return $list_insurance_charge;

    }


    //other charge like sms, stationary,collection,fuel charge all calc in other charge in loan. LEDGER CHARGES PER EMI
    public function loanOtherCharge()
    {
        $ledger_account = "CHARGES PER EMI";
        $runtime = Carbon::now()->format('Y-m-d H:i:s');
       //resolution to be add default 
        $fetchData = DB::table('last_log_run_accounts')->where('ledger_accounts','CHARGES PER EMI')->orderBy('id','desc')->first();

        $createData = DB::table('last_log_run_accounts')->insertGetId([
            'ledger_accounts' => $ledger_account,
            'run_time' =>$runtime,

        ]);

        $emi_other_charge = EmiDetails::select(
            'emi_details.other_charges',
            'emi_details.status',
            'emi_details.loan_disbursement_id as LoanId',
            'emi_details.paid_date',
            'member_management.first_name as memberName',
            'member_management.member_id_code',
            'company_branches.branch_name',
            'company_branches.id as BranchId',

        )
        ->leftjoin('loan_disbursements','loan_disbursements.id','=','emi_details.loan_disbursement_id')
        ->leftjoin('loan_applications','loan_applications.loanApplication_id','=','loan_disbursements.loanApplication_id')
        ->leftjoin('member_management','member_management.member_id','=','loan_applications.member')
        ->leftjoin('company_branches','company_branches.id','=','loan_applications.branch')
        ->where('emi_details.status','=','Paid')
        ->where('emi_details.paid_date','>',$fetchData->run_time)

        ->get();
        
        //CHARGES PER EMI CODE CHG2203
        $results = DB::table('ledger_accounts as la')
                ->select('la.id as account_id')
                ->where('la.name', '=', 'CHARGES PER EMI')
                ->first();

                $lastEntry = DB::table('account_debit_credits')->where('ledger_account_id','=',$results->account_id)->orderBy('id','desc')->first();
            
                if($lastEntry){  
                     
                    $sum_chrge_fees = $lastEntry->closing_acc_balance;  
                    
                    foreach($emi_other_charge as $key=>$fees){
       
                       $fees['description'] ='Other loan a/c '.$fees->id." ".$fees->first_name." ".$fees->member_id_code." debit to consolidated EMI charges.";     
                       $fees['credit'] = $fees->other_charges;
                       $fees['obalance'] = $key==0?$lastEntry->closing_acc_balance:$sum_chrge_fees;      
                       $sum_chrge_fees = $sum_chrge_fees+$fees->other_charges;
                       $fees['close_balance'] = $key==0?$lastEntry->closing_acc_balance+$fees['credit']:$fees['obalance'] + $fees['credit'];
                       $fees['branch'] = $fees->branch_name;
                       $fees['is_system'] = 'Yes';
       
                    }
                    
                    foreach($emi_other_charge as $store){
       
                       $account = new AccountDebitCredit();
                       $account->opening_acc_balance = $store->obalance;
                       $account->amount = $store->credit;
                       $account->description = $store->description;
                       $account->closing_acc_balance = $store->close_balance;
                       $account->branch_id = $store->BranchId;
                       $account->ledger_account_id = $results->account_id;
                       $account->type = 'credit';
                       $account->save();
                     
                    }
                  
                }elseif($lastEntry == null){
                    $sum_chrge_fees = 0;

                    foreach($emi_other_charge as $key=>$fees){

                    $fees['description'] ='Other loan a/c'.$fees->LoanId." ".$fees->memberName." ".$fees->member_id_code." debit to consolidation EMI charge";
                    $fees['credit'] = $fees->other_charges;
                    $fees['obalance'] = $key==0?0:$sum_chrge_fees;
                    $sum_chrge_fees = $sum_chrge_fees+$fees->other_charges;
                    $fees['close_balance'] = $key==0?0+$fees['credit']:$fees['obalance'] + $fees['credit'];
                    $fees['branch'] = $fees->branch_name;
                    $fees['is_system'] = 'Yes';

                    }
                    foreach($emi_other_charge as $store){
                        $account = new AccountDebitCredit();
                        $account->opening_acc_balance = $store->obalance;
                        $account->amount = $store->credit;
                        $account->description = $store->description;
                        $account->closing_acc_balance = $store->close_balance;
                        $account->branch_id = $store->BranchId;
                        $account->ledger_account_id = $results->account_id;

                        $account->type = 'credit';
                        $account->save();
                    
                    }
                }

        return $emi_other_charge;
    }

    //overdue charges as overdue loan revenue
    public function loanPaneltyCharge()
    {
        $ledger_account = "OVER DUE CHARGES";
        $runtime = Carbon::now()->format('Y-m-d H:i:s');
       //resolution to be add default 
        $fetchData = DB::table('last_log_run_accounts')->where('ledger_accounts','OVER DUE CHARGES')->orderBy('id','desc')->first();

        $createData = DB::table('last_log_run_accounts')->insertGetId([
            'ledger_accounts' => $ledger_account,
            'run_time' =>$runtime,

        ]);

        $emi_panelty_charge = EmiDetails::select(
            'emi_details.fine_amt',
            'emi_details.status',
            'emi_details.loan_disbursement_id as LoanId',
            'emi_details.paid_date',
            'member_management.first_name as memberName',
            'member_management.member_id_code',
            'company_branches.branch_name',
            'company_branches.id as BranchId',

        )
        ->leftjoin('loan_disbursements','loan_disbursements.id','=','emi_details.loan_disbursement_id')
        ->leftjoin('loan_applications','loan_applications.loanApplication_id','=','loan_disbursements.loanApplication_id')
        ->leftjoin('member_management','member_management.member_id','=','loan_applications.member')
        ->leftjoin('company_branches','company_branches.id','=','loan_applications.branch')
        ->where('emi_details.status','=','Paid')
        ->where('emi_details.fine_amt','!=',0)
        ->where('emi_details.paid_date','>',$fetchData->run_time)
        ->get();

        //OVERDUE CHARGES CODE 123
        $results = DB::table('ledger_accounts as la')
        ->select('la.id as account_id')
        ->where('la.name', '=', 'OVER DUE CHARGES')
        ->first();


        $lastEntry = DB::table('account_debit_credits')->where('ledger_account_id','=',$results->account_id)->orderBy('id','desc')->first();
            
        if($lastEntry){  
             
            $sum_panelty_fees = $lastEntry->closing_acc_balance;  
            
            foreach($emi_panelty_charge as $key=>$fees){

               $fees['description'] ='Other loan overdue interest debit to other loan a/c '.$fees->id." ".$fees->first_name." ".$fees->member_id_code." .";     
               $fees['credit'] = $fees->fine_amt;
               $fees['obalance'] = $key==0?$lastEntry->closing_acc_balance:$sum_panelty_fees;      
               $sum_panelty_fees = $sum_panelty_fees+$fees->fine_amt;
               $fees['close_balance'] = $key==0?$lastEntry->closing_acc_balance+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['branch'] = $fees->branch_name;
               $fees['is_system'] = 'Yes';

            }
            
            foreach($emi_panelty_charge as $store){

               $account = new AccountDebitCredit();
               $account->opening_acc_balance = $store->obalance;
               $account->amount = $store->credit;
               $account->description = $store->description;
               $account->closing_acc_balance = $store->close_balance;
               $account->branch_id = $store->BranchId;
               $account->ledger_account_id = $results->account_id;
               $account->type = 'credit';
               $account->save();
             
            }
          
        }elseif($lastEntry == null){
            $sum_panelty_fees = 0;

            foreach($emi_panelty_charge as $key=>$fees){

               $fees['description'] ='Other loan overdue interest debit to other loan a/c '.$fees->LoanId." ".$fees->memberName." ".$fees->member_id_code." .";

               $fees['credit'] = $fees->fine_amt;
               $fees['obalance'] = $key==0?0:$sum_panelty_fees;
               $sum_panelty_fees = $sum_panelty_fees+$fees->fine_amt;
               $fees['close_balance'] = $key==0?0+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['branch'] = $fees->branch_name;
               $fees['is_system'] = 'Yes';

            }
            foreach($emi_panelty_charge as $store){

                $account = new AccountDebitCredit();
                $account->opening_acc_balance = $store->obalance;
                $account->amount = $store->credit;
                $account->description = $store->description;
                $account->closing_acc_balance = $store->close_balance;
                $account->branch_id = $store->BranchId;
                $account->ledger_account_id = $results->account_id;
                $account->type = 'credit';
                $account->save();
              
             }
        }

        return $emi_panelty_charge;


    }

    //stamp charge revenue
    public function loanStampCharge()
    {
        $ledger_account = "STAMP DUTY";
        $runtime = Carbon::now()->format('Y-m-d H:i:s');
       //resolution to be add default 
        $fetchData = DB::table('last_log_run_accounts')->where('ledger_accounts','STAMP DUTY')->orderBy('id','desc')->first();

        $createData = DB::table('last_log_run_accounts')->insertGetId([
            'ledger_accounts' => $ledger_account,
            'run_time' =>$runtime,

        ]);

        $list_stamp_charge = LoanDisbursement::select(
            'loan_disbursements.id',
            'loan_disbursements.stamp_fee',
            'loan_disbursements.created_at',
            'loan_applications.member',
            'member_management.first_name',
            'member_management.member_id_code',
            'company_branches.branch_name',
            'company_branches.id as BranchId',


            )->leftjoin('loan_applications','loan_applications.loanApplication_id','=','loan_disbursements.loanApplication_id')
            ->leftjoin('member_management','member_management.member_id','=','loan_applications.member')
            ->leftjoin('company_branches','company_branches.id','=','loan_applications.branch')
            ->orderBy('loan_disbursements.created_at')
            ->where('loan_disbursements.stamp_fee','!=','0')
            ->where('loan_disbursements.created_at','>',$fetchData->run_time)
            ->get();

            //STAMP DUTY CODE 171 
            $results = DB::table('ledger_accounts as la')
            ->select('la.id as account_id')
            ->where('la.name', '=', 'STAMP DUTY')
            ->first();
           
            $lastEntry = DB::table('account_debit_credits')->where('ledger_account_id','=',$results->account_id)->orderBy('id','desc')->first();
            
            if($lastEntry){  
                 
                $sumStampfees = $lastEntry->closing_acc_balance;  
                
                foreach($list_stamp_charge as $key=>$fees){
   
                   $fees['description'] ='Other loan a/c '.$fees->id." ".$fees->first_name." ".$fees->member_id_code." debit to cash";  
                   $fees['credit'] = $fees->stamp_fee;
                   $fees['obalance'] = $key==0?$lastEntry->closing_acc_balance:$sumStampfees;   
                   $sumStampfees = $sumStampfees+$fees->stamp_fee;   
                   $fees['close_balance'] = $key==0?$lastEntry->closing_acc_balance+$fees['credit']:$fees['obalance'] + $fees['credit'];
                   $fees['branch'] = $fees->branch_name;
                   $fees['is_system'] = 'Yes';
   
                }
                
                foreach($list_stamp_charge as $store){
   
                   $account = new AccountDebitCredit();
                   $account->opening_acc_balance = $store->obalance;
                   $account->amount = $store->credit;
                   $account->description = $store->description;
                   $account->closing_acc_balance = $store->close_balance;
                   $account->branch_id = $store->BranchId;
                   $account->ledger_account_id = $results->account_id;
                   $account->type = 'credit';
                   $account->save();
                 
                }
              
        }elseif($lastEntry == null){
            $sum_stamp_fees = 0;

            foreach($list_stamp_charge as $key=>$fees){

               $fees['description'] ='Other loan a/c '.$fees->id." ".$fees->first_name." ".$fees->member_id_code." debit to cash";

               $fees['credit'] = $fees->stamp_fee;
               $fees['obalance'] = $key==0?0:$sum_stamp_fees;
               $sum_stamp_fees = $sum_stamp_fees+$fees->stamp_fee;
               $fees['close_balance'] = $key==0?0+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['branch'] = $fees->branch_name;
               $fees['is_system'] = 'Yes';

            }
            foreach($list_stamp_charge as $store){
   
                $account = new AccountDebitCredit();
                $account->opening_acc_balance = $store->obalance;
                $account->amount = $store->credit;
                $account->description = $store->description;
                $account->closing_acc_balance = $store->close_balance;
                $account->branch_id = $store->BranchId;
                $account->ledger_account_id = $results->account_id;
                $account->type = 'credit';
                $account->save();
              
             }
        }
            return $list_stamp_charge;

    }


//other panelty charge and round off charge in revenue
    public function EmiroundOff()
    {
        $ledger_account = "ROUNDING OFF";
        $runtime = Carbon::now()->format('Y-m-d H:i:s');
       //resolution to be add default 
        $fetchData = DB::table('last_log_run_accounts')->where('ledger_accounts','ROUNDING OFF')->orderBy('id','desc')->first();

        $createData = DB::table('last_log_run_accounts')->insertGetId([
            'ledger_accounts' => $ledger_account,
            'run_time' =>$runtime,

        ]);

        $emi_round_off= EmiDetails::select(
            'emi_details.round_off',
            'emi_details.status',
            'emi_details.loan_disbursement_id as LoanId',
            'emi_details.paid_date',
            'member_management.first_name',
            'member_management.member_id_code',
            'company_branches.branch_name',
            'company_branches.id as BranchId',

        )
        ->leftjoin('loan_disbursements','loan_disbursements.id','=','emi_details.loan_disbursement_id')
        ->leftjoin('loan_applications','loan_applications.loanApplication_id','=','loan_disbursements.loanApplication_id')
        ->leftjoin('member_management','member_management.member_id','=','loan_applications.member')
        ->leftjoin('company_branches','company_branches.id','=','loan_applications.branch')
        ->where('emi_details.status','=','Paid')
        ->where('emi_details.round_off','!=',0)
        ->where('emi_details.paid_date','>',$fetchData->run_time)       
        ->get();

        //ROUNDING OFF CODE 2206
        $results = DB::table('ledger_accounts as la')
        ->select('la.id as account_id')
        ->where('la.name', '=', 'ROUNDING OFF')
        ->first();

        $lastEntry = DB::table('account_debit_credits')->where('ledger_account_id','=',$results->account_id)->orderBy('id','desc')->first();
            
        if($lastEntry){  
             
            $sum_round_off_fees = $lastEntry->closing_acc_balance;  
            
            foreach($emi_round_off as $key=>$fees){

               $fees['description'] ='Other loan a/c '.$fees->id." ".$fees->first_name." ".$fees->member_id_code." debit to cash";  
               $fees['credit'] = $fees->round_off;
               $fees['obalance'] = $key==0?$lastEntry->closing_acc_balance:$sum_round_off_fees;   
               $sum_round_off_fees = $sum_round_off_fees+$fees->round_off;   
               $fees['close_balance'] = $key==0?$lastEntry->closing_acc_balance+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['branch'] = $fees->branch_name;
               $fees['is_system'] = 'Yes';

            }
            
            foreach($emi_round_off as $store){

               $account = new AccountDebitCredit();
               $account->opening_acc_balance = $store->obalance;
               $account->amount = $store->credit;
               $account->description = $store->description;
               $account->closing_acc_balance = $store->close_balance;
               $account->branch_id = $store->BranchId;
               $account->ledger_account_id = $results->account_id;
               $account->type = 'credit';
               $account->save();
             
            }
          
        }elseif($lastEntry == null){

        $sum_round_off_fees = 0;

        foreach($emi_round_off as $key=>$fees){

           $fees['description'] ='Other loan a/c'.$fees->LoanId." ".$fees->memberName." ".$fees->member_id_code." debit to cash";

           $fees['credit'] = $fees->round_off;
           $fees['obalance'] = $key==0?0:$sum_round_off_fees;
           $sum_round_off_fees = $sum_round_off_fees+$fees->round_off;
           $fees['close_balance'] = $key==0?0+$fees['credit']:$fees['obalance'] + $fees['credit'];
           $fees['branch'] = $fees->branch_name;
           $fees['is_system'] = 'Yes';

        }
        foreach($emi_round_off as $store){
   
            $account = new AccountDebitCredit();
            $account->opening_acc_balance = $store->obalance;
            $account->amount = $store->credit;
            $account->description = $store->description;
            $account->closing_acc_balance = $store->close_balance;
            $account->branch_id = $store->BranchId;
            $account->ledger_account_id = $results->account_id;
            $account->type = 'credit';
            $account->save();
          
         }
        }
            return $emi_round_off;
    }


    // loan interest amount as other loan interest

    public function EmiInterstAmt()
    {
        $ledger_account = "OTHER LOAN INTEREST";
        $runtime = Carbon::now()->format('Y-m-d H:i:s');
       //resolution to be add default 
        $fetchData = DB::table('last_log_run_accounts')->where('ledger_accounts','OTHER LOAN INTEREST')->orderBy('id','desc')->first();

        $createData = DB::table('last_log_run_accounts')->insertGetId([
            'ledger_accounts' => $ledger_account,
            'run_time' =>$runtime,

        ]);
        $emi_interest_amt= EmiDetails::select(
            'emi_details.interest',
            'emi_details.status',
            'emi_details.loan_disbursement_id as LoanId',
            'emi_details.paid_date',
            'member_management.first_name as memberName',
            'member_management.member_id_code',
            'company_branches.branch_name',
            'company_branches.id as BranchId',

        )
        ->leftjoin('loan_disbursements','loan_disbursements.id','=','emi_details.loan_disbursement_id')
        ->leftjoin('loan_applications','loan_applications.loanApplication_id','=','loan_disbursements.loanApplication_id')
        ->leftjoin('member_management','member_management.member_id','=','loan_applications.member')
        ->leftjoin('company_branches','company_branches.id','=','loan_applications.branch')
        ->where('emi_details.status','=','Paid') 
        ->where('emi_details.paid_date','>',$fetchData->run_time)
        ->get();

        //OTHER LOAN INTEREST CODE 119
        $results = DB::table('ledger_accounts as la')
        ->select('la.id as account_id')
        ->where('la.name', '=', 'OTHER LOAN INTEREST')
        ->first();


        $lastEntry = DB::table('account_debit_credits')->where('ledger_account_id','=',$results->account_id)->orderBy('id','desc')->first();
            
        if($lastEntry){  
             
            $sum_int_fees = $lastEntry->closing_acc_balance;  
            
            foreach($emi_interest_amt as $key=>$fees){

               $fees['description'] ='Other loan interest debit to other loan a/c  '.$fees->id." ".$fees->first_name." ".$fees->member_id_code." .";  
               $fees['credit'] = $fees->interest;
               $fees['obalance'] = $key==0?$lastEntry->closing_acc_balance:$sum_int_fees;   
               $sum_int_fees = $sum_int_fees+$fees->interest;   
               $fees['close_balance'] = $key==0?$lastEntry->closing_acc_balance+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['branch'] = $fees->branch_name;
               $fees['is_system'] = 'Yes';

            }
            
            foreach($emi_interest_amt as $store){

               $account = new AccountDebitCredit();
               $account->opening_acc_balance = $store->obalance;
               $account->amount = $store->credit;
               $account->description = $store->description;
               $account->closing_acc_balance = $store->close_balance;
               $account->branch_id = $store->BranchId;
               $account->ledger_account_id = $results->account_id;
               $account->type = 'credit';
               $account->save();
             
            }
          
         }elseif($lastEntry == null){
            $sum_interest_fees = 0;

            foreach($emi_interest_amt as $key=>$fees){

               $fees['description'] ='Other loan interest debit to other loan  a/c'.$fees->LoanId." ".$fees->memberName." ".$fees->member_id_code." .";

               $fees['credit'] = $fees->interest;
               $fees['obalance'] = $key==0?0:$sum_interest_fees;
               $sum_interest_fees = $sum_interest_fees+$fees->interest;
               $fees['close_balance'] = $key==0?0+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['branch'] = $fees->branch_name;
               $fees['is_system'] = 'Yes';

            }
            foreach($emi_interest_amt as $store){

                $account = new AccountDebitCredit();
                $account->opening_acc_balance = $store->obalance;
                $account->amount = $store->credit;
                $account->description = $store->description;
                $account->closing_acc_balance = $store->close_balance;
                $account->branch_id = $store->BranchId;
                $account->ledger_account_id = $results->account_id;
                $account->type = 'credit';
                $account->save();
              
             }
        }
             return $emi_interest_amt;
    }



// principle amt asset
    public function EmiPrincipleAmt()
    {
        $emi_principal_amt= EmiDetails::select(
            'emi_details.principal_amt',
            'emi_details.status',
            'emi_details.loan_disbursement_id as LoanId',
            'emi_details.paid_date',
            'member_management.first_name as memberName',
            'member_management.member_id_code',
            'company_branches.branch_name',
        )
        ->leftjoin('loan_disbursements','loan_disbursements.id','=','emi_details.loan_disbursement_id')
        ->leftjoin('loan_applications','loan_applications.loanApplication_id','=','loan_disbursements.loanApplication_id')
        ->leftjoin('member_management','member_management.member_id','=','loan_applications.member')
        ->leftjoin('company_branches','company_branches.id','=','loan_applications.branch')
        ->where('emi_details.status','=','Paid')
       
        ->get();

        $sum_princ_fees = 0;

            foreach($emi_principal_amt as $key=>$fees){

               $fees['description'] ='Cash debit to other loan a/c'.$fees->LoanId." ".$fees->memberName." ".$fees->member_id_code." .";

               $fees['credit'] = $fees->principal_amt;
               $fees['obalance'] = $key==0?$fees->principal_amt:$sum_princ_fees;
               $sum_princ_fees = $sum_princ_fees+$fees->principal_amt;
               $fees['close_balance'] = $key==0?0+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['branch'] = $fees->branch_name;
               $fees['is_system'] = 'Yes';

            }
             return $emi_principal_amt;
    }

    public static function empSalary()
    {
        $ledger_account = "Salary";
        $runtime = Carbon::now()->format('Y-m-d H:i:s');
       //resolution to be add default 
        $fetchData = DB::table('last_log_run_accounts')->where('ledger_accounts','Salary')->orderBy('id','desc')->first();

        $createData = DB::table('last_log_run_accounts')->insertGetId([
            'ledger_accounts' => $ledger_account,
            'run_time' =>$runtime,

        ]);
        $emp_salary= EmployeeSalaryRelease::select(
            'employee_salary_releases.amt_to_pay',
            'employee_salary_releases.pay_date',
            'employee_salary_releases.status',
            'hr_management.name',
            'hr_management.emp_code',
            'hr_management.branch as BranchId',
        )
       
        ->leftjoin('hr_management','hr_management.hrmanagement_id','=','employee_salary_releases.employee')
        ->where('employee_salary_releases.status','=','Paid') 
        ->where('employee_salary_releases.pay_date','>',$fetchData->run_time)
        ->get();

        //SALARY
        $results = DB::table('ledger_accounts as la')
        ->select('la.id as account_id')
        ->where('la.name', '=', 'Salary')
        ->first();

        $lastEntry = DB::table('account_debit_credits')->where('ledger_account_id','=',$results->account_id)->orderBy('id','desc')->first();
            
        if($lastEntry){  
             
            $sum_salary_fees = $lastEntry->closing_acc_balance;  
            
            foreach($emp_salary as $key=>$fees){

               $fees['description'] ='Salary '.$fees->name." ".$fees->emp_code." debit to cash";  
               $fees['credit'] = $fees->amt_to_pay;
               $fees['obalance'] = $key==0?$lastEntry->closing_acc_balance:$sum_salary_fees;   
               $sum_salary_fees = $sum_salary_fees+$fees->amt_to_pay;   
               $fees['close_balance'] = $key==0?$lastEntry->closing_acc_balance+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['is_system'] = 'Yes';

            }
            
            foreach($emp_salary as $store){

               $account = new AccountDebitCredit();
               $account->opening_acc_balance = $store->obalance;
               $account->amount = $store->credit;
               $account->description = $store->description;
               $account->closing_acc_balance = $store->close_balance;
               $account->branch_id = $store->BranchId;
               $account->ledger_account_id = $results->account_id;
               $account->type = 'debit';
               $account->save();
             
            }
          
         }elseif($lastEntry == null){
            $sum_salary_fees = 0;

            foreach($emp_salary as $key=>$fees){

               $fees['description'] ='Salary' .$fees->name." ".$fees->emp_code." debit to cash";

               $fees['credit'] = $fees->amt_to_pay;
               $fees['obalance'] = $key==0?0:$sum_salary_fees;
               $sum_salary_fees = $sum_salary_fees+$fees->amt_to_pay;
               $fees['close_balance'] = $key==0?0+$fees['credit']:$fees['obalance'] + $fees['credit'];

               $fees['is_system'] = 'Yes';

            }
            foreach($emp_salary as $store){

                $account = new AccountDebitCredit();
                $account->opening_acc_balance = $store->obalance;
                $account->amount = $store->credit;
                $account->description = $store->description;
                $account->closing_acc_balance = $store->close_balance;
                $account->branch_id = $store->BranchId;
                $account->ledger_account_id = $results->account_id;
                $account->type = 'debit';
                $account->save();
              
             }
        }
             return $emp_salary;

    }



    //EMPLOYEE PF
    public static function empPF()
    {
        $ledger_account = "EMPLOYEE PF";
        $runtime = Carbon::now()->format('Y-m-d H:i:s');
       //resolution to be add default 
        $fetchData = DB::table('last_log_run_accounts')->where('ledger_accounts','EMPLOYEE PF')->orderBy('id','desc')->first();

        $createData = DB::table('last_log_run_accounts')->insertGetId([
            'ledger_accounts' => $ledger_account,
            'run_time' =>$runtime,

        ]);
        $emp_pf= EmployeeSalaryRelease::select(
            'employee_salary_releases.PF',
            'employee_salary_releases.pay_date',
            'employee_salary_releases.status',
            'hr_management.name',
            'hr_management.emp_code',
            'hr_management.branch as BranchId',
        )
       
        ->leftjoin('hr_management','hr_management.hrmanagement_id','=','employee_salary_releases.employee')
        ->where('employee_salary_releases.status','=','Paid') 
        ->where('employee_salary_releases.PF','!=',0) 
         ->where('employee_salary_releases.pay_date','>',$fetchData->run_time)
        ->get();

        //EMPLOYEE PF
        $results = DB::table('ledger_accounts as la')
        ->select('la.id as account_id')
        ->where('la.name', '=', 'EMPLOYEE PF')
        ->first();

        $lastEntry = DB::table('account_debit_credits')->where('ledger_account_id','=',$results->account_id)->orderBy('id','desc')->first();
            
        if($lastEntry){  
             
            $sum_emp_pf = $lastEntry->closing_acc_balance;  
            
            foreach($emp_pf as $key=>$fees){

               $fees['description'] ='Employee PF '.$fees->name." ".$fees->emp_code." debit to cash";  
               $fees['credit'] = $fees->PF;
               $fees['obalance'] = $key==0?$lastEntry->closing_acc_balance:$sum_emp_pf;   
               $sum_emp_pf = $sum_emp_pf+$fees->PF;   
               $fees['close_balance'] = $key==0?$lastEntry->closing_acc_balance+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['is_system'] = 'Yes';

            }
            
            foreach($emp_pf as $store){

               $account = new AccountDebitCredit();
               $account->opening_acc_balance = $store->obalance;
               $account->amount = $store->credit;
               $account->description = $store->description;
               $account->closing_acc_balance = $store->close_balance;
               $account->branch_id = $store->BranchId;
               $account->ledger_account_id = $results->account_id;
               $account->type = 'debit';
               $account->save();
             
            }
          
         }elseif($lastEntry == null){
            $sum_emp_pf = 0;

            foreach($emp_pf as $key=>$fees){

               $fees['description'] ='Employee PF ' .$fees->name." ".$fees->emp_code." debit to cash";

               $fees['credit'] = $fees->PF;
               $fees['obalance'] = $key==0?0:$sum_emp_pf;
               $sum_emp_pf = $sum_emp_pf+$fees->PF;
               $fees['close_balance'] = $key==0?0+$fees['credit']:$fees['obalance'] + $fees['credit'];

               $fees['is_system'] = 'Yes';

            }
            foreach($emp_pf as $store){

                $account = new AccountDebitCredit();
                $account->opening_acc_balance = $store->obalance;
                $account->amount = $store->credit;
                $account->description = $store->description;
                $account->closing_acc_balance = $store->close_balance;
                $account->branch_id = $store->BranchId;
                $account->ledger_account_id = $results->account_id;
                $account->type = 'debit';
                $account->save();
              
             }
        }

        return $emp_pf;

    }



   // EMPLOYEE ESIC
    public static function empESI()
    {
        $ledger_account = "EMPLOYEE ESIC";
        $runtime = Carbon::now()->format('Y-m-d H:i:s');
       //resolution to be add default 
        $fetchData = DB::table('last_log_run_accounts')->where('ledger_accounts','EMPLOYEE ESIC')->orderBy('id','desc')->first();

        $createData = DB::table('last_log_run_accounts')->insertGetId([
            'ledger_accounts' => $ledger_account,
            'run_time' =>$runtime,

        ]);
        $emp_esi= EmployeeSalaryRelease::select(
            'employee_salary_releases.ESI',
            'employee_salary_releases.pay_date',
            'employee_salary_releases.status',
            'hr_management.name',
            'hr_management.emp_code',
            'hr_management.branch as BranchId',
        )
       
        ->leftjoin('hr_management','hr_management.hrmanagement_id','=','employee_salary_releases.employee')
        ->where('employee_salary_releases.status','=','Paid') 
        ->where('employee_salary_releases.ESI','!=',0) 
         ->where('employee_salary_releases.pay_date','>',$fetchData->run_time)
        ->get();

        //EMPLOYEE ESIC
        $results = DB::table('ledger_accounts as la')
        ->select('la.id as account_id')
        ->where('la.name', '=', 'EMPLOYEE ESIC')
        ->first();

        $lastEntry = DB::table('account_debit_credits')->where('ledger_account_id','=',$results->account_id)->orderBy('id','desc')->first();
            
        if($lastEntry){  
             
            $sum_emp_esi = $lastEntry->closing_acc_balance;  
            
            foreach($emp_esi as $key=>$fees){

               $fees['description'] ='Salary '.$fees->name." ".$fees->emp_code." debit to cash";  
               $fees['credit'] = $fees->ESI;
               $fees['obalance'] = $key==0?$lastEntry->closing_acc_balance:$sum_emp_esi;   
               $sum_emp_esi = $sum_emp_esi+$fees->ESI;   
               $fees['close_balance'] = $key==0?$lastEntry->closing_acc_balance+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['is_system'] = 'Yes';

            }
            
            foreach($emp_esi as $store){

               $account = new AccountDebitCredit();
               $account->opening_acc_balance = $store->obalance;
               $account->amount = $store->credit;
               $account->description = $store->description;
               $account->closing_acc_balance = $store->close_balance;
               $account->branch_id = $store->BranchId;
               $account->ledger_account_id = $results->account_id;
               $account->type = 'debit';
               $account->save();
             
            }
          
         }elseif($lastEntry == null){
            $sum_emp_esi = 0;

            foreach($emp_esi as $key=>$fees){

               $fees['description'] ='Salary' .$fees->name." ".$fees->emp_code." debit to cash";

               $fees['credit'] = $fees->ESI;
               $fees['obalance'] = $key==0?0:$sum_emp_esi;
               $sum_emp_esi = $sum_emp_esi+$fees->ESI;
               $fees['close_balance'] = $key==0?0+$fees['credit']:$fees['obalance'] + $fees['credit'];

               $fees['is_system'] = 'Yes';

            }
            foreach($emp_esi as $store){

                $account = new AccountDebitCredit();
                $account->opening_acc_balance = $store->obalance;
                $account->amount = $store->credit;
                $account->description = $store->description;
                $account->closing_acc_balance = $store->close_balance;
                $account->branch_id = $store->BranchId;
                $account->ledger_account_id = $results->account_id;
                $account->type = 'debit';
                $account->save();
              
             }
        }

        return $emp_esi;

    }

    public static function membershipFee()
    {
        $ledger_account = "MEMBERSHIP FEE";
        $runtime = Carbon::now()->format('Y-m-d H:i:s');
       //resolution to be add default 
        $fetchData = DB::table('last_log_run_accounts')->where('ledger_accounts','MEMBERSHIP FEE')->orderBy('id','desc')->first();

        $createData = DB::table('last_log_run_accounts')->insertGetId([
            'ledger_accounts' => $ledger_account,
            'run_time' =>$runtime,

        ]);
        $member_fee= MembersPayment::select(
            'members_payments.member_fees',
            'members_payments.created_at',
            'members_payments.status',
            'member_management.first_name',
            'member_management.member_id_code',
            'member_management.branch as BranchId',
        )
       
        ->leftjoin('member_management','member_management.member_id','=','members_payments.member_id')
        ->where('members_payments.status','=','Paid') 
         ->where('members_payments.created_at','>',$fetchData->run_time)
        ->get();

        //MEMBERSHIP FEE
        $results = DB::table('ledger_accounts as la')
        ->select('la.id as account_id')
        ->where('la.name', '=', 'MEMBERSHIP FEE')
        ->first();

        $lastEntry = DB::table('account_debit_credits')->where('ledger_account_id','=',$results->account_id)->orderBy('id','desc')->first();
            
        if($lastEntry){  
             
            $sum_member_fees = $lastEntry->closing_acc_balance;  
            
            foreach($member_fee as $key=>$fees){

               $fees['description'] ='Cash debit to membership fee  '.$fees->first_name." ".$fees->member_id_code." .";  
               $fees['credit'] = $fees->member_fees;
               $fees['obalance'] = $key==0?$lastEntry->closing_acc_balance:$sum_member_fees;   
               $sum_member_fees = $sum_member_fees+$fees->member_fees;   
               $fees['close_balance'] = $key==0?$lastEntry->closing_acc_balance+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['is_system'] = 'Yes';

            }
            
            foreach($member_fee as $store){

               $account = new AccountDebitCredit();
               $account->opening_acc_balance = $store->obalance;
               $account->amount = $store->credit;
               $account->description = $store->description;
               $account->closing_acc_balance = $store->close_balance;
               $account->branch_id = $store->BranchId;
               $account->ledger_account_id = $results->account_id;
               $account->type = 'credit';
               $account->save();
             
            }
          
         }elseif($lastEntry == null){
            $sum_member_fees = 0;

            foreach($member_fee as $key=>$fees){
               $fees['description'] ='Cash debit to membership fee  '.$fees->first_name." ".$fees->member_id_code." ."; 
               $fees['credit'] = $fees->member_fees;
               $fees['obalance'] = $key==0?0:$sum_member_fees;
               $sum_member_fees = $sum_member_fees+$fees->member_fees;
               $fees['close_balance'] = $key==0?0+$fees['credit']:$fees['obalance'] + $fees['credit'];
               $fees['is_system'] = 'Yes';

            }
            foreach($member_fee as $store){

                $account = new AccountDebitCredit();
                $account->opening_acc_balance = $store->obalance;
                $account->amount = $store->credit;
                $account->description = $store->description;
                $account->closing_acc_balance = $store->close_balance;
                $account->branch_id = $store->BranchId;
                $account->ledger_account_id = $results->account_id;
                $account->type = 'credit';
                $account->save();
              
             }
        }
             return $member_fee;

    }


    public static function cashbook()
    {


    }

    public static function AssetOtherLoan()
    {

        $other_loan = LoanDisbursement::select(
            'loan_disbursements.id',
            'loan_disbursements.loan_amount',
            'loan_disbursements.created_at',
            'loan_applications.member',
            'member_management.first_name',
            'member_management.member_id_code',
            'company_branches.branch_name',
            'company_branches.id as BranchId',


            )->leftjoin('loan_applications','loan_applications.loanApplication_id','=','loan_disbursements.loanApplication_id')
            ->leftjoin('member_management','member_management.member_id','=','loan_applications.member')
            ->leftjoin('company_branches','company_branches.id','=','loan_applications.branch')
            ->orderBy('loan_disbursements.created_at','desc')
            ->where('loan_applications.status','=','Disbursed')
            // ->where('loan_disbursements.created_at','>',$fetchData->run_time)
            ->get();
            return ($other_loan);
    }

}
