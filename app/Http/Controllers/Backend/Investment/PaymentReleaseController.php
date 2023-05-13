<?php

namespace App\Http\Controllers\Backend\Investment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InvestmentPayDetails;
use Response;
use App\Exports\InvestmentReleaseExport;
use Maatwebsite\Excel\Facades\Excel;

class PaymentReleaseController extends Controller
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
        return view('backend.pages.payment_rel_inv.index');
        
    }

    public function searchByDate(Request $request)
    {
        $details = InvestmentPayDetails::select(
            'investment_pay_details.id',

            'investment_pay_details.tenure_no',
            'investment_pay_details.principal_amt',
            'investment_pay_details.interest_earned',
            'investment_pay_details.maturity_amount',
            'investment_pay_details.int_per_tenure',
            'investment_pay_details.bal_principal',
            'investment_pay_details.period',
            

            'investment_pay_details.status',
            'investment_creates.member',
            'company_branches.branch_name',
            'member_management.first_name',
            'member_management.member_id_code',

        )
         ->join('investment_creates', 'investment_creates.id', '=', 'investment_pay_details.createInvestment_id')

         ->join('member_management', 'member_management.member_id', '=', 'investment_creates.member')
         ->join('company_branches', 'company_branches.id', '=', 'investment_creates.branch')
       
         ->where('investment_pay_details.status', '=', "Pending")
         ->where('investment_pay_details.period', $request->to_date)
        ->get();
        //dd($details);

        return Response::json($details, 200);
    }

    public function export($to_date){
        return Excel::download(new InvestmentReleaseExport($to_date),'InvestmentRelease-report.xlsx');

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
}
