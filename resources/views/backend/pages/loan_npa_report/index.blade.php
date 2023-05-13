
@extends('backend.layouts.master')

@section('title')
 NPA Report - Admin Panel
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
                <h4 class="page-title pull-left">Report -  NPA  Report</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>NPA Details</span></li>
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
        color: #286090;
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
  
    <div class="card mt-5">
        <div class="card-body card-b">
        <div class='d-flex justify-content-between align-items-center'>
           <h4 class="header-title">Search loan NPA</h4>
           <div class="toggle">
            <h4 class='toggle-text'>+</h4>
           </div>
         </div>

    
            <div class="form-row d-none">
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
                    <div class=" col-md-3 pt-4 pl-3">
                        <button id="date_search" class="btn btn-primary pr-4 pl-4"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                        <a class="btn btn-danger" href="{{route('admin.members_management.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Clear</a>
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


    <!-------------- EMI Details Table------------>

    <div class="card mt-5">
        <div class="card-body" style="border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
        <div>
        <h4 class="header-title">NPA Details</h4>
        <div class="text-right">
                <a href="" id="export" class="btn btn-danger btn-sm" style="text-align: right;"><i class="fa fa-download" aria-hidden="true"></i>Download Excel</a>
                <a href="" id="pdf_export" class="btn btn-danger btn-sm" style="text-align: right;"><i class="fa fa-download" aria-hidden="true"></i>Download PDF</a>
            </div>
    
    </div>
        
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
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
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
            url: "npa_report_search",
            type: 'GET',
            data: {from_date:from_date,
                to_date: to_date,
                 branch: branch,

            },
                success:function(res){  
                    //console.log(res);

                    if(res.length){
                         $('#myTable').empty();
                    
                        const obj =(res);
                        Object.entries(obj).forEach((entry) => {
                            const [key, value] = entry;
                            //console.log(`${key}: ${value.created_at}`);
                            
                            $('#myTable').append(
                                '<tr><td>' + `${value.branch_name}` +
                                '</td><td>' + `${value.member_id_code} - ${value.first_name}` +
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
        $("#export").attr("href","./npa_report_export/"+from_date+"/"+to_date+"/"+branch);
    })
    $("#pdf_export").click(function(){
        var from_date=$("#from_date").val();
        var to_date=$("#to_date").val();
        var branch=$("#search_by_branch").find(":selected").val();

       // console.log(from_date);
        $("#pdf_export").attr("href","./npa_report_exportPdf/"+from_date+"/"+to_date+"/"+branch);
    })
})
        
</script>
@endsection