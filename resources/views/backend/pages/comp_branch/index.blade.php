
@extends('backend.layouts.master')

@section('title')
Company Branch - Admin Panel
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
                <h4 class="page-title pull-left">Company Branch</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Branch...</span></li>
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
                    <h4 class="header-title float-left">Branch List</h4>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.comp_branch.create') }}">Create New Branch</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="15%">Branch Name</th>
                                    <th width="15%">Branch Code</th>
                                    <th width="10%">City</th>
                                    <th width="15%">State</th>
                                    <th width="10%">Opening Date</th>
                                    
                                    <th width="10%">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($branch as $branches)
                               <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $branches->branch_name }}</td>
                                    <td>{{ $branches->branch_code }}</td>
                                    <td>{{$branches->city}}</td>
                                    <td>{{$branches->state}}</td>
                                    <td>{{ Carbon\Carbon::parse($branches->open_date)->format('d-m-Y') }}</td>

                                  
                                       
                                    <td> 
                                         <a href="{{ route('admin.comp_branch.edit', $branches->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                         <a class="pl-3" href="{{ route('admin.comp_branch.show', $branches->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a> 

                                        <!-- <a class="btn btn-danger text-white" href="{{ route('admin.comp_branch.destroy', $branches->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $branches->id }}').submit();">
                                            Delete
                                        </a>

                                        <form id="delete-form-{{ $branches->id }}" action="{{ route('admin.comp_branch.destroy', $branches->id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form> -->
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