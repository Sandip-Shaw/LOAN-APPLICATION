
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

    .row {
  display: flex;
  margin-left:-5px;
  margin-right:-5px;
}
.column {
  flex: 50%;
  padding: 5px;
}
</style>
@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Member Payment Collection</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>EMI Details</span></li>
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
        <h4 class="header-title">EMI Collection Search</h4>
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label  for="search_by_branch">Branch:</label>
                        <select name="search_by_branch" id="search_by_branch" class="form-control">
                        @foreach($branches as $key=>$branch)
                                    <option value="{{$branch}}">{{$key}}</option>
                                   
                                   @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label  for="filter_by_year">Select Financial Year</label>
                        <select name="filter_by_year" id="filter_by_year" class="form-control">

                            <option value="2023-2024">2023-2024</option>
                            <option value="2022-2023">2022-2023</option>
                            <option value="2021-2022">2021-2022</option>
                            
                        </select>
                    </div>

                </div>

                <button id="date_search" class="btn btn-primary  pr-4 pl-4">Search</button>
                <a class="btn btn-danger" href="{{route('admin.ledger_account.profit_and_loss')}}">Clear</a>
        </div>
    </div>



    <!-------------- EMI Details Table------------>

    <div class="card mt-5">
        <div class="card-body">
        <h4 class="header-title" id="emi_details">EMI Details</h4>
        <div class="row">
            <div class="clearfix"></div>
                <div class="data-tables column" id="emi_collection" style="overflow-x: auto;">
                    <table style=" width: 100%" id="dataTable" class="text-center" >
                        <thead class="bg-light text-capitalize">
                            <tr style="font-size: 15px;">
                                <th>PARTICULARS</th>
                                <th>CURRENT</th>

                            </tr>
                        </thead>
                    <tbody id="current_year">
                    <tr>
                        <td style="float: left; font-weight: bold; height: 40px;">REVENUES</td>
                    </tr>
                        @foreach($revenue as $revenues)
                        <tr>
                            <td style="float: left;">{{$revenues->name}} ({{$revenues->system_name}})</td>
                            <td>{{$revenues->closing_acc_balance}}</td>
                            
                        </tr>
                        @endforeach
                        <tr>
                        <td style="font-weight: bold; height: 40px;">TOTAL REVENUES</td>
                        <td id="tot_rev" style="font-weight: bold;">{{$total_revenue[0]->total}}</td>
                    </tr>

                    <tr>
                        <td style="float: left; font-weight: bold; height: 40px;">EXPENSES</td>
                    </tr>
                        @foreach($expenses as $expense)
                        <tr>
                            <td style="float: left;">{{$expense->name}} ({{$expense->system_name}})</td>
                            <td>{{$expense->closing_acc_balance}}</td>
                            
                        </tr>
                        @endforeach
                        <tr>
                        <td style="font-weight: bold; height: 40px;">TOTAL EXPENSES</td>
                        <td style="font-weight: bold;">{{$total_expenses[0]->total}}</td>
                    </tr>
                            
                    </tbody>
                    
                    </table>
                </div>

                <div class="column">
                <table style=" width: 100%" id="dataTable" class="text-center" >
                        <thead class="bg-light text-capitalize">
                            <tr style="font-size: 15px;">
                                <th>PARTICULARS</th>
                                <th>PERVIOUS</th>
                            
                            
                            </tr>
                        </thead>
                        <tbody id="prev_year">
                    <tr>
                        <td style="float: left; font-weight: bold; height: 40px;"></td>
                    </tr>
                        @foreach($prev_revenue as $revenues)
                        <tr>
                            <td style="float: left;">{{$revenues->name}} ({{$revenues->system_name}})</td>
                            <td>{{$revenues->closing_acc_balance}}</td>
                            
                        </tr>
                        @endforeach
                        <tr>
                        <td style="font-weight: bold; height: 40px;">TOTAL REVENUES</td>
                        <td style="font-weight: bold;">{{$total_prev_revenue[0]->total}}</td>
                    </tr>

                    <tr>
                        <td style="float: left; font-weight: bold; height: 40px;"></td>
                    </tr>
                        @foreach($prev_expenses as $expense)
                        <tr>
                            <td style="float: left;">{{$expense->name}} ({{$expense->system_name}})</td>
                            <td>{{$expense->closing_acc_balance}}</td>
                            
                        </tr>
                        @endforeach
                        <tr>
                        <td style="font-weight: bold; height: 40px;">TOTAL EXPENSES</td>
                        <td style="font-weight: bold;">{{$total_prev_expenses[0]->total}}</td>
                    </tr>
                            
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

     <script>

$(document).ready(function(){
$("#date_search").click(function(){
    var branch = $('#search_by_branch').val();
    var from_date=$("#filter_by_year").val();
    //console.log(from_date);
    var new_url = "{{route('admin.ledger_account.profit_and_loss')}}"+"?branch="+branch+"&from_date="+from_date;
    window.location = new_url;

    })
})

</script>


@endsection