
@extends('backend.layouts.master')

@section('title')
Investment Schemes - Admin Panel
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
                <h4 class="page-title pull-left">IP-ADDRESS</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>IP-ADDRESS</span></li>
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
                    <h4 class="header-title"> Create IP-ADDRESS </h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.ip-address.store') }}" method="POST" id="form" data-parsley-validate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="ip-address">IP ADDRESS Name<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="ip-address" name="ipaddress" placeholder="Enter ip-address" required>
                            </div>
                           <!-- <div class="form-group col-md-6 ">
                                <label for="Schema_code">Scheme Code<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="scheme_code" name="scheme_code" placeholder="Enter Scheme Code" required>
                            </div>-->
                           
                        </div>

                       <!-- <div class="form-row">
                            
                            <div class="form-group col-md-6 ">
                                <label for="min_amt">Minimum  Amount(INR)<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="min_amt" name="min_amt" placeholder="Enter Minimum  Amount(INR)" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="int_rate"> Interest Rate (%)<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="int_rate" name="int_rate" placeholder="Enter  Interest Rate (%)" required>
                            </div>
                            
                        </div>
                     

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="term">Term<span style="color:red; font-size: 18px;line-height:1">*</span></label> 
                               
                                <select name="term" id="term" class="form-control" required>
                                <option value="">Choose One</option>

                                    <option value="1 Months">1 Month</option>
                                    <option value="3 Months">3 Months</option>
                                    <option value="6 Months">6 Months</option>
                                    <option value="9 Months">9 Months</option>
                                    <option value="12 Months">12 Months</option>
                                    <option value="18 Months">18 Months</option>
                                    <option value="2 Years">2 Years</option>
                                    <option value="3 Years">3 Years</option>
                                    <option value="5 Years">5 Years</option>
                                    <option value="10 Years">10 Years</option>
                                  
                                   
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pay_mode">Interest Pay Mode<span style="color:red; font-size: 18px;line-height:1">*</span></label> 
                               
                                <select name="int_pay_mode" id="int_pay_mode" class="form-control" required>
                                <option value="">Choose One</option>

                                    <option value="Monthly">Monthly</option>
                                    <option value="Yearly">Yearly</option>
                                   
                                </select>
                            </div>

                           
                            

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="fore_close_chrge"> Fore closed Charge (if any)</label>
                                <input type="text" class="form-control" id="fore_close_chrge" name="fore_close_chrge" placeholder="Enter Fore closed Charge" required>
                            </div>
                            <div class="form-group col-md-6">
                                <p><b> Active</b><span style="color:red; font-size: 18px;line-height:1">*</span></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="active" value="yes">
                                    <label class="form-check-label" for="active">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="active" value="no" required>
                                    <label class="form-check-label" for="active">No</label>
                                </div>
                            </div>  
                           

                        </div>-->

                                               

                        
                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary  pr-4 pl-4"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;Submit</button>
                        <a class="btn btn-danger" href="{{route('admin.investment_scheme.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
                        <!--<button type="reset" class="btn btn-warning  pr-4 pl-4"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset Scheme</button>-->
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
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
@endsection
