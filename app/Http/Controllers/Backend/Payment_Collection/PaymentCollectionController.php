<?php

namespace App\Http\Controllers\Backend\Payment_Collection;

use App\Http\Controllers\Controller;
use App\Models\CompanyBranch;
use App\Models\EmiDetails;
use App\Models\HrManagement;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\EmiPaymentCollectionExport;

class PaymentCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch = CompanyBranch::select('id', 'branch_name')->get();
        $associate = HrManagement::select('hrmanagement_id', 'name')->get();

        
        return view('backend.pages.payment_collection.index', compact('branch', 'associate'));
    }

    public function searchByDate(Request $request)
    {
        $emi_details = EmiDetails::select(
            'emi_details.*',
            'loan_applications.loanApplication_id',
            'member_management.first_name',
            'company_branches.branch_name',

        )
        ->join('loan_disbursements', 'loan_disbursements.id', '=', 'emi_details.loan_disbursement_id')
        ->join('loan_applications', 'loan_applications.loanApplication_id', '=', 'loan_disbursements.loanApplication_id')
        ->join('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->join('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->where('loan_applications.status', '=', "Disbursed")
        ->where('emi_details.status', '=', "Pending")
        ->where('emi_details.emi_date', $request->to_date)
        ->get();
        return $emi_details->toJson();
        //dd($emi_details);
    }

    public function export($to_date){
        return Excel::download(new EmiPaymentCollectionExport($to_date),'EmiPayment-report.xlsx');

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
