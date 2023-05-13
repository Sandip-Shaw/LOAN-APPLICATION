
@extends('backend.layouts.master')

@section('title')
LEDGER ACCOUNTS  - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection
<style>
/* .project-tab {
    padding: 10%;
    margin-top: -8%;
} */
.project-tab #tabs{
    background: #007b5e;
    color: #eee;
}
.project-tab #tabs h6.section-title{
    color: #eee;
}
.project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #0062cc;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 3px solid !important;
    font-size: 16px;
    font-weight: bold;
}
.project-tab .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #0062cc;
    font-size: 16px;
    font-weight: 600;
}
.project-tab .nav-link:hover {
    border: none;
}
.project-tab thead{
    background: #f3f3f3;
    color: #333;
}

</style>

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">LEDGER ACCOUNTS </h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Accounts</span></li>
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
                    <h4 class="header-title float-left">LEDGER ACCOUNTS </h4>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.ledger_account.create') }}">Create New Account</a>
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">ALL</a>
                                <a class="nav-item nav-link active" id="nav-asset-tab" data-toggle="tab" href="#nav-asset" role="tab" aria-controls="nav-asset" aria-selected="false">ASSET</a>
                                <a class="nav-item nav-link" id="nav-liability-tab" data-toggle="tab" href="#nav-liability" role="tab" aria-controls="nav-liability" aria-selected="false">LIABILITY</a>
                                <a class="nav-item nav-link" id="nav-equity-tab" data-toggle="tab" href="#nav-equity" role="tab" aria-controls="nav-equity" aria-selected="false">EQUITY</a>
                                <a class="nav-item nav-link" id="nav-expenses-tab" data-toggle="tab" href="#nav-expenses" role="tab" aria-controls="nav-expenses" aria-selected="false">EXPENSES</a>
                                <a class="nav-item nav-link" id="nav-revenue-tab" data-toggle="tab" href="#nav-revenue" role="tab" aria-controls="nav-revenue" aria-selected="false">REVENUE</a>

                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th> CODE</th>
                                            <th>NAME</th>
                                            <th>SYSTEM NAME</th>
                                            <th>GROUP</th>
                                            <th>TYPE</th>
                                            <th>SYSTEM A/C</th>
                                            <th>BALANCE</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($ledger as $ledgers)
                                        <tr>
                                            <td>{{$ledgers->code}}</td>
                                            <td>{{$ledgers->name}}</td>
                                            <td>{{$ledgers->system_name}}</td>
                                            <td>{{$ledgers->ledgergroup->display_name}}</td>
                                            <td>{{$ledgers->ledgertype->types}}</td>
                                            <td></td>

                                            <td>{{$ledgers->closing_balance}}</td>
                                            <td>
                                                <a href="{{ route('admin.ledger_account.edit',$ledgers->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{ route('admin.ledger_account.show',$ledgers->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade show active" id="nav-asset" role="tabpanel" aria-labelledby="nav-asset-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th> CODE</th>
                                        <th>NAME</th>
                                        <th>SYSTEM NAME</th>
                                        <th>GROUP</th>
                                        <th>TYPE</th>
                                        <th>SYSTEM A/C</th>
                                        <th>BALANCE</th>
                                        <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                        @foreach($asset as $assets)
                                        <tr>
                                            <td>{{$assets->code}}</td>
                                            <td>{{$assets->name}}</td>
                                            <td>{{$assets->system_name}}</td>
                                            <td>{{$assets->ledgergroup->display_name}}</td>
                                            <td>{{$assets->ledgertype->types}}</td>
                                            <td></td>

                                            <td>{{$assets->closing_balance}}</td>
                                            <td>
                                                <a href="{{ route('admin.ledger_account.edit',$assets->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{ route('admin.ledger_account.show',$assets->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                      
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-liability" role="tabpanel" aria-labelledby="nav-liability-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th> CODE</th>
                                        <th>NAME</th>
                                        <th>SYSTEM NAME</th>
                                        <th>GROUP</th>
                                        <th>TYPE</th>
                                        <th>SYSTEM A/C</th>
                                        <th>BALANCE</th>
                                        <th>ACTIONS</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                     
                                        @foreach($liability as $liabilities)
                                        <tr>
                                            <td>{{$liabilities->code}}</td>
                                            <td>{{$liabilities->name}}</td>
                                            <td>{{$liabilities->system_name}}</td>
                                            <td>{{$liabilities->ledgergroup->display_name}}</td>
                                            <td>{{$liabilities->ledgertype->types}}</td>
                                            <td></td>

                                            <td>{{$liabilities->closing_balance}}</td>
                                            <td>
                                                <a href="{{ route('admin.ledger_account.edit',$liabilities->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{ route('admin.ledger_account.show',$liabilities->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-equity" role="tabpanel" aria-labelledby="nav-equity-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th> CODE</th>
                                        <th>NAME</th>
                                        <th>SYSTEM NAME</th>
                                        <th>GROUP</th>
                                        <th>TYPE</th>
                                        <th>SYSTEM A/C</th>
                                        <th>BALANCE</th>
                                        <th>ACTIONS</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                     
                                        @foreach($equity as $equities)
                                        <tr>
                                            <td>{{$equities->code}}</td>
                                            <td>{{$equities->name}}</td>
                                            <td>{{$equities->system_name}}</td>
                                            <td>{{$equities->ledgergroup->display_name}}</td>
                                            <td>{{$equities->ledgertype->types}}</td>
                                            <td></td>

                                            <td>{{$equities->closing_balance}}</td>
                                            <td>
                                                <a href="{{ route('admin.ledger_account.edit',$equities->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{ route('admin.ledger_account.show',$equities->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-expenses" role="tabpanel" aria-labelledby="nav-expenses-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th> CODE</th>
                                            <th>NAME</th>
                                            <th>SYSTEM NAME</th>
                                            <th>GROUP</th>
                                            <th>TYPE</th>
                                            <th>SYSTEM A/C</th>
                                            <th>BALANCE</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                        @foreach($expenses as $expens)
                                        <tr>
                                            <td>{{$expens->code}}</td>
                                            <td>{{$expens->name}}</td>
                                            <td>{{$expens->system_name}}</td>
                                            <td>{{$expens->ledgergroup->display_name}}</td>
                                            <td>{{$expens->ledgertype->types}}</td>
                                            <td></td>

                                            <td>{{$expens->closing_balance}}</td>
                                            <td>
                                                <a href="{{ route('admin.ledger_account.edit',$expens->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{ route('admin.ledger_account.show',$expens->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-revenue" role="tabpanel" aria-labelledby="nav-revenue-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th> CODE</th>
                                            <th>NAME</th>
                                            <th>SYSTEM NAME</th>
                                            <th>GROUP</th>
                                            <th>TYPE</th>
                                            <th>SYSTEM A/C</th>
                                            <th>BALANCE</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                        @foreach($revenue as $revenues)
                                        <tr>
                                            <td>{{$revenues->code}}</td>
                                            <td>{{$revenues->name}}</td>
                                            <td>{{$revenues->system_name}}</td>
                                            <td>{{$revenues->ledgergroup->display_name}}</td>
                                            <td>{{$revenues->ledgertype->types}}</td>
                                            <td></td>

                                            <td>{{$revenues->closing_balance}}</td>
                                            <td>
                                                <a href="{{ route('admin.ledger_account.edit',$revenues->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{ route('admin.ledger_account.show',$revenues->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-eye"></i></a>
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
        </section>


    
                     
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
        // if ($('#dataTable').length) {
        //     $('#dataTable').DataTable({
        //         responsive: true
        //     });
        // }

     </script>
     <script>
        $(function(){
          var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');

            $('.nav-tabs a').click(function (e) {
            $(this).tab('show');
            var scrollmem = $('body').scrollTop();
            window.location.hash = this.hash;
            $('html,body').scrollTop(scrollmem);
            });
        });
     </script>
@endsection