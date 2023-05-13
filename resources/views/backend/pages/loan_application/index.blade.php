
@extends('backend.layouts.master')

@section('title')
Loan Management - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection
<style>
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
        /* search bar */
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
        /* border-right: 1px solid black; */
        /* border-bottom: 1px solid black; */
        border-top: 2px solid #8914fe;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);
      }
      .toggle-text{
        position: relative;
        animation-name: up-down;
        animation-duration: 1s;
        animation-iteration-count: infinite;
        animation-timing-function: ease-in-out;
        font-size: 4rem;
        color: #8914fe;
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

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Loan Application</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Applications</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->
<!-- <div class="row">
    <div class="col-xs-12">
        <div class="box collapse-box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Search Box
                </h3>

            </div>
            
        </div>
    </div>

</div> -->
<div class="main-content-inner">
    <div class="row">
<!-- search -->
<div class="col-12 mt-5">


<div class="card">
    <div class="card-body card-b">
        <div class='d-flex justify-content-between align-items-center'>
          <h4 class="header-title">Search loan application</h4>
          <div class="toggle">
            <h4 class='toggle-text'>+</h4>
          </div>
        </div>

            <div class="form-row d-none">
                <div class="form-group col-md-3">
                    <label for="search_by_branch"><b>Branch:</b></label>
                    <select name="search_by_branch" id="search_by_branch" class="form-control">
                        <option value="">Select One</option>
                        @foreach($branch as $key=>$search_by_branch)
                        
                            <option value="{{$search_by_branch}}">{{$key}}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label  for="search_by_associate"><b>Employee:</b></label>
                    <!-- <input type="text" class="form-control" id="search_by_associate" name="search_by_associate" > -->
                    <select name="search_by_associate" id="search_by_associate" class="form-control" >
                                <option value="">Select Associate</option>

                                @foreach($hrmanagements as $key=>$search_by_associate)
                        
                                    <option value="{{$search_by_associate}}">{{$key}}</option>
                                @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label  for="search_by_phone_no"><b>Mobile No:</b></label>
                    <input type="text" class="form-control" id="search_by_phone_no" name="search_by_phone_no" placeholder="Search Phone No">
                </div>
                <div class="form-group col-md-3">
                    <label  for="search_by_member_code">Member Code:</label>
                    <input type="text" class="form-control" id="search_by_member_code" name="search_by_member_code" placeholder="Search Member Code">
                 </div>
                 
            </div>
            
            <div class="form-row d-none">
                <div class="form-group col-md-3">
                    <label  for="search_by_member_name">Member Name:</label>
                    <input type="text" class="form-control" id="search_by_member_name" name="search_by_member_name" placeholder="Search Member Name">
                 </div>
                <div class="form-group col-md-3">
                    <label  for="search_by_application"><b>Application No:</b></label>
                    <input type="text" class="form-control" id="search_by_application" name="search_by_application" placeholder="Search Application No">
                </div>
                <div class="form-group col-md-3">
                    <label  for="search_by_application_date"><b>Application Date:</b></label>
                    <input type="date" class="form-control" id="search_by_application_date" name="search_by_application_date" >
                </div>
                
                <div class=" col-md-3 pt-4 pl-3">
                <button id="appication_search" class="btn btn-primary pr-4 pl-4"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                <a class="btn btn-danger" href="{{route('admin.loan_application.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Clear</a>
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
</div>
            

        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card" style="border-top: 2px solid #8914fe; padding-top: 1.5rem; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <h4 class="header-title float-left">Applicant's List</h4>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.loan_application.create') }}">Create Loan Application</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   
                                    <th width="15%">Associate</th>
                                    <th width="10%">Application No.</th>
                                    <th width="10%">Application Date</th>
                                    <th width="20%">Member</th>
                                    <th width="10%">Branch</th>
                                    <th width="10%">Scheme</th>
                                    <th width="10%">Principal Amt.</th>
                                    <th width="10%">Status</th>
                                   
                                    <th width="05%">Actions</th>


                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($applications as $application)
                                <tr>  
                                    <td>@isset($application->employee_name)
                                        {{ $application->employee_name }}
                                        @else

                                        @endisset
                                    </td>
                                    <td>{{ $application->loanApplication_id  }}</td>
                                    <td>{{ $application->application_date }} </td>
                                    <td>{{ $application->first_name }} </td>
                                    <td>{{ $application->branch_name }} </td>
                                    <td>{{ $application->loanSchema->schema_name }} </td>
                                
                                    <td>{{ $application->amt_approved }} </td>

                                    <td>{{ $application->status }} </td>
 
                                    <td>
                                     
                                            <!-- <a class="btn btn-success text-white" href="">Edit</a> -->
                                            <a class="btn" data-toggle="tooltip" href="{{ route('admin.loan_application.show',$application->loanApplication_id) }}"><i class="fa fa-eye"></i></a> 

                                            
                                            @if($application->status == "RequestForApproval")
                                            <a class="btn" data-toggle="tooltip" href="{{ route('admin.loan_application.edit',$application->loanApplication_id) }}"><i class="fa fa-pencil-square-o"></i></a>
                                            
                                            @else

                                            
                                          @endif
                                     
                                      
                                     
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

<!-- loader -->
            <div class="loader-div">
                 <img class="loader-img" src="{{asset('backend/assets/images/loader.gif')}}" style="height: 50%;width: auto;" />
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
 
    $("#appication_search").click(function(){
       var loader = $(".loader-div").show(); // show loader
        var branch=$("#search_by_branch").find(":selected").val();
        var associate=$("#search_by_associate").find(":selected").val();
        var phone_no=$("#search_by_phone_no").val();
        var member_code=$("#search_by_member_code").val();
        var member_name=$("#search_by_member_name").val();
        var application=$("#search_by_application").val();
        var application_date=$("#search_by_application_date").val();

        console.log(loader);
        // console.log(associate);
        // console.log(phone_no);
        // console.log(member_code);
        // console.log(member_name);
        // console.log(application);
        // console.log(application_date);

        var check_selected_field = 0;
        var check_branch_field = 0;

        if(branch != null && branch != '' && branch != ' '){
            check_branch_field=1;
        }

        if(associate != null && associate != '' && associate != ' '){
            check_selected_field++;
        }
        if(phone_no != null && phone_no != '' && phone_no != ' '){
         
            check_selected_field++;
        }
        if(member_code != null && member_code != '' && member_code != ' '){
         
            check_selected_field++;

        }
        if(member_name != null && member_name != '' && member_name != ' '){
        
            check_selected_field++;

        }
        if(application != null && application != '' && application != ' '){
         
            check_selected_field++;

        }
        if(application_date != null && application_date != '' && application_date != ' '){
           
            check_selected_field++;

        }

        if(check_branch_field==1 && check_selected_field>0){
            
             var new_url = "{{route('admin.loan_application.index')}}"+"?branch="+branch+"&associate="+associate+"&phone_no="+phone_no+"&member_code="+member_code+"&member_name="+member_name+"&application="+application+"&application_date="+application_date;
            //  $(".loader-div").hide(); // hide loader
             window.location = new_url;

        }
        else{

            if(check_branch_field!=1){
                alert("Please select a branch");
            }
            else{
                alert("Select any one field");
            }
        }

    });

});
</script>
@endsection