<?php

namespace App\Http\Controllers\Backend\Investment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MemberManagement;
use App\Models\CompanyBranch;
use App\Models\HrManagement;
use App\Models\InvestmentScheme;
use App\Models\InvestmentCreate;
use App\Models\InvestmentPayDetails;
use DateTime;
use Illuminate\Support\Facades\DB;



class CreateInvestmentController extends Controller
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
        $investment= InvestmentCreate::all();
        return view('backend.pages.createInvestment.index',compact('investment'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member = MemberManagement::select('member_id', 'member_id_code', 'first_name')->where('status','=','Active')->get();
        //dd($member);
        $branch= CompanyBranch::pluck('id','branch_name');
        $hrmanagements= HrManagement::select('hrmanagement_id','name','emp_code')->get();
        $inv_scheme =InvestmentScheme::pluck('id','scheme_name');
        return view('backend.pages.createInvestment.create',compact('member','hrmanagements','inv_scheme'))->withBranches($branch);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check_status = MemberManagement::select('status')->where('member_id', '=', $request->member)->get();
        
        if($check_status[0]->status == "Active"){
       
            $investment = new InvestmentCreate();
            $investment->create_date  =   $request->create_date;
            $investment->member  = $request->member;
            $investment->member_name  =  $request->member_name;
            $investment->branch =  $request->branch;
            $investment->employee =  $request->employee;
            $investment->scheme =  $request->scheme;
            $investment->tenure =  $request->tenure;
            $investment->amount =  $request->amount;
            $investment->amt_approved =  $request->amt_approved;
            $investment->interest_earned =  $request->interest_earned;
            $investment->maturity_amount =  $request->maturity_amount;
            $investment->int_per_tenure =  $request->int_per_tenure;
            $investment->fore_close_charge =  $request->fore_close_charge;
            $investment->int_pay_mode =  $request->int_pay_mode;
            $investment->int_rate =  $request->int_rate;
            $investment->tenure_val =  $request->tenure_val;

            $investment->status  = 'RequestForApproval';

            $investment->save();

            session()->flash('success', 'Approval request has been made for Investmemt of Member and is pending for approval !!');
            return redirect()->route('admin.create_investment.index');
        }
        else{
            session()->flash('error', 'Member is not Active !!');
            return redirect()->route('admin.create_investment.create');
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
        $invest = InvestmentCreate::findOrFail($id);
 
         return view('backend.pages.createInvestment.show',compact('invest'));
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


    public function schmeDetails($id)
    {
        $scheme = InvestmentScheme::findOrFail($id);
        return $scheme->toJson();

    }

    public function approval()
    {
   
       $approval = InvestmentCreate::where('status','RequestForApproval')->get();
       //dd($application);
       return view('backend.pages.createInvestment.approval',compact('approval'));
    }

    public function updateStatus(Request $request, $id)
    {
       $approval=InvestmentCreate::findOrFail($id);
       //dd($loan_application);
   
       $approval->status = $request->status;
    
       $approval->save();
  
    }

    public function create_investment_details($id)
    {
        $application = InvestmentCreate::select('*')->where('id', '=', $id)->get();
        //dd($application);
       return $application->toJson();
 
      
    }

    public function tenure_store(Request $request)
    {
       // dd($request->pay_details);

        $emiJSON = json_decode($request->pay_details, true);
       // dd($emiJSON);
        $emi = $emiJSON['emi'];
       // dd($emi["TENURE1"]["INVEST_ID"]);
        $check_pay = InvestmentCreate::select('*')
                    ->where([
                        ['id', '=', $emi["TENURE1"]["INVEST_ID"]],
                        ['status', '=', 'Completed'],
                        ])
                    ->count();
        //dd($check_pay);

        if($check_pay == 0){
            foreach ($emi as $val)
            {
                //echo $val['Emi_No'];
                $pay_details = new InvestmentPayDetails();        
                $pay_details->createInvestment_id = $val['INVEST_ID'];
                $pay_details->tenure_no = $val['TENURE'];
                $pay_details->period = $val['PERIOD']; 
                $pay_details->principal_amt = $val['PRINCIPAL'];
                $pay_details->interest_earned = $val['INTEREST_EARN'];
                $pay_details->maturity_amount = $val['MATURITY_AMOUNT'];
                $pay_details->int_per_tenure = $val['INT_PER_TENURE'];
                $pay_details->bal_principal = $val['BAL_PRINCIPAL'];
            
                $pay_details->status = "Pending";

                $pay_details->save();

            }
          $upd_status=  DB::table('investment_creates')
                ->where('id', '=', $emi["TENURE1"]["INVEST_ID"])  // find your user by their email
                  
                ->update(array('status' => "Completed"));
            
            session()->flash('success', 'Investment Details has been created !!');
            return redirect()->route('admin.create_investment.index');
        }else{
            session()->flash('error', 'already Exist !!');
            return redirect()->route('admin.create_investment.index');
        }
    
    }
}
