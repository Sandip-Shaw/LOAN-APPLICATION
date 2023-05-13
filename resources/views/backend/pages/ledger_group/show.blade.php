
@extends('backend.layouts.master')

@section('title')
Group - Admin Panel
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
                <h4 class="page-title pull-left">Ledger Group </h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.ledger_group.index') }}">Ledger Group</a></li>

                    <li><span>{{$group->group_type}}</span></li>
                    <li><span>--</span></li>

                    <li><span>{{$group->display_name}}</span></li>

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
        
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <!-- <h4 class="header-title float-left">Blogs List</h4> -->
                    <!-- <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.company.create') }}">Create New Profile</a>
                    </p> -->
                    <!-- <div class="pull-right editBtn"> -->
                    <!-- <a class="btn btn-default btn-xs" onclick="block_ui()" href="">
                        <i class="fa fa-pencil"></i></a>
                    </div> -->
                 
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class=col-md-12>
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-details ">
                        <thead class="table-primary">
                                        <tr>
                                            
                                            <th>NAME</th>
                                            <th>SYSTEM NAME</th>
                                            <th>TYPE</th>   
                                            <th>POSITION</th>
                                            <th>ACCOUNTS</th>
                                            <th>BALANCE</th>
                                            <th>ACTIONS</th>


                                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td>{{$group->display_name}}</td>
                                <td>{{$group->system_name}}</td>
                                <td>{{$group->ledgergrp->types}}</td>
                                <td>{{$group->position}}</td>
                                <td>{{$group->ledgeraccount->count()}}</td>
                                <td>{{$group->ledgeraccount->sum('closing_balance')}}</td>
                               
                                <td>
                                <a href="{{ route('admin.ledger_group.edit',$group->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i>Edit</a>
                                <!-- <a href="" data-toggle="tooltip"  class="btn"><i class="fa fa-trash"></i></a> -->
                                <a class="btn" href="{{ route('admin.ledger_group.destroy', $group->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $group->id }}').submit();"><i class="fa fa-trash"></i>
                                            Delete
                                </a>

                                        <form id="delete-form-{{ $group->id }}" action="{{ route('admin.ledger_group.destroy', $group->id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                
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


        <div class="col-md-12">
            <h4>Ledgers under Group</h4>
            <div class="box">
                <div class="box-body">
                    <!-- <h4 class="header-title float-left">Blogs List</h4> -->
                    <!-- <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.company.create') }}">Create New Profile</a>
                    </p> -->
                    <!-- <div class="pull-right editBtn"> -->
                    <!-- <a class="btn btn-default btn-xs" onclick="block_ui()" href="">
                        <i class="fa fa-pencil"></i></a>
                    </div> -->
                 
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class=col-md-12>
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-details ">
                        <thead class="table-primary">
                                        <tr>
                                            <th>CODE</th>
                                            <th>NAME</th>
                                            <th>SYSTEM NAME</th>
                                            <th>TYPE</th>   
                                            <th>SYSTEM A/C</th>
                                            <th>BALANCE</th>
                                            <th>ACTIONS</th>


                                        </tr>
                        </thead>
                        <tbody>
                            @foreach($accounts as $acc)
                            <tr>
                                
                                <td>{{$acc->code}}</td>
                                <td>{{$acc->name}}</td>
                                <td>{{$acc->system_name}}</td>
                                <td>{{$acc->ledgertype->types}}</td>
                                <td></td>
                                <td>{{$acc->closing_balance}}</td>
                               
                                <td>
                                <a href="{{ route('admin.ledger_account.edit',$acc->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i>Edit</a>
                                <!-- <a href="" data-toggle="tooltip"  class="btn"><i class="fa fa-trash"></i></a> -->
                                <a class="btn" href="{{ route('admin.ledger_account.destroy', $acc->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $acc->id }}').submit();"><i class="fa fa-trash"></i>
                                            Delete
                                </a>

                                        <form id="delete-form-{{ $acc->id }}" action="{{ route('admin.ledger_account.destroy', $acc->id) }}" method="POST" style="display: none;">
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
        </div>
        
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


     </script>
@endsection