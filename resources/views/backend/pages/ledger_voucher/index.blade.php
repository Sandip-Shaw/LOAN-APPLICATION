
@extends('backend.layouts.master')

@section('title')
Ledger Voucher - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


<style>
    .form-check-label {
        text-transform: capitalize;
    }
    th{
        padding: 0 20px;
    }
</style>
@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Payment Voucher</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Ledger Voucher</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
        @include('backend.layouts.partials.messages')
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
  
    <div class="card mt-5">
        <div class="card-body">
        <h4 class="header-title"> Search</h4>

    
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="search_by_branch">Branch:</label>
                    <!-- <input id="branch_search" type="text" class="form-control" placeholder="Search by Branch"> -->
                    <select name="branch" id="search_by_branch" class="form-control" >
                        <option value="">Select One</option>
                            @foreach($branch as $key=>$branches)
                            <option value="{{$branches}}">{{$key}}</option>
                                   
                           @endforeach
                                  
                    </select>
                </div>

                
                    <div class="form-group col-md-3">
                        <label  for="search_by_member_no">From Date:</label>
                        <input type="date" class="form-control" id="from_date" name="from_date">
                    </div>

                    <div class="form-group col-md-3">
                        <label  for="search_by_member_name">To Date:</label>
                        <input type="date" class="form-control" id="to_date" name="to_date">
                    </div>

                </div>
            

                <button id="date_search" class="btn btn-primary  pr-4 pl-4">Search</button>
                <a class="btn btn-danger" href="{{route('admin.ledger_voucher.index')}}">Clear</a>
        </div>
        
    </div>

    <!-- enty details -->
    <div class="card mt-5">
        <div class="card-body" style="border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
        <h4 class="header-title"> Enrty Details</h4>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="search_by_branch">Branch:</label>
                    <!-- <input id="branch_search" type="text" class="form-control" placeholder="Search by Branch"> -->
                    <select name="branchs" id="branchs" class="form-control" >
                        <option value="">Select One</option>
                            @foreach($branch as $key=>$branches)
                            <option value="{{$branches}}">{{$key}}</option>
                                   
                           @endforeach
                                  
                    </select>
            </div>
            <div class="form-group col-md-3 ">
                <label for="select_type">Select Type:</label>
                    <!-- <input id="branch_search" type="text" class="form-control" placeholder="Search by Branch"> -->
                    <select name="select_type" id="select_type" class="form-control" >
                            <option value="">Select One</option>
                           
                            <option value="">Direct</option>
                                   
                    </select>
            </div>
            <div class="form-group col-md-3 ">
                <label for="branch_code">Receipt no.<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                <input type="text" class="form-control" id="receipt_no" name="receipt_no" readonly required>
            </div>  
            
            <div class="form-group col-md-3 ">
                <label for="select_type">Direct/Transfer:</label>
                    <!-- <input id="branch_search" type="text" class="form-control" placeholder="Search by Branch"> -->
                    <select name="transfer" id="transfer" class="form-control" >
                            <option value="">Select One</option>
                           
                            <option value="">Cash A/C</option>
                                   
                    </select>
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="txn_date">Txn Date<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                <input type="date" class="form-control" id="txn_date" name="txn_date"  required>
            </div>
            <div class="form-group col-md-3 ">
                <label for="amount">Amount<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                <input type="text" class="form-control" id="amount" name="amount"  required>
            </div>
            <div class="form-group col-md-3 ">
                <label for="ledger">Select Ledger:</label>
                    <!-- <input id="branch_search" type="text" class="form-control" placeholder="Search by Branch"> -->
                    <select name="ledger" id="ledger" class="form-control" >
                            <option value="">Select One</option>
                           
                            <option value="">Official Exp</option>
                                   
                    </select>
            </div>
            <div class="form-group col-md-3 ">
                <label for="remarks">Remarks (if any)</label>
                <!-- <input type="text" class="form-control" id="" name="receipt_no" readonly required> -->
                <textarea id="summernote" name="remarks" class="form-control" placeholder="Remarks..."></textarea> 

            </div>  
            
            
        </div>
            
            <div style="text-align:right;">

                <button id="date_search" class="btn btn-primary  pr-4 pl-4">Save</button>
                <!-- <a class="btn btn-danger" href="{{route('admin.loan_overDue_report.index')}}">Clear</a> -->
            </div>
    </div>
        
    </div>



    <!-- end entry details -->


    <!-------------- EMI Details Table------------>

    <div class="card mt-5">
        <div class="card-body">
        <div>
        <h4 class="header-title">Ledger Voucher</h4>
        <a href="" id="export" class="btn btn-danger" style="text-align:right;">Download csv</a></div>
        
        <div class="clearfix"></div>
            <div class="data-tables" id="emi_collection" style="overflow-x: auto;">
                <table style=" width: 100%" id="dataTable" class="text-center" >
                    <thead class="bg-light text-capitalize">
                        <tr style="font-size: 15px;">
                            
                            <th>BRANCH</th>
                            <th>MEMBER</th>
                            <th>MOBILE NUMBER</th>
                            <th>ACCOUNT NO.</th>
                            <th>EMI NO.</th>
                            <th>EMI DATE </th>
                            <th>EMI DUE DATE</th>
                            <th>PRINCIPAL</th>
                            <th>INTEREST</th>
                            <th>EMI AMOUNT</th>

                            <th>STATE</th>

                        </tr>
                    </thead>
                   <tbody id="myTable">
                    
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        

                    </tr>
                       
                   </tbody>
                   
                </table>
            </div>
        </div>

    </div>


    
</div>




@endsection

@section('scripts')


@section('scripts')
     <!-- Start datatable js -->
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     
     <!-- <script>
         /*================================
        datatable active
        ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }

     </script> -->

<script>

$(document).ready(function(){
    $("#date_search").click(function(){
       
         var branch=$("#search_by_branch").find(":selected").val();

        var from_date=$("#from_date").val();
        var to_date=$("#to_date").val();
       // console.log(branch);

        $.ajax({
            url: "overdue_report_search",
            type: 'GET',
            data: {from_date:from_date,
                to_date: to_date,
                 branch: branch,

            },
                success:function(res){  
                    //console.log(res);

                    if(res){
                         $('#myTable').empty();
                    
                        const obj = JSON.parse(res);
                        Object.entries(obj).forEach((entry) => {
                            const [key, value] = entry;
                            //console.log(`${key}: ${value.created_at}`);
                            
                            $('#myTable').append(
                                '<tr><td>' + `${value.branch_name}` +
                                '</td><td>' + `${value.member_id} - ${value.first_name}` +
                                '</td><td>' + `${value.mobile}` +
                                '</td><td>' + `${value.loan_disbursement_id}` +
                                '</td><td>' + `${value.emi_no}` +
                                '</td><td>' + `${value.emi_date}` +
                                '</td><td>' + `${value.emi_due_date}` +
                                '</td><td>' + `${value.principal_amt}` +
                                '</td><td>' + `${value.interest}` +
                                '</td><td>' + `${value.emi_amt}` +
                                '</td><td>' + `${value.status}` +
                                // '</td><td>' + '<a href="'+`./loan_appli_accnt/`+`${value.emi_id}`+`/emi_pay/`+'" target="_blank"><i class="fa fa-money" aria-hidden="true"></i></a>' +
                                 '</td></tr>'
                                
                            );
                           // console.log(value.emi_date);
                        });
                    }
                   
                }
        })

    

    })
})

</script>

<script>
   $(document).ready(function(){
    $("#export").click(function(){
        var from_date=$("#from_date").val();
        var to_date=$("#to_date").val();
        var branch=$("#search_by_branch").find(":selected").val();

       // console.log(from_date);
        $("#export").attr("href","./emi_overdue_report_export/"+from_date+"/"+to_date+"/"+branch);
    })
})
        
</script>
@endsection