
@extends('backend.layouts.master')

@section('title')
Salary Disbursement - Admin Panel
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
                <h4 class="page-title pull-left">Salary Disbursement</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Release Salary</span></li>
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
        <div class="col-md-8">
            <div class="card" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <h4 class="header-title"> Create New </h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ route('admin.salary_disbursement.store') }}" method="POST" id="form"  data-parsley-validate>
                        @csrf
                      
                            <div class="form-group row">
                                <label  for="employee" class="col-sm-4 col-form-label">Employee<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <div class="col-sm-7">
                                <select name="employee_id" id="employee" class="form-control" >
                                <option value="">Select Employee</option>
                                @foreach($hrmanagements as $key=>$employee_id)
                                        <option value="{{$employee_id}}">{{$key}}</option>
                                    
                                @endforeach
                                   
                                  
                                   
                               
                                </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  for="disburse_salary" class="col-sm-4 col-form-label">Salary<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <div class="col-sm-7">
                                <input type="text" class="form-control" id="disburse_salary" name="disburse_salary" placeholder="Enter Salary to Disburse" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  for="remarks" class="col-sm-4 col-form-label">Remarks (if any)</label>
                                <div class="col-sm-7">
                                <textarea id="summernote" name="remarks" class="form-control" placeholder="Enter Remarks (if any)"></textarea> 
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label  for="trans_date" class="col-sm-4 col-form-label">Transaction Date<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                                <div class="col-sm-7">
                                <input type="date" class="form-control" id="trans_date" name="trans_date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >Pay Mode <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                <div class="form-group col-sm-6">
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
                            
                            </div>

                                           
                        <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary  pr-4 pl-4">Save </button>
                        <a class="btn btn-danger" href="{{route('admin.comp_branch.index')}}">Cancel </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        <div class="col-md-4" id="employee_details" style="width:450px; height: 100%;height: 250px; height: 250px;">

        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="jquery.js"></script>
<script src="parsley.min.js"></script>


   
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
                                    <label class="col-sm-4 col-form-label" for="bank_name_cheque" >Bank Name <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="text" name="bank_name_cheque" id="" value="" class="form-control" >

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="cheque_no" >Cheque No. <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="text" name="cheque_no" id="" value="" class="form-control" >

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="cheque_date" >Cheque Date <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="date" name="cheque_date" id="" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" >

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
                                    <label class="col-sm-4 col-form-label" for="transfer_date_onlineTrans" >Transfer Date<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="date" name="transfer_date_onlineTrans" id="" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" >

                                    </div>
                                </div><div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="transaction_no" >UTR/ Transaction No. <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="text" name="transaction_no" id="" value="" class="form-control" >

                                    </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="transfer_mode" >Transfer Mode  <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                <div class="form-group col-sm-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="transfer_mode" id="" value="IMPS">
                                    <label class="form-check-label" for="transfer_mode">IMPS</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="transfer_mode" id="" value="VPA">
                                    <label class="form-check-label" for="transfer_mode">VPA</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="transfer_mode" id="" value=" NEFT/RTGS" >
                                    <label class="form-check-label" for="transfer_mode"> NEFT/RTGS  </label>
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
        $("#employee").change(function(){
            var id=$(this).find(":selected").val();
          

            $.ajax({
                type:"GET",
                url:"../employeeDetails/"+id,
                success:function(res){        
                if(res){
                    const obj = JSON.parse(res);
                   // console.log(obj);
                   
                   $('#employee_details').empty(); 

                    trHTML = '<table id="doc_table" style="width:100%;">  <tr class="table-primary"><td>' + 'Employee Details'  + '</td></tr> <tr><td>' + 'Branch' + '</td><td>' + obj.branch + '</td></tr> <tr><td>' + 'Name' + 
                    '</td><td>' + obj.name + '</td></tr><tr><td>' + 'Code' + '</td><td>' + obj.emp_code + '</td></tr> <tr><td>' + 'Joining Date' + '</td><td>' + obj.dateofjoining + '</td></tr></table>';
              
                    $('#employee_details').append(trHTML);
                   
                }
            }
            })
        })
    })


</script>
<script>
  $('#form').parsley();
</script>
@endsection