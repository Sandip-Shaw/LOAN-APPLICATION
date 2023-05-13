<?php
namespace App\Helpers;
use App\Models\HrManagement;
use App\Models\CompanyProfile;
use App\Models\LoanApplication;
use App\Models\InvestmentCreate;
use App\Models\EmiDetails;
use App\Models\LoanDisbursement;






class Helper{
 public static function IDGenerator($model, $trow, $length = 4,$prefix){
    $data= $model::orderBy('member_id','desc')->first();   //getting last inserted data
   // dd($data);
    if(!$data){
        $og_lengh=$length;
        $last_number='';

    }else{
       // dd($data->$trow);
        $code= substr($data->$trow, strlen($prefix)+1);     //get last code without prefix
       // dd($code);
        $actial_last_number =("$code"/1)*1;             //if last code is 000012, last number=000012/1*1 =12
        $increment_last_number= $actial_last_number+1;      //12+1=13
        $last_number_lenght= strlen($increment_last_number);
        $og_lengh=$length-$last_number_lenght;
        $last_number= $increment_last_number;

    }
    $zeros="";
    for($i=0;$i<$og_lengh;$i++){
        $zeros.="0";
    }
    return $prefix.'-'.$zeros.$last_number;
 }


 public static function IDGeneratorEmp($model, $trow, $length = 4,$prefix){
    $data= $model::orderBy('hrmanagement_id','desc')->first();   //getting last inserted data
   // dd($data);
    if(!$data){
        $og_lengh=$length;
        $last_number='';

    }else{
       // dd($data->$trow);
        $code= substr($data->$trow, strlen($prefix)+1);     //get last code without prefix
       // dd($code);
        $actial_last_number =("$code"/1)*1;             //if last code is 000012, last number=000012/1*1 =12
        $increment_last_number= $actial_last_number+1;      //12+1=13
        $last_number_lenght= strlen($increment_last_number);
        $og_lengh=$length-$last_number_lenght;
        $last_number= $increment_last_number;

    }
    $zeros="";
    for($i=0;$i<$og_lengh;$i++){
        $zeros.="0";
    }
    return $prefix.'-'.$zeros.$last_number;
 }

    public static function getEmpName($id){

        $employee = HrManagement::where('hrmanagement_id','=',$id)->first();
        $obj = [
            "emp_code" => $employee->emp_code,
            "emp_name" => $employee->name
        ];

        return $obj;

    }


    public static function cashAssetData($branch)
    {
       $paid_capiltal = CompanyProfile::select('paid_ip_capital')->get();   //company invest to start the company

       $cash_invested_by_member = InvestmentCreate::select(
        'investment_creates.id',
        'investment_creates.branch',
        'investment_creates.status',

        'investment_creates.amt_approved',
        // 'investment_pay_details.int_per_tenure',

       )
    //   ->join('investment_pay_details','investment_pay_details.createInvestment_id','=','investment_creates.id')
         ->where('investment_creates.branch','=',$branch)
        // ->groupBy('branch')
         
         ->selectRaw('SUM(amt_approved) as total_amt')
         ->where('investment_creates.status','=','Completed')
        ->get();

      // dd($cash_invested_by_member);

        $cash_disbursed_to_customer = LoanApplication::select(
            'loan_applications.loanApplication_id',
            'loan_applications.branch',
            'loan_applications.status',

            'loan_disbursements.final_disburse_amt',
            'loan_disbursements.processing_fee',
            'loan_disbursements.insurance_charge',
            'loan_disbursements.disburse_transaction',

        )->join('loan_disbursements','loan_disbursements.loanApplication_id','=','loan_applications.loanApplication_id')
       // ->groupBy('branch')
        ->where('loan_applications.branch','=',$branch)
         
         ->selectRaw('SUM(final_disburse_amt) as disburse_amt')
        ->where('loan_applications.status','=','Disbursed')

        ->get();
        //dd($cash_disbursed_to_customer);


        $balance_get_emi = EmiDetails::select(
            'loan_applications.loanApplication_id',
            'loan_applications.branch',
            'loan_disbursements.id',
            'emi_details.total_amt',
             'emi_details.pay_mode',
             'company_branches.branch_name',
            
            
      )
        ->join('loan_disbursements', 'loan_disbursements.id', '=', 'emi_details.loan_disbursement_id')
        ->join('loan_applications', 'loan_applications.loanApplication_id', '=', 'loan_disbursements.loanApplication_id')
        ->join('company_branches', 'company_branches.id', '=', 'loan_applications.branch')

        //->groupBy('branch')
        ->where('loan_applications.branch','=',$branch)
        
        ->selectRaw('SUM(total_amt) as total_amt')
        ->where('pay_mode','=','Cash')
        ->get();

       // dd($balance_get_emi);

       // return $paid_capiltal;
       
    }
    public static function paidCapital($id)
    {
        $paid_capiltal = CompanyProfile::select('paid_ip_capital')->get();   //company invest to start the company
        return $paid_capiltal;
    }


   public static function dayBook($date)
   {
    $daybook = EmiDetails::select(
        'loan_applications.loanApplication_id',
        'loan_applications.branch',
        'loan_disbursements.id',
        'emi_details.total_amt',
         'emi_details.pay_mode',
         'company_branches.branch_name',
        
        
  )
    ->join('loan_disbursements', 'loan_disbursements.id', '=', 'emi_details.loan_disbursement_id')
    ->join('loan_applications', 'loan_applications.loanApplication_id', '=', 'loan_disbursements.loanApplication_id')
    ->join('company_branches', 'company_branches.id', '=', 'loan_applications.branch')

    ->groupBy('branch')
    ->selectRaw('SUM(total_amt) as total_amt')
    ->where('pay_mode','=','Cash')
    ->where('paid_date','=',$date)
    ->get();

    return $daybook;
   }

   public static function processingFee()
   {
        $p_fee = LoanDisbursement::selectRaw('SUM(processing_fee) as fee')->get();

        $list_processing_fee = LoanDisbursement::select(
            'loan_disbursements.id',
            'loan_disbursements.processing_fee',
            'loan_disbursements.created_at',
            'loan_applications.member',
            'member_management.first_name',
            'member_management.member_id_code',
            'company_branches.branch_name',

            )->leftjoin('loan_applications','loan_applications.loanApplication_id','=','loan_disbursements.loanApplication_id')
            ->leftjoin('member_management','member_management.member_id','=','loan_applications.member')
            ->leftjoin('company_branches','company_branches.id','=','loan_applications.branch')
            ->orderBy('loan_disbursements.created_at')
            ->get();

        //     $array = [];
        //     $object = new stdClass();
            $sumprocfees = 0;
            foreach($list_processing_fee as $key=>$fees){
               
                $fees['description'] ='Cash Debit to other loan a/c'.$fees->id." ".$fees->first_name." ".$fees->member_id_code." in reference to processing";
                $sumprocfees = $sumprocfees+$fees->processing_fee;
                $fees['obalance'] = $key==0?$fees->processing_fee:$sumprocfees;
                // if($key[]){
                //     $
                // }
            }
           
           return $list_processing_fee;

        //    dd($array) ;
       
   }

   public static function insuranceFee()
   {
        $i_fee = LoanDisbursement::selectRaw('SUM(insurance_charge) as insurance')->get();
        return $i_fee;
   }

}

?>