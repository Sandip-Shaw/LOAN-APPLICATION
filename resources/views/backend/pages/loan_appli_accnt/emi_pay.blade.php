
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

    .content {
            position: absolute;
            top: 40%;
            left: 54%;
            transform: translate(-50%, -50%);
            width: 344px;
            height: 200px;
            text-align: left;
            background-color: #d2e5be;
            box-sizing: border-box;
            padding: 10px;
            z-index: 100;
            display: none;
            /*to hide popup initially*/
        }
          
        .close-btn {
            position: absolute;
            right: 20px;
            top: 15px;
            background-color: black;
            color: white;
            border-radius: 50%;
            padding: 4px;
        }

        .adj{
            height: 2vh;
            font-size: 13px;
            width: 2px;
        }

        .info{
            position: absolute;
            top: 10px;
            left: 178px;
        }
</style>
@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Business Loan Payment </h4>
                <ul class="breadcrumbs pull-left">

                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>EMI Pay</span></li>
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
        <div class="col-md-7">
            <div class="card" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <!-- <h4 class="header-title"> Create Schemes </h4> -->
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{route('admin.loan_paynow',$emi[0]->emi_id)}}" method="post" data-parsley-validate>
                        @csrf
                        @method('PATCH')
                         
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b> Transaction Date </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="date" class="form-control" id="transaction_date" name="transaction_date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Emi Amount to Collect </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="amt_to_collect" name="amt_to_collect" value="{{$emi[0]->emi_amt}}" readonly>
                                
                                </div>
                            </div>

                        
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="fine_amt" ><b>Panelty Charges  </b> <button type="button" class="btn btn-warning adj" onclick="togglePopup()"> <i class="fa fa-info info" aria-hidden="true"></i>  </button><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="fine_amt" name="fine_amt"  readonly>
                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="fine_amt" ><b> Roundoff (if any) </b></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="other_charges" name="other_charges" value="0" >
                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Net Amount to Collect</b></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="total_amt" name="total_amt" value="" readonly>

                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Amount Collected</b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="amt_collect" name="amt_collect" value="" required>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Remarks (if any) </b></label>
                            
                                <div class="col-sm-6">
                                <textarea class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks (if any)"></textarea>
                                
                                </div>
                            </div>
                            <input type="hidden" name="loan_id", id="loan_id", value="{{$emi[0]->loanApplication_id}}">

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Pay Mode </b><span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                <div class="form-group col-sm-6" id>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="disburse_transaction" id="Cash" value="Cash" required>
                                    <label class="form-check-label" for="disburse_transaction">Cash</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="disburse_transaction" id="Cheque" value="Cheque">
                                    <label class="form-check-label" for="disburse_transaction">Cheque</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="disburse_transaction" id="online_tr" value="online_tr" >
                                    <label class="form-check-label" for="disburse_transaction">Online Tr. </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="disburse_transaction" id="payment_gateway" value="Payment Gateway" >
                                    <label class="form-check-label" for="disburse_transaction">Payment Gateway </label>
                                </div>
                                
                                </div>
                            </div>
                            <div class="form-row" id="radio_btn">
                            
                            </div>

                            <div style="text-align:center;">
                                <button type="button" class="btn btn-primary  pr-4 pl-4" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;Pay</button>
                                <a class="btn btn-danger" href=""><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>

                            </div>
                             <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" >
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
            
                                        <div class="modal-body">
                                                Are you sure to Pay?
                                          
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;Pay</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</button>
                
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
        <!-- end modal -->
          
                </div>
            </div>
        </div>
        
<!-- data table end -->
        <div class="col-md-5">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class=col-md-12>
                            <div class="container">
          
                                <div id="accordion">
                                    <div class="card" style="width:100%; color:blue;">
                                        <div class="card-header text-white" style="background-color: #4e81a5;">
                                            <a class="card-link" data-toggle="collapse" href="#collapseOne"  style="color: #fff !important;">
                                            Other Loan Account Info
                                            </a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                            <table id="dataTable" class="table table-details">
                                                <tbody>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Loan No.</td>
                                                        <td> 
                                                        {{$emi[0]->id}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Member</td>
                                                        <td> 
                                                        {{$emi[0]->first_name}}
                                                        
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Open Date</td>
                                                        <td> 
                                                        {{Carbon\Carbon::parse($emi[0]->loan_disburse_date)->format('d-m-Y')}}
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Scheme </td>
                                                        <td> 
                                                        {{$emi[0]->schema_name}}
                                                        
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Loan Amount</td>
                                                        <td> 
                                                        
                                                      INR  {{$emi[0]->final_disburse_amt}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Annual Interest Rate</td>
                                                        <td> 
                                                    
                                                        {{$emi[0]->ann_rate_int}}%
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Interest Type</td>
                                                        <td> 
                                                        {{$emi[0]->int_type}}
                                                        
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Tenure</td>
                                                        <td> 
                                                        {{$emi[0]->tenure_type}}    
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                             </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                 
    </div>
</div>

<!-- div containing the popup -->
<div class="content">
        <div onclick="togglePopup()" class="close-btn">
            ×
        </div>
        <h3>Overdue Charges</h3>
  
        <p>
           Penalty Amount: {{$emi[0]->penalty}}
            <br>
           Penalty Type :  {{$emi[0]->panulty_type}}
            <br>
            @if($emi[0]->panulty_type == 'percentage')
            {{$emi[0]->penalty}} &nbsp; {{$emi[0]->panulty_type}} * {{$emi[0]->emi_amt}};
            @elseif($emi[0]->panulty_type == 'fixed')
            {{$emi[0]->penalty}}
            @endif
        </p>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


<script >
      
      // Function to show and hide the popup
      function togglePopup() {
          $(".content").toggle();
      }
  </script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>

<script>
  $('#form').parsley();
</script>
<script>
$(document).ready(function() {

let result = document.querySelector('#radio_btn');
    document.body.addEventListener('change', function (e) {
        let target = e.target;
        tenure=target.id;
 
        let message;
      
        switch (target.id) {
            case 'Cash':
        
               result.innerHTML='';
              
                break;
            case 'Cheque':
                result.innerHTML=` <div class="col-md-7">
                                    <div class="box">
                                    <div class="box-body">
                                    <div class="row">
                                    <div class=col-md-12>
                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="" >Bank Name <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="text" name="cheque_bank_name" id="" value="" class="form-control" >

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="" >Cheque No. <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="text" name="cheque_no" id="" value="" class="form-control" >

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="" >Cheque Date <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="date" name="cheque_date" id="" value="" class="form-control" >

                                    </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                `;
           
                break;
            case 'online_tr':
               
                result.innerHTML=`<div class="col-md-7">
                                    <div class="box">
                                    <div class="box-body">
                                    <div class="row">
                                    <div class=col-md-12>
                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="" >Transfer Date<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="date" name="onl_transfer_date" id="" value="" class="form-control" >

                                    </div>
                                </div><div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="" >UTR/ Transaction No. <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="text" name="onl_transaction_no" id="" value="" class="form-control" >

                                    </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >Transfer Mode  <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                <div class="form-group col-sm-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="onl_transfer_mode" id="" value="IMPS">
                                    <label class="form-check-label" for="onl_transfer_mode">IMPS</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="onl_transfer_mode" id="" value="VPA">
                                    <label class="form-check-label" for="onl_transfer_mode">VPA</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="onl_transfer_mode" id="" value=" NEFT/RTGS" >
                                    <label class="form-check-label" for="onl_transfer_mode"> NEFT/RTGS  </label>
                                </div>
                                
                                </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            `;
                
                break;
                case 'payment_gateway':

                    result.innerHTML=`<div class="col-md-7">
                                    <div class="box">
                                    <div class="box-body">
                                    <div class="row">
                                    <div class=col-md-12>
                                    
                                <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >Transfer Mode  <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                <div class="form-group col-sm-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pay_gatw_mode" id="" value="Merchant Pay">
                                    <label class="form-check-label" for="pay_gatw_mode">Merchant Pay</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pay_gatw_mode" id="" value="Customer Pay">
                                    <label class="form-check-label" for="pay_gatw_mode">Customer Pay</label>
                                </div>
                                
                                
                                </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            `;

                    break;

        }
      

    });
});

</script>

<script>
      $(document).ready(function(){
        var check = 0;
    
    // const moment= require('moment'); 
      var id = {!! json_encode($emi[0]->emi_id) !!}; 
      var panelty_type = {!! json_encode($emi[0]->panulty_type) !!}; 
      var panelty_amt = {!! json_encode($emi[0]->penalty) !!}; 
      var emi_amt = {!! json_encode($emi[0]->emi_amt) !!}; 
      var emi_status = {!! json_encode($emi[0]->emi_status) !!}; 

      if(emi_status == 'OverDue'){
        if(panelty_type == 'fixed'){
            check = panelty_amt; 
        }else if(panelty_type == 'percentage'){
            check =  Math.ceil((panelty_amt/100)*emi_amt);
        }
      }

      var total_amt = document.getElementById("fine_amt").value = check;
       var emi_fine = Number(emi_amt) + Number(total_amt);

      document.getElementById("total_amt").value = emi_fine;
        $(" #other_charges").keyup(function(){
        

        if($('#other_charges').val() != 0 || $('#other_charges').val() != null){
            var total = Number(emi_fine) + (+$('#other_charges').val());
          //  console.log(total);
        }
       
    
        $('#total_amt').val(total);
      });


      })
</script>

@endsection
