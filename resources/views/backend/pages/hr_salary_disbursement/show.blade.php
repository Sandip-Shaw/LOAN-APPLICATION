
@extends('backend.layouts.master')

@section('title')
Salary Disbursement - Admin Panel
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
                <h4 class="page-title pull-left">Salary Disbursement</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.salary_disbursement.index') }}">Salary Disbursement</a></li>

                    <li><span>{{$salary->emp_list->emp_code}} - {{$salary->emp_list->name}}</span></li>
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
        
        <div class="col-md-7">
            <div class="box">
                <div class="box-body">
                    <!-- <h4 class="header-title float-left">Blogs List</h4> -->
                    <!-- <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.company.create') }}">Create New Profile</a>
                    </p> -->
                    <div class="pull-right editBtn">
                    <a class="btn btn-default btn-xs" onclick="block_ui()" href="">
                        <i class="fa fa-trash"></i></a>
                    </div>
                 
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class=col-md-11>
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-details">
                            <tbody>
             
                                <tr>
                                    <td class="ft-600" style="width: 250px;"> Salary Amount</td>
                                    <td> 
                                    INR {{$salary->disburse_salary}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;"> Transaction Date</td>
                                    <td> 
                                     {{$salary->created_at->format('d/m/Y')}}
                                
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Reference Id</td>
                                    <td> 
                                    
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Transaction Status</td>
                                    <td> 
                                    {{$salary->status}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Payment Mode </td>
                                    <td> 
                                    {{$salary->paymode}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Bank Name </td>
                                    <td> 
                                    {{$salary->bank_name_cheque}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Cheque No. </td>
                                    <td> 
                                    {{$salary->cheque_no}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Cheque Date </td>
                                    <td> 
                                    {{$salary->cheque_date}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Online Transaction Date </td>
                                    <td> 
                                    {{$salary->transfer_date_onlineTrans}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Transaction No.</td>
                                    <td> 
                                    {{$salary->transaction_no}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Online Transfer Mode</td>
                                    <td> 
                                    {{$salary->transfer_mode}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Remarks</td>
                                    <td> 
                                    {{$salary->remarks}}
                                    </td>
                                </tr>

                      

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Created at</td>
                                    <td> 
                                    {{$salary->created_at->format('d/m/Y')}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Updated at</td>
                                    <td> 
                                    {{$salary->updated_at->format('d/m/Y')}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600" style="width: 250px;">Is Accounted</td>
                                    <td> 
                                    
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