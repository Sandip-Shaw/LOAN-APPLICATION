
@extends('backend.layouts.master')

@section('title')
Code series - Admin Panel
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
                <h4 class="page-title pull-left">Account Code Series</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Account Code Series</span></li>
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
                    <h4 class="header-title"> Set Members / Accounts Sequence No Series </h4>
                    @include('backend.layouts.partials.messages')
                    <table class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="30%">Name</th>
                                    <th width="15%">Code Prefix</th> 
                                    <th width="15%">No. of Digits</th>
                                    <th width="15%">Start No. Digits</th>
                                    
                                </tr>
                            </thead>
           
                            <tbody id="code_details">
                                    <tr>
                                        <td>
                                        <label for="member_code">Member code</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="advisor_code">Collector/Advisor Code</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="emp_code">Employee Code</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="rd_policy">RD Policy No.</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="fd_policy">FD Policy Code</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="daily_policy">Daily Policy No.</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="flexi_daily_policy">Flexi Daily Policy</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="mis_policy">MIS Policy No.</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="saving_accnt">Saving Account No.</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="fixed_emi">Fixed Emi Loan</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="no_emi">No EMI Loan</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="fixed_eni_gold_loan">Fixed EMI Gold Loan</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="no_emi_gold_loan">No EMI Gold Loan</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="group_loan">Group Loan ID</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                    <tr>
                                        <td>
                                        <label for="hrm_code">HRM Code</label>
                                        <input type="hidden" name="code_name[]" id="member_code" value="" class="form-control"/>

                                        </td>
                                        
                                        <td>
                                            <input type="text" name="code_prefix[]" id="code_prefix" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="no_of_digit[]" id="no_of_digit" value="" class="form-control"/>&nbsp;
                                        </td>
                                        <td>
                                            <input type="text" name="start_digits[]" id="start_digits" value="" class="form-control"/>&nbsp;
                                        </td>
                                        
                                    </tr>

                                   
                                    <!-- <tr>
                                        <td style="text-align:center">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </td>
                                    </tr>
                                    -->
                            </tbody>
             
                    </table>  
                <div style="text-align:center" style="display: inline-block;">
                    <button onclick="storeTblValues()" class="btn btn-primary">Save</button>

             
                    <form action="{{route('admin.series-setting.store')}}" method="post">
                        @csrf
                        <input type="text" name="code_data" id="code_data">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
        
                    
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="parsley.min.js"></script>

<!-- <script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script> -->

<script>
  $('#form').parsley();



function storeTblValues()
{
 
    $('#code_data').val(null);
    var TableData = {
                    "data" : {}
                }

    $('#code_details tr').each(function(row, tr){
        TableData.data["code"+row]={
            "name" : $(tr).find('label:eq(0)').text()
            , "code_prefix" :$(tr).find('input:eq(1)').val()
            , "no_of_digit" : $(tr).find('input:eq(2)').val()
            , "start_digits" : $(tr).find('input:eq(3)').val()
        }    
    }); 
    //TableData.shift();  // first row will be empty - so remove
    console.log(TableData);
    $('#code_data').val(JSON.stringify(TableData));
    
    
}
</script>


@endsection
