<?php

namespace App\Http\Controllers\Backend\Groups;

use App\Http\Controllers\Controller;
use App\Models\CompanyBranch;
use Illuminate\Http\Request;
use App\Models\Groups;
use App\Models\HrManagement;
use App\Models\MemberManagement;
use PHPUnit\TextUI\XmlConfiguration\Group;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Groups::all();
        return view('backend.pages.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = CompanyBranch::select('branch_name', 'branch_code')->get();
        $members = MemberManagement::pluck('member_id', 'member_id');
        $employee = HrManagement::select('name', 'emp_code')->get();
        return view('backend.pages.groups.create', compact('members', 'branch', 'employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'required',
            'op_date' => 'required',
            'group_branch' => 'required',
            'group_leader_name' => 'required',
            'mobile_no' => 'required',
            'group_address' => 'required',
            'assign_employee' => 'required',
            'collection_day' => 'required',
            'collection_time' => 'required',
             
        ]);
       // dd($request);

        $groups = new Groups();
        $groups->group_name = $request->group_name;
        $groups->op_date = $request->op_date;
        $groups->group_branch = $request->group_branch;
        $groups->group_leader_name = $request->group_leader_name;
        $groups->mobile_no = $request->mobile_no;
        $groups->group_address = $request->group_address;
        $groups->assign_employee = $request->assign_employee;
        $groups->collection_day = $request->collection_day;
        $groups->collection_time = $request->collection_time;

        $file=$request->file('group_photo');
        $filename='Group_photo_'.$request->group_name.time().'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('images/Group_photo');
        $file->move($destinationPath,$filename);
        $groups->group_photo=$filename;

        $file=$request->file('leader_photo');
        $filename='Leader_photo_'.$request->group_leader_name.time().'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('images/Leader_photo');
        $file->move($destinationPath,$filename);
        $groups->leader_photo=$filename;

        $groups->save();

        session()->flash('success', 'Groups has been created !!');
        return redirect()->route('admin.groups.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Groups::findOrFail($id);
        //$members = MemberManagement::pluck('member_id', 'first_name');
        $members = MemberManagement::select('*')->where('group', '=', NULL)->get();
        $member_table = MemberManagement::select('*')->where('group','=', $id)->get();
        $allbranch = CompanyBranch::select('branch_name', 'branch_code')->get();
        $employee = HrManagement::select('name', 'emp_code')->get();

        return view('backend.pages.groups.show',compact('group', 'members', 'member_table', 'allbranch', 'employee')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Groups::find($id);
        //$members = MemberManagement::pluck('member_id', 'member_id');
        $members = MemberManagement::select('*')->where('group', '=', NULL)->get();
        $member_table = MemberManagement::select('*')->where('group','=', $id)->get();
        $allbranch = CompanyBranch::select('branch_name', 'branch_code')->get();
        $employee = HrManagement::select('name', 'emp_code')->get();
    
        //dd($members);
        return view('backend.pages.groups.edit', compact('group', 'members', 'member_table', 'allbranch', 'employee'));
    }

    public function member_details($member_id)
    {
        $member = MemberManagement::findOrFail($member_id);
        return $member->toJson();
 
        //dd($member);
       
    }

    public function memberupdate(Request $request, $id)
    {
        // dd($request->search_by_member);
        // dd($id);
        $member_id = $request->search_by_member;
        MemberManagement::where('member_id','=', $member_id)->update([
            'group' => $id,
        ]);

        session()->flash('success', 'Member has been Added !!');
        return redirect()->route('admin.groups.index');
       
        
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
        $group = Groups::find($id);

        $request->validate([
            'group_name' => 'required',
            'op_date' => 'required',
            'group_branch' => 'required',
            'group_leader_name' => 'required',
            'mobile_no' => 'required',
            'group_address' => 'required',
            'assign_employee' => 'required',
            'collection_day' => 'required',
            'collection_time' => 'required',
             
        ]);

       // dd($request);
        $group_file=$request->file('group_photo');
        $leader_file=$request->file('leader_photo');
        if (file_exists($group_file) && file_exists($leader_file)){
            $group_filename='Group_photo_'.$request->group_name.time().'.'.$group_file->getClientOriginalExtension();
            $destinationPath = public_path('images/Group_photo');
            $group_file->move($destinationPath,$group_filename);
            //$groups->group_photo=$filename;

            $leader_filename='Leader_photo_'.$request->group_leader_name.time().'.'.$leader_file->getClientOriginalExtension();
            $destinationPath = public_path('images/Leader_photo');
            $leader_file->move($destinationPath,$leader_filename);
            //$groups->leader_photo=$filename;

            //dd($group_filename, $leader_filename);
            Groups::where('id','=', $id)->update([
                'group_name' => $request->group_name,
                'op_date' => $request->op_date,
                'group_branch' => $request->group_branch,
                'group_leader_name' => $request->group_leader_name,
                'mobile_no' => $request->mobile_no,
                'group_address' => $request->group_address,
                'assign_employee' => $request->assign_employee,
                'collection_day' => $request->collection_day,
                'collection_time' => $request->collection_time,
                'group_photo' => $group_filename,
                'leader_photo' => $leader_filename,
           ]);
           session()->flash('success', 'Group has been Updated !!');
            return redirect()->route('admin.groups.index');

        } elseif (file_exists($group_file) || file_exists($leader_file)){
            if(file_exists($group_file)){
                $group_filename='Group_photo_'.$request->group_name.time().'.'.$group_file->getClientOriginalExtension();
                $destinationPath = public_path('images/Group_photo');
                $group_file->move($destinationPath,$group_filename);
                //$groups->group_photo=$filename;
                //dd($group_filename);

                Groups::where('id','=', $id)->update([
                    'group_name' => $request->group_name,
                    'op_date' => $request->op_date,
                    'group_branch' => $request->group_branch,
                    'group_leader_name' => $request->group_leader_name,
                    'mobile_no' => $request->mobile_no,
                    'group_address' => $request->group_address,
                    'assign_employee' => $request->assign_employee,
                    'collection_day' => $request->collection_day,
                    'collection_time' => $request->collection_time,
                    'group_photo' => $group_filename,
               ]);
               session()->flash('success', 'Group has been Updated !!');
                return redirect()->route('admin.groups.index');
            } else if(file_exists($leader_file)){
                $leader_filename='Leader_photo_'.$request->group_leader_name.time().'.'.$leader_file->getClientOriginalExtension();
                $destinationPath = public_path('images/Leader_photo');
                $leader_file->move($destinationPath,$leader_filename);
                //$groups->leader_photo=$filename;
                // dd($leader_filename);
                Groups::where('id','=', $id)->update([
                    'group_name' => $request->group_name,
                    'op_date' => $request->op_date,
                    'group_branch' => $request->group_branch,
                    'group_leader_name' => $request->group_leader_name,
                    'mobile_no' => $request->mobile_no,
                    'group_address' => $request->group_address,
                    'assign_employee' => $request->assign_employee,
                    'collection_day' => $request->collection_day,
                    'collection_time' => $request->collection_time,
                    'leader_photo' => $leader_filename,
               ]);
               session()->flash('success', 'Group has been Updated !!');
                return redirect()->route('admin.groups.index');
            }
            } else {
                Groups::where('id','=', $id)->update([
                    'group_name' => $request->group_name,
                    'op_date' => $request->op_date,
                    'group_branch' => $request->group_branch,
                    'group_leader_name' => $request->group_leader_name,
                    'mobile_no' => $request->mobile_no,
                    'group_address' => $request->group_address,
                    'assign_employee' => $request->assign_employee,
                    'collection_day' => $request->collection_day,
                    'collection_time' => $request->collection_time,
               ]);
               session()->flash('success', 'Group has been Updated !!');
                return redirect()->route('admin.groups.index');
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
        $group = Groups::find($id);
        if (!is_null($group)) {
            MemberManagement::where('group','=', $id)->update([
                'group' => NULL,
            ]);
            $group->delete();
        }

        session()->flash('success', 'Group has been deleted !!');
        return back();
    }
}
