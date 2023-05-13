
@extends('backend.layouts.master')

@section('title')
Loan Schemes - Admin Panel
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
                <h4 class="page-title pull-left">Loan Scheme</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>All Scheme's</span></li>
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
                    <h4 class="header-title float-left">Scheme's List</h4>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.loan_schema.create') }}">Create Scheme</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   
                                    <th width="15%">Scheme Code</th>
                                    <th width="15%">Scheme Name</th>
                                    <th width="10%">Tenure</th>
                                    <th width="15%">Max. Loan Ammount</th>
                                    <th width="15%">Loan Type</th>

                                    <th width="15%">Interest Type</th>
                                    <th width="15%">A.Interest Rate(%)</th>
                                    <th width="05%">Active</th>
                                  
                                    <th width="10%">Actions</th>


                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($schemas as $schema)
                                    <td>{{ $schema->schema_code }}</td>
                                    <td>{{ $schema->schema_name }}</td>
                                    <td>{{ $schema->max_tanure }} </td>
                                    <td>{{ $schema->max_loan_amt }} </td>
                                    <td>{{ $schema->loan_type }} </td>

                                    <td>{{ $schema->int_type }} </td>
                                    <td>{{ $schema->ann_rate_int }} </td>
                                    <td>{{ $schema->active }} </td>
                                    <td>
                                     
                                            <a href="{{ route('admin.loan_schema.edit',$schema->loanSchema_id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                            <a class="pl-2" href="{{ route('admin.loan_schema.show',$schema->loanSchema_id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a> 
                                        
                                     
                                      
                                     
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