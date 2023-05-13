
@extends('backend.layouts.master')

@section('title')
Report Salary Report - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />


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
                <h4 class="page-title pull-left">Report -  Salary Report</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Salary Report Details</span></li>
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
        <div class="card-body" style="border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
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
                        <label  for="month_year">Month-Year:</label>
                        <input type="month" class="form-control" id="month_year" name="month_year">
                    </div>
                    <div class=" col-md-3 pt-4 pl-3">
                        <button id="member_search" class="btn btn-primary pr-4 pl-4"><i class="fa fa-search" aria-hidden="true"></i>Search</button>
                        <a class="btn btn-danger" href="{{route('admin.members_management.index')}}">Clear</a>
                </div>
                </div>

                
        </div>
        
    </div>


    <!-------------- EMI Details Table------------>

    <div class="card mt-5">
        <div class="card-body" style="border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
        <div>
        <h4 class="header-title">Salary Report Details</h4>
        <div class="text-right">
                <a href="" id="export" class="btn btn-danger btn-sm" style="text-align: right;"><i class="fa fa-download" aria-hidden="true"></i>Download Xlsx</a>
                <a href="" id="pdf_export" class="btn btn-danger btn-sm" style="text-align: right;"><i class="fa fa-download" aria-hidden="true"></i>Download PDF</a>
            </div>
    </div>
        
        <div class="clearfix"></div>
            <div class="data-tables" id="emi_collection" style="overflow-x: auto;">
                <table style=" width: 100%" id="dataTable" class="text-center " >
                    <thead class="bg-light text-capitalize">
                        <tr style="font-size: 15px;">
                            
                            <th>Branch</th>
                            <th>Employee Code & Name</th>
                            <!-- <th>Mobile No.</th> -->
                            <th>Designation</th>
                            <th>Mobile No.</th>
                            <th>Email  </th>
                            <th>Amount Release</th>
                            <th>Mode</th>
                           
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

        var month_year=$("#month_year").val();
       
       // console.log(branch);

        $.ajax({
            url: "salary_report_search",
            type: 'GET',
            data: {branch:branch,
                month_year: month_year,

            },
                success:function(res){ 
                    // console.log(res);

                    // console.log(typeof(res));

                    // console.log(res.length);

                    if(res.length){
                         $('#myTable').empty();
                    
                       // const obj = JSON.parse(res);
                       const obj = res;
                        Object.entries(obj).forEach((entry) => {
                            const [key, value] = entry;
                            //console.log(`${key}: ${value.created_at}`);
                            
                            $('#myTable').append(
                                '<tr><td>' + `${value.branch_name}` +
                                '</td><td>' + `${value.emp_code} - ${value.name}` +
                                '</td><td>' + `${value.designation_name}` +
                                '</td><td>' + `${value.mobile}` +
                                '</td><td>' + `${value.email}` +
                                '</td><td>' + `${value.amt_to_pay}` +
                                '</td><td>' + `${value.payment_by}` +
                                '</td><td>' + `${value.status}` +
                                '</td></tr>'
                                
                            );

                        });
                    }else{
                        $('#myTable').empty();

                        $('#myTable').append(
                            '<tr><td>' + `` +
                                '</td><td>' + `` +
                                '</td><td>' + `` +
                                '</td><td>' + `No Data Available` +
                                '</td><td>' + `` +
                                '</td><td>' + `` +
                                '</td><td>' + `` +
                                '</td><td>' + `` +
                                '</td></tr>'
                        );
                       
                       // alert("No data Available"); 
                    }
                   
                }
        })


    })
})

</script>

<script>
   $(document).ready(function(){
    $("#export").click(function(){
      
        var month_year=$("#month_year").val();
        var branch=$("#search_by_branch").find(":selected").val();

        //console.log(month_year);
        $("#export").attr("href","./salary_report_export/"+month_year+"/"+branch);

    })

    $("#pdf_export").click(function(){
        
        var month_year=$("#month_year").val();
        var branch=$("#search_by_branch").find(":selected").val();

        $("#pdf_export").attr("href","./salary_report_exportPdf/"+month_year+"/"+branch);

    })
})
        
</script>
@endsection