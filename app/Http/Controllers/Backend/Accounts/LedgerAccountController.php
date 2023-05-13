<?php

namespace App\Http\Controllers\Backend\Accounts;

use App\Http\Controllers\Controller;
use App\Models\AccountDebitCredit;
use App\Models\CompanyBranch;
use Illuminate\Http\Request;
use App\Models\LedgerGroup;
use App\Models\LedgerAccount;
use App\Models\LedgerType;

use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;




class LedgerAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        set_time_limit(0);

        $ledger=LedgerAccount::all();
        $asset=LedgerAccount::select('*')->where('ledger_type','=',"1")->get();
        $liability=LedgerAccount::select('*')->where('ledger_type','=',"2")->get();
        $equity=LedgerAccount::select('*')->where('ledger_type','=',"3")->get();
        $expenses=LedgerAccount::select('*')->where('ledger_type','=',"4")->get();
        $revenue=LedgerAccount::select('*')->where('ledger_type','=',"5")->get();
        return view('backend.pages.ledger_account.index',compact('ledger', 'asset', 'liability', 'equity', 'expenses', 'revenue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group= LedgerType::select('ledger_types_id', 'types')->get();
        return view('backend.pages.ledger_account.create', compact('group'));
        
    }
    
    public function group_details($id)
    {
        $ledger_group = LedgerGroup::select([
            'ledger_groups.*',
            'ledger_types.types'
        ])
        ->join('ledger_types', 'ledger_types.ledger_types_id', '=', 'ledger_groups.group_type')
        ->where('group_type', '=', $id)->get();
        return $ledger_group->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'ledger_type' => 'required',
            'ledger_group' => 'required',
            'name' => 'required',
            'system_name' => 'required',
            'code' => 'required|unique:ledger_accounts,code',

        ]);
        if ($validator->fails()){
            $fieldsWithErrorMessagesArray = $validator->messages()->get('*');
             return \Redirect::back()->withErrors($validator)->withInput();
            
         }else{
        $group= new LedgerAccount();
        $group->ledger_type      =   $request->ledger_type;
        $group->ledger_group_id  =   $request->ledger_group;
        $group->name             =   $request->name;
        $group->system_name      =   $request->system_name;
        $group->code             =   $request->code;
        $group->is_bank_account  =   $request->is_bank_account;
        $group->show_in_day_book =   $request->show_in_day_book;

        $group->save();
        session()->flash('success', 'Ledger Account has been created !!');
        return redirect()->route('admin.ledger_account.index');
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
        $ledger = LedgerAccount::find($id);
        $entry = AccountDebitCredit::where('ledger_account_id','=',$ledger->id)->get();
        // dd($entry);
        return view('backend.pages.ledger_account.show',compact('ledger','entry')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ledger = LedgerAccount::find($id);
        $group = LedgerGroup::find($id);
        $type= LedgerType::select('ledger_types_id', 'types')->get();
    
        return view('backend.pages.ledger_account.edit',compact('ledger','group','type')); 
    }

    public function tree()
    {
        $led_grp_asset = LedgerAccount::select("*")->where("ledger_type", "=", 1)->get();
        $led_grp_liability = LedgerAccount::select("*")->where("ledger_type", "=", 2)->get();
        $led_grp_equity = LedgerAccount::select("*")->where("ledger_type", "=", 3)->get();
        $led_grp_expenses = LedgerAccount::select("*")->where("ledger_type", "=", 4)->get();
        $led_grp_revenue = LedgerAccount::select("*")->where("ledger_type", "=", 5)->get();
        
        return view('backend.pages.ledger_account.tree', compact('led_grp_asset', 'led_grp_liability', 'led_grp_equity', 'led_grp_expenses', 'led_grp_revenue'));
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
        $account= LedgerAccount::find($id);

        $request->validate([
            'ledger_type' => 'required',
            'ledger_group' => 'required',
            'name' => 'required',
            'system_name' => 'required',
            'code' => 'required',

        ]);
        $account->ledger_type       =       $request->ledger_type;
        $account->ledger_group_id   =       $request->ledger_group;
        $account->name              =       $request->name;
        $account->system_name       =       $request->system_name;
        $account->code              =       $request->code;
        $account->is_bank_account   =       $request->is_bank_account;
        $account->show_in_day_book  =       $request->show_in_day_book;
        $account->save();

        session()->flash('success', 'Ledger Account has been Updated !!');
        return redirect()->route('admin.ledger_account.index');
    }

    public function trial_balance()
    {
        $ledger=LedgerAccount::select([
            'ledger_accounts.id',
            'ledger_accounts.code',
            'ledger_accounts.name',
            'ledger_accounts.system_name',
            'ledger_accounts.ledger_group_id',
            'ledger_accounts.ledger_type',
            'account_debit_credits.opening_acc_balance',
            'ledger_accounts.total_debit',
            'ledger_accounts.total_credit',
            'ledger_accounts.closing_balance',
            ])
            ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MIN(account_debit_credits.id) FROM account_debit_credits GROUP BY account_debit_credits.ledger_account_id)')->orderBy('account_debit_credits.id', 'asc')->get();

        $asset=LedgerAccount::select([
            'ledger_accounts.id',
            'ledger_accounts.code',
            'ledger_accounts.name',
            'ledger_accounts.system_name',
            'ledger_accounts.ledger_group_id',
            'ledger_accounts.ledger_type',
            'account_debit_credits.opening_acc_balance',
            'ledger_accounts.total_debit',
            'ledger_accounts.total_credit',
            'ledger_accounts.closing_balance',
            ])
            ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MIN(account_debit_credits.id) FROM account_debit_credits GROUP BY account_debit_credits.ledger_account_id)')->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")->get();
            //dd($asset);

            
        $liability=LedgerAccount::select([
            'ledger_accounts.id',
            'ledger_accounts.code',
            'ledger_accounts.name',
            'ledger_accounts.system_name',
            'ledger_accounts.ledger_group_id',
            'ledger_accounts.ledger_type',
            'account_debit_credits.opening_acc_balance',
            'ledger_accounts.total_debit',
            'ledger_accounts.total_credit',
            'ledger_accounts.closing_balance',
            ])
            ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MIN(account_debit_credits.id) FROM account_debit_credits GROUP BY account_debit_credits.ledger_account_id)')->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"2")->get();
    

        $equity=LedgerAccount::select([
            'ledger_accounts.id',
            'ledger_accounts.code',
            'ledger_accounts.name',
            'ledger_accounts.system_name',
            'ledger_accounts.ledger_group_id',
            'ledger_accounts.ledger_type',
            'account_debit_credits.opening_acc_balance',
            'ledger_accounts.total_debit',
            'ledger_accounts.total_credit',
            'ledger_accounts.closing_balance',
            ])
            ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MIN(account_debit_credits.id) FROM account_debit_credits GROUP BY account_debit_credits.ledger_account_id)')->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"3")->get();
            
                    
        $expenses=LedgerAccount::select([
            'ledger_accounts.id',
            'ledger_accounts.code',
            'ledger_accounts.name',
            'ledger_accounts.system_name',
            'ledger_accounts.ledger_group_id',
            'ledger_accounts.ledger_type',
            'account_debit_credits.opening_acc_balance',
            'ledger_accounts.total_debit',
            'ledger_accounts.total_credit',
            'ledger_accounts.closing_balance',
            ])
            ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MIN(account_debit_credits.id) FROM account_debit_credits GROUP BY account_debit_credits.ledger_account_id)')->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"4")->get();
    

        $revenue=LedgerAccount::select([
            'ledger_accounts.id',
            'ledger_accounts.code',
            'ledger_accounts.name',
            'ledger_accounts.system_name',
            'ledger_accounts.ledger_group_id',
            'ledger_accounts.ledger_type',
            'account_debit_credits.opening_acc_balance',
            'ledger_accounts.total_debit',
            'ledger_accounts.total_credit',
            'ledger_accounts.closing_balance',
            ])
            ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MIN(account_debit_credits.id) FROM account_debit_credits GROUP BY account_debit_credits.ledger_account_id)')->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"5")->get();
    
        return view('backend.pages.ledger_account.trialBalance',compact('ledger', 'asset', 'liability', 'equity', 'expenses', 'revenue'));
    }

    public function profit_loss(Request $request)
    {
        $branch= CompanyBranch::pluck('id','branch_name');
        //dd($request->branch);

        if(!$request->from_date && !$request->branch){

        $year = date('y');
        if(date('m')<=3){
            $d1 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year-1));
            $d2 = date("y-m-d",mktime(0, 0, 0, 3, 31, $year));

            $prev_d1 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year-2));
            $prev_d2 = date("y-m-d",mktime(0, 0, 0, 3, 31, $year-1));
        } elseif(date('m')>3){
            $d1 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year));
            $d2 = date("y-m-d",mktime(0, 0, 0, 3, 31, $year+1));

            $prev_d1 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year-1));
            $prev_d2 = date("y-m-d",mktime(0, 0, 0, 3, 31, $year));
        }
    } elseif(!$request->branch && $request->from_date) {
        $date = $request->from_date;
        $year = explode("-", $date);
        $d1 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year[0]));
        $d2 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year[1]));

        $prev_d1 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year[0]-1));
        $prev_d2 = date("y-m-d",mktime(0, 0, 0, 3, 31, $year[1]-1));
    } elseif ($request->branch) {

            $date = $request->from_date;
            $year = explode("-", $date);
            $d1 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year[0]));
            $d2 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year[1]));

            $prev_d1 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year[0]-1));
            $prev_d2 = date("y-m-d",mktime(0, 0, 0, 3, 31, $year[1]-1));


            $revenue = LedgerAccount::select([
                'ledger_accounts.name',
                'ledger_accounts.system_name',
                'account_debit_credits.closing_acc_balance',
            ])
            ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $d1, $d2))
            ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")->where('account_debit_credits.branch_id', '=', $request->branch)
            ->get();
        // dd($revenue);

            
            $total_revenue = LedgerAccount::select(DB::raw('SUM(account_debit_credits.closing_acc_balance) as total')) ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $d1, $d2))
            ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")->where('account_debit_credits.branch_id', '=', $request->branch)
            ->get();
            //dd($total_revenue);


            $prev_revenue = LedgerAccount::select([
                'ledger_accounts.name',
                'ledger_accounts.system_name',
                'account_debit_credits.closing_acc_balance',
            ])
            ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $prev_d1, $prev_d2))
            ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")->where('account_debit_credits.branch_id', '=', $request->branch)
            ->get();

            $total_prev_revenue = LedgerAccount::select(DB::raw('SUM(account_debit_credits.closing_acc_balance) as total')) ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $prev_d1, $prev_d2))
            ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")->where('account_debit_credits.branch_id', '=', $request->branch)
            ->get();
            

            $expenses = LedgerAccount::select([
                'ledger_accounts.name',
                'ledger_accounts.system_name',
                'account_debit_credits.closing_acc_balance',
            ])
            ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $d1, $d2))
            ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")->where('account_debit_credits.branch_id', '=', $request->branch)
            ->get();
            
            $total_expenses = LedgerAccount::select(DB::raw('SUM(account_debit_credits.closing_acc_balance) as total')) ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $d1, $d2))
            ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")->where('account_debit_credits.branch_id', '=', $request->branch)
            ->get();
            

            $prev_expenses = LedgerAccount::select([
                'ledger_accounts.name',
                'ledger_accounts.system_name',
                'account_debit_credits.closing_acc_balance',
            ])
            ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $prev_d1, $prev_d2))
            ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")->where('account_debit_credits.branch_id', '=', $request->branch)
            ->get();

            $total_prev_expenses = LedgerAccount::select(DB::raw('SUM(account_debit_credits.closing_acc_balance) as total'))->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
            ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $prev_d1, $prev_d2))
            ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")->where('account_debit_credits.branch_id', '=', $request->branch)
            ->get();

            return view('backend.pages.ledger_account.profitAndloss', compact('revenue', 'total_revenue', 'expenses', 'total_expenses', 'prev_revenue', 'total_prev_revenue', 'prev_expenses', 'total_prev_expenses'))->withBranches($branch);

    }


   
        $revenue = LedgerAccount::select([
            'ledger_accounts.name',
            'ledger_accounts.system_name',
            'account_debit_credits.closing_acc_balance',
        ])
        ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
        ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $d1, $d2))
        ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")
        ->get();
       // dd($revenue);

        
        $total_revenue = LedgerAccount::select(DB::raw('SUM(account_debit_credits.closing_acc_balance) as total')) ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
        ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $d1, $d2))
        ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")
        ->get();
        //dd($total_revenue);


        $prev_revenue = LedgerAccount::select([
            'ledger_accounts.name',
            'ledger_accounts.system_name',
            'account_debit_credits.closing_acc_balance',
        ])
        ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
        ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $prev_d1, $prev_d2))
        ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")
        ->get();

        $total_prev_revenue = LedgerAccount::select(DB::raw('SUM(account_debit_credits.closing_acc_balance) as total')) ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
        ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $prev_d1, $prev_d2))
        ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")
        ->get();
        

        $expenses = LedgerAccount::select([
            'ledger_accounts.name',
            'ledger_accounts.system_name',
            'account_debit_credits.closing_acc_balance',
        ])
        ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
        ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $d1, $d2))
        ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")
        ->get();
        
        $total_expenses = LedgerAccount::select(DB::raw('SUM(account_debit_credits.closing_acc_balance) as total')) ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
        ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $d1, $d2))
        ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")
        ->get();
        

        $prev_expenses = LedgerAccount::select([
            'ledger_accounts.name',
            'ledger_accounts.system_name',
            'account_debit_credits.closing_acc_balance',
        ])
        ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
        ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $prev_d1, $prev_d2))
        ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")
        ->get();

        $total_prev_expenses = LedgerAccount::select(DB::raw('SUM(account_debit_credits.closing_acc_balance) as total'))->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
        ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits Where `account_debit_credits`.`created_at` BETWEEN ? AND ?  GROUP BY account_debit_credits.ledger_account_id)', array( $prev_d1, $prev_d2))
        ->orderBy('account_debit_credits.id', 'asc')->where('ledger_accounts.ledger_type','=',"1")
        ->get();

        return view('backend.pages.ledger_account.profitAndloss', compact('revenue', 'total_revenue', 'expenses', 'total_expenses', 'prev_revenue', 'total_prev_revenue', 'prev_expenses', 'total_prev_expenses'))->withBranches($branch);
    }

    public function income_statement(Request $request)
    {
        $branches = CompanyBranch::pluck('id','branch_name');
        if($request->filter_by_year == null){

            $date = date("Y/M/D",);
           
            $year = explode("/", $date);
            $d1 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year[0]));
            $d2 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year[0]+1));
        } else {
            $date = $request->filter_by_year;
            $year = explode("-", $date);
            $d1 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year[0]));
            $d2 = date("y-m-d",mktime(0, 0, 0, 4, 1, $year[1]));

        }
          
        $revenue = LedgerAccount::select([
            'ledger_accounts.name',
            'ledger_accounts.system_name',
            'account_debit_credits.closing_acc_balance',
        ])
        ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
        ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits GROUP BY account_debit_credits.ledger_account_id)')->orderBy('account_debit_credits.id', 'asc')
        ->where([
            'ledger_accounts.ledger_type' => "5",
            'account_debit_credits.branch_id' => $request->filter_by_branch,
        ])
        ->whereBetween('account_debit_credits.created_at', array($d1, $d2))->get();

        $total_revenue = LedgerAccount::
        leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
        ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits GROUP BY account_debit_credits.ledger_account_id)')->orderBy('account_debit_credits.id', 'asc')
        ->where([
            'ledger_accounts.ledger_type' => "5",
            'account_debit_credits.branch_id' => $request->filter_by_branch,
        ])
        ->whereBetween('account_debit_credits.created_at', array($d1, $d2))->sum('account_debit_credits.closing_acc_balance');
        //dd($total_revenue);

        $expenses = LedgerAccount::select([
            'ledger_accounts.name',
            'ledger_accounts.system_name',
            'account_debit_credits.closing_acc_balance',
        ])
        ->leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
        ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits GROUP BY account_debit_credits.ledger_account_id)')->orderBy('account_debit_credits.id', 'asc')
        ->where([
            'ledger_accounts.ledger_type' => "4",
            'account_debit_credits.branch_id' => $request->filter_by_branch,
        ])
        ->whereBetween('account_debit_credits.created_at', array($d1, $d2))->get();

        $total_expenses = LedgerAccount::
        leftjoin('account_debit_credits', 'account_debit_credits.ledger_account_id', '=', 'ledger_accounts.id')
        ->whereRaw('account_debit_credits.id IN (select MAX(account_debit_credits.id) FROM account_debit_credits GROUP BY account_debit_credits.ledger_account_id)')->orderBy('account_debit_credits.id', 'asc')
        ->where([
            'ledger_accounts.ledger_type' => "4",
            'account_debit_credits.branch_id' => $request->filter_by_branch,
        ])
        ->whereBetween('account_debit_credits.created_at', array($d1, $d2))->sum('account_debit_credits.closing_acc_balance');
        //dd($revenue);
        return view('backend.pages.ledger_account.incomeStatement', compact('branches', 'revenue', 'total_revenue', 'expenses', 'total_expenses'));
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
