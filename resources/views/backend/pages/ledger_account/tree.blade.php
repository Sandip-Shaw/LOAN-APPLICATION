
@extends('backend.layouts.master')

@section('title')
Ledger - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">

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
                <h4 class="page-title pull-left">Accounting Tree </h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.ledger_account.index') }}">Tree</a></li>


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
    <div id="data">
  
    <ul>

        <li data-jstree='{"opened":true, "icon":"glyphicon glyphicon-cog"}'>Accounting
        <ul>
       
       <li data-jstree='{"opened":true, "icon":"//jstree.com/tree.png"}'>ASSETS
           <ul>
               @foreach($led_grp_asset as $asset)
                   <li>{{$asset->name}} (<span style="font-weight: bold;">{{$asset->closing_balance}}</span>)</li>
               @endforeach
           </ul>
       </li>
       <li data-jstree='{"opened":true, "icon":"//jstree.com/tree.png"}'>LIABILITIES
           <ul>
               @foreach($led_grp_liability as $liability)
                   <li>{{$liability->name}} (<span style="font-weight: bold;">{{$liability->closing_balance}}</span>)</li>
               @endforeach
           </ul>
       </li>
       <li data-jstree='{"opened":true, "icon":"//jstree.com/tree.png"}'>EQUITY
           <ul>
               @foreach($led_grp_equity as $equity)
                   <li>{{$equity->name}} (<span style="font-weight: bold;">{{$equity->closing_balance}}</span>)</li>
               @endforeach
           </ul>
       </li>
       <li data-jstree='{"opened":true, "icon":"//jstree.com/tree.png"}'>EXPENSES
           <ul>
               @foreach($led_grp_expenses as $expenses)
                   <li>{{$expenses->name}} (<span style="font-weight: bold;">{{$expenses->closing_balance}}</span>)</li>
               @endforeach
           </ul>
       </li>
       <li data-jstree='{"opened":true, "icon":"//jstree.com/tree.png"}'>REVENUE
           <ul>
               @foreach($led_grp_revenue as $revenue)
                   <li>{{$revenue->name}} (<span style="font-weight: bold;">{{$revenue->closing_balance}}</span>)</li>
               @endforeach
           </ul>
       </li>
   </ul>

        </li>
    </ul>
    

        
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
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>


     
     <script>
       $(document).ready(function(){
        $('#data').jstree({
            "types" : {
            "default" : {
                "icon" : "glyphicon glyphicon-flash"
            },
            "demo" : {
                "icon" : "glyphicon glyphicon-ok"
            }
            },
            "plugins": ["types"]
        });
       });



     </script>
@endsection