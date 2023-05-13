
@extends('backend.layouts.master')

@section('title')
Collection Center - Admin Panel
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
                <h4 class="page-title pull-left">Collection Center</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.collec_branch.index') }}">Collection Center</a></li>

                    <li><span>{{$collection->center_no}}</span></li>
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
        
        <div class="col-md-8">
            <div class="box">
                <div class="box-body">
                    <!-- <h4 class="header-title float-left">Blogs List</h4> -->
                    <!-- <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.company.create') }}">Create New Profile</a>
                    </p> -->
                    <div class="pull-right editBtn">
                    <a class="btn btn-default btn-xs" onclick="block_ui()" href="{{ route('admin.collec_branch.edit',$collection->id) }}">
                        <i class="fa fa-pencil"></i></a>
                    </div>
                 
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class=col-md-11>
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-details">
                            <tbody>
             
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"> Branch</td>
                                    <td> 
                                    {{$collection->collectiondetails->branch_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Center No</td>
                                    <td> 
                                    {{$collection->center_no}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Head Name</td>
                                    <td> 
                                    {{$collection->center_head}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Cashier Name</td>
                                    <td> 
                                    {{$collection->center_cashier}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Collection Day</td>
                                    <td> 
                                    {{$collection->collection_day}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Collection Time</td>
                                    <td> 
                                    {{$collection->collection_time}}
                                    </td>
                                </tr>

                      

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Address</td>
                                    <td> 
                                    {{$collection->current_address}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">GPS Lat/ Log</td>
                                    <td> 
                                    {{$collection->latitude}} / {{$collection->longitude}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Active</td>
                                    <td> 
                                    {{$collection->center_active}}
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