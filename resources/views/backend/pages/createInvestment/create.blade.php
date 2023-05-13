
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
                <h4 class="page-title pull-left">Investment</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>New Investment</span></li>
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
                    <h4 class="header-title"> Create Investment </h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.create_investment.store') }}" method="POST" id="form" data-parsley-validate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="create_date">Date<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="create_date" name="create_date"  required>
                            </div>
                            
                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="member">Member Code & Name<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <!-- <input type="date" class="form-control" id="create_date" name="create_date"  required> -->
                                <select name="member" id="member" class="form-control selectpicker" data-live-search="true" required>
                                    <option value=""></option>

                                    @foreach($member as $members)
                                    <option value="{{$members->member_id}}" >{{$members->member_id_code}}-{{$members->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label  for="create_date">Member Name<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="member_name" name="member_name"  readonly>
                            </div>
                            
                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="create_date">Branch<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <!-- <input type="text" class="form-control" id="branch" name="branch"  required> -->
                                <select name="branch" id="branch" class="form-control" required>
                                    <option value="">Select Branch</option>
                                    @foreach($branches as $key=>$branch)
                                        <option value="{{$branch}}">{{$key}}</option>
                                    @endforeach
                                  
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label  for="create_date">Employee Code & Name<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <!-- <input type="date" class="form-control" id="create_date" name="create_date"  required> -->
                                <select name="employee" id="employee" class="form-control "  >
                                <option value="">Select Employee</option>
                                    @foreach($hrmanagements as $hrmanagement)
                                    <option value="{{$hrmanagement->hrmanagement_id}}" >{{$hrmanagement->emp_code}}-{{$hrmanagement->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                           
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="scheme">Scheme<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <!-- <input type="text" class="form-control" id="branch" name="branch"  required> -->
                                <select name="scheme" id="scheme" class="form-control" required>
                                    <option value="">Select scheme</option>
                                    @foreach($inv_scheme as $key=>$scheme)
                                        <option value="{{$scheme}}">{{$key}}</option>
                                    @endforeach
                                  
                                </select>
                            </div>
                           
                            <div id="schema_details" style="width:450px; height: 100%;height: 250px; height: 250px;">

                            </div>
                           
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="scheme">Tenure Period<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <!-- <input type="text" class="form-control" id="tenure" name="tenure"  required> -->
                                <select name="tenure" id="tenure" class="form-control" required>
                                <option value="">Choose One</option>

                                    <option value="1">1 Month</option>
                                    <option value="3">3 Months</option>
                                    <option value="6">6 Months</option>
                                    <option value="9">9 Months</option>
                                    <option value="12">1 Year</option>
                                    <option value="24">2 Years</option>
                                    <option value="36">3 Years</option>
                                    <option value="60">5 Years</option>
                                    <option value="120">10 Years</option>
                                  
                                   
                                </select>
                            </div>
                 
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="scheme">Amount<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="amount" name="amount"  required>
                               
                            </div>
                 
                        </div>
                        <!-- <div class="form-group row">
                            
                                <div class="form-group col-sm-6">
                                <label for="" >Pay Mode :<span style="color:red; font-size: 18px;line-height:1">*</span></label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="paymode" id="Cash" value="Cash">
                                    <label class="form-check-label" for="paymode">Cash</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="paymode" id="Cheque" value="Cheque">
                                    <label class="form-check-label" for="paymode">Cheque</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="paymode" id="online_tr" value="online_tr" >
                                    <label class="form-check-label" for="paymode">Online Tr. </label>
                                </div>
                                
                                </div>
                            </div>

                            <div class="form-row" id="radio_btn">
                            
                            </div> -->
                            <input type="hidden" class="form-control" id="principal_amount" name="amt_approved"  >

                            <input type="hidden" class="form-control" id="interest_earned" name="interest_earned"  >

                            <input type="hidden" class="form-control" id="maturity_amount" name="maturity_amount"  >

                            <input type="hidden" class="form-control" id="int_per_tenure" name="int_per_tenure"  >

                            <input type="hidden" class="form-control" id="fore_close_charge" name="fore_close_charge"  >
                            <input type="hidden" class="form-control" id="int_pay_mode" name="int_pay_mode"  >
                            <input type="hidden" class="form-control" id="int_rate" name="int_rate"  >
                            <input type="hidden" class="form-control" id="tenure_val" name="tenure_val"  >
                       
                        <div style="text-align:center;">
                        <button type="button" id="calculate" class="btn btn-primary  pr-4 pl-4"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Calculate </button>
                        <a class="btn btn-danger" href="{{route('admin.create_investment.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
                        <button type="reset" class="btn btn-warning  pr-4 pl-4"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset </button>
                        </div>
                
                </div>
            </div>
        </div>
        <!-- data table end -->
         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">MESSAGE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
            Are you sure to continue?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Yes </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
            </form>
            </div>
        </div>
        </div>
        <!-- end modal -->
        
    </div>
</div>

<div id="application_value" style="width: 100%; height: 100%;">
          
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
    var min_amt=0;
    var int_rate=0;
    var term=0;
    var int_pay_mode=0;
    var fore_close_chrge=0;
    

$(document).ready(function(){
   
        $("#member").change(function(){
            var id=$(this).find(":selected").val();
          
            console.log(id);
            $.ajax({
                type:"GET",
                url:"../member_details/"+id,
                success:function(res){ 
                   // console.log(res);       
                if(res){
                    const obj = JSON.parse(res);
                    document.getElementById("member_name").value = obj.first_name;
                    document.getElementById("branch").value = obj.branch;

                }
            }
        })
    })
  
        $("#scheme").change(function(){
            var id=$(this).find(":selected").val();
          

            $.ajax({
                type:"GET",
                url:"../inv_scheme_detail/"+id,
                success:function(res){ 
                   // console.log(res);       
                if(res){
                    const obj = JSON.parse(res);
                    
                     $('#schema_details').empty();

                     min_amt=obj.min_amt;
                     int_rate=obj.int_rate;
                     term=obj.term;
                     int_pay_mode=obj.int_pay_mode;
                     fore_close_chrge=obj.fore_close_chrge;
                   
                    trHTML = '<table id="doc_table" style="width:100%;"><tr><td>' + 'Scheme Name' + '</td><td>' + obj.scheme_name + '</td></tr> <tr><td>' + 'Scheme Code' + '</td><td>' + obj.scheme_code + '</td></tr><tr><td>' +
                             'Minimum Amount(INR)' + '</td><td>' + obj.min_amt + '</td></tr><tr><td>' + 'Interest Rate(%)' + '</td><td>' + obj.int_rate + '</td></tr><tr><td>' + 'term' + '</td><td>' + obj.term + 
                            '</td></tr><tr><td>' + 'Interest Pay Mode' + '</td><td>' + obj.int_pay_mode + '</td></tr> <tr><td>' + 'Fore Closure Charge' + '</td><td>' + obj.fore_close_chrge + 
                            '</td></tr></table>';
                    
                    $('#schema_details').append(trHTML);

                }
            }
            })
        })
    })


</script>

<script>
$(document).ready(function(){
    $("#calculate").click(function(){
        var amount =  $('#amount').val();
        var tenure =  $('#tenure').val();
        var amt_approved= Number(min_amt) < Number(amount) ? amount : min_amt;
    
        var eff_int_perc=0;
        var eff_int=0;
        var total_amt=0;
        var tenure_val=0;

       if(int_pay_mode=='Yearly'){
        
            eff_int_perc=(int_rate/12)*tenure;
            eff_int=Math.ceil(amt_approved*(eff_int_perc/100));
            total_amt= Number(amt_approved) + Number(eff_int);
            emi_interest= Math.ceil((eff_int/tenure)*12);
            tenure_val=tenure/12;
            // console.log(eff_int_perc);
            // console.log(eff_int);
            // console.log(total_amt);
            // console.log(emi_interest);
            // console.log(tenure);


       }else if(int_pay_mode=='Monthly'){
            eff_int_perc=(int_rate/12)*tenure;
            eff_int=Math.ceil(amt_approved*(eff_int_perc/100));
            total_amt= Number(amt_approved) + Number(eff_int);
            emi_interest= Math.ceil(eff_int/tenure);
            tenure_val = tenure;
            // console.log(eff_int_perc);
            // console.log(eff_int);
            // console.log(total_amt);
            // console.log(emi_interest);
            // console.log(tenure);

       }

       $('#application_value').empty();
            

            trHTML = '<table id="cal-form" style="width:100%"><tr><td>' + 'Amount(INR)' + '</td><td>' + amount + '</td></tr><tr><td>' + 
            'Amount Approved(Principal Amount)' + '</td><td>' + amt_approved + '</td></tr> <tr><td>' + 'Interest Earned' + '</td><td>' + eff_int + 
            '</td></tr><tr><td>' + 'Total Maturity Amount' + '</td><td>' + total_amt + '</td></tr> <tr><td>' + 'Interest per Tenure' + '</td><td>' + emi_interest + 
            '</td></tr><tr><td>' + 'Tenure Period' + '</td><td>' + tenure_val + "( "+int_pay_mode+" )"+ '</td></tr> </table>' +
             '<div style="display:flex;justify-content:center;"> <button type="submit" class="btn btn-primary" style="text-align:center;margin:10px 0;" data-toggle="modal" data-target="#exampleModal">Save</button></div>';
            
        $('#application_value').append(trHTML);

        document.getElementById("principal_amount").value = amt_approved;
        document.getElementById("interest_earned").value = eff_int;
        document.getElementById("maturity_amount").value = total_amt;
        document.getElementById("int_per_tenure").value = emi_interest;
        document.getElementById("fore_close_charge").value = fore_close_chrge;
        document.getElementById("int_pay_mode").value = int_pay_mode;
        document.getElementById("int_rate").value = int_rate;
        document.getElementById("tenure_val").value = tenure_val;



    })

})
</script>
@endsection
