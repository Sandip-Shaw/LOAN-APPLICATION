
@extends('backend.layouts.master')

@section('title')
Branch Create - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Company Branch</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Company Branch</span></li>
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
                    <h4 class="header-title"> Create Company's Branch </h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.comp_branch.store') }}" method="POST" id="form"  data-parsley-validate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="branch_name">Branch Name<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Enter Branch Name" required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="branch_code">Branch Code<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="branch_code" name="branch_code" placeholder="Enter Branch Code" required>
                            </div>
                           
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="open_date">Opening Date<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="open_date" name="open_date" required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="ifsc_code">Zone</label>
                                <input type="text" class="form-control" id="zone" name="zone" placeholder="Enter Area Zone">
                            </div>
                            
                        </div>
                     

                        <div class="form-row">
                            <div class="form-group col-md-6 ">
                                <label for="address">Address<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <textarea id="summernote" name="address" class="form-control" placeholder="Enter Address"required></textarea> 
                               
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="name">City<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required>
                            </div>
                        
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="state">State<span style="color:red; font-size: 18px;line-height:1">*</span></label> 
                               
                                <select name="state" id="state" class="form-control" required>
                                    <option value="">Choose your state</option>

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
                           
                            <div class="form-group col-md-6">
                                <label for="pincode">Pin Code<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode" required>
                            </div>

                        </div>


                        <div class="form-row">
                            
                            <div class="form-group col-md-6">
                                <label for="country">Country<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="country" name="country" value="INDIA" readonly>
                            </div>
                           
                           
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contact_no">Contact Number</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter Contact Number">
                            </div>
                           
                        </div>

                                           
                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-success pr-4 pl-4"><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;Create Branch</button>
                        <a class="btn btn-danger" href="{{route('admin.comp_branch.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
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
    })
</script>

<script>
  $('#form').parsley();
</script>
@endsection