<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\CompanyBranch;


class CompanyBranchController extends Controller
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
        if (is_null($this->user) || !$this->user->can('company_branch.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $branch = CompanyBranch::all();
        return view('backend.pages.comp_branch.index')->withBranch($branch);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('company_branch.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }

        $branch= CompanyBranch::all();
        return view('backend.pages.comp_branch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('company_branch.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }

        $request->validate([
            'branch_name' => 'required',
            'branch_code' => 'required',
            'open_date' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'country' => 'required',
           
             
        ]);
        $branch = new CompanyBranch();
        $branch->branch_name       =       $request->branch_name;
        $branch->branch_code       =       $request->branch_code;
        $branch->open_date         =       $request->open_date;
        $branch->zone         =       $request->zone;
        $branch->address           =       $request->address;
        $branch->city              =       $request->city;
        $branch->state             =       $request->state;
        $branch->pincode           =       $request->pincode;
        $branch->country           =       $request->country;
        $branch->contact_no        =       $request->contact_no;
        
        $branch->email             =       $request->email;
        $branch->save(); 

        // if($branch->save()){
        //     $branch_capital = new BranchPerCapital;
        //     $branch_capital->branch_id = $branch->id;
        //     $branch_capital->capital_bal = Helper::paidCapital();
        
        // }else{

        // }

        session()->flash('success', 'Companys Branch has been created !!');
        return redirect()->route('admin.comp_branch.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($this->user) || !$this->user->can('company_branch.show')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $company = CompanyBranch::findOrFail($id);
       $profile = CompanyBranch::all();
   //dd($company);
        return view('backend.pages.comp_branch.show',compact('company','profile')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        if (is_null($this->user) || !$this->user->can('company_branch.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $branch = CompanyBranch::find($id);
    
        return view('backend.pages.comp_branch.edit')->withBranch($branch); 
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
        if (is_null($this->user) || !$this->user->can('company_branch.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $branch=CompanyBranch::find($id);

        $request->validate([
            'branch_name' => 'required',
            'branch_code' => 'required',
            'open_date' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'country' => 'required',
            
             
        ]);
     
        $branch->branch_name       =       $request->branch_name;
        $branch->branch_code       =       $request->branch_code;
        $branch->open_date         =       $request->open_date;
        $branch->zone         =       $request->zone;
        $branch->address           =       $request->address;
        $branch->city              =       $request->city;
        $branch->state             =       $request->state;
        $branch->pincode           =       $request->pincode;
        $branch->country           =       $request->country;
        $branch->contact_no        =       $request->contact_no;
       
        $branch->email             =       $request->email;
        $branch->save();

        session()->flash('success', 'Companys Branch has been Updated !!');
        return redirect()->route('admin.comp_branch.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = CompanyBranch::find($id);
        if (!is_null($branch)) {
            $branch->delete();
        }

        session()->flash('success', 'Company Branch has been deleted !!');
        return back();
    }
}
