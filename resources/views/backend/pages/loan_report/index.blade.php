
@extends('backend.layouts.master')

@section('title')
Loan Application Report - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Loan Application Report</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Not Approval Reports</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->
<style>
      .toggle{
         cursor:pointer;
       }
       .d-none{
         display: none;
       }
       .card-body{
         padding:  0.2rem 1rem 0.2rem 1rem !important;
       }
       .card-b{
        border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);
      }
      .toggle-text{
        position: relative;
        animation-name: up-down;
        animation-duration: 1s;
        animation-iteration-count: infinite;
        animation-timing-function: ease-in-out;
        font-size: 4rem;
        color: #8914fe;
      }
      @keyframes up-down {
         0% {
           transform: translateY(0);
         }
         50% {
           transform: translateY(-5px);
         }
         100% {
           transform: translateY(0);
         }
       }
</style>   
<div class="main-content-inner">
    <div class="row">

    <div class="col-12 mt-5">

    <div class="card">
        <div class="card-body card-b">
        <div class='d-flex justify-content-between align-items-center'>
           <h4 class="header-title">Search Loan Application</h4>
           <div class="toggle">
            <h4 class='toggle-text'>+</h4>
           </div>
         </div>
            

    
            
        
                <div class="form-row d-none">
                    <div class="form-group col-md-3">
                        <label for="search_by_branch">Branch:</label>
                        <select name="branch" id="search_by_branch" class="form-control">
                            <option value="">ALL</option>
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
                    <div class=" col-md-3 pt-4 pl-3">
                        <button id="date_search" class="btn btn-primary pr-4 pl-4"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                        <a class="btn btn-danger" href="{{route('admin.members_management.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Clear</a>
                </div> 
                          
                </div>

               
            

        </div>
    </div>
    </div>
                <script>
                   const toggleButton = document.querySelector('.toggle');
                   const formRows = document.querySelectorAll('.form-row');

                   toggleButton.addEventListener('click', function() {
                     // toggle the visibility of the form-row divs
                     formRows.forEach(row => {
                       row.classList.toggle('d-none');
                     });

                     // toggle the text content of the toggle button
                     const toggleText = document.querySelector('.toggle-text');
                     toggleText.textContent = toggleText.textContent === '-' ? '+' : '-';
                   });
                </script> 
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card" style="border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
            
                <div class="card-body">
                    <div>
                    <h4 class="header-title float-left">Not Approval Report's List</h4>
                    <div class="text-right">
                <a href="" id="export" class="btn btn-danger btn-sm" style="text-align: right;"><i class="fa fa-download" aria-hidden="true"></i>Download Excel</a>
                <a href="" id="pdf_export" class="btn btn-danger btn-sm" style="text-align: right;"><i class="fa fa-download" aria-hidden="true"></i>Download PDF</a>
            </div>
                    
                </div>

                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   
                                    <!-- <th width="05%">SL No.</th> -->
                                    <th width="10%">Application No.</th>
                                    <th width="10%">Member Code</th>
                                  
                                    <th width="10%">Member Name</th>
                                    <th width="05%">Application Date</th>
                                    <th width="10%">Branch</th>
                                    <th width="10%">Scheme Name</th>
                                   
                                    <th width="05%">Loan Amount</th>
                                    <th width="05%">Term</th>
                                    <th width="05%">Mode</th>
                                    <th width="05%">ROI</th>
                                    <th width="10%">EMI</th>

                                </tr>
                            </thead>
                            <tbody id="myTable">
                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
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
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
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
$(document).ready(function(){
    $("#date_search").click(function(){
       
         var branch=$("#search_by_branch").find(":selected").val();

        var from_date=$("#from_date").val();
        var to_date=$("#to_date").val();
       // console.log(branch);

        $.ajax({
            url: "application_report_search",
            type: 'GET',
            data: {from_date:from_date,
                to_date: to_date,
                 branch: branch,

            },
                success:function(res){  
                    //console.log(res);

                    if(res.length){
                         $('#myTable').empty();
                    
                        const obj = (res);
                        Object.entries(obj).forEach((entry) => {
                            const [key, value] = entry;
                            //console.log(`${key}: ${value.created_at}`);
                            
                            $('#myTable').append(
                                // '<tr><td>' +  +
                                '<tr><td>' + `${value.loanApplication_id} ` +
                                '</td><td>' + `${value.member_id_code}` +
                                '</td><td>' + `${value.first_name}` +
                                '</td><td>' + `${value.application_date}` +
                                '</td><td>' + `${value.branch_name}` +
                                '</td><td>' + `${value.schema_name}` +
                                '</td><td>' + `${value.amt_approved}` +
                                '</td><td>' + `${value.tenure_months}` +
                                '</td><td>' + `${value.tenure_type}` +
                                '</td><td>' + `${value.ann_rate_int}` +
                                '</td><td>' + `${value.emi_amount_total}` +

                                // '</td><td>' + '<a href="'+`./loan_appli_accnt/`+`${value.emi_id}`+`/emi_pay/`+'" target="_blank"><i class="fa fa-money" aria-hidden="true"></i></a>' +
                                 '</td></tr>'
                                
                            );
                           // console.log(value.emi_date);
                        });
                    }else{
                        $('#myTable').empty();

                            $('#myTable').append(
                                '<tr><td>' + `` +
                                    '</td><td>' + `` +
                                    '</td><td>' + `` +
                                    '</td><td>' + `` +

                                    '</td><td>' + `No Data Available` +
                                    '</td><td>' + `` +
                                    '</td><td>' + `` +
                                    '</td><td>' + `` +
                                    '</td><td>' + `` +
                                    '</td><td>' + `` +
                                    '</td><td>' + `` +

                                    '</td></tr>'
                                );
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
        $("#export").attr("href","./not_approval_report_export/"+from_date+"/"+to_date+"/"+branch);
    })

    $("#pdf_export").click(function(){
        var from_date=$("#from_date").val();
        var to_date=$("#to_date").val();
        var branch=$("#search_by_branch").find(":selected").val();

       // console.log(from_date);
        $("#pdf_export").attr("href","./not_approval_report_exportPdf/"+from_date+"/"+to_date+"/"+branch);
    })
})
        
</script>


@endsection