
@extends('backend.layouts.master')

@section('title')
Members Edit - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }

    .switch {
	position: relative;
	display: block;
	vertical-align: top;
	width: 100px;
	height: 30px;
	padding: 3px;
	margin: 0 10px 10px 0;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
	border-radius: 18px;
	box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
	cursor: pointer;
	box-sizing:content-box;
}
.switch-input {
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0;
	box-sizing:content-box;
}
.switch-label {
	position: relative;
	display: block;
	height: inherit;
	font-size: 10px;
	text-transform: uppercase;
	background: #eceeef;
	border-radius: inherit;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
	box-sizing:content-box;
}
.switch-label:before, .switch-label:after {
	position: absolute;
	top: 50%;
	margin-top: -.5em;
	line-height: 1;
	-webkit-transition: inherit;
	-moz-transition: inherit;
	-o-transition: inherit;
	transition: inherit;
	box-sizing:content-box;
}
.switch-label:before {
	content: attr(data-off);
	right: 11px;
	color: #aaaaaa;
	text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
	content: attr(data-on);
	left: 11px;
	color: #FFFFFF;
	text-shadow: 0 1px rgba(0, 0, 0, 0.2);
	opacity: 0;
}
.switch-input:checked ~ .switch-label {
	background: #E1B42B;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
	opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
	opacity: 1;
}
.switch-handle {
	position: absolute;
	top: 4px;
	left: 4px;
	width: 28px;
	height: 28px;
	background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
	background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
	border-radius: 100%;
	box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
}
.switch-handle:before {
	content: "";
	position: absolute;
	top: 50%;
	left: 50%;
	margin: -6px 0 0 -6px;
	width: 12px;
	height: 12px;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
	border-radius: 6px;
	box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
}
.switch-input:checked ~ .switch-handle {
	left: 74px;
	box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}
 
/* Transition
========================== */
.switch-label, .switch-handle {
	transition: All 0.3s ease;
	-webkit-transition: All 0.3s ease;
	-moz-transition: All 0.3s ease;
	-o-transition: All 0.3s ease;
}
</style>
@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Edit Members Management</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Members</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card" style="border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <h3 class="header-title"> Edit Members </h3>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{route('admin.members_management.update', $member->member_id)}}" method="POST" id="form" enctype="multipart/form-data">
                    @method('PUT')
                        @csrf


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="associate">Associate/Advisor/Staff </label>
                                <select name="associate" id="associate" class="form-control">
                                    <option value="">Select Associate</option>

                                    @foreach($hrmanagements as $key=>$associate)
                                        <option value="{{$associate}}" @php if($member->associate==$associate) echo "selected";  @endphp >{{$key}}</option>

                                    @endforeach
                                   
                               
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label  for="group">Group</label>
                                <input type="text" class="form-control" id="group" name="group" value="{{ $member->group }}"  placeholder="Enter Group Name">
                           
                            </div>
                           
                           
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="branch">Branch <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="branch" id="branch" class="form-control" required>
                                    @foreach($branches as $key=>$branch)
                                    <option value="{{$branch}}"@php if($member->branch==$branch) echo "selected";  @endphp>{{$key}}</option>
                                   
                                   @endforeach
                             
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emr_date">Enrollment Date <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="emr_date" name="emr_date" value="{{ $member->emr_date }}" required>
                            </div>
                           
                           
                        </div>
                        <hr>
                        <h4 class="header-title" style="text-align:center;">Member's Information</h4>

                        <div class="form-row">
                        <div class="form-group col-md-6" style="display:flex"> 
                                <p style="padding-right: 10px;line-height: 3;"> Title <span style="color:red; font-size: 18px;line-height:1">*</span></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="title" value="Mr." <?php if($member->title=="Mr.") {echo "checked";} ?>>
                                    <label class="form-check-label" for="title">Mr.</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="title" value="Mrs." <?php if($member->title=="Mrs.") {echo "checked";} ?>>
                                    <label class="form-check-label" for="title">Mrs.</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="title" value="Ms." <?php if($member->title=="Ms.") {echo "checked";} ?>>
                                    <label class="form-check-label" for="title">Ms.</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="title" value="Md." <?php if($member->title=="Md.") {echo "checked";} ?>>
                                    <label class="form-check-label" for="title">Md.</label>
                                </div>
                            </div>
                             <div class="form-group col-md-6" style="display:flex"> 
                                <p style="padding-right: 10px;line-height: 3;"> Gender <span style="color:red; font-size: 18px;line-height:1">*</span></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="male" <?php if($member->gender=="male") {echo "checked";} ?>>
                                    <label class="form-check-label" for="gender">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="female" <?php if($member->gender=="female") {echo "checked";} ?>>
                                    <label class="form-check-label" for="gender">Female</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="first_name">Full Name <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="first_name" value="{{ $member->first_name }}" name="first_name" placeholder="Enter Full Name" required>
                            </div>
                            <!-- <div class="form-group col-md-4 ">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" value="{{ $member->middle_name }}" name="middle_name" placeholder="Enter Middle Name">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" value="{{ $member->last_name }}" name="last_name" placeholder="Enter Last Name">
                            </div> -->
                            <div class="form-group col-md-4">
                                <label for="dob">Date Of Birth <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="dob" value="{{ $member->dob }}" name="dob" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="qualification">Qualification</label>
                                <input type="text" class="form-control" id="qualification" name="qualification" value="{{ $member->qualification }}" placeholder="Enter Qualification">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="occupation">Occupation</label>
                                <input type="text" class="form-control" id="occupation" name="occupation" value="{{ $member->occupation }}" placeholder="Enter Occupation">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="monthly_income">Monthly Income</label>
                                <input type="text" class="form-control" id="monthly_income" name="monthly_income" value="{{ $member->monthly_income }}" placeholder="Enter Monthly Income">
                            </div>
                            
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="father_name">Father Name</label>
                                <input type="text" class="form-control" id="father_name" value="{{ $member->father_name }}" name="father_name" placeholder="Enter Father Name">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="mother_name">Mother Name</label>
                                <input type="text" class="form-control" id="mother_name" value="{{ $member->mother_name }}" name="mother_name" placeholder="Enter Mother Name">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="husbandWife_name">Husband/Wife Name</label>
                                <input type="text" class="form-control" id="husbandWife_name" value="{{ $member->husbandWife_name }}" name="husbandWife_name" placeholder="Enter Husband/Wife Name">
                            </div>
                            
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="mobile">Mobile Number <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="mobile" value="{{ $member->mobile }}" name="mobile" placeholder="Enter Mobile Number" required>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" value="{{ $member->email }}" name="email" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="marital_status">Marital Status</label>
                                <select name="marital_status" id="marital_status" class="form-control" >
                                    <option value="">Select Marital Status</option>
                                    <option value="Married"{{$member->marital_status=='Married'?'selected':''}}>Married</option>
                                    <option value="Seperated"{{$member->marital_status=='Seperated'?'selected':''}}>Seperated</option>
                                    <option value="Divorced"{{$member->marital_status=='Divorced'?'selected':''}}>Divorced</option>
                                    <option value="Widowed"{{$member->marital_status=='Widowed'?'selected':''}}>Widowed</option>
                                    <option value="Unmarried"{{$member->marital_status=='Married'?'selected':''}}>Unmarried</option>
                                    <option value="Untagged"{{$member->marital_status=='Married'?'selected':''}}>Untagged</option>
                                  
                                </select>
                            </div>
                            
                        </div>

                        <!-- <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="dob">Date Of Birth <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="dob" value="{{ $member->dob }}" name="dob" required>
                            </div>
                            
                            
                        </div> -->
                     <hr>
                        <h4 class="header-title" style="text-align:center;">Member's Correspondence Address</h4>     

                        <div class="form-row">

                            <div class="form-group col-md-4 ">
                                <label for="address">Address <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <textarea id="summernote" name="address" class="form-control" placeholder="Enter Address">{{ $member->address }}</textarea> 
                               
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="ward">Ward</label>
                                <input type="text" class="form-control" id="ward" value="{{ $member->ward }}" name="ward" placeholder="Enter Ward">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="area">Area</label>
                                <input type="text" class="form-control" id="area" value="{{ $member->area }}" name="area" placeholder="Enter Area">
                            </div>
                        
                        </div>

                    <div class="form-row">
                       
                       <div class="form-group col-md-4 ">
                           <label for="landmark">Landmark</label>
                           <input type="text" class="form-control" id="landmark" value="{{ $member->landmark }}" name="landmark" placeholder="Enter Landmark">
                       </div>
                       <div class="form-group col-md-4 ">
                           <label for="dist">City/District</label>
                           <input type="text" class="form-control" id="dist" name="dist" value="{{ $member->dist }}" placeholder="Enter City/District">
                       </div>
                       <div class="form-group col-md-4">
                                <label for="state">State <span style="color:red; font-size: 18px;line-height:1">*</span></label> 
                               
                                <select name="state" id="state" class="form-control" required>
                                    <option value="Andhra Pradesh"{{$member->state=='Andhra Pradesh'?'selected':''}}>Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh"{{$member->state=='Arunachal Pradesh'?'selected':''}}>Arunachal Pradesh</option>
                                    <option value="Assam"{{$member->state=='Assam'?'selected':''}}>Assam</option>
                                    <option value="Bihar"{{$member->state=='Bihar'?'selected':''}}>Bihar</option>
                                    <option value="Chhattisgarh"{{$member->state=='Chhattisgarh'?'selected':''}}>Chhattisgarh</option>
                                    <option value="Goa"{{$member->state=='Goa'?'selected':''}}>Goa</option>
                                    <option value="Gujarat"{{$member->state=='Gujarat'?'selected':''}}>Gujarat</option>
                                    <option value="Haryana"{{$member->state=='Haryana'?'selected':''}}>Haryana</option>
                                    <option value="Himachal Pradesh"{{$member->state=='Himachal Pradesh'?'selected':''}}>Himachal Pradesh</option>
                                    <option value="Jharkhand"{{$member->state=='Jharkhand'?'selected':''}}>Jharkhand</option>
                                    <option value="Karnataka"{{$member->state=='Karnataka'?'selected':''}}>Karnataka</option>
                                    <option value="Kerala"{{$member->state=='Kerala'?'selected':''}}>Kerala</option>
                                    <option value="Madhya Pradesh"{{$member->state=='Madhya Pradesh'?'selected':''}}>Madhya Pradesh</option>
                                    <option value="Maharashtra"{{$member->state=='Maharashtra'?'selected':''}}>Maharashtra</option>
                                    <option value="Manipur"{{$member->state=='Manipur'?'selected':''}}>Manipur</option>
                                    <option value="Meghalaya"{{$member->state=='Meghalaya'?'selected':''}}>Meghalaya</option>
                                    <option value="Mizoram"{{$member->state=='Mizoram'?'selected':''}}>Mizoram</option>
                                    <option value="Nagaland"{{$member->state=='Nagaland'?'selected':''}}>Nagaland</option>
                                    <option value="Odisha"{{$member->state=='Odisha'?'selected':''}}>Odisha</option>
                                    <option value="Punjab"{{$member->state=='Punjab'?'selected':''}}>Punjab</option>
                                    <option value="Rajasthan"{{$member->state=='Rajasthan'?'selected':''}}>Rajasthan</option>
                                    <option value="Sikkim"{{$member->state=='Sikkim'?'selected':''}}>Sikkim</option>
                                    <option value="Tamil Nadu"{{$member->state=='Tamil Nadu'?'selected':''}}>Tamil Nadu</option>
                                    <option value="Telangana"{{$member->state=='Telangana'?'selected':''}}>Telangana</option>
                                    <option value="Tripura"{{$member->state=='Tripura'?'selected':''}}>Tripura</option>
                                    <option value="Uttar Pradesh"{{$member->state=='Uttar Pradesh'?'selected':''}}>Uttar Pradesh</option>
                                    <option value="Uttarakhand"{{$member->state=='Uttarakhand'?'selected':''}}>Uttarakhand</option>
                                    <option value="West Bengal"{{$member->state=='West Bengal'?'selected':''}}>West Bengal</option>
                                    <option value="Others"{{$member->state=='Others'?'selected':''}}>Others</option>
                                   
                                </select>
                            </div>
                   
                   </div>


                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="pincode">Pin Code</label>
                                <input type="text" class="form-control" id="pincode" value="{{ $member->pincode }}" name="pincode" placeholder="Enter Pincode">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="country">Country <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="country" value="{{ $member->country }}" name="country" placeholder="Enter Country" required readonly>
                            </div>

                        </div>
                    <hr>
                        <h4 class="header-title" style="text-align:center;">Member's Permanent Address</h4>  
                        <div class="form-row">
                       
                   
                            <div class="form-group col-md-4 ">
                                <label for="address">Address</label>
                                <textarea id="summernote" name="p_address" class="form-control" placeholder="Enter Address">{{ $member->p_address }}</textarea> 
                               
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="dist">City/District</label>
                                <input type="text" class="form-control" id="dist" name="p_dist" value="{{ $member->p_dist }}" placeholder="Enter City/District">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="state">State</label> 
                               
                                <select name="p_state" id="state" class="form-control" >
                                <option value="Andhra Pradesh"{{$member->p_state=='Andhra Pradesh'?'selected':''}}>Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh"{{$member->p_state=='Arunachal Pradesh'?'selected':''}}>Arunachal Pradesh</option>
                                    <option value="Assam"{{$member->p_state=='Assam'?'selected':''}}>Assam</option>
                                    <option value="Bihar"{{$member->p_state=='Bihar'?'selected':''}}>Bihar</option>
                                    <option value="Chhattisgarh"{{$member->p_state=='Chhattisgarh'?'selected':''}}>Chhattisgarh</option>
                                    <option value="Goa"{{$member->p_state=='Goa'?'selected':''}}>Goa</option>
                                    <option value="Gujarat"{{$member->p_state=='Gujarat'?'selected':''}}>Gujarat</option>
                                    <option value="Haryana"{{$member->p_state=='Haryana'?'selected':''}}>Haryana</option>
                                    <option value="Himachal Pradesh"{{$member->p_state=='Himachal Pradesh'?'selected':''}}>Himachal Pradesh</option>
                                    <option value="Jharkhand"{{$member->p_state=='Jharkhand'?'selected':''}}>Jharkhand</option>
                                    <option value="Karnataka"{{$member->p_state=='Karnataka'?'selected':''}}>Karnataka</option>
                                    <option value="Kerala"{{$member->p_state=='Kerala'?'selected':''}}>Kerala</option>
                                    <option value="Madhya Pradesh"{{$member->p_state=='Madhya Pradesh'?'selected':''}}>Madhya Pradesh</option>
                                    <option value="Maharashtra"{{$member->p_state=='Maharashtra'?'selected':''}}>Maharashtra</option>
                                    <option value="Manipur"{{$member->p_state=='Manipur'?'selected':''}}>Manipur</option>
                                    <option value="Meghalaya"{{$member->p_state=='Meghalaya'?'selected':''}}>Meghalaya</option>
                                    <option value="Mizoram"{{$member->p_state=='Mizoram'?'selected':''}}>Mizoram</option>
                                    <option value="Nagaland"{{$member->p_state=='Nagaland'?'selected':''}}>Nagaland</option>
                                    <option value="Odisha"{{$member->p_state=='Odisha'?'selected':''}}>Odisha</option>
                                    <option value="Punjab"{{$member->p_state=='Punjab'?'selected':''}}>Punjab</option>
                                    <option value="Rajasthan"{{$member->p_state=='Rajasthan'?'selected':''}}>Rajasthan</option>
                                    <option value="Sikkim"{{$member->p_state=='Sikkim'?'selected':''}}>Sikkim</option>
                                    <option value="Tamil Nadu"{{$member->p_state=='Tamil Nadu'?'selected':''}}>Tamil Nadu</option>
                                    <option value="Telangana"{{$member->p_state=='Telangana'?'selected':''}}>Telangana</option>
                                    <option value="Tripura"{{$member->p_state=='Tripura'?'selected':''}}>Tripura</option>
                                    <option value="Uttar Pradesh"{{$member->p_state=='Uttar Pradesh'?'selected':''}}>Uttar Pradesh</option>
                                    <option value="Uttarakhand"{{$member->p_state=='Uttarakhand'?'selected':''}}>Uttarakhand</option>
                                    <option value="West Bengal"{{$member->p_state=='West Bengal'?'selected':''}}>West Bengal</option>
                                    <option value="Others"{{$member->p_state=='Others'?'selected':''}}>Others</option>
                                   
                                </select>
                            </div>
                           
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="pincode">Pin Code</label>
                                <input type="text" class="form-control" id="pincode" name="p_pincode" value="{{ $member->p_pincode }}" placeholder="Enter Pincode">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="p_country" value="{{ $member->p_country }}" placeholder="Enter Country" >
                            </div>

                        </div>
                        <hr>
                        <h4 class="header-title" style="text-align:center;">Member's Address GPS Location - 
                        <a href="" class="btn btn-primary pr-4 pl-4">Get Current Location </a></h4>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="latitude">Location Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $member->latitude }}" placeholder="Enter Latitude ">
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="longitude">Location Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $member->longitude }}" placeholder="Enter Longitude">
                            </div>
                           
                        </div>
                        <hr>
                        <h4 class="header-title" style="text-align:center;">Member's KYC </h4>
                        
                        <div class="form-row">
                            <div class="form-group col-md-4 ">
                                <label for="adhar_no">Aadhar Number</label>
                                <input type="text" class="form-control" id="adhar_no" name="adhar_no" value="{{ $member->adhar_no }}" placeholder="Enter Aadhar Number">
                            </div>
                            
                            <div class="form-group col-md-4 ">
                                <label for="voter_no">Voter Id No.</label>
                                <input type="text" class="form-control" id="voter_no" name="voter_no" value="{{ $member->voter_no }}" placeholder="Enter Voter Id No.">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="pan_no">Pan No.</label>
                                <input type="text" class="form-control" id="pan_no" name="pan_no" value="{{ $member->pan_no }}" placeholder="Enter Pan No.">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4 ">
                                <label for="ration_no">Ration Card Number</label>
                                <input type="text" class="form-control" id="ration_no" name="ration_no" value="{{ $member->ration_no }}" placeholder="Enter Ration Card Number">
                            </div>
                            
                            <div class="form-group col-md-4 ">
                                <label for="meter_no">Meter No.</label>
                                <input type="text" class="form-control" id="meter_no" name="meter_no" value="{{ $member->meter_no }}" placeholder="Enter Meter No.">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="cl_no">CL No.</label>
                                <input type="text" class="form-control" id="cl_no" name="cl_no" value="{{ $member->cl_no }}" placeholder="Enter CL No.">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4 ">
                                <label for="cl_relation">CL Relation</label>
                                <input type="text" class="form-control" id="cl_relation" name="cl_relation" value="{{ $member->cl_relation }}" placeholder="Enter CL Relation">
                            </div>
                            
                            <div class="form-group col-md-4 ">
                                <label for="dl_no">DL No.</label>
                                <input type="text" class="form-control" id="dl_no" name="dl_no" value="{{ $member->dl_no }}" placeholder="Enter DL No.">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="passport_no">Passport No.</label>
                                <input type="text" class="form-control" id="passport_no" name="passport_no" value="{{ $member->passport_no }}" placeholder="Enter Passport No.">
                            </div>

                        </div>
                        <hr>
                        <h4 class="header-title" style="text-align:center;">Member's KYC Document</h4>  
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-sm-3 control-label">Photo <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                         
                                <input type="file" name="image_photo" class="GalleryImage" id="image_photo" />  
                                @if(isset($member))
                                    <img src="{{asset('/images/KYC-Member/member_photo/'.$member->image_photo)}}" width="60%" class="img-thumbnail">
                                @endif
                             </div>
                             <div class="form-group col-md-6">
                                <label class="col-sm-3 control-label">Id Proof <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                         
                                <input type="file" name="image_idproof" class="GalleryImage" id="image_idproof"  />  
                                @if(isset($member))
                                    <img src="{{asset('/images/KYC-Member/member_idProof/'.$member->image_idproof)}}" width="60%" class="img-thumbnail">
                                @endif
                             </div>  
                             
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-sm-3 control-label">Address Proof <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                         
                                <input type="file" name="image_address" class="GalleryImage" id="image_address"  />  
                                @if(isset($member))
                                    <img src="{{asset('/images/KYC-Member/member_address/'.$member->image_address)}}" width="60%" class="img-thumbnail">
                                @endif
                             </div>
                             <div class="form-group col-md-6">
                                <label class="col-sm-3 control-label">Pan Card <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                         
                                <input type="file" name="image_pan" class="GalleryImage" id="image_pan"  />  
                                @if(isset($member))
                                    <img src="{{asset('/images/KYC-Member/member_pan/'.$member->image_pan)}}" width="60%" class="img-thumbnail">
                                @endif
                             </div>  
                             
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-sm-3 control-label">Signature <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                         
                                <input type="file" name="image_signature" class="GalleryImage" id="image_signature"  />  
                                @if(isset($member))
                                    <img src="{{asset('/images/KYC-Member/member_signature/'.$member->image_signature)}}" width="60%" class="img-thumbnail">
                                @endif
                             </div>
                             
                        </div>
<hr>
                        <h4 class="header-title" style="text-align:center;">Nominee Information</h4>
                        
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label  for="nominee_name">Nominee Name</label>
                                <input type="text" class="form-control" id="nominee_name" name="nominee_name" value="{{ $member->nominee_name }}" placeholder="Enter Nominee Name">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="nominee_relation">Nominee Relation</label>
                                <input type="text" class="form-control" id="nominee_relation" name="nominee_relation" value="{{ $member->nominee_relation }}" placeholder="Enter Nominee Relation">
                            </div>
                            <div class="form-group col-md-4">
                                <label  for="nominee_mobile">Nominee Mobile No.</label>
                                <input type="text" class="form-control" id="nominee_mobile" name="nominee_mobile" value="{{ $member->nominee_mobile }}" placeholder="Enter Nominee Mobile Number">
                            </div>
                           
                        </div>

                        <div class="form-row">
                            
                            <div class="form-group col-md-4 ">
                                <label for="nominee_dob">Nominee DOB</label>
                                <input type="date" class="form-control" id="nominee_dob" name="nominee_dob" value="{{ $member->nominee_dob }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label  for="nominee_adhar">Nominee Aadhar No.</label>
                                <input type="text" class="form-control" id="nominee_adhar" name="nominee_adhar" value="{{ $member->nominee_adhar }}" placeholder="Enter Nominee Aadhar No.">
                            </div>
                            <div class="form-group col-md-4">
                                <label  for="nominee_voter">Nominee Voter ID No.</label>
                                <input type="text" class="form-control" id="nominee_voter" name="nominee_voter" value="{{ $member->nominee_voter }}" placeholder="Enter Nominee Voter ID No.">
                            </div>
                           
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label  for="nominee_pan">Nominee Pan No.</label>
                                <input type="text" class="form-control" id="nominee_pan" name="nominee_pan" value="{{ $member->nominee_pan }}" placeholder="Enter Nominee Pan No.">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="nominee_ration">Nominee Ration Card No.</label>
                                <input type="text" class="form-control" id="nominee_ration" name="nominee_ration" value="{{ $member->nominee_ration }}" placeholder="Enter Nominee Ration Card No.">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="nominee_address">Nominee Address</label>
                                <textarea id="summernote" name="nominee_address" class="form-control"  placeholder="Enter Nominee Address">{{ $member->nominee_address }}</textarea> 
                               
                            </div>
                           
                        </div>

                        <!-- <h4 class="header-title" style="text-align:center;">Extra Settings</h4>
                        <label  for="sms">SMS</label>
                        <div class="form-group row">
                      
                            <label class="switch">
                                <input class="switch-input" type="checkbox" />
                                <span class="switch-label" data-on="On" data-off="Off"></span> 
                                <span class="switch-handle"></span> 
                            </label>  
                        </div> -->

                        <hr>    
                        <h4 class="header-title"  style="text-align:center;">Bank Details</h4>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label  for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ $member->bank_name }}" placeholder="Enter Bank Name">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="bank_branch">Bank Branch</label>
                                <input type="text" class="form-control" id="bank_branch" name="bank_branch" value="{{ $member->bank_branch }}" placeholder="Enter Bank Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label  for="account_no">Account No.</label>
                                <input type="text" class="form-control" id="account_no" name="account_no" value="{{ $member->account_no }}" placeholder="Enter Account Number">
                            </div>
                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label  for="ifsc_code">IFSC Code</label>
                                <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" value="{{ $member->ifsc_code }}" placeholder="Enter IFSC Code">
                            </div>
                            
                           
                        </div>
                        <div style="text-align:center;">
                        
                        <button type="submit" class="btn btn-primary  pr-4 pl-4"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Update Member</button>
                        <a class="btn btn-danger" href="{{route('admin.members_management.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />

<script src="jquery.js"></script>
<script src="parsley.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('#form').parsley();
    })
</script>

<script>
 
</script>
@endsection