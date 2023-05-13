
@extends('backend.layouts.master')

@section('title')
Hr Management - Admin Panel
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
                <h4 class="page-title pull-left">Employee Leave List</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Employee Leave</span></li>
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
                    <h4 class="header-title float-left">Employee's Leave List</h4>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.employee_leave.create') }}">Create Employee Leave</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   
                                    <th width="25%">Financial Year</th>
                                    <th width="25%">Branch</th>
                                    <th width="05%">CL</th>
                                    <th width="05%">SL</th>
                                    <th width="05%">EL</th>
                                    <th width="05%">LOP</th>
                                 
                                    <th width="20%">Actions</th>


                                </tr>
                            </thead>
                            <tbody>
                             @foreach($leave as $leaves)
                                <tr>
                                    <td>{{$leaves->financial_year}}</td>
                                    <td>{{$leaves->branchdetlist->branch_name}}</td>
                                    <td>{{$leaves->cl}}</td>
                                    <td>{{$leaves->sl}}</td>
                                    <td>{{$leaves->el}}</td>
                                    <td>{{$leaves->lop}}</td>
                                    <td>

                                        <a class="mr-3" href="{{ route('admin.employee_leave.edit', $leaves->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                        <a  href="{{ route('admin.employee_leave.destroy', $leaves->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $leaves->id }}').submit();">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>

                                        <form id="delete-form-{{ $leaves->id }}" action="{{ route('admin.employee_leave.destroy', $leaves->id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
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