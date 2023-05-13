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
use App\Models\CompanyDirector;
use App\Models\MemberManagement;

use Image;

class CompanyDirectorController extends Controller
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
        if (is_null($this->user) || !$this->user->can('company_director.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $director = CompanyDirector::all();
        return view('backend.pages.comp_director.index')->withDirector($director);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (is_null($this->user) || !$this->user->can('company_director.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        } 
        $member= MemberManagement::pluck('member_id','first_name','last_name');
        //dd($member);
        return view('backend.pages.comp_director.create')->withMembers($member);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('company_director.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create any admin !');
        }

        // dd($request);
        $director=new CompanyDirector;
        $variable=$request->toArray();
        foreach ($variable as $key => $value) {
           if($key!='_token' & $key!='image')
            $director->$key=$value;
        }

        $image=$request->file('image');
      
        //dd($image);
        $filename='Director'.'-'.rand().time().'.'.$image->getClientOriginalExtension();//part of image intervention library
        $location=public_path('/images/directorImage/'.$filename);

      

        Image::make($image)->resize(800,600)->save($location);
        $director->image=$filename;
        $director->save();        
        //dd("hello");
        session()->flash('success', 'The Director Profile Has Been Added Successfully!');
        return redirect()->route('admin.comp_director.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($this->user) || !$this->user->can('company_director.show')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $director = CompanyDirector::findOrFail($id);
        $profile = CompanyDirector::all();
    //dd($company);
         return view('backend.pages.comp_director.show',compact('director','profile')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('company_director.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $director = CompanyDirector::find($id);
        $member= MemberManagement::pluck('member_id','first_name','last_name');
    
        return view('backend.pages.comp_director.edit')->withDirector($director)->withMembers($member); 
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

        if (is_null($this->user) || !$this->user->can('company_director.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }


        $director=CompanyDirector::find($id);

        $variable=$request->toArray();
        foreach ($variable as $key => $value) {
           if($key!='_token' & $key!='image' & $key!='_method')
            $director->$key=$value;
        }

        $image=$request->file('image');
        //if($request->hasFile('image_name')){
        //dd($image);
        if(isset($image)){
        $filename='Director'.'-'.rand().time().'.'.$image->getClientOriginalExtension();//part of image intervention library
        $location=public_path('/images/directorImage/'.$filename);

        // use $location='images/'.$filename; on a server

        Image::make($image)->resize(800,600)->save($location);
        $director->image=$filename;
}
        $director->save();        

        session()->flash('success', 'The Directors Profile Has Been updated Successfully!');
        return redirect()->route('admin.comp_director.index');
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
