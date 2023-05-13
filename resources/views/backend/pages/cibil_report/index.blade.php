
@extends('backend.layouts.master')

@section('title')
Cibil Report- Admin Panel
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
                <h4 class="page-title pull-left">Cibil Report </h4>
                <ul class="breadcrumbs pull-left">

                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span> Download Cibil Report</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->
<form action="{{route('admin.cibil_report.store')}}" method="post">
    @csrf
<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-md-12">
            <div class="card" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <!-- <h4 class="header-title"> Create Schemes </h4> -->
                    @include('backend.layouts.partials.messages')
                    
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="text-align: center" for="" ><b> Reported Date </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-5">
                                    <input type="date" class="form-control" id="reported_date" name="reported_date"  value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                    
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="text-align: center" for="" ><b> Format Type</b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-5">
                                    <!-- <input type="text" class="form-control" id="format_type" name="format_type"  required> -->
                                    <select name="format_type" id="format_type" class="form-control">
                                        <option value="">Select Format Type</option>
                                        <option value="Crif Highmark">Crif Highmark</option>
                                        <option value="Crif Highpatch">Crif Highpatch</option>


                                      
                                    </select>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="text-align: center" for="" ><b>Account Status</b></label>
                            
                                <div class="col-sm-5">
                                    <!-- <input type="text" class="form-control" id="format_type" name="format_type"  required> -->
                                    <select name="account_status" id="account_status" class="form-control">
                                        <option value="Active">Active</option>
                                        <option value="Closed">Closed</option>
                                        <option value="Fore Close">Fore Close</option>

                                      
                                    </select>
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="text-align: center" for="" ><b>Account Type</b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-5">
                                    <!-- <input type="text" class="form-control" id="format_type" name="format_type"  required> -->
                                    <select name="account_type" id="account_type" class="form-control">
                                        <option value="Loan">Loan</option>
                                        <option value="Other Loan">Other Loan</option>                                    
                                    </select>
                                </div>
                                
                            </div>
                            <div style="text-align: center">
                                <button type="submit" class="btn btn-primary  pr-4 pl-4 btn-sm" ><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;submit</button>
                                <a class="btn btn-danger btn-sm" href=""><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>

                            </div>
   
                </div>
            </div>
        </div>
        

                                 
    </div>
</div>
</form>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />



<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>

<script>
  $('#form').parsley();
</script>

<script>

$(document).ready(function(){
    $("#export").click(function(){
      
        var reported_date =$("#reported_date").val();
        var  format_type=$("#format_type").find(":selected").val();
        var account_status =$("#account_status").find(":selected").val();
        var account_type =$("#account_type").find(":selected").val();



        //console.log(month_year);
        $("#export").attr("href","./salary_report_export/"+reported_date+"/"+format_type+"/"+account_status+"/"+account_type);

    })

    $("#pdf_export").click(function(){
        
        var reported_date =$("#reported_date").val();
        var format_type =$("#format_type").find(":selected").val();
        var account_status =$("#account_status").find(":selected").val();
        var account_type =$("#account_type").find(":selected").val();


        $("#pdf_export").attr("href","./salary_report_exportPdf/"+month_year+"/"+branch);

    })
})

</script>

@endsection
