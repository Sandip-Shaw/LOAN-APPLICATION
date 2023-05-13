
@extends('backend.layouts.master')

@section('title')
Loan Application Edit - Admin Panel
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

   #cal-form td{
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
                <h4 class="page-title pull-left">  Loan Application</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Edit Applicant</span></li>
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
                    <h3 class="header-title"> Edit Applicants </h3>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.loan_application.update',$application->loanApplication_id) }}" method="POST" id="form" enctype="multipart/form-data" data-parsley-validate>
                   
                        @csrf


                        <div class="form-row">
                           
                            <div class="form-group col-md-6">
                                <label  for="application_date">Application Date<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="application_date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" name="application_date"  required>
                               
                            </div>
                           
                           
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="member">Member<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="member" id="member" class="form-control selectpicker" data-live-search="true" readonly>
                                    <option value="">Select Member</option>
                                    @foreach($members as $key=>$member)
                                    <option value="{{$member->member_id}}" @php if($application->member==$member->member_id) echo "selected";  @endphp>{{$member->first_name}}</option>
                                   
                                   @endforeach
                                   
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="member_name">Member Name</label>
                                <input type="text" class="form-control" id="member_name" name="member_name" readonly>
                            </div>
                            
                           
                        </div>


                        <div class="form-row">
                        <div class="form-group col-md-6">
                                <label  for="branch">Branch<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="branch" id="branch" class="form-control" readonly>
                                    <option value="">Select Branch</option>
                                    @foreach($branches as $key=>$branch)
                                        <option value="{{$branch}}" @php if($application->branch==$branch) echo "selected";  @endphp>{{$key}}</option>
                                    @endforeach
                                  
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="associate">Associate/Advisor/Staff </label>
                                <select name="associate" id="associate" class="form-control selectpicker" data-live-search="true">
                                <option value="">Select Associate</option>

                                @foreach($hrmanagements as $key=>$associate)
                                    <option value="{{$associate->hrmanagement_id}}"  @php if($application->associate==$associate->hrmanagement_id) echo "selected";  @endphp>{{$associate->emp_code}} - {{$associate->name}}</option>
                                   
                                   @endforeach
                             
                                </select>
                            </div>
 
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 ">
                                <label for="coapplicant_member1">Co-Applicant Member(if any)</label>
                                <select name="coapplicant_member1" id="coapplicant_member1" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Select Co-Applicant Member</option>
                                    @foreach($members as $key=>$member)
                                    <option value="{{$member->member_id}}" @php if($application->coapplicant_member1==$member->member_id) echo "selected";  @endphp>{{$member->first_name}}</option>
                                   
                                   @endforeach
                             
                                </select>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="guarantor_member1">Guarantor Member 1(if any)</label>
                                <select name="guarantor_member1" id="guarantor_member1" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Select Guarantor Member 1</option>
                                    @foreach($members as $key=>$member)
                                    <option value="{{$member->member_id}}" @php if($application->guarantor_member1==$member->member_id) echo "selected";  @endphp>{{$member->first_name}}</option>
                                   
                                   @endforeach
                             
                                </select>
                            </div>
    
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="coapplicant_member2">2nd Co-Applicant Member(if any)</label>
                                <select name="coapplicant_member2" id="coapplicant_member2" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Select 2nd Co-Applicant Member</option>
                                    @foreach($members as $key=>$member)
                                    <option value="{{$member->member_id}}" @php if($application->coapplicant_member2==$member->member_id) echo "selected";  @endphp>{{$member->first_name}}</option>
                                   
                                @endforeach
                             
                                </select>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="guarantor_member2">Guarantor Member 2(if any)</label>
                                <select name="guarantor_member2" id="guarantor_member2" class="form-control selectpicker" data-live-search="true">
                                <option value="">Select Guarantor Member 2</option>
                                @foreach($members as $key=>$member)
                                    <option value="{{$member->member_id}}" @php if($application->guarantor_member2==$member->member_id) echo "selected";  @endphp>{{$member->first_name}}</option>
                                   
                                @endforeach
                             
                                </select>
                            </div>
       
                        </div>
                        <hr>

                        <div class="form-row">
                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="loan_schema">Loan Scheme<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="loan_schema" id="loan_scheme" class="form-control selectpicker" data-live-search="true" required>
                                <option value="" id="default-val">Select Loan Scheme</option>
                                @foreach($schemas as $scheme)
                                    <option value="{{$scheme->loanSchema_id}}" @php if($application->loan_schema == $scheme->loanSchema_id) echo "selected";  @endphp>{{$scheme->schema_code}} - {{$scheme->schema_name}}</option>
                                   
                                @endforeach
                              
                                </select>
                            </div>
                           <!-- <div id="schema_details" style="width:450px; ">

                           </div> -->
    
                        </div>

                      

                        <div class="form-row">
                        <div class="form-group col-md-6">
                                <p > Tenure Type<span style="color:red; font-size: 18px;line-height:1">*</span></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input radio-tenure"  type="radio" name="tenure_type" id="days" value="days" >
                                    <label class="form-check-label" for="tenure_type">Days</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input radio-tenure" type="radio"  name="tenure_type" id="weeks" value="weeks" >
                                    <label class="form-check-label" for="tenure_type">Weeks</label>
                                </div>
                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input radio-tenure" type="radio"  name="tenure_type" id="months" value="months">
                                    <label class="form-check-label" for="tenure_type">Months</label>
                                </div>
                           
                            </div>  
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tenure_months" id="tenure_months_label">Tenure (Months)<span style="color:red; font-size: 18px;line-height:1">*</span> </label>
                                <input type="text" class="form-control" id="tenure_months" name="tenure_months" placeholder="Enter Tenure (Months)"  required>
                              
                            </div>
    
                        </div>

                        <div class="form-row">
                        <div class="form-group col-md-6 ">
                                <label for="emi_collection">EMI Collection<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <select name="emi_collection" id="emi_collection" class="form-control" required>
                                    <option value="">Please Select </option>
                                    <option value="1">Monthly</option>
                                    <option value="3">Qaurterly</option>
                                    <option value="6">Half Yearly</option>
                                    <option value="12">Yearly</option>
                                   
                                </select>
                             
                            </div>
                         </div>

                         <div class="form-row" id="radio_btn">
                            
                         </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="credit_period">Credit Period (EMI Grace Period) (Days) <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="credit_period" name="credit_period" placeholder="Enter Credit Period (EMI Grace Period) (Days)" value="{{$application->credit_period}}" required>
                              
                            </div>
    
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="loan_requested">Amount of Loan Requested <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="loan_requested" name="loan_requested" placeholder="Amount of Loan Requested" value="{{$application->loan_requested}}"required>
                              
                            </div>
    
                        </div>

                       
                        <input type="hidden" class="form-control" id="principal_amount" name="amt_approved"  >

                        <input type="hidden" class="form-control" id="interest_amount" name="interest_amount"  >
                        
                        <input type="hidden" class="form-control" id="other_charges" name="other_charges"  >
                        
                        <input type="hidden" class="form-control" id="total_amount_coll" name="total_amount_coll"  >

                        <input type="hidden" class="form-control" id="emi_amount_total" name="emi_amount_total"  >

                        <input type="hidden" class="form-control" id="no_of_emis" name="no_of_emis"  >

                        <input type="hidden" class="form-control" id="processing_charges" name="processing_charges"  >
                              
                       
    
                        <button type="button" id="calculate" class="btn btn-primary  pr-4 pl-4"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Calculate </button>
                        <a class="btn btn-danger" href="{{route('admin.loan_application.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</a>
                        <!-- <button type="reset" class="btn btn-warning  pr-4 pl-4"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Clear </button> -->

                  
                </div>
            </div>
        </div>
        <!-- data table end -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="margin-top: 7rem;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to continue?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- <div class="modal-body">
            
            </div> -->
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://parsleyjs.org/dist/parsley.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
$(function () {
    $('.selectpicker').selectpicker();
});

</script>

<script>


$(document).ready(function(){
        $("#member").change(function(){
            var id=$(this).find(":selected").val();
          

            $.ajax({
                type:"GET",
                url:"../../member_details/"+id,
                
                success:function(res){ 
                    console.log(res);       
                if(res){
                    const obj = JSON.parse(res);
                    document.getElementById("member_name").value = obj.first_name;
                    document.getElementById("branch").value = obj.branch;

                }
            }
        })
    })
})

</script>
<script>
//     $(document).ready(function() {
//          $('.select2').select2();
// //  $('#form').parsley();
//     })
//var target='';
var tenure='';
let radio_event='';
const radioTenure = [...document.getElementsByClassName("radio-tenure")]

for(let i=0;i<radioTenure.length;i++){
    
    radioTenure[i].addEventListener("change",(e)=>{
        radio_event=e.target.value
        // console.log(e.target.value)
    })
}


$(document).ready(function() {

    

    let result = document.querySelector('#radio_btn');
        document.body.addEventListener('change', function (e) {
            let target = e.target;
            tenure=target.id;
        
           // console.log(e);

            let message;
            const select=document.querySelector("#emi_collection");
            const emiCollects={
                days:[
                        {
                            label:"Please select",value:''
                        },
                        {
                            label:"Daily",value:1
                        }
                ],
                weeks:[
                        {
                            label:"Please select",value:''
                        },
                        {
                            label:"Weekly",value:1

                        },
                        {
                            label:"BI_weekly",value:2
                            
                        },
                        {
                            label:"4_weekly",value:4
                            
                        }
                ],
                months:[
                        {
                            label:"Please select",value:''
                        },
                        {
                            label:"Monthly",value:1

                        },
                        {
                            label:"Quaterly",value:3
                            
                        },
                        {
                            label:"Half_annualy",value:6
                            
                        },
                        {
                            label:"Annualy",value:12
                            
                        }

                ],

        
            }
                const options=[];
            switch (target.id) {
                case 'days':
                   document.querySelector('#tenure_months_label').textContent= "Tenure (Days)";
                   document.querySelector('#tenure_months').placeholder= "Enter Tenure (Days)";
                   select.innerHTML='';
                   emiCollects.days.forEach(element => {
                    const option= document.createElement("option")
                    option.setAttribute("value",element.value)
                    option.textContent= element.label
                    select.appendChild(option)
                   });
                    break;
                case 'weeks':
                    document.querySelector('#tenure_months_label').textContent= "Tenure (Weeks)";
                   document.querySelector('#tenure_months').placeholder= "Enter Tenure (Weeks)";
                   select.innerHTML='';
                   emiCollects.weeks.forEach(element => {
                    const option= document.createElement("option")
                    option.setAttribute("value",element.value)
                    option.textContent= element.label
                    select.appendChild(option)
                   });
                    break;
                case 'months':
                    document.querySelector('#tenure_months_label').textContent= "Tenure (Months)";
                    document.querySelector('#tenure_months').placeholder= "Enter Tenure (Months)";
                    select.innerHTML='';
                    emiCollects.months.forEach(element => {
                    const option= document.createElement("option")
                    option.setAttribute("value",element.value)
                    option.textContent= element.label
                    select.appendChild(option)
                   });
                    break;
            }
            result.textContent = message;

        });
    });

</script>
<script>
    $(document).ready(function(){
       
        $('#form').parsley();      
        })
  
</script>

<script>
    var max_tanure=0;
    var max_loan_amt=0;
    var ann_rate_int=0;
    var sms_charges=0;
    var fuel_charge=0;
    var stationary_charges=0;
    var maintenance_charge=0;
    var collection_charge=0;
    var process_fee=0;
    var int_type=0;
    $(window).on("load",function(){
        //alert('hi');
        $("#loan_scheme").change(function(){
            var id=$(this).find(":selected").val();
          
            console.log(id);
            $.ajax({
                type:"GET",
                url:"../../scheme_details/"+id,
                success:function(res){ 
                    console.log(res);       
                if(res){
                    const obj = JSON.parse(res);
                    
                    $('#schema_details').empty();

                    max_tanure=obj.max_tanure;
                    max_loan_amt=obj.max_loan_amt;
                    ann_rate_int=obj.ann_rate_int;
                    sms_charges=obj.sms_charges;
                    fuel_charge=obj.fuel_charge;
                    stationary_charges=obj.stationary_charges;
                    maintenance_charge=obj.maintenance_charge;
                    collection_charge=obj.collection_charge;
                    process_fee=obj.process_fee;
                    int_type=obj.int_type;

                    trHTML = '<table id="doc_table" style="width:100%;"><tr><td>' + 'Scheme Name' + '</td><td>' + obj.schema_name + '</td></tr> <tr><td>' + 'Scheme Code' + '</td><td>' + obj.schema_code + '</td></tr><tr><td>' +
                             'Maximum Loan Amount' + '</td><td>' + obj.max_loan_amt + '</td></tr><tr><td>' + 'Maximum Tenure' + '</td><td>' + obj.max_tanure + '</td></tr><tr><td>' + 'Annual Rate Interest' + '</td><td>' + obj.ann_rate_int + 
                            '</td></tr><tr><td>' + 'Fore Closure Charge' + '</td><td>' + obj.fore_closure_charge + '</td></tr> <tr><td>' + 'Processing Fee' + '</td><td>' + obj.process_fee + 
                            '</td></tr> <tr><td>' + ' SMS Charges ' + '</td><td>' + obj.sms_charges + '</td></tr> <tr><td>' + 'Fuel Charges ' + '</td><td>' + obj.fuel_charge + 
                            '</td></tr> <tr><td>' + 'Stationary Charges ' + '</td><td>' + obj.stationary_charges + '</td></tr> <tr><td>' + 'Maintenance Charges ' + '</td><td>' + obj.maintenance_charge + 
                            '</td></tr><tr><td>' + 'Collection Charges' + '</td><td>' + obj.collection_charge + '</td></tr> </table>';
                    
                    $('#schema_details').append(trHTML);

                }
            }
            })
        })
    })

</script>
<!-- <script>
    $(document).ready(function(){
        $("#calculate").click(function(){
            var formInstance = $('#form').parsley();
        })
    })
</script> -->

<script>


$(document).ready(function(){
        $("#calculate").click(function(){
        // $('#form').parsley();
            var loan_requested =  $('#loan_requested').val();
            var tenure_months=$('#tenure_months').val();
            var amt_approved= Number(max_loan_amt) > Number(loan_requested) ? loan_requested : max_loan_amt;
            var emi_collection =  $('#emi_collection').val();
            var total_other_charges = Number(sms_charges)+Number(fuel_charge)+Number(stationary_charges)+Number(maintenance_charge)+Number(collection_charge);
            var processing_fee = (process_fee/100)*amt_approved;

           var eff_int_perc=0;
           var eff_int=0;
           var no_emi_collection=0;
           var total_emi_charge=0;
           var total_collection=0;
           var emi_amount=0;
           var eff_interest_percent=0;
           var interest_per=0;
           var eff_interest_per=0;
           var no_of_emis=0;
           var emi_per_excl_ot=0;
           var emi_per_incl_ot=0;
            
//<----------------calculation done for flat Emi---------------------->
    if(int_type=='Flat EMI'){
          // console.log(radio_event);
           if (radio_event=='days'){
            
            //set the divisor for days
             eff_int_perc=(ann_rate_int/365)*tenure_months;
             eff_int=Math.ceil(amt_approved*(eff_int_perc/100));
             no_emi_collection=tenure_months/emi_collection;
             total_emi_charge=total_other_charges*no_emi_collection;
             total_collection=Number(amt_approved)+Number(eff_int)+Number(total_emi_charge);
             emi_amount=Math.ceil(total_collection/no_emi_collection);
            // console.log(eff_int);
            //end divisor for days
           }else if(radio_event=='weeks'){
            //set the divisor for weeks
             eff_int_perc=(ann_rate_int/52)*tenure_months;
             eff_int=Math.ceil(amt_approved*(eff_int_perc/100));
             no_emi_collection=tenure_months/emi_collection;
             total_emi_charge=total_other_charges*no_emi_collection;
             total_collection=Number(amt_approved)+Number(eff_int)+Number(total_emi_charge);
             emi_amount=Math.ceil(total_collection/no_emi_collection);
            //end divisor for weeks
           }else if(radio_event=='months'){
            //set the divisor for months
             eff_int_perc=(ann_rate_int/12)*tenure_months;
             eff_int=Math.ceil(amt_approved*(eff_int_perc/100));
             no_emi_collection=tenure_months/emi_collection;
             total_emi_charge=total_other_charges*no_emi_collection;
             total_collection=Number(amt_approved)+Number(eff_int)+Number(total_emi_charge);
             emi_amount=Math.ceil(total_collection/no_emi_collection);
            //end divisor for months
        }
    }
//<----------------calculation done for Reducing Emi---------------------->
    if(int_type=='Reducing EMI'){
        if(radio_event=='months'){
             eff_interest_percent=(ann_rate_int/12)*tenure_months;
             interest_per=emi_collection*((eff_interest_percent/tenure_months)/100);   
             eff_interest_per=(interest_per*amt_approved);           
             no_of_emis=tenure_months/emi_collection;         
             no_emi_collection=tenure_months/emi_collection;
             emi_per_excl_ot=(amt_approved*interest_per)/(1-Math.pow((1+interest_per),-(no_of_emis)));
             emi_amount=Math.ceil(emi_per_excl_ot+total_other_charges);
             eff_int=Math.ceil((emi_per_excl_ot*no_of_emis)-amt_approved);
             total_emi_charge=  total_other_charges*no_emi_collection;
             total_collection=Number(amt_approved)+Number(eff_int)+Number(total_emi_charge);
            //end divisor for months
        }else if(radio_event == 'weeks'){
             eff_interest_percent=(ann_rate_int/52)*tenure_months;
             interest_per=emi_collection*((eff_interest_percent/tenure_months)/100);
             eff_interest_per=(interest_per*amt_approved);
             no_of_emis=tenure_months/emi_collection;
             no_emi_collection=tenure_months/emi_collection;
             emi_per_excl_ot=(amt_approved*interest_per)/(1-Math.pow((1+interest_per),-(no_of_emis)));
             emi_amount=Math.ceil(emi_per_excl_ot+total_other_charges);       
             eff_int=Math.ceil((emi_per_excl_ot*no_of_emis)-amt_approved);
             total_emi_charge=  total_other_charges*no_emi_collection;
             total_collection=Number(amt_approved)+Number(eff_int)+Number(total_emi_charge);
            //end divisor for weeks
        }else if(radio_event=='days'){
             eff_interest_percent=(ann_rate_int/365)*tenure_months;
             interest_per=emi_collection*((eff_interest_percent/tenure_months)/100);
             eff_interest_per=(interest_per*amt_approved);
             no_of_emis=tenure_months/emi_collection;
             no_emi_collection=tenure_months/emi_collection;
             emi_per_excl_ot=(amt_approved*interest_per)/(1-Math.pow((1+interest_per),-(no_of_emis)));
             emi_amount=Math.ceil(emi_per_excl_ot+total_other_charges);
    
             eff_int=Math.ceil((emi_per_excl_ot*no_of_emis)-amt_approved);
             total_emi_charge= total_other_charges*no_emi_collection;
             total_collection=Number(amt_approved)+Number(eff_int)+Number(total_emi_charge);
            //end divisor for days

        }
    }

            $('#application_value').empty();
            

                trHTML = '<table id="cal-form" style="width:100%"><tr><td>' + 'Amount of loan requested' + '</td><td>' + loan_requested + '</td></tr><tr><td>' + 
                'Amount of Loan can be Approved' + '</td><td>' + max_loan_amt + '</td></tr> <tr><td>' + 'Loan Amount Approved (Principal Amount)' + '</td><td>' + amt_approved + 
                '</td></tr><tr><td>' + 'Interest Amount' + '</td><td>' + eff_int + '</td></tr> <tr><td>' + 'Other Charges' + '</td><td>' + total_emi_charge + 
                '</td></tr><tr><td>' + 'Total Amount Recovered' + '</td><td>' + total_collection + '</td></tr> <tr><td>' + 'Loan Tenure' + '</td><td>' + tenure_months + " "+radio_event+" "+
                '</td></tr> <tr><td>' + 'EMI Amount' + '</td><td>' + emi_amount + '</td></tr> <tr><td>' + 'No. of EMIs' + '</td><td>' + no_emi_collection +
                 '</td></tr> <tr><td>' + 'Processing Charges' + '</td><td>' + processing_fee + '</td></tr></table>' +
                 '<div style="display:flex;justify-content:center;"> <button type="submit" class="btn btn-primary" style="text-align:center;margin:10px 0;" data-toggle="modal" data-target="#exampleModal">Update Loan</button>'+'<a href="" style="margin:10px 0;" class="btn btn-danger">Cancel</a></div>';
                
                $('#application_value').append(trHTML);

                document.getElementById("principal_amount").value = amt_approved;
                document.getElementById("interest_amount").value = eff_int;
                document.getElementById("other_charges").value = total_emi_charge;
                document.getElementById("total_amount_coll").value = total_collection;
                document.getElementById("emi_amount_total").value = emi_amount;
                document.getElementById("no_of_emis").value = no_emi_collection;
                document.getElementById("processing_charges").value = processing_fee;
                    
            })

        })
  

</script>

@endsection