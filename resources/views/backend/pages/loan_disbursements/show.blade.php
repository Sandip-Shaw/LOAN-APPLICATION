
@extends('backend.layouts.master')

@section('title')
Loan Disbursement - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection

<style>
    a{
        /* color: #333 !important; */
    }
    .fst-tbl{
           padding: 1rem;
           background-color: white;
           border-top: 2px solid #8914fe;
           box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);
           margin: 2rem 0;
    }
</style>

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left"> Loan// Disbursement</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.loan_disbursements.index') }}"> Loan Disbursement</a></li>
                    <li><span>  {{$applications->loanApplication_id }} </span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner" style="margin-top: 15px">
    <div class="row">
        <!-- data table start -->
        
        <div class="col-md-7 ">
            <div class="box fst-tbl">
                <div class="box-body">
                   
                    <div class="clearfix"></div>
                        <div class="row">
                            <div class=col-md-12>
                             @include('backend.layouts.partials.messages')
                             <h4>Application No. - {{$applications->loanApplication_id }} </h4>
                             <hr>
                             <form action="{{ route('admin.loan_disbursements.store') }}" method="post"  >
                                @csrf
                             <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >Loan Amount (A)</label>
                            
                                <div class="col-sm-6">
                                <input type="text" name="loan_amount" id="principal_amount" value="{{$applications->amt_approved}}" class="form-control" readonly>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >Processing Fee(B)</label>
                            
                                <div class="col-sm-6">
                                <input type="text" name="processing_fee" id="" value="{{$applications->processing_charges}}" class="form-control" readonly>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >Insurance Fee(C)</label>
                            
                                <div class="col-sm-6">
                                <input type="text" name="insurance_charge" id="" value="{{$applications->loanSchema->insurance_charge}}" class="form-control" readonly>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >Stamp Fee Charge(D)</label>
                            
                                <div class="col-sm-6">
                                <input type="text" name="stamp_fee_charge" id="" value="{{($applications->loanSchema->stamp_charge) ? ($applications->loanSchema->stamp_charge) : '0'}}" class="form-control" readonly>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >Final Amount To Disburse (E = A - B - C - D) </label>
                            
                                <div class="col-sm-6">
                                <input type="text" name="final_disburse_amt" id="" value="{{($applications->amt_approved)-($applications->processing_charges) - ($applications->loanSchema->insurance_charge) - ($applications->loanSchema->stamp_charge)}}" class="form-control" readonly>

                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >Loan Disbursement Date <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="date" name="loan_disburse_date" id="" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" >

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >First EMI Date <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="date" name="first_emi_date" id="first_emi_date" value="" class="form-control" >

                                </div>
                            </div>
                            <hr>
                          
                            <h4>Disbursement Amount :</h4>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >Net Amount to Release <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" name="disburse_amt" id="" value="{{($applications->amt_approved)-($applications->processing_charges)-($applications->loanSchema->insurance_charge) -($applications->loanSchema->stamp_charge) }}" class="form-control" readonly>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >Pay Mode <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                <div class="form-group col-sm-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="disburse_transaction" id="Cash" value="Cash">
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
                                
                                </div>
                            </div>

                            <div class="form-row" id="radio_btn">
                            
                            </div>

                            <div id="application_details">

                            </div>

                            <input type="hidden" name="loanApplication_id" id="" value="{{($applications->loanApplication_id)}}" class="form-control" >
                            <input type="hidden" name="emi_details" id="emi_details" class="form-control">
                            <input type="hidden" name="member_name" id="" value="{{($applications->memberdetails->first_name)}}" class="form-control" >
                            <input type="hidden" name="member_mobile" id="" value="{{($applications->memberdetails->mobile)}}" class="form-control" >


                            <div style="text-align:center;">
                                <button type="button"  class="btn btn-primary  pr-4 pl-4" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;Disburse Loan </button>
                                <a class="btn btn-danger" href=""><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
                               
                            </div>

                        
                            </div>
                        </div>
                </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
            Are you sure to DISBURSE Application No -{{$applications->loanApplication_id }}
            <br>
            <br>
            Note: This operation is irreversible.


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;Pay </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</button>
                
            </div>
            </form>
            </div>
        </div>
        </div>
        <!-- end modal -->
            </div>
        </div>
        <!-- data table end -->
        <div class="col-md-5">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class=col-md-12>
                            <div class="container">
          
                                <div id="accordion" style='margin-top: 2rem; width: 38rem;'>
                                    <div class="card" style="width:100%; color:blue;">
                                        <div class="card-header text-white" style="background-color: #4e81a5;">
                                            <a class="card-link" data-toggle="collapse" href="#collapseOne"  style="color: #fff !important;">
                                            Other Loan Account Info
                                            </a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body" style='height: 20rem;overflow: scroll;'>
                                            <table id="dataTable" class="table table-details">
                                                <tbody>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Application Date</td>
                                                        <td> 
                                                        
                                                        {{ Carbon\Carbon::parse($applications->application_date)->format('d-m-Y') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Application No.</td>
                                                        <td> 
                                                        {{$applications->loanApplication_id }}
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Member</td>
                                                        <td> 
                                                        {{$applications->memberdetails->first_name }}
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Scheme </td>
                                                        <td> 
                                                        {{$applications->loanSchema->schema_name }}
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Amount Requested</td>
                                                        <td> 
                                                        INR {{$applications->loan_requested }}
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Amount Approved</td>
                                                        <td> 
                                                        INR {{$applications->amt_approved }}
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">EMI Payout</td>
                                                        <td> 
                                                        {{$applications->tenure_type }}
                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Interest Type</td>
                                                        <td> 
                                                        {{$applications->loanSchema->int_type }}

                                                        
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ft-200 font-weight-bold" style="width: 250px;">Status</td>
                                                        <td> 
                                                        {{$applications->status }}
                                                        
                                                        </td>
                                                    </tr>


                                                </tbody>
                                             </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                <div class="card" style="width:38rem; margin-top: 15px">
                    <div class="card-header" style="background-color: #0095ff;">
                        <a class="card-link" data-toggle="collapse" href="#collapseTwo"  style="color: #fff !important;width: 100%; display: flex; align-items: center;">
                        EMI Info
                        <i class="fa fa-print " id="btnprn" style="margin-left: auto"></i>
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse show" data-parent="#accordion">

                        <div id="total_interest" style="text-align:center; margin-top:20px"></div>
                        <div class="card-body" style="display:flex;padding: 10px; flex-direction:column-reverse; overflow-x: scroll; height: 35.7rem;">
                        <hr>
                            <table id="dataTable" class="table table-details">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>Emi No.</th>
                                        <th>PRINCIPAL</th>
                                        <th>INTEREST</th>
                                        <th>OTHER CHRG.</th>
                                        <th>EMI</th>
                                        <th>EMI DATE</th>
                                        <th>DUE DATE</th>
                                        <th>BAL. PRINCIPAL</th>
                                    </tr>

                                </thead>
                                
                                <tbody id="emi_list">
                                    
                                    <!-- <tr id="emi_list">

                                    </tr> -->
                                   
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


 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
            Are you sure to continue?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Pay </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
            </form>
            </div>
        </div>
        </div>
        <!-- end modal -->
        
      
                
        </div>
        
    </div>
</div>
@endsection


@section('scripts')
     <!-- Start datatable js -->
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
     <script type="text/javascript" src="js/jquery.printPage.js"></script>
     <script>
         /*================================
        datatable active
        ==================================*/
        // if ($('#dataTable').length) {
        //     $('#dataTable').DataTable({
        //         responsive: true
        //     });
        // }

     </script>
<script>
$(document).ready(function() {

let result = document.querySelector('#radio_btn');
    document.body.addEventListener('change', function (e) {
        let target = e.target;
        tenure=target.id;
    
        //console.log(target.id);

        let message;
       
        //const options=[];
        switch (target.id) {
            case 'Cash':
        //console.log(result);
              
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
      //  console.log(result.innerHTML);
               
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
        }
      

    });
});

</script>
<script>
    var tenure_months=0;

      $(document).ready(function(){
    
        // const moment= require('moment'); 
          var id = {!! json_encode($applications->loanApplication_id) !!}; 
            $.ajax({
                type:"GET",
                url:"../application_details/"+id,
                success:function(res){  
                  // console.log(res);   
                if(res){
                  
                     const obj = JSON.parse(res);

                     Object.entries(obj).forEach((entry)=>
                     {
                        const [key,value]=entry;
                        //console.log(`${value.loan_schema}`);
                        ann_rate_int=`${value.ann_rate_int}`;
                        tenure_months=`${value.tenure_months}`;
                        interest_amount=`${value.interest_amount}`;
                        other_charges=`${value.other_charges}`;
                        credit_period=`${value.credit_period}`;
                        emi_collection=`${value.emi_collection}`;
                        no_of_emis=`${value.no_of_emis}`;
                        int_type=`${value.int_type}`;

                        tenure_type=`${value.tenure_type}`;
                    })
                    // tenure_months=obj.tenure_months;
                    // interest_amount=obj.interest_amount;
                    // other_charges=obj.other_charges;
                    // credit_period=obj.credit_period;
                    var principal =  $('#principal_amount').val();

  

//<------------------------- emi calculation for flat emi---------------------------->
    if(int_type == "Flat EMI"){
                    var principal_per_emi = Number(principal)/Number(no_of_emis);
                    var interest_per_emi= Number(interest_amount)/Number(no_of_emis);
                    var other_charges_per_emi =Number(other_charges)/Number(no_of_emis); 
                    var per_emi=Number(principal_per_emi)+Number(interest_per_emi)+Number(other_charges_per_emi); 
                    var no_emi_collection=tenure_months/emi_collection;
                   // console.log(no_emi_collection);
                document.getElementById("total_interest").innerHTML = "TOTAL INTEREST RECOVERABLE -"+ interest_amount + "<br>"+"TOTAL OTHER CHARGES RECOVERABLE - "+ other_charges;
                 var d = new Date();
                 var first_emi_date='';
                 var newDate='';
                 var next_emi_date='';
                 var days=0;
                if(tenure_type=="months"){
                    days=30*emi_collection;

                     first_emi_date = new Date(d.setDate(d.getDate() + days));
                     newDate = moment(first_emi_date,"MM/DD/YY").format("YYYY-MM-DD");
                }else if(tenure_type=="weeks"){
                    days=7*emi_collection;

                    first_emi_date = new Date(d.setDate(d.getDate() + days));
                    newDate = moment(first_emi_date,"MM/DD/YY").format("YYYY-MM-DD");
                    days=7*emi_collection;
                }else if(tenure_type=="days"){
                    days=1*emi_collection;

                    first_emi_date = new Date(d.setDate(d.getDate() + days));
                    newDate = moment(first_emi_date,"MM/DD/YY").format("YYYY-MM-DD");
                }


               document.getElementById("first_emi_date").value = newDate;
                var paid_principal= 0;
                var emiCount = {
                    "emi" : {}
                }

                   for (let i = 1; i <= no_of_emis; i++) {
                    d = new Date();
                   
                    var per_emi=Number(principal_per_emi)+Number(interest_per_emi)+Number(other_charges_per_emi); 
                    if (i==1){
                        next_emi_date = new Date(d.setDate(d.getDate() + days));
                        newDates = moment(next_emi_date,"MM/DD/YY").format("DD-MM-YYYY");
                        
                    }
                    else{
                        next_emi_date = new Date(next_emi_date.setDate(next_emi_date.getDate() + days));
                        newDates = moment(next_emi_date,"MM/DD/YY").format("DD-MM-YYYY");
                    }

                   // console.log(next_emi_date);
                    var newDates = moment(next_emi_date,"MM/DD/YY").format("DD-MM-YYYY");
                    var due_date = moment(next_emi_date).add(credit_period, "days").format("DD-MM-YYYY");
                   
                   paid_principal=paid_principal+principal_per_emi;
                   var bal_principal = principal - paid_principal;
                   
                   trHTML ='<tr><td>'+i+'</td><td>'+principal_per_emi.toFixed(2)+'</td><td>'+interest_per_emi.toFixed(2) +
                            '</td><td>'+other_charges_per_emi.toFixed(2) +'</td><td>' + per_emi.toFixed(2) +'</td><td>' +newDates +
                            '</td><td>'+due_date +'</td><td>' +bal_principal.toFixed(2) + '</td></tr>';

                    $('#emi_list').append(trHTML);
                //    console.log(i+'-'+principal_per_emi.toFixed(2)+'-'+interest_per_emi.toFixed(2)+'-'+other_charges_per_emi.toFixed(2)+'-'+per_emi.toFixed(2)+'-'+newDate+'-'+due_date+'-'+bal_principal.toFixed(2));
                   first_emi_date=next_emi_date;

                    emiCount.emi["EMI"+i] = {
                            "Emi_No":i, 
                            "PRINCIPAL":principal_per_emi.toFixed(2), 
                            "INTEREST":interest_per_emi.toFixed(2), 
                            "OTHER_CHRG":other_charges_per_emi.toFixed(2),
                            "EMI":per_emi.toFixed(2),
                            "EMI_DATE":newDates,
                            "DUE_DATE":due_date,
                            "BAL_PRINCIPAL":bal_principal.toFixed(2),
                        };
                   
                    }
                    // console.log(emiCount);
                    $('#emi_details').val(JSON.stringify(emiCount));
                } 

// <--------------------------end of flat emi calculation--------------------------->

    if(int_type == "Reducing EMI"){

                var eff_interest_percent='';
                var interest_per='';
                var emi_per_excl_ot='';
                var interest='';
                var rev_principle='';
                var other_charges_per_emi='';
                var emi='';
                var outstanding_principal='';
                var first_emi_date='';
                var newDate='';
                var days=0;
                var next_emi_date='';
                //var newDates='';

            var d = new Date();

        if(tenure_type == "months"){
             eff_interest_percent=(ann_rate_int/12)*tenure_months;
             interest_per=emi_collection*((eff_interest_percent/tenure_months)/100);
             emi_per_excl_ot=(principal*interest_per)/(1-Math.pow((1+interest_per),-(no_of_emis)));
             interest = interest_per * principal;

             rev_principle=emi_per_excl_ot-interest;
            
             other_charges_per_emi =Number(other_charges)/Number(no_of_emis); 

             emi=Number(rev_principle)+Number(interest)+Number(other_charges_per_emi);
        
             outstanding_principal=principal-rev_principle;
    
             days=30*emi_collection;
             first_emi_date = new Date(d.setDate(d.getDate() + days));
             newDate = moment(first_emi_date,"MM/DD/YY").format("YYYY-MM-DD");

        }else if(tenure_type == "weeks"){
            eff_interest_percent=(ann_rate_int/52)*tenure_months;
             interest_per=emi_collection*((eff_interest_percent/tenure_months)/100);
             emi_per_excl_ot=(principal*interest_per)/(1-Math.pow((1+interest_per),-(no_of_emis)));
             interest = interest_per * principal;

             rev_principle=emi_per_excl_ot-interest;
            
             other_charges_per_emi =Number(other_charges)/Number(no_of_emis); 

             emi=Number(rev_principle)+Number(interest)+Number(other_charges_per_emi);
        
             outstanding_principal=principal-rev_principle;
          
             days=7*emi_collection;
             first_emi_date = new Date(d.setDate(d.getDate() + days));
             newDate = moment(first_emi_date,"MM/DD/YY").format("YYYY-MM-DD");

        }else if(tenure_type == "days"){
            eff_interest_percent=(ann_rate_int/365)*tenure_months;
             interest_per=emi_collection*((eff_interest_percent/tenure_months)/100);
             emi_per_excl_ot=(principal*interest_per)/(1-Math.pow((1+interest_per),-(no_of_emis)));
             interest = interest_per * principal;

             rev_principle=emi_per_excl_ot-interest;
            
             other_charges_per_emi =Number(other_charges)/Number(no_of_emis); 

             emi=Number(rev_principle)+Number(interest)+Number(other_charges_per_emi);
        
             outstanding_principal=principal-rev_principle;

             days=1*emi_collection;
             first_emi_date = new Date(d.setDate(d.getDate() + days));
             newDate = moment(first_emi_date,"MM/DD/YY").format("YYYY-MM-DD");

        }



    document.getElementById("total_interest").innerHTML = "TOTAL INTEREST RECOVERABLE -"+ interest_amount + "<br>"+"TOTAL OTHER CHARGES RECOVERABLE - "+ other_charges;
   // var first_emi_date = new Date(d.setMonth(d.getMonth() + 1));
                 // console.log(first_emi_date);
    //var newDate = moment(first_emi_date,"MM/DD/YY").format("YYYY-MM-DD");

    var paid_principal= 0;
    var emiCount = {
            "emi" : {}
        }

    document.getElementById("first_emi_date").value = newDate;
      newPrincipal=principal;
    var i = 1;
    while (i <= newPrincipal) {
        newInterest=interest_per*newPrincipal;

        reduction=emi_per_excl_ot-newInterest;
        newPrincipal=newPrincipal-reduction;
        d = new Date();
        if (i==1){
            next_emi_date = new Date(d.setDate(d.getDate() + days));
            newDate = moment(next_emi_date,"MM/DD/YY").format("DD-MM-YYYY");
                        
            }
        else{
            next_emi_date = new Date(next_emi_date.setDate(next_emi_date.getDate() + days));
            newDate = moment(next_emi_date,"MM/DD/YY").format("DD-MM-YYYY");
            }
      
    
        var due_date = moment(next_emi_date).add(credit_period, "days").format("DD-MM-YYYY");
        var emi=Number(rev_principle)+Number(interest)+Number(other_charges_per_emi);

        trHTML ='<tr><td>'+i+'</td><td>'+reduction.toFixed(2)+'</td><td>'+newInterest.toFixed(2) +
                            '</td><td>'+other_charges_per_emi.toFixed(2) +'</td><td>' + emi.toFixed(2) +'</td><td>' +newDate +
                            '</td><td>'+due_date +'</td><td>' +newPrincipal.toFixed(2) + '</td></tr>';

         $('#emi_list').append(trHTML);

        //  console.log(i+'-'+reduction.toFixed(2)+'-'+newInterest.toFixed(2)+'-'+newPrincipal.toFixed(2));
         first_emi_date=next_emi_date;
         emiCount.emi["EMI"+i] = {
                    "Emi_No":i, 
                    "PRINCIPAL":reduction.toFixed(2), 
                    "INTEREST":newInterest.toFixed(2), 
                    "OTHER_CHRG":other_charges_per_emi.toFixed(2),
                    "EMI":emi.toFixed(2),
                    "EMI_DATE":newDate,
                    "DUE_DATE":due_date,
                    "BAL_PRINCIPAL":newPrincipal.toFixed(2),
                };
         i++;
        }
        $('#emi_details').val(JSON.stringify(emiCount));
    }
    }
                
    }
    })

})
  
</script>

<script type="text/javascript">
    $(document).ready(function(){
    $('#btnprn').printPage();
});
</script>

<!-- <script>
    $(document).ready(function(){
        
        //console.log(tenure_months);
           

    })
</script> -->
@endsection