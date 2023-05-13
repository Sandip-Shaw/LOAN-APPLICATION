
@extends('backend.layouts.master')

@section('title')
Entries - Admin Panel
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
                    <li><span>Account Entries</span></li>
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
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.account_entries.create') }}"> New Entry</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center" >
                            <thead class="bg-primary text-capitalize" style="font-size:20px;">
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
                            <tbody class="even">
                                @foreach($entries as $entry)
                                <tr>
                                    <td style="text-align:left;"><b>{{$entry->description}}</b></td>
                                
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                        
                                    <td>{{$entry->entry_date}}</td>
                                    <td>{{$entry->created_at}}</td>
                                    <td></td>
                                    <td>
                                        <a href="{{ route('admin.account_entries.edit', $entry->id) }}" data-toggle="tooltip" ><i class="fa fa-pencil-square"></i></a>&emsp;
                                        <a href="{{ route('admin.account_entries.show', $entry->id) }}" data-toggle="tooltip"><i class="fa fa-eye"></i></a>&emsp;
                                        <a href="{{ route('admin.account_entries.destroy', $entry->id) }}" data-toggle="tooltip" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $entry->id }}').submit();"> <i class="fa fa-trash"></i></a>&emsp;
                                        <form id="delete-form-{{ $entry->id }}" action="{{ route('admin.account_entries.destroy', $entry->id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <a href="" data-toggle="tooltip"><i class="fa fa-print"></i></a>
                                        

                                        
                                    </td>
                                                                        
                                </tr>


                                @foreach($entry->accountdetail as $trans)
                              
                                <tr>
                                    <td><a href="{{ route('admin.acc_details', $trans->ledgeraccnt->id) }}" data-toggle="tooltip">&emsp;{{$trans->ledgeraccnt->name}}-{{$trans->ledgeraccnt->system_name}}({{$trans->ledgeraccnt->ledger_type}})</td>
                                    <td>{{$trans->ledgerbrnch->branch_name}}</a></td>
                                    <td>@php
                                       if($trans->type=='Debit'){
                                       echo $trans->amount;
                                       }else{

                                       } 
                                       @endphp
                                    </td>
                                    <td>
                                    @php
                                       if($trans->type=='Credit'){
                                        echo $trans->amount;
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
//         $(document).ready(function(){
//   $("#desc_row").on("load", function() {
//     var value = $(this.children[0]).val();
//     console.log(value);
//     // $("#odd tr").filter(function() {
//     //   $(this).toggle($(this.children[0]).text().toLowerCase().indexOf(value) > -1)
//     // });
//   });
// });
     </script>
@endsection