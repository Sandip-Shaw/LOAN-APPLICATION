<?php

namespace App\Http\Controllers\Backend\Collection_Center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CollectionCenter;
use App\Models\CompanyBranch;
use PhpParser\ErrorHandler\Collecting;

class CollectionCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = CollectionCenter::all();
        return view('backend.pages.collection.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = CompanyBranch::pluck('id', 'branch_name');
        return view('backend.pages.collection.create', compact('branches'));
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
            'center_no' => 'required',
            'branch' => 'required',
            'center_active' => 'required',
             
        ]);

        $collection = new CollectionCenter();
        $collection->center_no = $request->center_no;
        $collection->branch = $request->branch;
        $collection->center_head = $request->center_head;
        $collection->center_cashier = $request->center_cashier;
        $collection->collection_day = $request->collection_day;
        $collection->collection_time = $request->collection_time;
        $collection->center_active = $request->center_active;
        $collection->current_address = $request->current_address;
        $collection->latitude = $request->latitude;
        $collection->longitude = $request->longitude;

        $collection->save();

        session()->flash('success', 'Collection Center has been created !!');
        return redirect()->route('admin.collec_branch.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collection = CollectionCenter::findOrFail($id);
        return view('backend.pages.collection.show',compact('collection')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $collection = CollectionCenter::find($id);
        $branches = CompanyBranch::pluck('id', 'branch_name');
    
       // dd($branches);
        return view('backend.pages.collection.edit', compact('collection', 'branches'));
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
        $collection = CollectionCenter::find($id);

        $request->validate([
            'center_no' => 'required',
            'branch' => 'required',
            'center_active' => 'required',
             
        ]);


        CollectionCenter::where('id','=',$id)->update([
            'center_no' => $request->center_no,
            'branch' => $request->branch,
            'center_head' => $request->center_head,
            'center_cashier' => $request->center_cashier,
            'collection_day' => $request->collection_day,
            'collection_time' => $request->collection_time,
            'center_active' => $request->center_active,
            'current_address' => $request->current_address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        session()->flash('success', 'Collection Center has been Updated !!');
        return redirect()->route('admin.collec_branch.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = CollectionCenter::find($id);
        if (!is_null($collection)) {
            $collection->delete();
        }

        session()->flash('success', 'Collection Center has been deleted !!');
        return back();
    }
}
