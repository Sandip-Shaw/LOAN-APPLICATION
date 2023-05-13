<?php

namespace App\Http\Controllers\Backend\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyBranch;
use App\Models\LedgerAccount;
use App\Models\LedgerEntries;
use App\Models\AccountDebit;
use App\Models\AccountDebitCredit;
use App\Helpers\Helper;


class AccountEntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $entries=LedgerEntries::all();
        return view('backend.pages.account_entries.index',compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches= CompanyBranch::pluck('id','branch_name');
        $account= LedgerAccount::select('id', 'name','system_name','ledger_type')->get();
        //dd($account);
        return view('backend.pages.account_entries.create',compact('branches','account'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(Helper::paidCapital(1));
        dd(env('MAIN_BRANCH'));
        // if()
        $entries=new LedgerEntries();
        $entries->entry_date  =  $request->entry_date;
        $entries->branch  =  $request->branch;
        $entries->description  =  $request->Description;
        
        $entries->save();

        if($entries->save()) {

            foreach ($request->branch1 as $index=>$branches)
            {   
                //dd($request->account[$index]);

                $accountdetails = LedgerAccount::select(
                    'total_transaction',
                    'total_debit',
                    'total_credit',
                    'debit_credit',
                    'closing_balance',
                )->where('id', '=', $request->account[$index])->get();
                //dd($accountdetails);

                $prev_closing = AccountDebitCredit::select("*")
                ->where('ledger_account_id', '=', $request->account[$index])
                ->where('branch_id','=',$request->branch1[$index])
                ->orderBy('id', 'desc')
                ->limit(1)->get();
                //dd($prev_closing);

                $total_transaction  = $accountdetails[0]->total_transaction;
                $total_debit   = $accountdetails[0]->total_debit;
                $total_credit  = $accountdetails[0]->total_credit;
                $total_debit_credit  = $accountdetails[0]->debit_credit;
                $closing_balance  = $accountdetails[0]->closing_balance;

                //dd($request->account[$index]);
                $transaction = new AccountDebitCredit(); 
                $transaction->ledger_entries_id = $entries->id;
                $transaction->ledger_account_id = $request->account[$index];
                $transaction->branch_id =  $request->branch1[$index];
                $transaction->amount = $request->amount[$index];                
                $transaction->type = $request->type[$index];

                if($request->type[$index] == "Debit"){
                    if($prev_closing->isEmpty()){
                        $transaction->opening_acc_balance  = 0;
                        $transaction->closing_acc_balance  = 0 - $request->amount[$index];
                    } else {
                        $transaction->opening_acc_balance  = $prev_closing[0]->closing_acc_balance;
                        $transaction->closing_acc_balance  = $prev_closing[0]->closing_acc_balance - $request->amount[$index];
                    }
                } 
                elseif($request->type[$index] == "Credit"){
                    if($prev_closing->isEmpty()){
                        $transaction->opening_acc_balance  = 0;
                        $transaction->closing_acc_balance  = 0 + $request->amount[$index];
                    } else {
                        $transaction->opening_acc_balance  = $prev_closing[0]->closing_acc_balance;
                        $transaction->closing_acc_balance  = $prev_closing[0]->closing_acc_balance + $request->amount[$index];
                    }
                }

                $transaction->save();


                if($transaction->save()){
                    
                    if($request->type[$index] == "Debit"){
                        $new_total_transaction  = $total_transaction + 1;
                        $new_total_debit  = $total_debit + $request->amount[$index];
                        $new_debit_credit  = $total_debit_credit - $request->amount[$index];
                        $new_closing_balance  = $closing_balance - $request->amount[$index];

                        $acc_update = LedgerAccount::find($request->account[$index]);
                        $acc_update->total_transaction =  $new_total_transaction;
                        $acc_update->last_transaction_date =  now();
                        $acc_update->total_debit =  $new_total_debit;
                        $acc_update->debit_credit =  $new_debit_credit;
                        $acc_update->closing_balance =  $new_closing_balance;

                        $acc_update->save();


                    } elseif($request->type[$index] == "Credit"){
                        $new_total_transaction =  $total_transaction + 1;
                        $new_total_credit =  $total_credit + $request->amount[$index];
                        $new_debit_credit =  $total_debit_credit + $request->amount[$index];
                        $new_closing_balance =  $closing_balance + $request->amount[$index];

                        $acc_update = LedgerAccount::find($request->account[$index]);
                        $acc_update->total_transaction =  $new_total_transaction;
                        $acc_update->last_transaction_date = now();
                        $acc_update->total_credit =  $new_total_credit;
                        $acc_update->debit_credit =  $new_debit_credit;
                        $acc_update->closing_balance =  $new_closing_balance;

                        $acc_update->save();
                    }
                }
                 
            } 
            //dd($request->branch1[$index]);
        
        session()->flash('success', 'Account Entries  has been Created !!');
        return redirect()->route('admin.account_entries.index');

      
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
        $entries = LedgerEntries::findOrFail($id);
        return view('backend.pages.account_entries.show',compact('entries'));  
    }

    public function acc_details($id)
    {
        $details = LedgerAccount::SELECT(
            'account_debit_credits.id',
            'company_branches.branch_name',
            'ledger_accounts.name',
            'account_debit_credits.branch_id',
            'account_debit_credits.created_at',
            'ledger_entries.description',
            'account_debit_credits.opening_acc_balance',
            'account_debit_credits.amount',
            'account_debit_credits.type',
            'account_debit_credits.closing_acc_balance',
        )
        ->leftjoin('account_debit_credits', 'ledger_accounts.id', '=', 'account_debit_credits.ledger_account_id')
        ->leftjoin('ledger_entries', 'ledger_entries.id', '=', 'account_debit_credits.ledger_entries_id')
        ->leftjoin('company_branches', 'company_branches.id', '=', 'account_debit_credits.branch_id')
        ->orderBy('account_debit_credits.id', 'DESC')
        ->where('ledger_accounts.id', '=', $id)->get();
        //dd($details);
        return view('backend.pages.account_entries.acc_details', compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entries = LedgerEntries::find($id);
        $branches= CompanyBranch::pluck('id','branch_name');
        $account= LedgerAccount::select('name','system_name','ledger_type')->get();
    
        return view('backend.pages.account_entries.edit',compact('entries','branches','account')); 
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
        // dd($request);
        $entries= LedgerEntries::find($id);
        $amount1=0;
        $amount2=0;

        foreach ($request->branch1 as $index=>$branches)
        {
          $amount1+=$request->debit_amount[$index];

        }
        //dd($amount1);
        foreach ($request->branch2 as $index=>$branches)
        {
          $amount2+=$request->credit_amount[$index];

        }
    if ($amount1==$amount2){

        // $entries=new LedgerEntries();
        $entries->entry_date  =  $request->entry_date;
        $entries->branch  =  $request->branch;
        $entries->description  =  $request->Description;
        
        $entries->save();


        if($entries->save()) {

            foreach ($request->branch1 as $index=>$branches)
            {
                 $debit = AccountDebit::where('id', '=', $id)->update([
            
                    'ledger_account' => $request->debit_account[$index],
                    'debit_amount' => $request->debit_amount[$index],
                    'branch' =>  $request->branch1[$index],
                 ]);
                 
                 //$debit->save();
            }
            foreach ($request->branch2 as $index=>$branches)
            {
                 $debit = new AccountCredit();
                 $debit->ledger_entries = $entries->id;
                 $debit->ledger_account = $request->credit_account[$index];
                 $debit->credit_amount = $request->credit_amount[$index];
                 $debit->branch =  $request->branch2[$index];
                 $debit->save();
            }


            //dd($request->branch1[$index]);

        }
        session()->flash('success', 'Account Entries  has been Updated !!');
        return redirect()->route('admin.account_entries.index');

        }else{
            session()->flash('success', 'Sum of debits must be equal to sum of credits. (DEBITS == CREDITS)
            !!');
            return redirect()->route('admin.account_entries.edit'); 
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = LedgerEntries::find($id);
        if (!is_null($del)) {
            AccountDebitCredit::where('ledger_entries_id','=', $id)->update([
                'ledger_entries_id' => NULL,
            ]);
            

            $del->delete();
        }

        session()->flash('success', 'Entries has been deleted !!');
        return back();
    }
}
