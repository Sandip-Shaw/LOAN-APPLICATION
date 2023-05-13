
@extends('backend.layouts.master')

@section('title')
Interest Pay - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection

<style>
    
th{
        padding: 0 20px;
    }


 </style>

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Investment Interest Pay</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="">Interest Pay</a></li>

                    <li><span></span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner" style="margin-top: 10px">
    <div class="row">
       

    <div class="card mt-5">
        <div class="card-body" style="border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
        <h4 class="header-title">Payment Schedule </h4>
        <div class="clearfix"></div>
            <div class="data-tables" id="payment_collection_details" style="overflow-x: auto;">
                <table style=" width: 100%" id="dataTable" class="text-center" id="" >
                    <thead class="text-white bg-info">
                        <tr style="font-size: 17px;">
                            <th width="05%">Tenure</th>                     
                            <th width="10%">Principal</th>
                            <th width="10%">Interest</th>
                            <th width="15%">Maturity Amount</th>
                            <th width="10%">Interest Per Tenure</th>
                            <th width="20%">Period</th>
                            <th width="10%">Balance Amount</th>
                            <th width="10%">Status</th>
                            <th width="10%">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                       @foreach($pay_details as $pay)
                            <tr>
                                <td>{{$pay->tenure_no}}</td>
                                <td>{{$pay->principal_amt}}</td>
                                <td>{{$pay->interest_earned}}</td>
                                <td>{{$pay->maturity_amount}}</td>
                                <td>{{$pay->int_per_tenure}}</td>
                                <td>{{$pay->period}}</td>
                                <td>{{$pay->bal_principal}}</td>
                                <td>{{$pay->status}}</td>
                                <td>

                                <a class="btn btn-success text-white" @php if($pay->status == "Paid") {@endphp style="display: none"; @php } @endphp id="pay_{{$pay->id}}" href="{{route('admin.interest_pay',$pay->id)}}"><i class="fa fa-money" aria-hidden="true"></i>&nbsp; Pay</a>


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
@endsection


@section('scripts')
     <!-- Start datatable js -->
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     
     
@endsection