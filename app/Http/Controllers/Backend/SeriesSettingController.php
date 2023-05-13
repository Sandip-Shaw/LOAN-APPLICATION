<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\AccountCodeSeries as BackendAccountCodeSeries;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountCodeSeries;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeriesSettingController extends Controller
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
        if (is_null($this->user) || !$this->user->can('code_setting.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view code setting !');
        }
        $series= AccountCodeSeries::all();
       // dd($series);
        return view('backend.pages.series_setting.index',compact('series'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('code_setting.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create code setting !');
        }
        return view('backend.pages.series_setting.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $store=new AccountCodeSeries();
        // $store->code_name  =  $request->code_name;
        // $store->code_prefix  =  $request->code_prefix;
        // $store->no_of_digit  =  $request->no_of_digit;
        // $store->start_digits  =  $request->start_digits;

        
        // $store->save();
        $TableData_JSON = json_decode($request->code_data, true);
        $code = $TableData_JSON['data'];
        foreach ($code as $val){
            //echo $val['name'];
            $code_series = new AccountCodeSeries();
            $code_series->code_name = $val['name'];
            $code_series->code_prefix = $val['code_prefix'];
            $code_series->no_of_digit = $val['no_of_digit'];
            $code_series->start_digits = $val['start_digits'];

            $code_series->save();
        }
        session()->flash('success', 'An Account series setting has been successfully added!!');
        return redirect()->route('admin.series-setting.index');

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
