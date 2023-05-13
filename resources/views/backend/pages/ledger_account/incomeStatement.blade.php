
@extends('backend.layouts.master')

@section('title')
Branch Create - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


<style>
    .form-check-label {
        text-transform: capitalize;
    }
    th{
        padding: 0 20px;
    }
</style>
@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Income Statement</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Statement</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
        @include('backend.layouts.partials.messages')
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
  
    <div class="card mt-5">
        <div class="card-body">
        <h4 class="header-title">Search By</h4>
        <form action="{{ route('admin.ledger_account.income_statement') }}" method="GET" id="form"> 
            @csrf
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label  for="filter_by_branch">Branch</label>
                        <select name="filter_by_branch" id="filter_by_branch" class="form-control" required>
                        <option value="">Select Branch</option>
                            @foreach($branches as $key=>$branch)
                                    <option value="{{$branch}}">{{$key}}</option>
                                   
                                   @endforeach
                        </select>
                        
                    </div>

                    <div class="form-group col-md-4">
                        <label  for="filter_by_year">Select Year</label>
                        <select name="filter_by_year" id="filter_by_year" class="form-control">
                            <option value="2022-2023">2022-2023</option>
                            <option value="2021-2022">2021-2022</option>
                            <option value="2020-2021">2020-2021</option>
                        </select>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary pr-4 pl-4">Search</button>
                <a class="btn btn-danger" href="{{route('admin.ledger_account.income_statement')}}">Clear</a>
        </div>
    </div>



    

    <div class="card mt-5">
        <div class="container">
            <div class="row">
                <!-------------- Revenues Table------------>
                <div class="col-mg-6 col-lg-6">
                    <div class="card-body">
                    <h4 class="header-title">Revenues</h4>
                    <div class="clearfix"></div>
                        <div class="data-tables" id="emi_collection" style="overflow-x: auto;">
                            <table style=" width: 100%" id="dataTable">
                                <thead class="bg-light text-capitalize">
                                    <tr style="font-size: 15px;">
                                        
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach($revenue as $revenues)
                                <tr>
                                    <td>{{$revenues->name}}-{{$revenues->system_name}}</td>
                                    <td>{{$revenues->closing_acc_balance}}</td>
                                </tr>

                                @endforeach
                                <tr>
                                    <td style="font-weight: bold; height: 40px;">TOTAL REVENUES</td>
                                    <td style="font-weight: bold;">{{$total_revenue}}</td>
                                </tr>
                                    
                            </tbody>
                            
                            </table>
                        </div>
                    </div>
                </div>


                <!-------------- Expenses Table------------>
                <div class="col-mg-6 col-lg-6">
                    <div class="card-body">
                    <h4 class="header-title">Expenses</h4>
                    <div class="clearfix"></div>
                        <div class="data-tables" id="emi_collection" style="overflow-x: auto;">
                            <table style=" width: 100%" id="dataTable">
                                <thead class="bg-light text-capitalize">
                                    <tr style="font-size: 15px;">
                                        
                                    </tr>
                                </thead>
                            <tbody>
                                @foreach($expenses as $expens)
                                    <tr>
                                        <td>{{$expens->name}}-{{$expens->system_name}}</td>
                                        <td>{{$expens->closing_acc_balance}}</td>
                                    </tr>

                                @endforeach
                                <tr>
                                    <td style="font-weight: bold; height: 40px;">TOTAL EXPENSES</td>
                                    <td style="font-weight: bold;">{{$total_expenses}}</td>
                                </tr>
                                    
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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     
     <!-- <script>
         /*================================
        datatable active
        ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }

     </script> -->


@endsection