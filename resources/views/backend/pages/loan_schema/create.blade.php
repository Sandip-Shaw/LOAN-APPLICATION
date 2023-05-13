
@extends('backend.layouts.master')

@section('title')
Loan Schemes - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
    .content {
            position: absolute;
            top: 120%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 403px;
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
            font-size: 10px;
            width: 2px;
        }

        .info{
            position: absolute;
            top: 5px;
            left: 174px;
        }
</style>


@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">New  Loan Schemes</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>New Schemes</span></li>
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
            <div class="card" style="border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <h4 class="header-title"> Create Schemes </h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.loan_schema.store') }}" method="POST" id="form" data-parsley-validate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label  for="schema_name">Scheme Name<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="schema_name" name="schema_name" placeholder="Enter Scheme Name" required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="Schema_code">Scheme Code<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="schema_code" name="schema_code" placeholder="Enter Scheme Code" required>
                            </div>
                           
                        </div>

                        <div class="form-row">
                            
                            <div class="form-group col-md-6 ">
                                <label for="max_loan_amt">Maximum Loan Amount(INR)<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="max_loan_amt" name="max_loan_amt" placeholder="Enter Maximum Loan Amount(INR)" required>
                            </div>
                            <!-- <div class="form-group col-md-6 ">
                                <label for="max_loan_lim">Maximum Loan Limit % (if any)</label>
                                <input type="text" class="form-control" id="max_loan_lim" name="max_loan_lim" placeholder="Enter Maximum Loan Limit % ">
                            </div> -->
                            <div class="form-group col-md-6">
                                <label for="loan_type">Loan Type<span style="color:red; font-size: 18px;line-height:1">*</span></label> 
                               
                                <select name="loan_type" id="loan_type" class="form-control" required>
                                    <option value="">Please Select</option>
                                    <option value="Business_loan">Business Loan</option>
                                    
                                    <option value="Vehical_loan">Vehical Loan</option>
                                    <option value="Unsecure_bazar_loan">Unsecure Bazar Loan</option>
                                    <option value="Micro_loan">Micro Loan</option>
                                    <option value="Personal_loan">Personal Loan</option>
                                    
                                    <option value="other_loan">Others Loan</option>
                                    
                                </select>
                            </div>
                        </div>
                     

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="max_tanure">Max. Tenure<span style="color:red; font-size: 18px;line-height:1">*</span></label> 
                               
                                <select name="max_tanure" id="max_tanure" class="form-control" required>
                                    <option value="1 Months">1 Month</option>
                                    <option value="3 Months">3 Months</option>
                                    <option value="6 Months">6 Months</option>
                                    <option value="9 Months">9 Months</option>
                                    <option value="12 Months">12 Months</option>
                                    <option value="18 Months">18 Months</option>
                                    <option value="2 Years">2 Years</option>
                                    <option value="3 Years">3 Years</option>
                                  
                                   
                                </select>
                            </div>
                           
                            <div class="form-group col-md-6">
                                <label for="ann_rate_int">Annual Interest Rate (%)<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="ann_rate_int" name="ann_rate_int" placeholder="Enter Annual Interest Rate (%)" required>
                            </div>

                        </div>


                        <div class="form-row">
                            
                            <div class="form-group col-md-6">
                                <label for="fore_closure_charge">Fore Closure Charges in INR(if any)</label>
                                <input type="text" class="form-control" id="fore_closure_charge" name="fore_closure_charge" placeholder="Enter Fore Closure Charges in INR">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="process_fee">Processing Fee (%)</label>
                                <input type="text" class="form-control" id="process_fee" name="process_fee" placeholder="Enter Processing Fee" required>
                            </div>
                           
                        </div>


                        <div class="form-row">
                            <!-- <div class="form-group col-md-6">
                                <label for="sec_deposit">Security Deposit<span style="color:red; font-size: 18px;line-height:1">*</span></label> 
                               
                                <select name="sec_deposit" id="sec_deposit" class="form-control" required>
                                    <option value="">Please Select</option>
                                    <option value="FD of Self">FD of Self</option>
                                    <option value="RD of Self">RD of Self</option>
                                    <option value="DD of Self">DD of Self</option>
                                    <option value="FD of Bank">FD of Bank</option>
                                    <option value="RD of Bank">RD of Bank</option>
                                    <option value="LIC">LIC</option>
                                    <option value="NSC">NSC</option>
                                    <option value="Others Govt. Security">Others Govt. Security</option>
                                    <option value="Micro Finance">Micro Finance</option>
                                  
                                   
                                </select>
                            </div> -->
                           
                            

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="min_age">Minimum Age </label>
                                <input type="text" class="form-control" id="min_age" name="min_age" placeholder="Enter Minimum Age" data-parsley-type="integer" data-parsley-min="15">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="max_age">Maximum Age </label>
                                <input type="text" class="form-control" id="max_age" name="max_age" placeholder="Enter Maximum Age" data-parsley-type="integer" data-parsley-max="80">
                            </div>

                           
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <p> Active<span style="color:red; font-size: 18px;line-height:1">*</span></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="active" value="yes">
                                    <label class="form-check-label" for="active">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="active" value="no" required>
                                    <label class="form-check-label" for="active">No</label>
                                </div>
                            </div>  
                            <div class="form-group col-md-6">
                                <p> Interest Type<span style="color:red; font-size: 18px;line-height:1">*</span></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="int_type" value="Reducing EMI">
                                    <label class="form-check-label" for="int_type">Reducing EMI</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="int_type" value="Flat EMI">
                                    <label class="form-check-label" for="int_type">Flat EMI</label>
                                </div>
                            </div>   

                        </div>

                        <hr>
                        <h4 class="header-title"  style="text-align:center;">Charges Per EMI (in INR)</h4>    

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="sms_charges">Sms Charges (if any)</label>
                                <input type="text" class="form-control" id="sms_charges" name="sms_charges" placeholder="Enter Sms Charges">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fuel_charge">Fuel Charges (if any)</label>
                                <input type="text" class="form-control" id="fuel_charge" name="fuel_charge" placeholder="Enter Fuel Charge">
                            </div>
                           
                           
                        </div> 
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="stationary_charges">Stationary Charges (if any)</label>
                                <input type="text" class="form-control" id="stationary_charges" name="stationary_charges" placeholder="Enter Stationary Charges">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="maintenance_charge">Maintenance Charges (if any)</label>
                                <input type="text" class="form-control" id="maintenance_charge" name="maintenance_charge" placeholder="Enter Maintenance Charges">
                            </div>
                           
                           
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="collection_charge">Collection Charges (if any)</label>
                                <input type="text" class="form-control" id="collection_charge" name="collection_charge" placeholder="Enter Collection Charges">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="insurance_charges">Insurance Charges (if any)</label>
                                <input type="text" class="form-control" id="insurance_charge" name="insurance_charge" placeholder="Enter Insurance Charges">
                            </div>
   
                        </div> 

                        <hr>
                        <h4 class="header-title"  style="text-align:center;">Late Fine Charges</h4>    
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="grace_period">Grace Period Days </label>
                                <input type="text" class="form-control" id="grace_period" name="grace_period" placeholder="Enter Grace Period Days " >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="panulty_type">Penulty Type </label>
 
                               <select name="panulty_type" id="panulty_type" class="form-control" >
                                   <option value="fixed">Fixed</option>
                                   <option value="percentage">Percentage</option>
                                  
                               </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="penalty">Penalty (per EMI)</label>
                                <input type="text" class="form-control" id="penalty" name="penalty" placeholder="Enter Penalty (p.m)" >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="penalty">Stamp Duty Charge (in INR)</label>
                                <input type="text" class="form-control" id="stamp_duty_charge" name="stamp_duty_charge" placeholder="Enter Stamp Duty Charge (in %)" >
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <!-- <div class="form-group col-md-4">
                                <label for="panulty_type">Overdue Interest Type - <button type="button" class="btn btn-warning adj" onclick="togglePopup()"> <i class="fa fa-info info" aria-hidden="true"></i>  </button></label>
 
                               <select name="overdue_int_type" id="overdue_int_type" class="form-control" >
                                    <option value="">Select One</option>
                                  
                                    <option value="Type-1">Type-1</option>
                                   <option value="Type-2">Type-2</option>
                                  
                               </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="grace_period">Overdue Interest Rate (in %) </label>
                                <input type="text" class="form-control" id="overdue_int_rate" name="overdue_int_rate" placeholder="Enter Overdue Interest Rate (in %) " >
                            </div> -->
                            
                            

                           
                        </div>


                        
                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary  pr-4 pl-4"><i class="fa fa-plus-square-o" aria-hidden="true"></i>&nbsp;Create Loan Scheme</button>
                        <a class="btn btn-danger" href="{{route('admin.loan_schema.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel </a>
                        <button type="reset" class="btn btn-warning  pr-4 pl-4"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>

<!-- div containing the popup -->
<!-- <div class="content">
        <div onclick="togglePopup()" class="close-btn">
            ×
        </div>
        <h3>Overdue Interest Type</h3>
  
        <p>
        Overdue Interest Rate always be in %.<br>

            Overdue Interest will be calculated over the loan interest rate whenever EMIs is in OVERDUE state. There are different types to calculate the penal interest rate as follow<br>

            Loan Interest Rate - 20%<br>

            TYPE 1 -<br>
            Overdue Interest Rate - 2%<br>
            Net Overdue Interest Rate - 20 + 2 = 22% annually<br>

            TYPE 2 (Overdue Interest Rate will be multiple by the no of EMIs OVERDUE) -<br>
            Overdue Interest Rate - 2%<br>
            OVERDUE EMIs Count - 3<br>
            Net Overdue Interest Rate - 20 + 6 (3 * 2) = 26% annually
        </p>
    </div> -->
   
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
<script >
      
      // Function to show and hide the popup
      function togglePopup() {
          $(".content").toggle();
      }
  </script>
<script>
  $('#form').parsley();
</script>
@endsection
