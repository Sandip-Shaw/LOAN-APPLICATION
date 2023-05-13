
@extends('backend.layouts.master')

@section('title')
Hr Management - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection
<style>
    .editBtn{
        position: absolute;
        top: 10px;
        right: 100px;
        z-index: 100;
    } 
 </style>

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Hr Management</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.hr_management.index') }}">Employee List</a></li>

                    <li><span>  {{$hrmanagement->emp_code}}</span></li>
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
        
        <div class="col-md-8">
            <div class="box">
                <div class="box-body">
                    <!-- <h4 class="header-title float-left">Blogs List</h4> -->
                    <!-- <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.company.create') }}">Create New Profile</a>
                    </p> -->
                    <!-- <div class="pull-right editBtn">
                    <a class="btn btn-default btn-xs" onclick="block_ui()" href="">
                        <i class="fa fa-pencil"></i></a>
                    </div> -->
                 
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class=col-md-11>
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-details">
                            <tbody>
             
                                <tr>
                                    <td class="ft-600" style="width: 250px;"> <b>Employee Code</b></td>
                                    <td> 
                               {{$hrmanagement->emp_code}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Employee Name</b></td>
                                    <td> 
                                    {{$hrmanagement->name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Designation</b></td>
                                    <td> 
                                    {{$hrmanagement->designationdet->designation_name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Branch</b></td>
                                    <td> 
                                    {{$hrmanagement->branchdetails->branch_name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Date of Birth</b> </td>
                                    <td> 
                                    {{ Carbon\Carbon::parse($hrmanagement->dob)->format('d-m-Y') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Date of Joining</b></td>
                                    <td> 
                                    {{ Carbon\Carbon::parse($hrmanagement->dateofjoining)->format('d-m-Y') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Email</b></td>
                                    <td> 
                                    {{$hrmanagement->email}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Mobile Number</b></td>
                                    <td> 
                                    {{$hrmanagement->mobile}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Address</b></td>
                                    <td> 
                                    {{$hrmanagement->address}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Father's Name</b></td>
                                    <td> 
                                    {{$hrmanagement->fathername}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Bank Name</b></td>
                                    <td> 
                                    {{$hrmanagement->bank_name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Bank Account Number</b></td>
                                    <td> 
                                    {{$hrmanagement->account_no}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>IFSC Code</b></td>
                                    <td> 
                                    {{$hrmanagement->ifsc_code}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Bank Branch Name</b></td>
                                    <td> 
                                    {{$hrmanagement->bank_branch_name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Blood Group</b></td>
                                    <td> 
                                    {{$hrmanagement->blood_group}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b>Monthly Salary</b></td>
                                    <td> 
                                    {{$hrmanagement->monthlysalary}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-200" style="width: 250px;"><b>Member Code</b></td>
                                    <td> 
                                    {{$hrmanagement->memberallDet->member_id_code}}- {{$hrmanagement->memberallDet->first_name}}
                                
                                    </td>
                                
                                </tr>

                                <!-- <tr>
                                    <td class="ft-600" style="width: 250px;">Image</td>
                                    <td> 
                                    @if(isset($hrmanagement))
                                    <img src="{{asset('/images/employeeImage/'.$hrmanagement->image)}}" width="60%" class="img-thumbnail" height="250">
                                    @endif
                                    </td>
                                </tr> -->

                        
                            </tbody>
                            
                        </table>
                     
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->

        <div class="col-md-6">
          
            <div id="accordion">
                <div class="card" style="width:100%; margin-top: 5px">
                <div class="card-header" style="background-color: dodgerblue;">
                    <a class="card-link" style="color: #fff" data-toggle="collapse" href="#collapseOne">
                  Employee KYC Info
                    </a>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                    <table id="dataTable" class="table table-details">
                    <tbody>
                        <tr>
                            <td class="ft-100" style="width: 150px;"><b>Aadhar Number</b></td>
                            <td> 
                            {{$hrmanagement->adhar_no}}
                    
                            </td>
                           
                        </tr>
                        <tr>
                            <td class="ft-200" style="width: 250px;"><b>Voter Id Number</b></td>
                            <td> 
                            {{$hrmanagement->voter_no}}
                        

                            </td>
                          
                        </tr>
                        <tr>
                            <td class="ft-200" style="width: 250px;"><b>Pan Number</b></td>
                            <td> 
                            {{$hrmanagement->pan_no}}
                        
                            </td>
                           
                        </tr>
                        
                       
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        </div>


        <div class="col-md-6">

        <div id="accordion">
                <div class="card" style="width:100%; margin-top: 5px">
                <div class="card-header" style="background-color: dodgerblue;">
                    <a class="card-link" style="color: #fff" data-toggle="collapse" href="#collapseTwo">
                  Employee KYC Photo
                    </a>
                </div>
                <div id="collapseTwo" class="collapse show " data-parent="#accordion">
                    <div class="card-body">
                    <table id="dataTable" class="table table-details">
                    <tbody>
                        <tr>
                            <td class="ft-100" style="width: 150px;"><b>Employee Image</b></td>
                            <td> 
                            @if(isset($hrmanagement))
                                    <img src="{{asset('/images/KYC-Member/member_photo/'.$hrmanagement->image)}}" width="60%" class="doc-img">
                            @endif
                    
                            </td>
                           
                        </tr>
                        <tr>
                            <td class="ft-200" style="width: 250px;"><b>Employee Signature</b></td>
                            <td> 
                            
                            @if(isset($hrmanagement))
                                    <img src="{{asset('/images/KYC-Member/member_signature/'.$hrmanagement->emp_image_sign)}}" width="60%" class="doc-img">
                            @endif

                            </td>
                          
                        </tr>
                        <tr>
                            <td class="ft-200" style="width: 250px;"><b>Pan Image</b></td>
                            <td> 
                            @if(isset($hrmanagement))
                                    <img src="{{asset('/images/KYC-Member/member_pan/'.$hrmanagement->emp_pan)}}" width="60%" class="doc-img">
                            @endif
                        
                            </td>
                           
                        </tr>
                        <tr>
                            <td class="ft-200" style="width: 250px;"><b>Id Proof Image</b></td>
                            <td> 
                            @if(isset($hrmanagement))
                                    <img src="{{asset('/images/KYC-Member/member_idProof/'.$hrmanagement->emp_idproof)}}" width="60%" class="doc-img">
                            @endif
                        
                            </td>
                           
                        </tr>
                       
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        </div>


        
    </div>
</div>
@endsection


@section('scripts')
     <!-- Start datatable js -->
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     
     <script>
         /*================================
        datatable active
        ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }

     </script>
@endsection