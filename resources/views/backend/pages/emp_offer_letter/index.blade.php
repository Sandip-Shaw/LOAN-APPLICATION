
@extends('backend.layouts.master')

@section('title')
EMI Payout - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Offer Letter  </h4>
                <ul class="breadcrumbs pull-left">

                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Issue Offer Letter</span></li>
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
        <div class="col-md-10">
            <div class="card" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <!-- <h4 class="header-title"> Create Schemes </h4> -->
                    @include('backend.layouts.partials.messages')
                    
    
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b> Employee Code & Name</b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <!-- <input type="text" class="form-control" id="designation_name" name="designation_name"  required> -->
                                <select name="employee_id" id="employee_pdf" class="form-control selectpicker" data-live-search="true" >
                                <option value="">Select Employee</option>
                                    @foreach($hrmanagements as $hrmanagement)
                                    <option value="{{$hrmanagement->hrmanagement_id}}" >{{$hrmanagement->emp_code}}-{{$hrmanagement->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

 

                            <div style="text-align:center;">
                                <button type="button" id="print" class="btn btn-primary  pr-4 pl-4" ><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print</button>
                               
                            </div>
                           
          
                </div>
            </div>
        </div>
        

                                 
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />



<script>
    // $(document).ready(function() {
    //     $('.select2').select2();
    // })
    $(function() {
         $('.selectpicker').selectpicker();
        });
</script>

<script>
//   $('#form').parsley();

$(document).ready(function(){
    $("#print").click(function(){
        var employee =$("#employee_pdf").val();
       
       console.log(employee);
        // var x = $("#print").attr("href","./bond_letter/"+employee);
        document.location.href=" ./offer_letter_pdf/"+employee;
    //    console.log(x);

    });
});
</script>

@endsection
