
@extends('backend.layouts.master')

@section('title')
Members Create - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }

    .switch {
	position: relative;
	display: block;
	vertical-align: top;
	width: 100px;
	height: 30px;
	padding: 3px;
	margin: 0 10px 10px 0;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
	border-radius: 18px;
	box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
	cursor: pointer;
	box-sizing:content-box;
}
.switch-input {
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0;
	box-sizing:content-box;
}
.switch-label {
	position: relative;
	display: block;
	height: inherit;
	font-size: 10px;
	text-transform: uppercase;
	background: #eceeef;
	border-radius: inherit;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
	box-sizing:content-box;
}
.switch-label:before, .switch-label:after {
	position: absolute;
	top: 50%;
	margin-top: -.5em;
	line-height: 1;
	-webkit-transition: inherit;
	-moz-transition: inherit;
	-o-transition: inherit;
	transition: inherit;
	box-sizing:content-box;
}
.switch-label:before {
	content: attr(data-off);
	right: 11px;
	color: #aaaaaa;
	text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
	content: attr(data-on);
	left: 11px;
	color: #FFFFFF;
	text-shadow: 0 1px rgba(0, 0, 0, 0.2);
	opacity: 0;
}
.switch-input:checked ~ .switch-label {
	background: #E1B42B;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
	opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
	opacity: 1;
}
.switch-handle {
	position: absolute;
	top: 4px;
	left: 4px;
	width: 28px;
	height: 28px;
	background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
	background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
	border-radius: 100%;
	box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
}
.switch-handle:before {
	content: "";
	position: absolute;
	top: 50%;
	left: 50%;
	margin: -6px 0 0 -6px;
	width: 12px;
	height: 12px;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
	border-radius: 6px;
	box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
}
.switch-input:checked ~ .switch-handle {
	left: 74px;
	box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}
 
/* Transition
========================== */
.switch-label, .switch-handle {
	transition: All 0.3s ease;
	-webkit-transition: All 0.3s ease;
	-moz-transition: All 0.3s ease;
	-o-transition: All 0.3s ease;
}

</style>
@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Members Management</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Members Payment/Share</span></li>
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
                    <h3 class="header-title">Members Payment/Share</h3>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.members_payment.store') }}" method="POST" id="form" data-parsley-validate>
                    @csrf


                        <hr>
                        <h4 class="header-title"  style="text-align:center;">Fees/Settings Details</h4>  
                        <div class="form-row">
                            <div class="form-group col-md-4 ">
                                <label for="member_id">Member Name<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="member_id" id="member_id" class="form-control" required>
                                    <option value=""></option>

                                    @foreach($member as $members)
                                    <option value="{{$members->member_id}}" >{{$members->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label  for="member_fees">Member Fees(If any)<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="member_fees" name="member_fees" placeholder="0" required>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="share_allotted_from">Share Allotted From<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="share_allotted_from" id="share_allotted_from" class="form-control" required>
                                    <option value=""></option>

                                    @foreach($director as $directors)
                                    <option value="{{$directors->id}}" >{{$directors->director_name}} - {{$directors->share }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label  for="shares">No. Of Shares<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="shares" name="shares" placeholder="1" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label  for="share_amount">Share Amount<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="share_amount" name="share_amount" placeholder="0" readonly>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="payment_by">Payment By<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="payment_by" id="payment_by" class="form-control" required>
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="NEFT">NEFT</option>
                                    <option value="UPI">UPI</option>
                                </select>
                            </div>
                            
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="remarks">Remarks</label>
                                <textarea id="remarks" name="remarks" class="form-control" placeholder="Remarks"></textarea> 
                            </div>
                            <div class="form-group col-md-6">
                                <label  for="total_amount">Total Amount<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="total_amount" name="total_amount" placeholder="0" readonly>
                            </div>
                        </div>


                        <!-- <h4 class="header-title">Extra Settings</h4>
                        <label  for="sms">SMS</label>
                        <div class="form-group row">
                      
                            <label class="switch">
                                <input class="switch-input" type="checkbox" />
                                <span class="switch-label" data-on="On" data-off="Off"></span> 
                                <span class="switch-handle"></span> 
                            </label>  
                        </div> -->

                       
                        
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; Make Payment </button>
                        <a class="btn btn-danger" href="{{route('admin.members_payment.create')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
                   
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

<script src="jquery.js"></script>
<script src="parsley.min.js"></script>

<script>


      
    $(document).ready(function(){
        $("#shares").change(function(){
            var share_no=$(this).val();
            //console.log(id);              
            $("#share_amount").val(share_no*10);

        })
    })

    $(document).ready(function(){
        $("#shares, #member_fees").change(function(){
            var member_fee=$("#member_fees").val();
            var share_amt=$("#share_amount").val();
            console.log(member_fee);              
            $("#total_amount").val((+member_fee)+(+share_amt));

        })
    })

</script>

<script>
 
</script>
@endsection