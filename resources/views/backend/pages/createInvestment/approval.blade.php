
@extends('backend.layouts.master')

@section('title')
Investmemt Approval - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Approval - Member's Investment </h4>
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
                                <tr style="font-size: 17px;">
                                   
                                    <th width="15%">Member Code & Name</th>
                                    <th width="15%">Scheme</th>
                                    <th width="10%">Investment Amount</th>
                                    <th width="10%">Interest Earned</th>
                                    <th width="10%">Maturity Amount</th>
                                    <th width="10%">Status</th>
                                                                      
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            @foreach($approval as $approvals)
                                    <tr>
                                        <td><a href="{{ route('admin.members_management.show',$approvals->mem_list->member_id) }}">{{$approvals->mem_list->member_id_code}} - {{$approvals->mem_list->first_name}}</a></td>
                                        <td>{{$approvals->inv_list->scheme_name}}</td>
                                        <td>{{$approvals->amt_approved}}</td>
                                        <td>{{$approvals->interest_earned}}</td>
                                        <td>{{$approvals->maturity_amount}}</td>
                                        <td>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Choose One</option>
                                                <option value="Approved">Approved</option>
                                                <option value="NotApproved">Not Approved</option>
                                            </select>
                                        </td>
                                        
                                        <td>
                                             <button id="approval" class="btn btn-success">DONE</button>

                                        </td>
                                        <input type="hidden" name="id" id="id" class="form-control" 
                                        value="{{$approvals->id}}" />

                                    </tr>
                            @endforeach
                            <tbody>
                             
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
            var id=currentRow.find("#id").val();
           
            var status=currentRow.find("#status").val();
            // var remarks=currentRow.find("#remarks").val();
            console.log(id);
        
            $.ajax({
                url: "investment_approvalUpdate/"+id,
                type: 'GET',
                data: {id:id,
                    status: status,
                    // remarks: remarks
                },
                    success:function(res){  
                        //console.log(res);
                        window.location.href = "investment_approval"
                    
                    
                }
            })
        })
    })

</script>
@endsection