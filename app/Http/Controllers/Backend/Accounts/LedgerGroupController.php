<?php

namespace App\Http\Controllers\Backend\Accounts;

use App\Http\Controllers\Controller;
use App\Models\LedgerAccount;
use Illuminate\Http\Request;
use App\Models\LedgerGroup;
use App\Models\LedgerType;



class LedgerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group=LedgerGroup::all();
        $asset=LedgerGroup::select('*')->where('group_type','=',"1")->get();
        $liability=LedgerGroup::select('*')->where('group_type','=',"2")->get();
        $equity=LedgerGroup::select('*')->where('group_type','=',"3")->get();
        $expenses=LedgerGroup::select('*')->where('group_type','=',"4")->get();
        $revenue=LedgerGroup::select('*')->where('group_type','=',"5")->get();

       // dd($asset);
        return view('backend.pages.ledger_group.index')->withGroups($group)->withAssets($asset)->withLiabilitys($liability)->withEquitys($equity)->withExpensess($expenses)->withRevenues($revenue);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group= LedgerType::select('ledger_types_id', 'types')->get();

        return view('backend.pages.ledger_group.create',compact('group'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'group_type' => 'required',
            'display_name' => 'required',
            'system_name' => 'required',
            'position' => 'required',

        ]);
        $group= new LedgerGroup();
        $group->group_type       =       $request->group_type;
        $group->display_name     =       $request->display_name;
        $group->system_name      =       $request->system_name;
        $group->position         =       $request->position;
        $group->system_group     =       $request->system_group;

        $group->save();

        session()->flash('success', 'Ledger Group has been created !!');
        return redirect()->route('admin.ledger_group.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = LedgerGroup::findOrFail($id);
        $accounts = LedgerAccount::select("*")->where('ledger_group_id', '=', $id)->get();

        return view('backend.pages.ledger_group.show',compact('group', 'accounts')); 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = LedgerGroup::find($id);
        $type= LedgerType::select('ledger_types_id', 'types')->get();
    
        return view('backend.pages.ledger_group.edit',compact('group','type')); 
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
        $group= LedgerGroup::find($id);

        $request->validate([
            'group_type' => 'required',
            'display_name' => 'required',
            'system_name' => 'required',
            'position' => 'required',

        ]);
        $group->group_type       =       $request->group_type;
        $group->display_name     =       $request->display_name;
        $group->system_name      =       $request->system_name;
        $group->position         =       $request->position;
        $group->system_group     =       $request->system_group;

        $group->save();

        session()->flash('success', 'Ledger Group has been Updated !!');
        return redirect()->route('admin.ledger_group.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ledger = LedgerGroup::find($id);
        if (!is_null($ledger)) {
            $ledger->delete();
        }

        session()->flash('success', 'Ledger Group has been deleted !!');
        return back();
    }
}
