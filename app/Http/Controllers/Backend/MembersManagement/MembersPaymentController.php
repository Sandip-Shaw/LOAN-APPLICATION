<?php

namespace App\Http\Controllers\Backend\MembersManagement;

use App\Http\Controllers\Controller;
use App\Models\CompanyDirector;
use App\Models\MemberManagement;
use App\Models\MembersPayment;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use PDF;

class MembersPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = MemberManagement::select('member_id', 'first_name')->get();
        return view('backend.pages.members_payment.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member = MemberManagement::select('member_id', 'first_name')->get();
        $director = CompanyDirector::select('id', 'director_name', 'share')->get();
        return view('backend.pages.members_payment.create', compact('member', 'director'));
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
        $request->validate([

            'member_id' => 'required',
            'member_fees' => 'required',
            'share_allotted_from' => 'required',
            'shares' => 'required',
            'share_amount' => 'required',
            'payment_by' => 'required',

        ]);

        $members = new MembersPayment();
            $members->member_id = $request->member_id;
            $members->member_fees = $request->member_fees;
            $members->share_allotted_from = $request->share_allotted_from;
            $members->shares = $request->shares;
            $members->share_amount = $request->share_amount;
            $members->payment_by = $request->payment_by;
            $members->status = 'Paid';


            //$members->save();

            if($members){
                $director_id = $request->share_allotted_from;
                $dir_share = CompanyDirector::select('share')->where('id', '=', $director_id)->get();
                    if($dir_share[0]->share > $request->shares) {
                    $dir_new_share = $dir_share[0]->share - $request->shares;
                    //dd($dir_new_share);
                    $members->save();
                    CompanyDirector::where('id', '=', $director_id)->update([
                        'share' => $dir_new_share,
                    ]);
                } else {
                    session()->flash('error', 'Insufficient Shares in Director!!');
                return redirect()->route('admin.members_payment.create');
                }
            }

            session()->flash('success', 'Member Payment Completed !!');
                return redirect()->route('admin.members_payment.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $member_id)
    {
        $membarpayment = MembersPayment::findorfail($id);
        $memberdetails = MemberManagement::select('first_name')->where('member_id', '=', $member_id)->get();
        $director_id = MembersPayment::select('share_allotted_from', 'created_at')->where('id', '=', $id)->get();
        $sharefrom = CompanyDirector::select('director_name')->where('id', '=', $director_id[0]->share_allotted_from)->get();
        //dd($sharefrom);
        $alloc_date = explode(" ", $director_id[0]->created_at);
        //dd($alloc_date[0]);

        return view('backend.pages.members_payment.show',compact('membarpayment', 'memberdetails', 'sharefrom', 'alloc_date'));
    }

    public function downloadCertificate($id, $member_id)
    {
        $membarpayment = MembersPayment::findorfail($id);
        $memberdetails = MemberManagement::select('first_name')->where('member_id', '=', $member_id)->get();
        $director_id = MembersPayment::select('share_allotted_from', 'created_at')->where('id', '=', $id)->get();
        $sharefrom = CompanyDirector::select('director_name')->where('id', '=', $director_id[0]->share_allotted_from)->get();
        //dd($sharefrom);
        $alloc_date = explode(" ", $director_id[0]->created_at);
        //dd($alloc_date[0]);

        $pdf = PDF::loadView('backend.pages.members_payment.show', compact('membarpayment', 'memberdetails', 'sharefrom', 'alloc_date'));
        //return $pdf->download('certificate.pdf');
        return $pdf->stream("certificate.pdf",array("Attachment" => false));

    }

    public function payment_details($member_id)
    {
        $member = MembersPayment::select('*')->where('member_id', '=', $member_id)->get();
        //$alloc_date = explode(" ", $member[0]->created_at);
        return $member->toJson();
 
        //dd($member);
       
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
