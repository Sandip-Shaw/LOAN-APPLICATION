
@extends('backend.layouts.master')

@section('title')
Member - Admin Panel
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
        top: 7px;
        right: 22px;
        z-index: 100;
    }
    .doc-img{
        padding: 0.25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        max-width: 100%;
        height: auto;
        object-fit: cover;
        object-position: top;
        cursor: pointer;
}
#Fullscreen {
  width: 100%;
  display: none;
  position:fixed;
  top:0;
  right:0;
  bottom:0;
  left:0;
  background: transparent url('../Images/bgTile_black50.png') repeat;
}
#Fullscreen::before{
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100vw;
  background-color: #00000090;
  z-index: -1;
}
#Fullscreen img {
  display: block;
    height: 90vh;
    width: 50vw;
    object-fit: contain;
    object-position: center;
    margin: auto;
    transform: translate(0%, 6%);
}
#Fullscreen h1{
  line-height: 1.4;
  font-size: 38px;
  position: absolute;
  top: 15px;
  right: 15%;
  cursor: pointer;
  border: 2px solid #333;
  height: 54px;
  width: 54px;
  text-align: center;
  font-weight: 600;
  background: #333;
  color: #fff;
  border-radius: 6px;
}
.cln{color: #fff; padding: 0.75rem 1.25rem; display: flex; width: 100%;}
.cheader{
    padding: 0 !important;
}
 </style>

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Member's Management</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.members_management.index') }}">Members</a></li>

                    <li><span>{{$member->first_name}}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner" style="margin-top: 10px">
    <div class="row">
        <!-- data table start -->
        
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <!-- <h4 class="header-title float-left">Blogs List</h4> -->
                    <!-- <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.company.create') }}">Create New Profile</a>
                    </p> -->
                    
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class=col-md-11>
                            <div class="pull-right editBtn">
                            <a class="btn btn-default btn-xs" onclick="block_ui()" href="{{ route('admin.members_management.edit',$member->member_id) }}">
                                <i class="fa fa-pencil"></i></a>
                            </div>
                            @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-details" style=" margin-top: 0 !important; background: #fff;">
                            <tbody>
             
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"> Status</td>
                                    <td> 
                                    {{$member->status}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"> Branch</td>
                                    <td> 
                                    {{$member->branchdet->branch_name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Associate/Advisor/Staff</td>
                                    <td>@isset($member->associatedet->name) 
                                    {{$member->associatedet->name}}
                                    @else

                                    @endisset
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Enrollment Date</td>
                                    <td> 
                                    {{ Carbon\Carbon::parse($member->emr_date)->format('d-m-Y') }}
                                    
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Name </td>
                                    <td> 
                                    {{$member->first_name}}
                                    
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">DOB</td>
                                    <td> 
                                   
                                    {{ Carbon\Carbon::parse($member->dob)->format('d-m-Y') }}

                                    </td>
                                </tr>

                      

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Age</td>
                                    <td> 
                                    @php
                                        $birthday = $member->dob;
                                        $age = Carbon\Carbon::parse($birthday)->diff(Carbon\Carbon::now())->format('%y years');
                                    @endphp

                                <p>{{$age}}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Senior Citizen</td>
                                    <td> 
                                    @php
                                        $birthday = $member->dob;
                                        $age = Carbon\Carbon::parse($birthday)->diff(Carbon\Carbon::now())->format('%y years');
                                        if($age>=60){
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    @endphp
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Gender</td>
                                    <td> 
                                    {{$member->gender}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Father Name</td>
                                    <td> 
                                    {{$member->father_name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Mother Name</td>
                                    <td> 
                                    {{$member->mother_name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Marital Status</td>
                                    <td> 
                                    {{$member->marital_status}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Qualification</td>
                                    <td> 
                                    {{$member->qualification}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Husband / Wife Name</td>
                                    <td> 
                                    {{$member->husbandWife_name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Occupation</td>
                                    <td> 
                                    {{$member->occupation}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Monthly Income</td>
                                    <td> 
                                    {{$member->monthly_income}}
                                    </td>
                                </tr>

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
                <div class="card-header cheader" style="background-color: dodgerblue;">
                    <a class="card-link cln"  data-toggle="collapse" href="#collapseOne">
                  Member KYC Info
                    </a>
                </div>
                <div id="collapseOne" class="collapse " data-parent="#accordion">
                    <div class="card-body">
                    <table id="dataTable" class="table table-details">
                    <tbody>
                        <tr>
                            <td class="ft-100 font-weight-bold" style="width: 150px;">Aadhar Number</td>
                            <td> 
                            {{$member->adhar_no}}
                            </td>
                            <td> <a class="btn btn-success text-white " href="https://uidai.gov.in/my-aadhaar/avail-aadhaar-services.html" target="_blank">Verify</a></td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Voter Id Number</td>
                            <td> 
                            {{$member->voter_no}}

                            </td>
                            <td> <a class="btn btn-success text-white " href="https://electoralsearch.in/" target="_blank">Verify</a></td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Pan Number</td>
                            <td> 
                            {{$member->pan_no}}
                            </td>
                            <td> <a class="btn btn-success text-white " href="https://www.incometaxindia.gov.in/Pages/tax-services/online-pan-verification.aspx" target="_blank">Verify</a></td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Ration Card Number</td>
                            <td> 
                            {{$member->ration_no}}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Meter Number</td>
                            <td> 
                            {{$member->meter_no}}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">CL Number</td>
                            <td> 
                            {{$member->cl_no}}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">CL Relation</td>
                            <td> 
                            {{$member->cl_relation}}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">DL Number</td>
                            <td> 
                            {{$member->dl_no}}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Passport Number</td>
                            <td> 
                            {{$member->passport_no}}
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                    </table>
                    </div>
                </div>
                </div>
                <div class="card" style="width:100%; margin-top: 5px">
                <div class="card-header cheader" style="background-color: dodgerblue;">
                    <a class="collapsed cln card-link" style="color: #fff !important" data-toggle="collapse" href="#collapseTwo">
                   Nominee Info
                </a>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                    <table id="dataTable" class="table table-details">
                    <tbody>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Nominee Name</td>
                            <td> 
                            {{$member->nominee_name}}
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Nominee Relation</td>
                            <td> 
                            {{$member->nominee_relation}}
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Nominee Phone Number</td>
                            <td> 
                            {{$member->nominee_mobile}}
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Nominee Date of Birth</td>
                            <td> 
                            {{$member->nominee_dob}}
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Nominee Aadhar Number</td>
                            <td> 
                            {{$member->nominee_adhar}}
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Nominee Voter Id Number</td>
                            <td> 
                            {{$member->nominee_voter}}
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Nominee Pan Number</td>
                            <td> 
                            {{$member->nominee_pan}}
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Nominee Ration Card Number</td>
                            <td> 
                            {{$member->nominee_ration}}
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Nominee Address</td>
                            <td> 
                            {{$member->nominee_address}}
                            
                            </td>
                        </tr>
                    </tbody>
                    </table>
                    </div>
                </div>
                </div>
                <div class="card" style="width:100%; margin-top: 5px">
                <div class="card-header cheader" style="background-color: dodgerblue;">
                    <a class="collapsed cln card-link" style="color: #fff !important" data-toggle="collapse" href="#collapseThree">
                   Member KYC Status
                    </a>
                </div>
                <div id="collapseThree" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                    <table id="dataTable" class="table table-details">
                    <tbody>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">KYC Status</td>
                            <td> 
                          
                            @php
                              if($member->kyc_status==0){
                                echo "Pending" ;
                                }elseif($member->kyc_status==-1){
                                echo  "Failed";
                                }else{
                                echo  "Full KYC";
                               }
                            @endphp
                            </td>
                        </tr>

                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Message</td>
                            <td> 
                            {{$member->kyc_message}}

                            </td>
                        </tr>
                    
                        </tbody>
                    </table>
                    <form action="{{route('admin.kyc_statusUpdate', $member->member_id)}}" method="PUT">
                    @csrf
                        <div class="form-group row">
                  
                            <label class="col-sm-4 col-form-label" for="kyc_status">KYC Status:</label>
                            <div class="col-sm-6">

                            {!!Form::select('kyc_status', array('1' => 'Full KYC', '0' => 'Pending', '-1'=>'Failed'),$member->kyc_status)!!}
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-4 col-form-label" for="message">Message:</label>
                            <div class="col-sm-6">

                             <textarea id="message" name="kyc_message" rows="4" cols="40"></textarea>
                             </div>
                        </div>
                        <div style="text-align:center;">

                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                    </div>
                </div>
                </div>

                <div class="card" style="width:100%; margin-top: 5px">
                <div class="card-header cheader" style="background-color: dodgerblue;">
                    <a class="collapsed card-link cln" style="color: #fff !important" data-toggle="collapse" href="#collapseFour">
                   Member Documents
                    </a>
                </div>
                <div id="collapseFour" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                    <table id="dataTable" class="table table-details" style="background: #fff;">
                    <tbody>
                    <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Photo</td>
                            <td> 
                            @if(isset($member))
                                    <img src="{{asset('/images/KYC-Member/member_photo/'.$member->image_photo)}}" width="60%" class="doc-img">
                            @endif
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Id Proof</td>
                            <td> 
                            @if(isset($member))
                                    <img src="{{asset('/images/KYC-Member/member_idProof/'.$member->image_idproof)}}" width="60%" class="doc-img">
                            @endif
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Address Proof</td>
                            <td> 
                            @if(isset($member))
                                    <img src="{{asset('/images/KYC-Member/member_address/'.$member->image_address)}}" width="60%" class="doc-img">
                            @endif
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Pan Card</td>
                            <td> 
                            @if(isset($member))
                                    <img src="{{asset('/images/KYC-Member/member_pan/'.$member->image_pan)}}" width="60%" class="doc-img">
                            @endif
                            
                            </td>
                        </tr>
                        <tr>
                            <td class="ft-200 font-weight-bold" style="width: 250px;">Signature</td>
                            <td> 
                            @if(isset($member))
                                    <img src="{{asset('/images/KYC-Member/member_signature/'.$member->image_signature)}}" width="60%" class="doc-img">
                            @endif
                            
                            </td>
                        </tr>
                    </tbody>
                    </table>
                    <div id="Fullscreen"><img src="" alt="" /> <h1>X</h1></div>
                    </div>
                </div>
                </div>
                <form action="{{route('cashfree.subscribe')}}" class="mt-2" method="POST">
                    @csrf
                    <input type="hidden" name="mobile" value="{{$member->mobile}}">
                    <input type="hidden" name="email" value="{{$member->email}}">
                    <label for="">Expiry Date</label><br>
                    <input class="form-control mt-2" type="datetime-local" name="date"><br>
                    <button  class="btn btn-danger mt-2">Subscribe</button>
                </form>

                
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

        $(document).ready(function(){
        //     if ($('#dataTable').length) {
        //     $('#dataTable').DataTable({
        //         responsive: true
        //     });
        // }

        $('#Fullscreen').css('height', $(document).outerWidth() + 'px');
        $('.doc-img').click(function(){
            var src = $(this).attr('src');
            $('#Fullscreen img').attr('src', src);
            $('#Fullscreen').fadeIn();
        });
        $('#Fullscreen').click(function(){
            $(this).fadeOut();
        });
        });
     </script>
@endsection