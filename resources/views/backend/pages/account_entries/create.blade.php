
@extends('backend.layouts.master')

@section('title')
New Journal Entry - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }

    #doc_table td{
    padding: 10px 20px;
   }

</style>
@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">New Journal Entry</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Journal Entry</span></li>
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
                    <h3 class="header-title"> Create New </h3>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{route('admin.account_entries.store')}}" method="POST" id="form"  data-parsley-validate>
                        @csrf
                      
                            <div class="form-group row">
                                <label  for="entry_date" class="col-sm-2 col-form-label" style="text-align: right">Date<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <div class="col-sm-4">
                                <input type="date" class="form-control" id="date" name="entry_date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  for="disburse_salary" class="col-sm-2 col-form-label" style="text-align: right">Origin Branch<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <div class="col-sm-4">
                                <!-- <input type="text" class="form-control" id="origin_branch" name="origin_branch" placeholder="Enter Salary to Disburse" required> -->
                                <select name="branch" id="branch" class="form-control" required>
                                    <option value="">Select Branch</option>
                                    @foreach($branches as $key=>$branch)
                                    <option value="{{$branch}}">{{$key}}</option>
                                   
                                   @endforeach
                                  
                                </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  for="remarks" class="col-sm-2 col-form-label" style="text-align: right">Description<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <div class="col-sm-5">
                                <textarea id="summernote" name="Description" class="form-control" placeholder="Enter Description" required></textarea> 
                                </div>
                            </div>
                           
                           <div class="form-group row">
                             <label  for="Debit" class="col-sm-2 col-form-label" style="text-align: right"><b>Debit</b><span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <div class="col-sm-10">
                                <div class="col-sm-8" style="display:flex;">
                                    <select name="branch1[]" id="branch1" class="form-control" required><option value="">Select Branch</option>
                                    @foreach($branches as $key=>$branch)
                                    <option value="{{$branch}}">{{$key}}</option>
                                   
                                    @endforeach
                                  
                                    </select> &emsp;
                                    <select name="account[]" id="debit_account" class="form-control" required><option value="">Select Debit Account</option>
                                    @foreach($account as $accounts)
                                    <option value="{{$accounts->id}}">{{$accounts->name}}--{{$accounts->system_name}}({{$accounts->ledger_type}})</option>
                                   
                                    @endforeach
                                  
                                    </select> &emsp;
                                    <input type="text" name="amount[]"  placeholder="Enter Debit Amount" class="form-control" required>
                                    <input type="hidden" name="type[]"  value="Debit">
                                </div>
                                <div class="col-sm-8" style="display:flex;">
                                
                                <div class="container1">
                                <a class="add_form_field" style="color:blue; cursor: pointer;">Add Debit Amount&nbsp; 
                                    <span style="font-size:16px; font-weight:bold;">+ </span>
                                </a>
                           
                                </div>
                                </div>
                                </div>


                                <!-- <input type="text", name="account_debits", id="account_debits", class="form-control"> -->

                            </div>

                            <div class="form-group row">
                             <label  for="Credit" class="col-sm-2 col-form-label" style="text-align: right"><b>Credit</b><span style="color:red; font-size: 18px;line-height:1">*</span></label>
                             <div class="col-sm-10">

                             <div class="col-sm-8" style="display:flex;">

                             <select name="branch1[]" id="branch1" class="form-control" required><option value="">Select Branch</option>
                                    @foreach($branches as $key=>$branch)
                                    <option value="{{$branch}}">{{$key}}</option>
                                   
                                   @endforeach
                                  
                                </select>&emsp;
                                <select name="account[]" id="credit_account" class="form-control" required><option value="">Select Credit Account</option>
                                    @foreach($account as $accounts)
                                    <option value="{{$accounts->id}}">{{$accounts->name}}--{{$accounts->system_name}}({{$accounts->ledger_type}})</option>
                                   
                                   @endforeach
                                  
                                </select>&emsp;
                                <input type="text" name="amount[]"  placeholder="Enter Credit Amount" class="form-control" required> 
                                <input type="hidden" name="type[]"  value="Credit">

                            </div>
                                <div class="col-sm-8" style="display:flex;">

                                <div class="container2">
                                <a class="add_form_field1" style="color:blue; cursor: pointer;">Add credit Amount&nbsp; 
                                    <span style="font-size:16px; font-weight:bold;">+ </span>
                                </a>
                           
                                </div>
                                </div>

                                </div>
                            </div>
                            



                                           
                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary  pr-4 pl-4"><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;Save Voucher </button>
                        <a class="btn btn-danger" href="{{route('admin.account_entries.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
                        </div>
                        <br>
                        <br>
                        <span style="color:white;background-color: coral;font-size: 150%;"><i class="fa fa-info-circle" aria-hidden="true"></i> &emsp; Sum of debits must be equal to sum of credits. (DEBITS == CREDITS)</span>

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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

<script src="jquery.js"></script>
<script src="parsley.min.js"></script>


<script>
  $('#form').parsley();
</script>
<script>
$(document).ready(function() {
    var branch='';
    var account='';
    var amount='';
    var branch1='';
    var account1='';
    var amount1='';
    var max_fields = 10;
    var wrapper = $(".container1");
    var wrapper1 = $(".container2");

    var add_button = $(".add_form_field");
    var add_button1 = $(".add_form_field1");
    
        branch =`<select name="branch1[]" id="branch1" class="form-control" required><option value="">Select Branch</option>
                                    @foreach($branches as $key=>$branch)
                                    <option value="{{$branch}}">{{$key}}</option>
                                   
                                   @endforeach
                                  
                                </select>`;

        account= `<select name="account[]" id="debit_account" class="form-control" required><option value="">Select Debit Account</option>
                                    @foreach($account as $accounts)
                                    <option value="{{$accounts->id}}">{{$accounts->name}}--{{$accounts->system_name}}({{$accounts->ledger_type}})</option>
                                   
                                   @endforeach
                                  
                                </select>`;   
        amount=  `<input type="text" name="amount[]"  placeholder="Enter Debit Amount" class="form-control" required> `;    
        
        type= `<input type="hidden" name="type[]"  value="Debit">`;
   
        branch1 =`<select name="branch1[]" id="branch1" class="form-control" required><option value="">Select Branch</option>
                                    @foreach($branches as $key=>$branch)
                                    <option value="{{$branch}}">{{$key}}</option>
                                   
                                   @endforeach
                                  
                                </select>`;

        account1= `<select name="account[]" id="credit_account" class="form-control" required><option value="">Select Credit Account</option>
                                    @foreach($account as $accounts)
                                    <option value="{{$accounts->id}}">{{$accounts->name}}--{{$accounts->system_name}}({{$accounts->ledger_type}})</option>
                                   
                                   @endforeach
                                  
                                </select>`;   
        amount1=  `<input type="text" name="amount[]"  placeholder="Enter Credit Amount" class="form-control" required> `;  
        type1= `<input type="hidden" name="type[]"  value="Credit">`;               
    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();

        if (x < max_fields) {
            x++;

            $(wrapper).append('<div style="display:flex;">'+branch+' &emsp;' + account+' &emsp;'+ amount+'&emsp;'+ type+' &emsp;'+'<a href="#" class="delete">Delete</a>'+'</div>'); //add input box
            
        } else {
            alert('You Reached the limits')
        }
        
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })

    $(add_button1).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            // $(wrapper).append('<div><input type="text" name=""  placeholder=""> &emsp;<input type="text" name="" >&emsp;<input type="text" name=""  placeholder=""> &emsp; <a href="#" class="delete">Delete</a></div>'); //add input box
            $(wrapper1).append('<div style="display:flex;">'+branch1+' &emsp;' + account1+' &emsp;'+ amount1+'&emsp;'+ type1+' &emsp;'+'<a href="#" class="delete">Delete</a>'+'</div>'); //add input box

        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper1).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});

</script>

@endsection