
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
                    <li><span>Account Entries Show</span></li>
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
                    <h4 class="header-title float-left">Journal Entries</h4>
                    <!-- <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.account_entries.create') }}"> New Entry</a>
                    </p> -->
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center" >
                            <thead class=" text-capitalize" style="font-size: 20px;">
                                <tr>
                                    <th width="15%">Description</th>
                                    <th width="20%">Branch</th>
                                    <th width="10%">Debit</th>
                                    <th width="10%">Credit</th>
                                    <th width="10%">Date</th>
                                    <th width="10%">Created At</th>
                                    <th width="10%">Is System</th>

                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody >
                              
                                <tr>
                                    <td style="text-align:left;"><b>{{$entries->description}}</b></td>
                                
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                        
                                    <td>{{$entries->entry_date}}</td>
                                    <td>{{$entries->created_at}}</td>
                                    <td></td>
                                    <td>
                                        <a href="" data-toggle="tooltip" ><i class="fa fa-pencil-square"></i></a>&emsp;
                                        <a href="" data-toggle="tooltip" ><i class="fa fa-print"></i></a>
                                        

                                        
                                    </td>
                                                                        
                                </tr>             
                            @foreach($entries->accountdetail as $entry)
                                <tr>
                                    <td>{{$entry->ledgeraccnt->name}}-{{$entry->ledgeraccnt->system_name}}({{$entry->ledgeraccnt->ledger_type}})</td>
                                    <td>{{$entry->ledgerbrnch->branch_name}}</td>
                                    <td>
                                    @php
                                       if($entry->type=='Debit'){
                                       echo "Debit";
                                       }else{

                                       } 
                                    @endphp
                                    </td>
                                    <td>
                                    @php
                                       if($entry->type=='Credit'){
                                       echo "Credit";
                                       }else{

                                       } 
                                    @endphp
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

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

     <script>

     </script>
@endsection