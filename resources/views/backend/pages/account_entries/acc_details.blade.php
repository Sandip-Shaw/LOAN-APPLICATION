
@extends('backend.layouts.master')

@section('title')
Entries Show- Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection

<style>
    tr:nth-child(odd) {
    background-color: #FFFFFF;
    }

   tr:nth-child(even) {
    background-color: #F5F5F5;
    }

    th {
       background-color: #d5f4e6;
       padding: 0 20px;
    }
</style>
@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Journal Entries</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Transactions</span></li>
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
                    <h4 class="header-title float-left">Transactions</h4>
                    
                    <div class="clearfix"></div>
                    <div class="data-tables" style="overflow-x: auto;">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center" >
                            <thead class=" text-capitalize" style="font-size: 20px;">
                                <tr style="font-size: 16px;">
                                    <th>BRANCH</th>
                                    <th>DATE</th>
                                    <th>DESCRIPTION</th>
                                    <th>IS SYSTEM	</th>
                                    <th>O. BALANCE</th>
                                    <th>DEBIT</th>
                                    <th>CREDIT</th>
                                    <th>C .BALANCE</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $acc_details)
                                    <tr>
                                        <td>{{$acc_details->branch_name}}</td>
                                        <td>{{$acc_details->created_at}}</td>
                                        <td>{{$acc_details->description}}</td>
                                        <td></td>
                                        <td>{{$acc_details->opening_acc_balance}}</td>
                                        <td>@php
                                                if($acc_details->type=='Debit'){
                                                echo $acc_details->amount;
                                                }else{

                                                } 
                                        @endphp</td>
                                        <td>@php
                                                if($acc_details->type=='Credit'){
                                                echo $acc_details->amount;
                                                }else{

                                                } 
                                        @endphp</td>
                                        <td>{{$acc_details->closing_acc_balance}}</td>
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
     
     <script>
         /*================================
        datatable active
        ==================================*/
        // if ($('#dataTable').length) {
        //     $('#dataTable').DataTable({
        //         responsive: true
        //     });
        // }

     </script>

     
@endsection