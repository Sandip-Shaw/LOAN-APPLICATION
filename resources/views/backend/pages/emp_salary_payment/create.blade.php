
@extends('backend.layouts.master')

@section('title')
HR Management Create - Admin Panel
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
                <h4 class="page-title pull-left">Salary Payment</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Create Salary Payment</span></li>
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
                    <!-- <h4 class="header-title"> Create Employees </h4> -->
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{route('admin.salary_payment.store')}}" method="POST" id="form" data-parsley-validate>
                        @csrf


                        <div class="form-row">
                            
                            
                            <div class="form-group col-md-6 ">
                                <label for="employee_id">Employee Code & Name</label>
                                <select name="employee_id" id="employee_id" class="form-control selectpicker" data-live-search="true" >
                                <option value="">Select Employee</option>
                                    @foreach($hrmanagements as $hrmanagement)
                                    <option value="{{$hrmanagement->hrmanagement_id}}" >{{$hrmanagement->emp_code}}-{{$hrmanagement->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="" ><b> Select Month Year :</b></label>&nbsp;

                                <input type="month" class="form-control" id="month_year" name="month_year"  required>
                            
                            </div>
                        </div>

                        <hr>
                        <h4 class="header-title"> Employee Structure </h4>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="basic">Basic</label>
                                <input type="text" class="form-control" id="basic" name="basic"  readonly>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="others">Others</label>
                                <input type="text" class="form-control" id="others" name="others" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="HRA">HRA</label>
                                <input type="text" class="form-control" id="HRA" name="HRA" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group col-md-4 ">
                                <label for="fuel">Fuel</label>
                                <input type="text" class="form-control" id="fuel" name="fuel" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="DA">DA</label>
                                <input type="text" class="form-control" id="DA" name="DA"  readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="allowance">Allowance</label>
                                <input type="text" class="form-control" id="allowance" name="allowance"  readonly>
                            </div>
                        </div>
                       
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="TA">TA</label>
                                <input type="text" class="form-control" id="TA" name="TA"  readonly>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="gross_pay">Gross Pay </label>
                                <input type="text" class="form-control" id="gross_pay" name="gross_pay" readonly>
                            </div>
                           
                           
                        </div>
                        <hr>
                        <div class="form-row">
                            
                            <div class="form-group col-md-4 ">
                                <label for="PF">PF </label>
                                <input type="text" class="form-control" id="PF" name="PF"  readonly>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="ESI">ESI </label>
                                <input type="text" class="form-control" id="ESI" name="ESI" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="net_pay">Net Pay<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="net_pay" name="net_pay"  readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="TA">Working days(per month)</label>
                                <input type="text" class="form-control" id="working_day" name="working_day"  readonly>
                            </div>
                            <!-- <div class="form-group col-md-4">
                                <label for="TA">Deduction</label>
                                <input type="text" class="form-control" id="deduction" name="deduction"  required>
                            </div> -->
                            <div class="form-group col-md-4">
                                <label for="amt_to_pay">Amount to Pay<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="text" class="form-control" id="amt_to_pay" name="amt_to_pay"  readonly>
                            </div>
                           
                           
                        </div>

                        <hr>
                        <div class="form-row">
                            
                            <div class="form-group col-md-4 ">
                                <label for="pay_branch">Pay Branch <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <!-- <input type="text" class="form-control" id="PF" name="PF"  > -->
                                <select name="pay_branch" id="pay_branch" class="form-control" required>
                                    <option value="">Choose Branch</option>
                                    @foreach($branch as $key=>$branches)
                                    <option value="{{$branches}}">{{$key}}</option>
                                   
                                   @endforeach
                                   
                                   
                                </select>
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="pay_date">Pay Date <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <input type="date" class="form-control" id="pay_date" name="pay_date" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="payment_by">Payment BY:<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <!-- <input type="text" class="form-control" id="net_pay" name="net_pay"  > -->
                                <select name="payment_by" id="payment_by" class="form-control" required>
                                <option value="">Choose One</option>

                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="NFT">NFT</option>
                                    
                                </select>
                            </div>
                        </div>
                        

                        <div style="text-align:center;">
                        <button type="button"  class="btn btn-primary  pr-4 pl-4" data-toggle="modal" data-target="#exampleModal">Release </button>
                        <a class="btn btn-danger" href="{{route('admin.salary_details.index')}}">Cancel </a>
                        <!-- <button type="reset" class="btn btn-warning  pr-4 pl-4">Clear </button> -->
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
                                                Do you want to release the employee salary?
                                          
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
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />


<!-- <script src="jquery.js"></script> -->
<script src="parsley.min.js"></script>

<script>
    // $(document).ready(function() {
        // $('.select2').select2();
        $(function() {
         $('.selectpicker').selectpicker();
        });
    // })

$(document).ready(function() {
    $("#employee_id").change(function(){
        
            var id=$(this).find(":selected").val();
          
            $.ajax({
                type:"GET",
                url:"../salary_detail/"+id,
                success:function(res){ 
                 // console.log(res);       
                if(res){
                    const obj = JSON.parse(res);
                   // console.log(obj);
                   Object.entries(obj).forEach((entry)=>
                     {
                        const [key,value]=entry;
                       // console.log(`${value.net_pay}`);
                       // net_pay=`${value.net_pay}`;
                     document.getElementById("basic").value = `${value.basic}`;
                     document.getElementById("others").value = `${value.others}`;
                     document.getElementById("HRA").value = `${value.HRA}`;
                     document.getElementById("fuel").value = `${value.fuel}`;
                     document.getElementById("DA").value = `${value.DA}`;
                     document.getElementById("allowance").value = `${value.allowance}`;
                     document.getElementById("TA").value = `${value.TA}`;
                     document.getElementById("gross_pay").value = `${value.gross_pay}`;
                     document.getElementById("PF").value = `${value.PF}`;
                     document.getElementById("ESI").value = `${value.ESI}`;
                     document.getElementById("net_pay").value = `${value.net_pay}`;

                       
                    })

                    var pf_val =  $('#PF').val();
                    var esi_val =  $('#ESI').val();
                  //  console.log(net_pay_val);
                    //console.log(working_per_day);
                  //  var working_per_day='';

                       // console.log(working_per_day);

                    // var not_work_day =
                    // $("#working_day").keyup(function(){
                        
    
                    //     if($('#working_day').val() != 0 || $('#working_day').val() != null ){
                    //         // var total_sub =  gross_pay_val - pf_val - esi_val - (+$('#deduction').val());

                    //         var amt_pay = working_per_day * ($('#working_day').val());
                    //          console.log(amt_pay);
                    //     }
                    //     $('#amt_to_pay').val(amt_pay);
                    // });

                }
            }
           
        })


    }) ;

    $("#month_year").change(function(){
        var emp_id=$("#employee_id").val();
        
        var month=$(this).val();

        // console.log(month);
        // console.log(emp_id);

        const url = '/laravel_role/admin/atten_type/'+emp_id+'/'+month;
        const resp = fetch(url)
        .then((response) => { 
            return response.json().then((data) => {

             document.getElementById('working_day').value = data.count;
           // r1.textContent = data.time_of_travel_so_far+" min";
           var net_pay_val =  $('#net_pay').val();
           var  working_per_day = net_pay_val/30;

                var amt_pay = data.count * working_per_day;
                $('#amt_to_pay').val(amt_pay);

            })
    });

});

});
</script>



@endsection