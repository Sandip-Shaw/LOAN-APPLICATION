<?php

namespace App\Http\Controllers\Backend\Hr_Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AddDesignation;


class AddDesignationController extends Controller
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
        $design= AddDesignation::all();
        return view('backend.pages.addDesignEmployee.index',compact('design'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.addDesignEmployee.create');
        
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
            'designation_name' => 'required',        
        ]);

        $design = new AddDesignation();
        $design->designation_name            =       $request->designation_name;
           
        $design->save();

        session()->flash('success', 'Designation has been created !!');
        return redirect()->route('admin.add_designation.index');

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
        $design = AddDesignation::find($id);
 
        return view('backend.pages.addDesignEmployee.edit',compact('design'));  
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
        $design=AddDesignation::find($id);
        $request->validate([
            'designation_name' => 'required',
          
        ]);
        $design->designation_name            =       $request->designation_name;

        $design->update();

        session()->flash('success', 'Designation has been Updated !!');
        return redirect()->route('admin.add_designation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $design = AddDesignation::find($id);
        if (!is_null($design)) {
            $design->delete();
        }

        session()->flash('success', 'Designation has been deleted !!');
        return back();
    }
}
