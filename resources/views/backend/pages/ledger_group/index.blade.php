
@extends('backend.layouts.master')

@section('title')
LEDGER GROUPS  - Admin Panel
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
                <h4 class="page-title pull-left">LEDGER GROUPS </h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Groups</span></li>
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
                    <h4 class="header-title float-left">LEDGER GROUPS </h4>
                    <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.ledger_group.create') }}">Create New Group</a>
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
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">ALL</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">ASSET</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">LIABILITY</a>
                                <a class="nav-item nav-link" id="nav-contact1-tab" data-toggle="tab" href="#nav-contact1" role="tab" aria-controls="nav-contact1" aria-selected="false">EQUITY</a>
                                <a class="nav-item nav-link" id="nav-contact2-tab" data-toggle="tab" href="#nav-contact2" role="tab" aria-controls="nav-contact2" aria-selected="false">EXPENSES</a>
                                <a class="nav-item nav-link" id="nav-contact3-tab" data-toggle="tab" href="#nav-contact3" role="tab" aria-controls="nav-contact3" aria-selected="false">REVENUE</a>

                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th> Name</th>
                                            <th>SYSTEM NAME</th>
                                            <th>TYPE</th>
                                            <th>SYSTEM GROUP</th>
                                            <th>ACCOUNTS</th>
                                            <th>BALANCE</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($groups as $group)
                                        <tr>
                                            <td>{{$group->display_name}}</td>
                                            <td>{{$group->system_name}}</td>
                                            <td>{{$group->ledgergrp->types}}</td>
                                            <td><button type="button">{{$group->system_group}}</button></td>
                                            <td>{{$group->ledgeraccount->count()}}</td>
                                            <td>{{$group->ledgeraccount->sum('closing_balance')}}</td>
                                            <td>
                                                <a href="{{ route('admin.ledger_group.edit',$group->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{ route('admin.ledger_group.show',$group->id)}}" data-toggle="tooltip"  class="btn"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                    <tr>
                                            <th> Name</th>
                                            <th>SYSTEM NAME</th>
                                            <th>TYPE</th>
                                            <th>SYSTEM GROUP</th>
                                            <th>ACCOUNTS</th>
                                            <th>BALANCE</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($assets as $asset)
                                        <tr>
                                            <td>{{$asset->display_name}}</td>
                                            <td>{{$asset->system_name}}</td>
                                            <td>{{$asset->ledgergrp->types}}</td>
                                            <td><button type="button">{{$asset->system_group}}</button></td>
                                            <td>{{$asset->ledgeraccount->count()}}</td>
                                            <td>{{$asset->ledgeraccount->sum('closing_balance')}}</td>
                                            <td>
                                                <a href="" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="" data-toggle="tooltip"  class="btn"><i class="fa fa-eye"></i></a>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                    <tr>
                                            <th> Name</th>
                                            <th>SYSTEM NAME</th>
                                            <th>TYPE</th>
                                            <th>SYSTEM GROUP</th>
                                            <th>ACCOUNTS</th>
                                            <th>BALANCE</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($liabilitys as $liability)
                                        <tr>
                                            <td>{{$liability->display_name}}</td>
                                            <td>{{$liability->system_name}}</td>
                                            <td>{{$liability->ledgergrp->types}}</td>
                                            <td><button type="button">{{$liability->system_group}}</button></td>
                                            <td>{{$liability->ledgeraccount->count()}}</td>
                                            <td>{{$liability->ledgeraccount->sum('closing_balance')}}</td>
                                            <td>
                                                <a href="" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="" data-toggle="tooltip"  class="btn"><i class="fa fa-eye"></i></a>
                                            </td>

                                        </tr>
                                     @endforeach     
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-contact1" role="tabpanel" aria-labelledby="nav-contact1-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                    <tr>
                                            <th> Name</th>
                                            <th>SYSTEM NAME</th>
                                            <th>TYPE</th>
                                            <th>SYSTEM GROUP</th>
                                            <th>ACCOUNTS</th>
                                            <th>BALANCE</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($equitys as $equity)
                                        <tr>
                                            <td>{{$equity->display_name}}</td>
                                            <td>{{$equity->system_name}}</td>
                                            <td>{{$equity->ledgergrp->types}}</td>
                                            <td><button type="button">{{$equity->system_group}}</button></td>
                                            <td>{{$equity->ledgeraccount->count()}}</td>
                                            <td>{{$equity->ledgeraccount->sum('closing_balance')}}</td>
                                            <td>
                                                <a href="" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="" data-toggle="tooltip"  class="btn"><i class="fa fa-eye"></i></a>
                                            </td>

                                        </tr>
                                       @endforeach   
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-contact2" role="tabpanel" aria-labelledby="nav-contact2-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                    <tr>
                                            <th> Name</th>
                                            <th>SYSTEM NAME</th>
                                            <th>TYPE</th>
                                            <th>SYSTEM GROUP</th>
                                            <th>ACCOUNTS</th>
                                            <th>BALANCE</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($expensess as $expense)
                                    
                                        <tr>
                                            <td>{{$expense->display_name}}</td>
                                            <td>{{$expense->system_name}}</td>
                                            <td>{{$expense->ledgergrp->types}}</td>
                                            <td><button type="button">{{$expense->system_group}}</button></td>
                                            <td>{{$expense->ledgeraccount->count()}}</td>
                                            <td>{{$expense->ledgeraccount->sum('closing_balance')}}</td>
                                            <td>
                                                <a href="" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="" data-toggle="tooltip"  class="btn"><i class="fa fa-eye"></i></a>
                                            </td>

                                        </tr>
                                      @endforeach    
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-contact3" role="tabpanel" aria-labelledby="nav-contact3-tab">
                                <table class="table" cellspacing="0">
                                    <thead>
                                    <tr>
                                            <th> Name</th>
                                            <th>SYSTEM NAME</th>
                                            <th>TYPE</th>
                                            <th>SYSTEM GROUP</th>
                                            <th>ACCOUNTS</th>
                                            <th>BALANCE</th>
                                            <th>ACTIONS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($revenues as $revenue)
                                    
                                        <tr>
                                            <td>{{$revenue->display_name}}</td>
                                            <td>{{$revenue->system_name}}</td>
                                            <td>{{$revenue->ledgergrp->types}}</td>
                                            <td><button type="button">{{$revenue->system_group}}</button></td>
                                            <td>{{$revenue->ledgeraccount->count()}}</td>
                                            <td>{{$revenue->ledgeraccount->sum('closing_balance')}}</td>
                                            <td>
                                                <a href="" data-toggle="tooltip"  class="btn"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="" data-toggle="tooltip"  class="btn"><i class="fa fa-eye"></i></a>
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