
@extends('backend.layouts.master')

@section('title')
Employee Salary - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection

<style>
    
th{
        padding: 0 15px;
    }


 </style>
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

                <h4 class="page-title pull-left">Loan Disbursed Approval  </h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Pending Approval Transactions</span></li>
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
                    <h4 class="header-title float-left">Transactions Details</h4>
                    
                    <div class="clearfix"></div>
                    <div class="data-tables" style="overflow-x: auto;">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>BRANCH</th>
                                    <th>MEMBER</th>
                                    <!-- <th>MOBILE</th>  -->
                                    <th>A/C	TRANS.</th>
                                    <th>DATE</th>
                                    <th>AMOUNT</th>
                                    <th>PAY. MODE</th>
                                    <th>BANK A/C</th>
                                    <th>CHQ. CLEARING DATE</th>
                                    <th>PAYMENT REV./ REL.</th>
                                    <th>STATUS</th>
                                    <th>REMARKS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loan_disbursement as $loan_dis_data)
                                    <tr>
                                        <td>{{$loan_dis_data->branch_name}}</td>
                                        <td>{{$loan_dis_data->first_name}}</td>
                                        <!-- <td>{{$loan_dis_data->mobile}}</td> -->
                                        <td>{{$loan_dis_data->id}}</td>
                                        <td>{{$loan_dis_data->loan_disburse_date}}</td>
                                        <td>{{$loan_dis_data->final_disburse_amt}}</td>
                                        <td>{{$loan_dis_data->disburse_transaction}}</td>
                                        <td>{{$loan_dis_data->cheque_bank_name}}</td>
                                        <td>{{$loan_dis_data->cheque_date}}</td>
                                        <td>
                                            <select name="payment_rev_rel" id="payment_rev_rel" class="form-control">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="Cheque Bounce">Cheque Bounce</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="status" id="status" class="form-control">
                                                <option value="NotApproved">Not Approved</option>
                                                <option value="Disbursed">Disbursed</option>
                                            </select>
                                        </td>
                                        <td>
                                        <input type="text" name="remarks" id="remarks" class="form-control"/>
                                        </td>
                                        <td>
                                        <button id="disbursed" class="btn btn-success">DONE</button>
                                        </td>
                                        <input type="hidden" name="loan_id" id="loan_id" class="form-control" 
                                        value="{{$loan_dis_data->loanApplication_id}}" />
                                        <input type="hidden" name="member_mobile" id="member_mobile" class="form-control" 
                                        value="{{$loan_dis_data->mobile}}" />
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
    $("#dataTable").on('click','#disbursed',function(){
        var currentRow=$(this).closest("tr"); 
        var loan_id=currentRow.find("#loan_id").val();
        var status=currentRow.find("#status").val();
        var remarks=currentRow.find("#remarks").val();
        var mobile=currentRow.find("#member_mobile").val();

        // console.log(mobile);
        $(".loader-div").show(); // show loader
    
        $.ajax({
            url: "loan_approvalUpdate/"+loan_id,
            type: 'GET',
            data: {loan_id:loan_id,
                status: status,
                remarks: remarks,
                mobile:mobile
            },
                success:function(res){  
                   // console.log(res);
                    window.location.href = "disbursement_approval"
                
                
            }
        })
    })
})

</script>
@endsection