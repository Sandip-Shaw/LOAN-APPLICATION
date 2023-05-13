
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
                <h4 class="page-title pull-left">Loan Scheme</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.loan_schema.index') }}"> Loan Scheme</a></li>
                    <li><span>   {{ $schema->schema_name }}</span></li>
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
                    <a class="btn btn-default btn-xs" onclick="block_ui()" href="{{ route('admin.loan_schema.edit',$schema->loanSchema_id) }}">
                        <i class="fa fa-pencil"></i></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class=col-md-11>
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-details">
                            <tbody>
                          
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Scheme Code </td>
                                    <td> 
                                    {{ $schema->schema_code }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"> Scheme Name</td>
                                    <td> 
                                    {{ $schema->schema_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Maximum Loan Amount(INR)</td>
                                    <td> 
                                    {{ $schema->max_loan_amt }}
                                    </td>
                                </tr>

                              

                                <!-- <tr>
                                    <td class="ft-600" style="width: 250px;">Maximum Loan Limit % (if any)</td>
                                    <td> 
                                    {{ $schema->max_loan_lim }}%
                                    </td>
                                </tr> -->

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Max. Tenure</td>
                                    <td> 
                                    {{ $schema->max_tanure }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Max. Age</td>
                                    <td> 
                                    {{ $schema->max_age }} &nbsp;Years
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Min. Age</td>
                                    <td> 
                                    {{ $schema->min_age }} &nbsp;Years
                                    </td>
                                </tr>

                      

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Annual Interest Rate (%)</td>
                                    <td> 
                                    {{ $schema->ann_rate_int }}&nbsp;%
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Fore Closure Charges in INR(if any)</td>
                                    <td> 
                                    {{ $schema->fore_closure_charge }}&nbsp; INR
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Processing Fee (%)</td>
                                    <td> 
                                    {{ $schema->process_fee }} &nbsp;%
                                    </td>
                                </tr>

                                <!-- <tr>
                                    <td class="ft-600" style="width: 250px;">Security Deposit</td>
                                    <td> 
                                    {{ $schema->sec_deposit }}
                                    </td>
                                </tr> -->

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Active</td>
                                    <td> 
                                    {{ $schema->active }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Interest Type</td>
                                    <td> 
                                    {{ $schema->int_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Sms Charges (if any)</td>
                                    <td> 
                                    {{ $schema->sms_charges }}&nbsp;INR
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Fuel Charges (if any)</td>
                                    <td> 
                                    {{ $schema->fuel_charge }} &nbsp;INR
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Stationary Charges (if any)</td>
                                    <td>
                                    {{ $schema->stationary_charges }} &nbsp;INR
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Maintenance Charges (if any)</td>
                                    <td> 
                                    {{ $schema->maintenance_charge }}&nbsp; INR
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Collection Charges (if any)</td>
                                    <td> 
                                    {{ $schema->collection_charge }} &nbsp;INR
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Insurance Charges (if any)</td>
                                    <td> 
                                    {{ $schema->insurance_charge }} &nbsp;INR
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Grace Period</td>
                                    <td> 
                                    {{ $schema->grace_period }} 
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Penalty Type</td>
                                    <td> 
                                    {{ $schema->panulty_type }} 
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Penalty Amount</td>
                                    <td> 
                                        @if($schema->panulty_type == "fixed")
                                         {{ $schema->penalty }} &nbsp; INR
                                         @elseif($schema->panulty_type == "percentage")
                                         {{ $schema->penalty }} &nbsp; %
                                         @endif
                                    </td>
                                </tr>

                                <!-- <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Overdue Interest Type</td>
                                    <td> 
                                    {{ $schema->overdue_int_type }} 
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Overdue Interest Rate</td>
                                    <td> 
                                    {{ $schema->overdue_int_rate }} &nbsp; %
                                    </td>
                                </tr> -->

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Stamp Charges</td>
                                    <td> 
                                    {{ $schema->stamp_charge }} &nbsp; INR

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