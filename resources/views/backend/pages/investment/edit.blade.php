
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
                <h4 class="page-title pull-left">Investment Schemes</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Edit Schemes</span></li>
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
                    <h4 class="header-title"> Edit Investment Schemes </h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.investment_scheme.update',$investment->id) }}" method="POST" id="form" data-parsley-validate>
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="schema_name">Scheme Name<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="scheme_name" name="scheme_name" value="{{$investment->scheme_name}}" required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="Schema_code">Scheme Code<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="scheme_code" name="scheme_code" value="{{$investment->scheme_code}}" required>
                            </div>
                           
                        </div>

                        <div class="form-row">
                            
                            <div class="form-group col-md-6 ">
                                <label for="min_amt">Minimum  Amount(INR)<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="min_amt" name="min_amt" value="{{$investment->min_amt}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="int_rate"> Interest Rate (%)<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="int_rate" name="int_rate" value="{{$investment->int_rate}}" required>
                            </div>
                            
                        </div>
                     

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="term">Term<span style="color:red; font-size: 18px;line-height:1">*</span></label> 
                               
                                <select name="term" id="term" class="form-control" required>
                                <option value="">Choose One</option>

                                    <option value="1 Months"{{$investment->term=='1 Months'?'selected':''}}>1 Month</option>
                                    <option value="3 Months"{{$investment->term=='3 Months'?'selected':''}}>3 Months</option>
                                    <option value="6 Months"{{$investment->term=='6 Months'?'selected':''}}>6 Months</option>
                                    <option value="9 Months"{{$investment->term=='9 Months'?'selected':''}}>9 Months</option>
                                    <option value="12 Months"{{$investment->term=='12 Months'?'selected':''}}>12 Months</option>
                                    <option value="18 Months"{{$investment->term=='18 Months'?'selected':''}}>18 Months</option>
                                    <option value="2 Years"{{$investment->term=='2 Years'?'selected':''}}>2 Years</option>
                                    <option value="3 Years"{{$investment->term=='3 Years'?'selected':''}}>3 Years</option>
                                    <option value="5 Years"{{$investment->term=='5 Years'?'selected':''}}>5 Years</option>
                                    <option value="10 Years"{{$investment->term=='10 Years'?'selected':''}}>10 Years</option>
                                  
                                   
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pay_mode">Interest Pay Mode<span style="color:red; font-size: 18px;line-height:1">*</span></label> 
                               
                                <select name="int_pay_mode" id="int_pay_mode" class="form-control" required>
                                <option value="">Choose One</option>

                                    <option value="Monthly"{{$investment->int_pay_mode=='Monthly'?'selected':''}}>Monthly</option>
                                    <option value="Yearly"{{$investment->int_pay_mode=='Yearly'?'selected':''}}>Yearly</option>
                                   
                                </select>
                            </div>

                           
                            

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="mature_amt">Fore closed Charge (if any)</label>
                                <input type="text" class="form-control" id="fore_close_chrge" name="fore_close_chrge" value="{{$investment->fore_close_chrge}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <p><b> Active</b><span style="color:red; font-size: 18px;line-height:1">*</span></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="active" value="yes" <?php if($investment->active=="yes") {echo "checked";} ?>>
                                    <label class="form-check-label" for="active">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="active" value="no" <?php if($investment->active=="no") {echo "checked";} ?> required>
                                    <label class="form-check-label" for="active">No</label>
                                </div>
                            </div>  
                           

                        </div>

                                               

                        
                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary  pr-4 pl-4"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Update Investment Scheme</button>
                        <a class="btn btn-danger" href="{{route('admin.investment_scheme.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
                        <!-- <button type="reset" class="btn btn-warning  pr-4 pl-4">Reset </button> -->
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
