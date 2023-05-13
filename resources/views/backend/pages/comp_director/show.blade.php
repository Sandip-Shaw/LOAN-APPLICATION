
@extends('backend.layouts.master')

@section('title')
Director - Admin Panel
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
                <h4 class="page-title pull-left">Company's Director</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.comp_branch.index') }}">Company's Director</a></li>

                    <li><span>{{$director->director_name}}</span></li>
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
                    <a class="btn btn-default btn-xs" onclick="block_ui()" href="{{ route('admin.comp_director.edit',$director->id) }}">
                        <i class="fa fa-pencil"></i></a>
                    </div>
                 
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class=col-md-11>
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-details" style='border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);'>
                            <tbody>
             
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"> Designation</td>
                                    <td> 
                                 {{$director->designation}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"> Member</td>
                                    <td> @isset($director->memberdet->first_name)
                                    {{$director->memberdet->first_name}}
                                    @else

                                    @endisset
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Director Name</td>
                                    <td> 
                                    {{$director->director_name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">DIN Number</td>
                                    <td> 
                                    {{$director->din_no}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Appointment Date </td>
                                    <td> 
                                    {{$director->appointment_date}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Resignation Date</td>
                                    <td> 
                                    {{$director->resignation_date}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Total Share</td>
                                    <td> 
                                    {{$director->share}}
                                    </td>
                                </tr>

                      

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Image</td>
                                    <td> 
                                    @if(isset($director))
                                    <img src="{{asset('/images/directorImage/'.$director->image)}}" width="60%" class="img-thumbnail">
                                    @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Authorized Signatory</td>
                                    <td> 
                                    {{$director->authorized_signatory}}
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