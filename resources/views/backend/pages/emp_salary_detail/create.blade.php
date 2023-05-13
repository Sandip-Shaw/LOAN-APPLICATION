
@extends('backend.layouts.master')

@section('title')
HR Management Create - Admin Panel
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
                <h4 class="page-title pull-left">Salary Master</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Create Salary Master</span></li>
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
                    <!-- <h4 class="header-title"> Create Employees </h4> -->
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.salary_details.store') }}" method="POST" id="form" enctype="multipart/form-data" data-parsley-validate>
                        @csrf


                        <div class="form-row">
                            
                            
                            <div class="form-group col-md-6 ">
                                <label for="employee_id">Ecmployee Code & Name</label>
                                <select name="employee_id" id="employee_id" class="form-control selectpicker" data-live-search="true" >
                                <option value="">Select Employee</option>
                                    @foreach($hrmanagements as $hrmanagement)
                                    <option value="{{$hrmanagement->hrmanagement_id}}" >{{$hrmanagement->emp_code}}-{{$hrmanagement->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr>
                        <h4 class="header-title"> Employee Salary Details </h4>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="basic">Basic<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="basic" name="basic" placeholder="Enter Amount" required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="others">Others<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="others" name="others" value="0" placeholder="Enter Amount"required>
                            </div>
                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="HRA">HRA<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="HRA" name="HRA" value="0" placeholder="Enter Amount" required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="fuel">Fuel<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="fuel" name="fuel" value="0" placeholder="Enter Amount">
                            </div>
                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="DA">DA<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="DA" name="DA"  value="0"placeholder="Enter Amount" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="allowance">Allowance<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="allowance" name="allowance" value="0" placeholder="Enter Amount" required>
                            </div>
                           
                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="TA">TA<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="TA" name="TA" value="0" placeholder="Enter Amount" required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="gross_pay">Gross Pay <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="gross_pay" name="gross_pay" readonly>
                            </div>
                           
                           
                        </div>
                        <hr>
                        <div class="form-row">
                            
                            <div class="form-group col-md-6 ">
                                <label for="PF">PF <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="PF" name="PF" value="0" placeholder="Enter Amount">
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="ESI">ESI <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="ESI" name="ESI" value="0" placeholder="Enter Amount">
                            </div>
                           
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group col-md-6 ">
                                <label for="net_pay">Net Pay <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="net_pay" name="net_pay" readonly>
                            </div>
                           
                           
                        </div>
                
                      

                                           
                        <div style="text-align:center;">
                        <button type="submit"  class="btn btn-primary  pr-4 pl-4"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;Create</button>
                        <a class="btn btn-danger" href="{{route('admin.salary_details.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel </a>
                        <button type="reset" class="btn btn-warning  pr-4 pl-4"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Clear </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />


<!-- <script src="jquery.js"></script> -->
<script src="parsley.min.js"></script>

<script>
    // $(document).ready(function() {
        // $('.select2').select2();
        $(function() {
         $('.selectpicker').selectpicker();
        });
    // })

$(document).ready(function() {
    var gross_pay='';
    $("#basic, #others, #HRA, #fuel,#DA, #allowance,#TA,#PF, #ESI").keyup(function(){
    if($('#basic').val() != 0 || $('#basic').val() != null || $('#others').val() != 0 || $('#others').val() != null || $('#HRA').val() != 0 || $('#HRA').val() != null ||
    $('#fuel').val() != 0 || $('#fuel').val() != null || $('#DA').val() != 0 || $('#DA').val() != null || $('#allowance').val() != 0 || $('#allowance').val() != null || $('#TA').val() != 0 || $('#TA').val() != null){
        var total = (+$('#basic').val()) + (+$('#others').val()) +  (+$('#HRA').val()) + (+$('#fuel').val()) +  (+$('#DA').val()) +  (+$('#allowance').val())+  (+$('#TA').val());
    }
    gross_pay= $('#gross_pay').val(total);

});
$("#PF, #ESI").keyup(function(){
//    console.log(gross_pay);
    
    if($('#PF').val() != 0 || $('#PF').val() != null || $('#ESI').val() != 0 || $('#ESI').val() != null){
        var total_sub = ($('#gross_pay').val()) - ($('#PF').val()) - (+$('#ESI').val());
        console.log(total_sub);
    }
    $('#net_pay').val(total_sub);
});
});
</script>




@endsection