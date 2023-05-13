<?php

namespace App\Http\Controllers\Backend\Hr_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\CompanyBranch;
use App\Models\HrManagement;
use Image;
use File;
use App\Helpers\Helper;
use App\Models\AccountCodeSeries;
use App\Models\AddDesignation;
use App\Models\MemberManagement;






class HrManagementController extends Controller
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
        $hrmanagement = HrManagement::all();
        return view('backend.pages.hr_management.index')->withHrmanagements($hrmanagement);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch= CompanyBranch::pluck('id','branch_name');
        $design= AddDesignation::pluck('id','designation_name');
        $member= MemberManagement::select('member_id', 'first_name', 'member_id_code')->get();
        //dd($member);
        return view('backend.pages.hr_management.create',compact('design','member'))->withBranches($branch);
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
        $series = AccountCodeSeries::select("*")->where('code_name', '=', "Employee Code")->get();
        $employee_code= Helper::IDGeneratorEmp(new HrManagement,'emp_code', $series[0]->no_of_digit, $series[0]->code_prefix);

        $hrmanagement=new HrManagement;
        $data=$request->toArray();
        $hrmanagement->emp_code          =   $employee_code;

        $hrmanagement->designation   =   $data['designation'];
        $hrmanagement->branch    =   $data['branch'];
        $hrmanagement->name      =   $data['name'];
        $hrmanagement->dob       =   $data['dob'];
        $hrmanagement->dateofjoining   =   $data['dateofjoining'];
        $hrmanagement->email        =   $data['email'];
        $hrmanagement->mobile        =   $data['mobile'];
        $hrmanagement->address        =   $data['address'];
        $hrmanagement->fathername        =   $data['fathername'];
        $hrmanagement->bank_name        =   $data['bank_name'];
        $hrmanagement->account_no        =   $data['account_no'];
        $hrmanagement->ifsc_code        =   $data['ifsc_code'];
        $hrmanagement->bank_branch_name        =   $data['bank_branch_name'];
        $hrmanagement->member        =   $data['member'];
        $hrmanagement->voter_no        =   $data['voter_no'];
        $hrmanagement->pan_no        =   $data['pan_no'];
        $hrmanagement->adhar_no        =   $data['adhar_no'];
        $hrmanagement->blood_group        =   $data['blood_group'];
        $hrmanagement->monthlysalary        =   $data['monthlysalary'];
        $hrmanagement->image        =   $data['emp_image'];
        $hrmanagement->emp_image_sign        =   $data['emp_image_sign'];
        $hrmanagement->emp_pan        =   $data['emp_pan'];
        $hrmanagement->emp_idproof        =   $data['emp_idproof'];


        $hrmanagement->save();        
        //dd("hello");
        session()->flash('success', 'The Employee Profile Has Been Added Successfully!');
        return redirect()->route('admin.hr_management.index');

    }


    public function employee_details($hrmanagement_id)
    {
        $employee = HrManagement::findOrFail($hrmanagement_id);
        return $employee->toJson();
       
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($hrmanagement_id)
    {
        $hrmanagement = HrManagement::findOrFail($hrmanagement_id);
        $profile = HrManagement::all();
   
         return view('backend.pages.hr_management.show',compact('hrmanagement','profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($hrmanagement_id)
    {
        $hrmanagement = HrManagement::find($hrmanagement_id);
        $branch= CompanyBranch::pluck('id','branch_name');
        $design= AddDesignation::pluck('id','designation_name');
    
        return view('backend.pages.hr_management.edit',compact('design'))->withBranches($branch)->withHrmanagements($hrmanagement); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hrmanagement_id)
    {
        $hrmanagement = HrManagement::find($hrmanagement_id);

        $hrmanagement->designation=$request->designation;
        $hrmanagement->branch=$request->branch;
        $hrmanagement->name=$request->name;
        $hrmanagement->dob=$request->dob;
    
        $hrmanagement->dateofjoining=$request->dateofjoining;
        $hrmanagement->email=$request->email;
        $hrmanagement->mobile=$request->mobile;
        $hrmanagement->address=$request->address;
        $hrmanagement->fathername=$request->fathername;
        $hrmanagement->bank_name = $request->bank_name;
        $hrmanagement->account_no  = $request->account_no;
        $hrmanagement->ifsc_code = $request->ifsc_code;
        $hrmanagement->bank_branch_name = $request->bank_branch_name;
        $hrmanagement->pan_no=$request->pan_no;
        $hrmanagement->adhar_no=$request->adhar_no;
        $hrmanagement->adhar_no=$request->voter_no;
        $hrmanagement->blood_group=$request->blood_group;
        $hrmanagement->monthlysalary=$request->monthlysalary;
       
        // if($request->hasFile('image')){
        //     if($hrmanagement->image){
        //         $old_path= public_path('images/employeeImage/'.$hrmanagement->image);
        //         if(File::exists($old_path)){
        //             File::delete($old_path);
        //         }
        //     }

        // }
        //     $file=$request->file('image');
        //     if(isset($file)){
        //     $filename='Employee'.'-'.time().'.'.$file->getClientOriginalName();
        //     // $extension=$file->getClientOriginalExtension();
        //     $destinationPath = public_path('images/employeeImage');
        //     $file->move($destinationPath,$filename);
        //     $hrmanagement->image=$filename;
        //     }
            
            $hrmanagement->save();        
        
        session()->flash('success', 'The Employee Profile Has Been Updated Successfully!');
        return redirect()->route('admin.hr_management.index');
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
