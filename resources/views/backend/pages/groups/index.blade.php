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

<style>
    .form-control-sm {
        width: 50px !important;
    }

    table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before,
    table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before {
        top: 50%;
        transform: translateY(-50%);
    }
</style>
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Group Details</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Groups</span></li>
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
                    <h4 class="header-title float-left">Group List</h4>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.groups.create') }}">Create New Group</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="5%">Group Code</th>
                                    <th width="10%">Group Name</th>
                                    <th width="10%">Gr Leader Name</th>
                                    <th width="15%">Op Date</th>
                                    <th width="15%">Employee</th>
                                    <th width="10%">Branch</th>
                                    <th width="10%">Coll Day</th>
                                    <th width="10%">Coll Time</th>
                                    <th width="10%">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $group)
                                <tr>
                                    <td>{{$loop->index+1 }}</td>
                                    <td>{{$group->id}}</td>
                                    <td>{{$group->group_name }}</td>
                                    <td>{{$group->group_leader_name}}</td>
                                    <td>{{$group->op_date}}</td>
                                    <td>{{$group->assign_employee}}</td>
                                    <td>{{$group->group_branch}}</td>
                                    <td>{{$group->collection_day}}</td>
                                    <td>{{$group->collection_time}}</td>


                                    <td>
                                        <a href="{{ route('admin.groups.edit', $group->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                        <a class="pl-2" href="{{ route('admin.groups.show', $group->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                        <a class="pl-2" href="{{ route('admin.groups.destroy', $group->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $group->id }}').submit();">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>

                                        <form id="delete-form-{{ $group->id }}" action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" style="display: none;">
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