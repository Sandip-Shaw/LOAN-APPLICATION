
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
                <h4 class="page-title pull-left">Employee Leave</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Update Employees Leave</span></li>
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
                    
                    <form action="{{ route('admin.employee_leave.update', $leave->id) }}" method="POST" id="form"  data-parsley-validate>
                        @csrf
                        @method('PUT')


                        <div class="form-row">
                            
                            <div class="form-group col-md-6 ">
                                <label for="ifsc_code">Financial Year</label>
                                <!-- <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="Enter IFSC Code" > -->
                                <select id="financialYear" class="form-control" name="financial_year" value="{{$leave->financial_year}}"></select>
                                <!-- <select name='financial_year'></select> -->
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="branch">Branch</label>
                                <!-- <input type="text" class="form-control" id="bank_branch_name" name="bank_branch_name" placeholder="Enter Bank Branch Name" data-parsley-maxlength="12"> -->
                                <select name="branch" id="branch" class="form-control" required>
                                    <option value="">Choose Branch</option>
                                    @foreach($branches as $key=>$branch)
                                    <option value="{{$branch}}" @php if($leave->branch_id==$branch) echo "selected";  @endphp>{{$key}}</option>
                                   
                                   @endforeach
                                   
                                   
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cl">CL<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="cl" name="cl" value="{{$leave->cl}}" placeholder="Enter No of CL" required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="sl">SL<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="sl" name="sl" value="{{$leave->sl}}" placeholder="Enter No of SL"required>
                            </div>
                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="el">EL<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="el" name="el" value="{{$leave->el}}" placeholder="Enter No of EL" required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="lop">LOP <span>(If none, write 0)</span></label>
                                <input type="text" class="form-control" id="lop" name="lop"  value="{{$leave->lop}}" placeholder="Enter No of LOP">
                            </div>
                           
                        </div>
                
                      

                                           
                        <div style="text-align:center;">
                        <button type="submit"  class="btn btn-primary  pr-4 pl-4">Update </button>
                        <a class="btn btn-danger" href="{{route('admin.employee_leave.index')}}">Cancel </a>
                        <!-- <button type="reset" class="btn btn-warning  pr-4 pl-4">Clear </button> -->
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
</script>

<script>
//   $('#form').parsley();
var yearsLength = 10;
var currentYear = new Date().getFullYear();
for(var i = 0; i < 10; i++){
  var next = currentYear+1;
  var year = currentYear + '-' + next.toString().slice(-2);
  $('#financialYear').append(new Option(year, year));
  currentYear++;
}
</script>

@endsection