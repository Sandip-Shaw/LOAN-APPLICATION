
@extends('backend.layouts.master')

@section('title')
Members Create - Admin Panel
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

    .loader-div {
			display: none;
			position: fixed;
			margin: 0px;
			padding: 0px;
			right: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			background-color: #fff;
			z-index: 30001;
			opacity: 0.8;
		}
		.loader-img {
            width: 100%;
            height: 100%;
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
		}

</style>
@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Members Management</h4>
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
            <div class="card" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <h3 class="header-title"> Create Members </h3>
                    @include('backend.layouts.partials.messages')

                    <form action="{{ route('admin.members_management.store') }}" method="POST" id="form" enctype="multipart/form-data">
                        @csrf


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="associate">Associate/Advisor/Staff</label>
                                <select name="associate" id="associate" class="form-control" >
                                <option value="">Select Associate</option>

                                    @foreach($hrmanagements as $key=>$associate)
                                        <option value="{{$associate}}">{{$key}}</option>

                                    @endforeach


                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label  for="group">Group</label>
                                <input type="text" class="form-control" id="group" name="group" placeholder="Enter Group Name">

                            </div>


                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="branch" >Branch<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="branch" id="branch" class="form-control" required>
                                 <option value="">Please Select</option>
                                    @foreach($branches as $key=>$branch)
                                    <option value="{{$branch}}">{{$key}}</option>

                                   @endforeach

                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emr_date">Enrollment Date <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="emr_date" name="emr_date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                            </div>


                        </div>
                    <hr>
                        <h4 class="header-title" style="text-align:center;">Member's Information</h4>

                        <div class="form-row">
                        <div class="form-group col-md-6" style="display:flex">

                                <p style="padding-right: 10px;line-height: 3;"> Title <span style="color:red; font-size: 18px;line-height:1">*</span></p>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="title" value="Mr."  >
                                    <label class="form-check-label" for="title">Mr.</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="title" value="Mrs.">
                                    <label class="form-check-label" for="title">Mrs.</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="title" value="Ms.">
                                    <label class="form-check-label" for="title">Ms.</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="title" value="Md." required>
                                    <label class="form-check-label" for="title">Md.</label>
                                </div>

                            </div>
                             <div class="form-group col-md-6"style="display:flex">
                                <p style="padding-right: 10px;line-height: 3;"> Gender <span style="color:red; font-size: 18px;line-height:1">*</span></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="male" >
                                    <label class="form-check-label" for="gender">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="female" required>
                                    <label class="form-check-label" for="gender">Female</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="first_name">Full Name <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter Full Name" required>
                            </div>
                           
                            <div class="form-group col-md-4">
                                <label for="dob">Date Of Birth <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="dob" name="dob" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="qualification">Qualification</label>
                                <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Enter Qualification">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="occupation">Occupation</label>
                                <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Enter Occupation">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="monthly_income">Monthly Income</label>
                                <input type="text" class="form-control" id="monthly_income" name="monthly_income" placeholder="Enter Monthly Income">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="father_name">Father Name</label>
                                <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Enter Father Name">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="mother_name">Mother Name</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="Enter Mother Name">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="husbandWife_name">Husband/Wife Name</label>
                                <input type="text" class="form-control" id="husbandWife_name" name="husbandWife_name" placeholder="Enter Husband/Wife Name">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="mobile">Mobile Number<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number" required>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="marital_status">Marital Status</label>
                                <select name="marital_status" id="marital_status" class="form-control" >
                                    <option value="">Select Marital Status</option>
                                    <option value="Married">Married</option>
                                    <option value="Seperated">Seperated</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Unmarried">Unmarried</option>
                                    <option value="Untagged">Untagged</option>

                                </select>
                            </div>

                        </div>


                     <hr>
                        <h4 class="header-title"  style="text-align:center;">Member's Correspondence Address</h4>

                        <div class="form-row">

                            <div class="form-group col-md-4 ">
                                <label for="address">Address <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <textarea id="address1" name="address" class="form-control" placeholder="Enter Address"></textarea>

                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="ward">Ward</label>
                                <input type="text" class="form-control" id="ward" name="ward" placeholder="Enter Ward">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="area">Area</label>
                                <input type="text" class="form-control" id="area" name="area" placeholder="Enter Area">
                            </div>

                        </div>

                    <div class="form-row">

                       <div class="form-group col-md-4 ">
                           <label for="landmark">Landmark</label>
                           <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Enter Landmark">
                       </div>
                       <div class="form-group col-md-4 ">
                           <label for="dist">City/District</label>
                           <input type="text" class="form-control" id="dist" name="dist" placeholder="Enter City/District">
                       </div>
                       <div class="form-group col-md-4">
                                <label for="state">State <span style="color:red; font-size: 18px;line-height:1">*</span></label>

                                <select name="state" id="state" class="form-control" required>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Odisha">Odisha</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                    <option value="Others">Others</option>

                                </select>
                            </div>

                   </div>


                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="pincode">Pin Code</label>
                                <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="country">Country <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="country" name="country" value="INDIA" placeholder="Enter Country" required readonly>
                            </div>

                        </div>
                    <hr>
                        <h4 class="header-title"  style="text-align:center;">Member's Permanent Address</h4>
                        <div class="form-row">


                            <div class="form-group col-md-4 ">
                                <label for="address">Address</label>
                                <textarea id="address" name="p_address" class="form-control" placeholder="Enter Address"></textarea>

                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="dist">City/District</label>
                                <input type="text" class="form-control" id="dist" name="p_dist" placeholder="Enter City/District">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="state">State</label>

                                <select name="p_state" id="state" class="form-control" >
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Odisha">Odisha</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                    <option value="Others">Others</option>

                                </select>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="pincode">Pin Code</label>
                                <input type="text" class="form-control" id="pincode" name="p_pincode" placeholder="Enter Pincode">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="p_country" placeholder="Enter Country">
                            </div>

                        </div>
                        <hr>
                        <h4 class="header-title"  style="text-align:center;">Member's Address GPS Location -
                        <button type="button" id="get_location" class="btn btn-primary pr-4 pl-4">Get Current Location </button></h4>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="latitude">Location Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude ">
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="longitude">Location Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude">
                            </div>

                        </div>
                        <hr>
                        <h4 class="header-title"  style="text-align:center;">Member's KYC </h4>

                        <div class="form-row">
                            <div class="form-group col-md-4 ">
                                <label for="adhar_no">Aadhar Number</label>
                                <input type="text" class="form-control" id="adhar_no" name="adhar_no" placeholder="Enter Aadhar Number">
                                <span >Verify aadhar no, to know more <button type="button" id="click_adhar">click here</button></span>
                                <button type="button" class="btn btn-primary" id="otpButton" data-toggle="modal" data-target="#otpModal" style="display: none;">Open OTP Modal</button>
                            </div>
            <!-- loader -->
            <div class="loader-div " >
                 <img class="loader-img " src="{{asset('backend/assets/images/loader.gif')}}" style="height: 50%;width: auto;" />
            </div> 
                            
<!-- Modal dialog box -->
<!-- <div id="otp-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="otp-modal-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="otp-modal-label">Enter OTP</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="otp">OTP</label>
            <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="submit-otp">Submit</button>
        </div>
      </div>
    </div>
  </div>
   -->

                            <div class="form-group col-md-4 ">
                                <label for="voter_no">Voter Id No.</label>
                                <input type="text" class="form-control" id="voter_no" name="voter_no" placeholder="Enter Voter Id No.">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="pan_no">Pan No.</label>
                                <input type="text" class="form-control" id="pan_no" name="pan_no" placeholder="Enter Pan No.">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4 ">
                                <label for="ration_no">Ration Card Number</label>
                                <input type="text" class="form-control" id="ration_no" name="ration_no" placeholder="Enter Ration Card Number">
                            </div>

                            <div class="form-group col-md-4 ">
                                <label for="meter_no">Meter No.</label>
                                <input type="text" class="form-control" id="meter_no" name="meter_no" placeholder="Enter Meter No.">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="cl_no">CL No.</label>
                                <input type="text" class="form-control" id="cl_no" name="cl_no" placeholder="Enter CL No.">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4 ">
                                <label for="cl_relation">CL Relation</label>
                                <input type="text" class="form-control" id="cl_relation" name="cl_relation" placeholder="Enter CL Relation">
                            </div>

                            <div class="form-group col-md-4 ">
                                <label for="dl_no">DL No.</label>
                                <input type="text" class="form-control" id="dl_no" name="dl_no" placeholder="Enter DL No.">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="passport_no">Passport No.</label>
                                <input type="text" class="form-control" id="passport_no" name="passport_no" placeholder="Enter Passport No.">
                            </div>

                        </div>
                        <hr>
                        <h4 class="header-title"  style="text-align:center;">Member's KYC Document</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-sm-3 control-label">Photo <span style="color:red; font-size: 18px;line-height:1">*</span></label>


                                <input type="file" name="image_photo" class="GalleryImage" id="image_photo" required />

                             </div>
                             <div class="form-group col-md-6">
                                <label class="col-sm-3 control-label">Id Proof <span style="color:red; font-size: 18px;line-height:1">*</span></label>

                                <input type="file" name="image_idproof" class="GalleryImage" id="image_idproof" required />

                             </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-sm-3 control-label">Address Proof<span style="color:red; font-size: 18px;line-height:1">*</span></label>

                                <input type="file" name="image_address" class="GalleryImage" id="image_address" required />

                             </div>
                             <div class="form-group col-md-6">
                                <label class="col-sm-3 control-label">Pan Card <span style="color:red; font-size: 18px;line-height:1">*</span></label>

                                <input type="file" name="image_pan" class="GalleryImage" id="image_pan" required />

                             </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-sm-3 control-label">Signature <span style="color:red; font-size: 18px;line-height:1">*</span></label>

                                <input type="file" name="image_signature" class="GalleryImage" id="image_signature" required />

                             </div>

                        </div>
                        <hr>
                        <h4 class="header-title"  style="text-align:center;">Nominee Information</h4>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label  for="nominee_name">Nominee Name</label>
                                <input type="text" class="form-control" id="nominee_name" name="nominee_name" placeholder="Enter Nominee Name">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="nominee_relation">Nominee Relation</label>
                                <input type="text" class="form-control" id="nominee_relation" name="nominee_relation" placeholder="Enter Nominee Relation">
                            </div>
                            <div class="form-group col-md-4">
                                <label  for="nominee_mobile">Nominee Mobile No.</label>
                                <input type="text" class="form-control" id="nominee_mobile" name="nominee_mobile" placeholder="Enter Nominee Mobile Number">
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-4 ">
                                <label for="nominee_dob">Nominee DOB</label>
                                <input type="date" class="form-control" id="nominee_dob" name="nominee_dob">
                            </div>
                            <div class="form-group col-md-4">
                                <label  for="nominee_adhar">Nominee Aadhar No.</label>
                                <input type="text" class="form-control" id="nominee_adhar" name="nominee_adhar" placeholder="Enter Nominee Aadhar No.">
                            </div>
                            <div class="form-group col-md-4">
                                <label  for="nominee_voter">Nominee Voter ID No.</label>
                                <input type="text" class="form-control" id="nominee_voter" name="nominee_voter" placeholder="Enter Nominee Voter ID No.">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label  for="nominee_pan">Nominee Pan No.</label>
                                <input type="text" class="form-control" id="nominee_pan" name="nominee_pan" placeholder="Enter Nominee Pan No.">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="nominee_ration">Nominee Ration Card No.</label>
                                <input type="text" class="form-control" id="nominee_ration" name="nominee_ration" placeholder="Enter Nominee Ration Card No.">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="nominee_address">Nominee Address</label>
                                <textarea id="summernote" name="nominee_address" class="form-control" placeholder="Enter Nominee Address"></textarea>

                            </div>

                        </div>



                        <!-- <h4 class="header-title">Extra Settings</h4>




                        <label  for="sms">SMS</label>
                        <div class="form-group row">

                            <label class="switch">
                                <input class="switch-input" type="checkbox" />
                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>  -->
                        <hr>
                        <h4 class="header-title"  style="text-align:center;">Bank Details</h4>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label  for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter Bank Name">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="bank_branch">Bank Branch</label>
                                <input type="text" class="form-control" id="bank_branch" name="bank_branch" placeholder="Enter Bank Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label  for="account_no">Account No.</label>
                                <input type="text" class="form-control" id="account_no" name="account_no" placeholder="Enter Account Number">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label  for="ifsc_code">IFSC Code</label>
                                <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="Enter IFSC Code">
                            </div>


                        </div>
                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary  pr-4 pl-4"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;Add Member</button>
                        <a class="btn btn-danger" href="{{route('admin.members_management.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->

    </div>
</div>


<!-- HTML for modal -->
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="otpModalLabel">Enter OTP</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="otpInput" class="form-label">OTP</label>
            <input type="text" class="form-control" id="otpInput">
          </div>
          <button type="button" class="btn btn-primary" id="submitOtpBtn">Submit</button>
        </form>
      </div>
    </div>
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


<script>

    const btn = document.getElementById("get_location")

   btn.addEventListener('click', function () {

    navigator.permissions.query({
        name: 'geolocation'
    }).then(function (result) {
        if (result.state == 'granted') {
            // report(result);
            navigator.geolocation.getCurrentPosition((e) =>{

                document.getElementById("latitude").value =e.coords.latitude;
                document.getElementById("longitude").value =e.coords.longitude;
            
            })
            // geoBtn.style.display = 'none';
        } else if (result.state == 'prompt') {
           
            navigator.geolocation.getCurrentPosition((e) =>{
            document.getElementById("latitude").value =e.coords.latitude;
                document.getElementById("longitude").value =e.coords.longitude;
            })
        } else if (result.state == 'denied') {
            // report(result.state);
            // geoBtn.style.display = 'inline';
        }
        result.addEventListener('change', function () {
            // report(result.state);
        });
    });
});

</script>

 <script>

$(document).ready(function() {
    var otpModal = new bootstrap.Modal(document.getElementById("otpModal"));

    $("#click_adhar").click(function() {
        var loader = $(".loader-div").show(); // show loader
 

       var aadhar = $('#adhar_no').val();
       var regx = /^[a-zA-Z]*$/  
       if(aadhar.length != 12){
        alert("Please input correct 12 digits aadhar number");
    
       }else if(!regx.test(aadhar.value)){
        alert("Aadhar number can only contain numeric characters");
        
       }
       else{
        console.log(aadhar);

            $.ajax({
            url: "../aadharotp",
            type: 'GET',
            data: {
                aadhar:aadhar,             
            },
                success:function(response){
                 console.log(response);
                
                if (response) {
                    const obj = JSON.parse(response);

                    // console.log(obj.ref_id);
                    // console.log(obj.status);

                    if(obj.status == "SUCCESS"){
                        //console.log("checked");
                        var loader = $(".loader-div").hide(); // show loader

                        otpModal.show();

                        // Pass data to modal form
                        var otpInput = document.getElementById("otpInput");
                        otpInput.value = "";
                        otpInput.dataset.refId = obj.ref_id;

                    }

                }
                }


            });

        }
       

    });

    // JavaScript to handle OTP submission
 var submitOtpBtn = document.getElementById("submitOtpBtn");
 submitOtpBtn.addEventListener("click", function() {
  var loader = $(".loader-div").show(); // show loader

  var otpInput = document.getElementById("otpInput");
  var refId = otpInput.dataset.refId;
  var otp = otpInput.value;

  // Send OTP and refId to server using AJAX
    $.ajax({
            url: "../verifyotp",
            type: 'GET',
            data: {
                otp:otp, 
                refId:refId,           
            },
            success:function(res){
                console.log(res);
                 var loader = $(".loader-div").hide(); // show loader
            
                otpModal.hide();
                 const obj = JSON.parse(res);
                     document.getElementById("first_name").value = obj.name;
                    //  var dateStr = obj.dob; 

                    //  document.getElementById("dob").value = formatDate(dateStr);
                     document.getElementById("address1").value = obj.address;
                    //  document.getElementById("first_name").value = obj.name;
                alert("adhar verified successfully");

            }

            
    });
  
   
});

});

</script>
@endsection
