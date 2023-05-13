
@extends('backend.layouts.master')

@section('title')
Loan Approval - Admin Panel
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
</style>

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Approval - Loan Application </h4>
                <ul class="breadcrumbs pull-left"> 
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Approval's List</span></li>
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
                    <h4 class="header-title float-left">Approval's List</h4>
                    <!-- <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.loan_application.create') }}">Create Loan Application</a>
                    </p> -->
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr style="font-size: 12px;">
                                   
                                    <th width="10%">BRANCH</th>
                                    <th width="10%">MEMBER</th>
                                    <!-- <th width="10%">A/C TYPE</th> -->
                                    <th width="10%">APPLICATION NO.</th>
                                    <th width="10%">AMT. REQUESTED</th>
                                    <th width="10%">CALULATED APPROVAL</th>
                                    <th width="10%">APPROVED AMT.</th>
                                    <th width="10%">STATUS</th>
                                    <th width="10%">REMARKS</th>                                  
                                    <th width="10%">ACTION</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($applications as $application)
                                <tr>
                                    <td>{{$application->branchdetails->branch_name}}</td> 
                                    <td>{{$application->memberdetails->first_name}}</td>
                                    <!-- <td></td>  -->
                                    <td><a href="{{ route('admin.loan_application.show',$application->loanApplication_id) }}">{{$application->loanApplication_id}}</a></td>  
                                    <td>{{$application->loan_requested}}</td> 
                                    <td>{{$application->loanSchema->max_loan_amt}}</td>
                                    <td>
                                        <input type="text" name="amt_approved" id="amt_approved" class="form-control" 
                                        value="{{$application->amt_approved}}" readonly/>
                                    </td>
                                    <td>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">Choose One</option>
                                            <option value="Approved">Approved</option>
                                            <option value="NotApproved">NotApproved</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="remarks" id="remarks" class="form-control" 
                                        value="{{$application->remarks}}" />
                                    </td> 
                                    <td>
                                        <button id="approval" class="btn btn-success">DONE</button>
                                    </td>
                                    <input type="hidden" name="loan_id" id="loan_id" class="form-control" 
                                        value="{{$application->loanApplication_id}}" />

                                        <input type="hidden" name="member_mobile" id="member_mobile" class="form-control" 
                                        value="{{$application->memberdetails->mobile}}" />

                                        <!-- <input type="hidden" name="user_id" id="user_id"value="{{ auth()->id() }}"> -->
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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     
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
        $("#dataTable").on('click','#approval',function(){
            var currentRow=$(this).closest("tr"); 
            var loan_id=currentRow.find("#loan_id").val();
            var amt_approved=currentRow.find("#amt_approved").val();
            var status=currentRow.find("#status").val();
            var remarks=currentRow.find("#remarks").val();
            var mobile=currentRow.find("#member_mobile").val();
            var user_id=currentRow.find("#user_id").val();


            // console.log(mobile);
            $(".loader-div").show(); // show loader
            $.ajax({
                url: "loan_approvalUpdate/"+loan_id,
                type: 'GET',
                data: {loan_id:loan_id,
                    amt_approved:amt_approved,
                    status: status,
                    remarks: remarks,
                    mobile:mobile,
                  
                },
                    success:function(res){  
                        // console.log(res);
                    // $(".loader-div").hide(); // show loader

                        window.location.href = "loan_approval"
                    
                    
                }
            })
        })
    })

</script>
@endsection