
@extends('backend.layouts.master')

@section('title')
HR Management Create - Admin Panel
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
                <h4 class="page-title pull-left">Employee</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Create Employees </span></li>
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
                    <!-- <h4 class="header-title"> Create Employees </h4> -->
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.hr_management.store') }}" method="POST" id="form" enctype="multipart/form-data" data-parsley-validate>
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="branch">Branch <span style="color:red; font-size: 18px;line-height:1">*</span></label> 
                               
                                <select name="branch" id="branch" class="form-control" required>
                                    <option value="">Choose Branch</option>
                                    @foreach($branches as $key=>$branch)
                                    <option value="{{$branch}}">{{$key}}</option>
                                   
                                   @endforeach
                                   
                                   
                                </select>
                            </div>
                           
                            <div class="form-group col-md-6">
                                <label for="dateofjoining">Joining Date <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="dateofjoining" name="dateofjoining" required>
                            </div>

                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="designation">Designation</label>
                                <!-- <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Employee Designation"> -->
                                <select name="designation" id="designation" class="form-control" required>
                                    <option value="">Choose designation</option>
                                    @foreach($design as $key=>$designation)
                                    <option value="{{$designation}}">{{$key}}</option>
                                   
                                   @endforeach
                                   
                                   
                                </select>
                            </div>
                            
                           
                        </div>
                        <hr>
                    <h4 class="header-title"> Employee Details </h4>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Employee Name <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Employee Name" required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="dob">Date of Birth <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="dob" name="dob" required>
                            </div>
                            <!-- <div class="form-group col-md-6 ">
                                <label for="emp_code">Employee Code <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="emp_code" name="emp_code" placeholder="Enter Employee Code" >
                            </div> -->
                            
                        </div>
                     
                        <div class="form-row">
                            
                           
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mobile">Mobile Number <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile no." data-parsley-maxlength="10" required>
                            </div>
                           
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 ">
                                <label for="address">Address <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <textarea id="summernote" name="address" class="form-control" placeholder="Enter Address" required></textarea> 
                               
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="fathername">Father's Name</label>
                                <input type="text" class="form-control" id="fathername" name="fathername" placeholder="Enter Father's Name">
                            </div>
                        
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 ">
                                <label for="blood_group">Blood Group</label>
                                <input type="text" class="form-control" id="blood_group" name="blood_group" placeholder="Enter Blood Group">
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="monthlysalary">Monthly Salary</label>
                                <input type="text" class="form-control" id="monthlysalary" name="monthlysalary" placeholder="Enter Monthly Salary">
                            </div> 
                            
                        </div>
                        
                        <hr>
                        <h4 class="header-title"> Bank Details </h4>

                        <div class="form-row">
                            
                            <div class="form-group col-md-6 ">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter Bank Name" >
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="account_no">Account No.</label>
                                <input type="text" class="form-control" id="account_no" name="account_no" placeholder="Enter Account No." data-parsley-maxlength="12">
                            </div>
                        </div>

                        <div class="form-row">
                            
                            <div class="form-group col-md-6 ">
                                <label for="ifsc_code">IFSC Code</label>
                                <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="Enter IFSC Code" >
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="adhar_no">Bank Branch Name</label>
                                <input type="text" class="form-control" id="bank_branch_name" name="bank_branch_name" placeholder="Enter Bank Branch Name" data-parsley-maxlength="12">
                            </div>
                        </div>
                            <hr>
                        <h4 class="header-title"> KYC Details </h4>
                        <div class="form-row">
                             <div class="form-group col-md-6 ">
                                <label for="blood_group">Member Code</label>
                                <!-- <input type="text" class="form-control" id="blood_group" name="blood_group" placeholder="Enter Blood Group"> -->
                                <select name="member" id="member" class="form-control selectpicker" data-live-search="true" required>
                                    <option value=""></option>

                                    @foreach($member as $members)
                                    <option value="{{$members->member_id}}" >{{$members->member_id_code}}-{{$members->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="form-group col-md-6 ">
                                <label for="pan_no">Voter Card Number</label>
                                <input type="text" class="form-control" id="voter_no" name="voter_no" placeholder="Enter PAN No." readonly>
                            </div>
                            
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group col-md-6 ">
                                <label for="pan_no">PAN Number</label>
                                <input type="text" class="form-control" id="pan_no" name="pan_no" placeholder="Enter PAN No." readonly>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="adhar_no">Adhar Number</label>
                                <input type="text" class="form-control" id="adhar_no" name="adhar_no" placeholder="Enter Adhar No." readonly>
                            </div>
                        </div>
                       
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="col-sm-3 control-label">Employee Image</label>
                         
                                <div id="image1">
                                <input type="hidden" name="emp_image" class="GalleryImage" id="emp_image"  />  

                                </div>
                             </div> 
                             <div class="form-group col-md-6">
                                <!-- <label class="col-sm-3 control-label">Employee Signature</label> -->
                         
                                
                                <input type="hidden" name="emp_image_sign" class="GalleryImage" id="emp_image_sign"  />  
                                <input type="hidden" name="emp_pan" class="GalleryImage" id="emp_pan"  />  
                                <input type="hidden" name="emp_idproof" class="GalleryImage" id="emp_idproof"  />  
                                <!-- <input type="text" name="emp_voter" class="GalleryImage" id="emp_voter"  />   -->

                            
                             </div>  
                            
                        </div>
                   

                                           
                        <div style="text-align:center;">
                        <button type="submit"  class="btn btn-primary  pr-4 pl-4"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;Create Employee</button>
                        <a class="btn btn-danger" href="{{route('admin.hr_management.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
                        <button type="reset" class="btn btn-warning  pr-4 pl-4"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Clear </button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />


<!-- <script src="jquery.js"></script> -->
<script src="parsley.min.js"></script>

<script>
    // $(document).ready(function() {
        // $('.select2').select2();
        $(function() {
         $('.selectpicker').selectpicker();
        });
    // })
</script>

<script>
//   $('#form').parsley();
</script>
<script>
$(document).ready(function(){
        $("#member").change(function(){
            var id=$(this).find(":selected").val();
          

            $.ajax({
                type:"GET",
                url:"../member_details/"+id,
                success:function(res){ 
                    console.log(res);       
                if(res){
                    const obj = JSON.parse(res);

                    var img = '{{asset('/images/KYC-Member/member_photo/')}}/'+obj.image_photo;
                    var img2 = '{{asset('images/KYC-Member/member_signature/')}}/'+obj.image_signature;

                    document.getElementById("voter_no").value = obj.voter_no;

                    document.getElementById("pan_no").value = obj.pan_no;
                    document.getElementById("adhar_no").value = obj.adhar_no;
                    // document.getElementById("image1").innerHTML = obj.image_photo;

                    const imagediv=document.getElementById("image1");
                    const imagetag= document.createElement("img") ;
                    // imagediv.removeChild(imagetag);
                    imagetag.setAttribute("src", img);
                    imagetag.setAttribute("height","200");
                    imagetag.setAttribute("width","200");
                    imagediv.appendChild(imagetag);

                    document.getElementById("emp_image").value = obj.image_photo;

                    document.getElementById("emp_image_sign").value = obj.image_signature;
                    document.getElementById("emp_pan").value = obj.image_pan;
                    document.getElementById("emp_idproof").value = obj.image_idproof;
                    // document.getElementById("emp_voter").value = obj.image_signature;
                   
                    // const imagediv1=document.getElementById("image2");
                    // const imagetag1= document.createElement("img2") ;
                    // imagetag1.setAttribute("src", img2);
                    // imagetag1.setAttribute("height","200");
                    // imagetag1.setAttribute("width","200");

                    // imagediv1.appendChild(imagetag1);
                    // document.getElementById("emp_image_sign").value = obj.image_signature;

                    // console.log(imagetag1);

                    //  console.log(img2);

                }
            }
        })
    })
})

</script>
@endsection