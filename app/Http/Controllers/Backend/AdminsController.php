<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\HrManagement;
use App\Models\AddDesignation;
use App\Models\CompanyBranch;
use App\Models\CompanyAdminBranch;



use Illuminate\Support\Facades\Http;

class AdminsController extends Controller
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
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $admins = Admin::all();
        return view('backend.pages.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }

        $roles  = Role::all();
        $employee= HrManagement::pluck('hrmanagement_id','name');
        $design= AddDesignation::pluck('id','designation_name');
        $branch= CompanyBranch::pluck('id','branch_name');


        return view('backend.pages.admins.create', compact('roles','employee','design','branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }
    //  dd($request);
        // Validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins',
            'username' => 'required|max:100|unique:admins',
            // 'password' => 'required|min:6|confirmed',
            'holiday_login' => 'required',
            'user_active' => 'required',

        ]);
        //dd($employee);
        // Create New Admin
        $pwd= rand(100000, 999999);
        $response = Http::get('message.neodove.com/sendsms.jsp?user=BOUNDPAR&password=7c51237a44XX&senderid=BPTCPE&mobiles=+91'.$request->mobile.'&sms='.$pwd.' is your OnecPe employee portal login . Do not share it with anyone. Boundparivar');

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->password = Hash::make($pwd);
        $admin->back_date_entry_days= $request->back_date_entry_days;
        $admin->holiday_login= $request->holiday_login;
        $admin->user_active= $request->user_active;

        $admin->save();
    //     if($admin->save()){
    //     foreach($request->branch as $branches){
    //         $admin_branch = new CompanyAdminBranch();
    //         $admin_branch->admin_id = $admin->id;
    //         $admin_branch->branch_id = $branches;
    //         $admin_branch->save();

    //     }
    // }

    $admin->branchs()->sync($request->branch);


        if ($request->roles) {
            $admin->assignRole($request->roles);
        }
        $employee= HrManagement::where('mobile','=',$request->mobile)->first();
        $employee->user_id=$admin->id;
        $employee->save();

        session()->flash('success', 'Admin has been created !!');
        return redirect()->route('admin.admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin_show = Admin::select(
            'admins.*',
            'hr_management.name as employee_name',
            'hr_management.email as employee_email',
            'hr_management.mobile as employee_mobile',
            'hr_management.designation as employee_designation',
            'company_admin_branches.branch_id as branch'

        )->leftjoin('hr_management','admins.id','=','hr_management.user_id')
         ->leftjoin('company_admin_branches','admins.id','=','company_admin_branches.admin_id')
         ->where('admins.id','=',$id)
         ->get();
        //dd($admin_show);
        return view('backend.pages.admins.show',compact('admin_show')); 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $admin = Admin::find($id);
        $roles  = Role::all();
        $branch_sel= CompanyBranch::all();

        return view('backend.pages.admins.edit', compact('admin', 'roles','branch_sel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        // TODO: You can delete this in your local. This is for heroku publish.
        // This is only for Super Admin role,
        // so that no-one could delete or disable it by somehow.
        if ($id === 1) {
            session()->flash('error', 'Sorry !! You are not authorized to update this Admin as this is the Super Admin. Please create new one if you need to test !');
            return back();
        }

        // Create New Admin
        $admin = Admin::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,' . $id,
             'password' => 'nullable|min:6|confirmed',
        ]);


        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        $admin->branchs()->sync($request->branch);


        $admin->roles()->detach();
        if ($request->roles) {
            $admin->assignRole($request->roles);
        }

        session()->flash('success', 'Admin has been updated !!');
        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any admin !');
        }

        // TODO: You can delete this in your local. This is for heroku publish.
        // This is only for Super Admin role,
        // so that no-one could delete or disable it by somehow.
        if ($id === 1) {
            session()->flash('error', 'Sorry !! You are not authorized to delete this Admin as this is the Super Admin. Please create new one if you need to test !');
            return back();
        }

        $admin = Admin::find($id);
        if (!is_null($admin)) {
            $admin->delete();
        }

        session()->flash('success', 'Admin has been deleted !!');
        return back();
    }
}
