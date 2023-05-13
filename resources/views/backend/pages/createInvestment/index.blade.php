
@extends('backend.layouts.master')

@section('title')
Investment  - Admin Panel
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
                <h4 class="page-title pull-left">Investment </h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Investment's</span></li>
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
                    <h4 class="header-title float-left">Investment List</h4>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.create_investment.create') }}">Create</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   
                                    <th width="15%">Member Code & Name</th>
                                    <th width="15%">Scheme </th>
                                    <th width="10%">Branch</th>
                                    <th width="15%">Investment Amount</th>
                                    <!-- <th width="15%">Loan Type</th> -->

                                    <th width="15%">Interest Earned</th>
                                    <th width="15%">Maturity Amount</th>
                                    <th width="05%">Status</th>
                                  
                                    <th width="10%">Actions</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($investment as $invest)
                                <tr>
                                    <td><a href="{{ route('admin.members_management.show',$invest->mem_list->member_id) }}">{{$invest->mem_list->member_id_code}} - {{$invest->mem_list->first_name}}</a></td>
                                    <td>{{$invest->inv_list->scheme_name}}</td>
                                    <td>{{$invest->branch_list->branch_name}}</td>
                                    <td>{{$invest->amt_approved}}</td>
                                    <td>{{$invest->interest_earned}}</td>
                                    <td>{{$invest->maturity_amount}}</td>
                                    <td>{{$invest->status}}</td>
                                    <td>
                                    <a class="btn" data-toggle="tooltip" @php if($invest->status == "RequestForApproval" || $invest->status == "NotApproved" ) {@endphp style="display: none"; @php } @endphp  href="{{ route('admin.create_investment.show',$invest->id) }}"><i class="fa fa-eye"></i></a> 

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