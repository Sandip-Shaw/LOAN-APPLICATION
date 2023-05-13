
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
                <h4 class="page-title pull-left">Salary Master</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Employee Salary Master</span></li>
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
                    <h4 class="header-title float-left">Employee's Salary Detail List</h4>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.salary_details.create') }}">Create Salary Structure</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   
                                    <th width="20%">Emp Code & Name</th>
                                    <th width="05%">Basic</th>
                                    <th width="05%">HRA</th>
                                    <th width="05%">DA</th>
                                    <th width="05%">TA</th>
                                    <th width="05%">Allowance</th>
                                    <th width="05%">Fuel</th>
                                    <th width="05%">Others</th>
                                    <th width="05%">Gross Pay</th>
                                    <th width="05%">PF</th>
                                    <th width="05%">ESI</th>
                                    <th width="10%">Net Pay</th>       
                                    <th width="10%">Actions</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detail as $details)
                                    <tr>
                                        <td>{{$details->salaryDet->emp_code}} - {{$details->salaryDet->name}}</td>
                                        <td>{{$details->basic}}</td>
                                        <td>{{$details->others}}</td>
                                        <td>{{$details->HRA}}</td>
                                        <td>{{$details->fuel}}</td>
                                        <td>{{$details->DA}}</td>
                                        <td>{{$details->allowance}}</td>
                                        <td>{{$details->TA}}</td>
                                        <td>{{$details->gross_pay}}</td>
                                        <td>{{$details->PF}}</td>
                                        <td>{{$details->ESI}}</td>
                                        <td>{{$details->net_pay}}</td>
                                        <td>
                                        
                                        <a href="{{ route('admin.salary_details.edit', $details->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                        
                                        <div class="pt-2">
                                        <a href="{{ route('admin.salary_details.destroy', $details->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $details->id }}').submit();">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                        </div>
                                    

                                        <form id="delete-form-{{ $details->id }}" action="{{ route('admin.salary_details.destroy', $details->id) }}" method="POST" style="display: none;">
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