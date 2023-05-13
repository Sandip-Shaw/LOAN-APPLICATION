<?php

namespace App\Http\Controllers\Backend\IPaddress;

use App\Http\Controllers\Controller;
use App\Models\Whitelistedip;
use Illuminate\Http\Request;

class IPaddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ips = Whitelistedip::orderBy('id', 'DESC')->get();

        return view('backend.pages.ip-address.index',compact('ips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.ip-address.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            //  dd($request);
               $request->validate([
                'ipaddress' => 'required'
            ]);
    
            $ips = explode(',', $request->input('ipaddress'));
            foreach ($ips as $ip) {
                $list = new Whitelistedip();
                $list->ips  =  $ip;
                $list->save();
            }
  

         
            session()->flash('success', 'ip-address has been added !!');
            return redirect()->route('admin.ip-address.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $investment = Whitelistedip::findOrFail($id);  
        // $profile = LoanSchema::all();
  
          //return view('backend.pages.investment.show',compact('investment'));
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

        $ip = Whitelistedip::find($id);
        if (!is_null($ip)) {
            $ip->delete();
        }
        session()->flash('success', 'IP has been deleted !!');
        return back();
    }
}
