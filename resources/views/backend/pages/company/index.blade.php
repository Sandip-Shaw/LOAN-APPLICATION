
@extends('backend.layouts.master')

@section('title')
Profile - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
   
@endsection
<style>
    .editBtn{
        position: absolute;
        top: 10px;
        right: 100px;
        z-index: 100;
    } 
    a{
        text-decoration: none !important;
    }
    .table td, .table th {
    padding: 1rem !important;
    }
    .font-weight-boldd {
    font-weight: 500!important;
}
@media screen and (max-width: 433px) {
    table.dataTable tbody tr {
    background-color: #ffffff;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}
}

 </style>

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Company Profile</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Company Profile</span></li>
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
    <div class="row" style="margin-top: 31px !important;">
        <!-- data table start -->
        
        <div class="col-md-8 mb-4" >
            <div class="box">
                <div class="box-body">
                    <!-- <h4 class="header-title float-left">Blogs List</h4> -->
                    <!-- <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.company.create') }}">Create New Profile</a>
                    </p> -->
                    @foreach ($profile as $profiles)
                   

                    <div class="pull-right editBtn">
                    <a class="btn btn-default btn-xs" onclick="block_ui()" href="{{ route('admin.company.edit',$profiles->id) }}">
                        <i class="fa fa-pencil"></i></a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class=col-md-11>
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-details" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                            <tbody>
                          
                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;"> Company Website</td>
                                    <td> 
                                    {{ $profiles->company_website }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;"> Company Name</td>
                                    <td> 
                                    {{ $profiles->company_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Short Name</td>
                                    <td> 
                                    {{ $profiles->short_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Company Email</td>
                                    <td> 
                                    {{ $profiles->email }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Mobile Number</td>
                                    <td> 
                                    {{ $profiles->mobile_no }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Landline Number</td>
                                    <td> 
                                    {{ $profiles->landline_no }}
                                    </td>
                                </tr>

                      

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">About Company</td>
                                    <td> 
                                    {{ $profiles->about_company }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Address</td>
                                    <td> 
                                    {{ $profiles->address }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">City</td>
                                    <td> 
                                    {{ $profiles->city }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">State</td>
                                    <td> 
                                    {{ $profiles->state }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Pin code</td>
                                    <td> 
                                    {{ $profiles->pincode }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Country</td>
                                    <td> 
                                    {{ $profiles->contry }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Category</td>
                                    <td> 
                                    {{ $profiles->category }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Company Class</td>
                                    <td> 
                                    {{ $profiles->company_class }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">CIN Number</td>
                                    <td> 
                                    {{ $profiles->cin_no }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">PAN Number</td>
                                    <td> 
                                    {{ $profiles->pan_no }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">TAN Number</td>
                                    <td> 
                                    {{ $profiles->tan_no }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">GST Number</td>
                                    <td> 
                                    {{ $profiles->gst_no }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Incorporation Date</td>
                                    <td> 
                                    {{ $profiles->incorporation_date }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Incorporation State</td>
                                    <td> 
                                    {{ $profiles->incorporation_state }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Incorporation Country</td>
                                    <td> 
                                    {{ $profiles->incorporation_country }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Authorized Capital</td>
                                    <td> 
                                    {{ $profiles->authorized_capital }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-boldd" style="width: 250px;">Paid-up Capital</td>
                                    <td> 
                                    {{ $profiles->paid_ip_capital }}
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

        <!-- data table end -->
        <div class="col-md-4" >
            <div class="box" >
                <div class="box-body" style="">
                    <div class="card" style="color:#fff; border-top: 2px solid #8914fe;  box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07); height:fit-content;">
                        <div class="card-body">
                            <div class="d-flex justify-content-start " style="color: #000; align-items: center; border-bottom: 1px solid lightgray;">
                              <i class="fa fa-image " style="color: black; margin-top: -10px;margin-right: 10px;"></i>
                              <h5>Logo</h5>
                            </div>
                            <div class="d-flex justify-content-center my-2">
                                <img src="{{ asset('/logo.png') }}" height="1rem" width="100%" alt="">
                            </div>
                            <div class="d-flex  flex-column justify-content-center my-2" >
                                <a href="" class="text-center mb-1">Remove Logo</a>
                                <button class="btn btn-primary">Change Logo</button>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4" style="color:#fff; border-top: 2px solid #8914fe;  box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07); height:fit-content;">
                        <div class="card-body">
                            <div class="d-flex justify-content-start " style="color: #000; align-items: center; border-bottom: 1px solid lightgray;">
                              <i class="fa fa-image " style="color: black; margin-top: -10px;margin-right: 10px;"></i>
                              <h5> Favicon</h5>
                            </div>
                            <div class="d-flex justify-content-center my-2">
                                <img src="{{ asset('/logo.png') }}" height="1rem" width="100%" alt="">
                            </div>
                            <div class="d-flex  flex-column justify-content-center my-2" >
                                <a href="" class="text-center mb-1">Remove Logo</a>
                                <button class="btn btn-primary">Change Logo</button>
                            </div>
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