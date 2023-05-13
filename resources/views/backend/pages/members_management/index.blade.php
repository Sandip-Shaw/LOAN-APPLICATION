
@extends('backend.layouts.master')

@section('title')
Member Management - Admin Panel

@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Member Management</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Members</span></li>
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

    <div class="col-12 mt-5">
    <style>
      .toggle{
        cursor:pointer;
      }
      .d-none{
        display: none;
      }
      .card-body{
        padding:  0.2rem 1rem 0.2rem 1rem !important;
       
      }
      .card-b{
        border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);
      }
      .toggle-text{
        position: relative;
        animation-name: up-down;
        animation-duration: 1s;
        animation-iteration-count: infinite;
        animation-timing-function: ease-in-out;
        font-size: 4rem;
        color: #286090;
      }

      @keyframes up-down {
         0% {
           transform: translateY(0);
         }
         50% {
           transform: translateY(-5px);
         }
         100% {
           transform: translateY(0);
         }
       }
    </style>
    <div class="card">
        <div class="card-body card-b">
            <div class='d-flex justify-content-between align-items-center click-box'>
              <h4 class="header-title">Search member box</h4>

              <div class="toggle">
                <h4 class='toggle-text'>+</h4>
              </div>
            </div>

                <div class="form-row d-none">
                    <div class="form-group col-md-3">
                        <label for="search_by_branch"><b>Branch:</b></label>
                        <select name="search_by_branch" id="search_by_branch" class="form-control">
                            <option value="">ALL</option>
                            @foreach($branch as $key=>$search_by_branch)

                                <option value="{{$search_by_branch}}">{{$key}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label  for="search_by_date"><b>Date:</b></label>
                        <input type="date" class="form-control" id="search_by_date" name="search_by_date" >
                    </div>
                    <div class="form-group col-md-3">
                        <label  for="search_by_phone_no"><b>Phone No:</b></label>
                        <input type="text" class="form-control" id="search_by_phone_no" name="search_by_phone_no" placeholder="Search Phone No">
                    </div>

                    <!-- <div class="form-group col-md-3">
                        <label  for="search_by_member_name">Member Name:</label>
                        <input type="text" class="form-control" id="search_by_member_name" name="search_by_member_name" placeholder="Search Member Name">
                    </div> -->
                    <div class=" col-md-3 pt-4 pl-3">
                       <button id="member_search" class="btn btn-primary pr-4 pl-4"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                       <a class="btn btn-danger" href="{{route('admin.members_management.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Clear</a>
                    </div>

                </div>


             <script>
              const toggleButton = document.querySelector('.toggle');
              const formRows = document.querySelectorAll('.form-row');
             

              toggleButton.addEventListener('click', function() {
                // toggle the visibility of the form-row divs
                formRows.forEach(row => {
                  row.classList.toggle('d-none');
                });

                // toggle the text content of the toggle button
                const toggleText = document.querySelector('.toggle-text');
                toggleText.textContent = toggleText.textContent === '-' ? '+' : '-';
              });

            </script>


        </div>
    </div>
    </div>


        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07); padding-top: 2rem;">
                <div class="card-body">
                    <h4 class="header-title float-left">Member's List</h4>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.members_management.create') }}">Create New Member</a>
                    </p>

                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>

                                    <th width="05%">Member Code</th>
                                    <th width="10%">Branch</th>
                                    <th width="10%">Name</th>

                                    <th width="10%">Senior Citizen</th>
                                    <th width="10%">Enroll Date</th>
                                    <th width="10%">Aadhar No.</th>
                                    <th width="10%">Pan No.</th>

                                    <th width="05%">KYC Status</th>
                                    <th width="10%">Mobile No.</th>
                                    <th width="05%">Status</th>
                                    <th width="05%">Actions</th>


                                </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach ($member as $members)
                               <tr>
                                    <td>{{ $members->member_id_code }}</td>

                                    <td>{{ $members->branchdet->branch_name }}</td>


                                    <td>{{ $members->first_name }}</td>

                                    <td>
                                        @php
                                        $birthday = $members->dob;
                                        $age = Carbon\Carbon::parse($birthday)->diff(Carbon\Carbon::now())->format('%y years');
                                        if($age>=60){
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                         @endphp
                                    </td>
                                    <td>{{ $members->emr_date }} </td>
                                    <td>{{ $members->adhar_no }} </td>
                                    <td>{{ $members->pan_no }} </td>

                                    <td>
                                         @php
                                            if($members->kyc_status==0){
                                                echo "Pending" ;
                                                }elseif($members->kyc_status==-1){
                                                echo  "Failed";
                                                }else{
                                                echo  "Full KYC";
                                            }
                                            @endphp
                                    </td>
                                    <td>{{ $members->mobile }} </td>

                                    <td>{{ $members->status }} </td>

                                    <td>

                                            <a class="btn btn-success text-white" href="{{ route('admin.members_management.edit',$members->member_id) }}">Edit</a>
                                            <a class="btn btn-primary text-white" href="{{ route('admin.members_management.show',$members->member_id) }}">Show</a>




                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->

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
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
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
<script>
$(document).ready(function(){

    $("#member_search").click(function(){

        var branch=$("#search_by_branch").find(":selected").val();

        var search_by_date=$("#search_by_date").val();
        var search_by_phone_no=$("#search_by_phone_no").val();
        console.log(branch);
        console.log(search_by_date);
        console.log(search_by_phone_no);
        var new_url = "{{route('admin.members_management.index')}}"+"?branch="+branch+"&date="+search_by_date+"&phoneNo="+search_by_phone_no;
        window.location = new_url;


    });

});



</script>


@endsection
