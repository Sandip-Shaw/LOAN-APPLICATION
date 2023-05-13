
@extends('backend.layouts.master')

@section('title')
Payment Collection - Admin Panel
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
    .main-content-inner {
    margin-top: 15px !important;
    padding: 0px 29px 50px;
}
</style>

@endsection


@section('admin-content')



<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Member Payment Collection</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>EMI Details</span></li>
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
  
    <!-- <div class="card mt-5">
        <div class="card-body"> -->
        <!-- <h4 class="header-title">EMI Collection Search</h4>
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label  for="search_by_member_no">From Date:</label>
                        <input type="date" class="form-control" id="from_date" name="from_date">
                    </div>

                    <div class="form-group col-md-4">
                        <label  for="search_by_member_name">To Date:</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                    </div>

                </div>

                <button id="date_search" class="btn btn-primary  pr-4 pl-4">Search</button>
                <a class="btn btn-danger" href="{{route('admin.payment_collection.index')}}">Clear</a>
        </div>
    </div> -->

    <!-- <div class="card mt-5">
        <div class="card-body">
        <h4 class="header-title">Name Search</h4>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="branch_search">Branch:</label>
                    <input id="branch_search" type="text" class="form-control" placeholder="Search by Branch">

                </div>

                <div class="form-group col-md-4">
                    <label for="member_search">Member:</label>
                    <input id="member_search" type="text" class="form-control" placeholder="Search by Member">
                </div>
            </div>
        </div>
    </div> -->

    <!-------------- EMI Details Table------------>

    <div class="card mt-5">
        <div class="card-body" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
        

        <h4 class="header-title">EMI Details:-</h4>
        <div class="float-right">
        <a href="" id="pdf_export" class="btn btn-danger"><i class="fa fa-download" aria-hidden="true"></i> xlsx file</a></div>
        </div>

        <div class="clearfix">
            <div class="data-tables" id="emi_collection" style="overflow-x: auto;">
                <table style=" width: 100%" id="dataTable" class="text-center" >
                    <thead class="bg-light text-capitalize">
                        <tr style="font-size: 15px;">
                            <th>Member Name</th>
                            <th>Branch</th>
                            <th>Emi No. </th>
                            <th>Emi Date</th>
                            <th>Emi Due Date</th>
                            <th>Principal</th>
                            <th>Interest</th>
                            <th>Other Charge</th>
                            <th>Emi</th>
                            <th>Bal Principal</th>
                            <th>Status</th>

                            <th>Actions</th>

                        </tr>
                    </thead>
                   <tbody id="myTable">
                        
                   </tbody>
                   
                </table>
            </div>
        </div>

    </div>


    
</div>




@endsection

@section('scripts')
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->

<!-- <script src="jquery.js"></script>
<script src="parsley.min.js"></script> -->

<!-- <script>
    $(document).ready(function() {
        $('.select2').select2();
    })

</script> -->

<!-- <script>
  $('#form').parsley();
</script> -->

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
    // $("#date_search").click(function(){
      //  var from_date=$("#from_date").val();
        var to_date=new Date().toISOString().slice(0, 10);
        console.log(to_date);

        $.ajax({
            url: "searchByDate",
            type: 'GET',
            data: {
                to_date: to_date,
            },
                success:function(res){  
                    console.log(res);

                    if(res){
                        $('tbody').empty();
                    
                        const obj = JSON.parse(res);
                        Object.entries(obj).forEach((entry) => {
                            const [key, value] = entry;
                            //console.log(`${key}: ${value.created_at}`);
                            
                            $('#emi_collection tbody').append(
                                '<tr><td>' + `${value.first_name}` +
                                '</td><td>' + `${value.branch_name}` +
                                '</td><td>' + `${value.emi_no}` +
                                '</td><td>' + `${value.emi_date}` +
                                '</td><td>' + `${value.emi_due_date}` +
                                '</td><td>' + `${value.principal_amt}` +
                                '</td><td>' + `${value.interest}` +
                                '</td><td>' + `${value.other_charges}` +
                                '</td><td>' + `${value.emi_amt}` +
                                '</td><td>' + `${value.bal_principal}` +
                                '</td><td>' + `${value.status}` +
                                '</td><td>' + '<a href="'+`./loan_appli_accnt/`+`${value.emi_id}`+`/emi_pay/`+'" target="_blank"><i class="fa fa-money" aria-hidden="true"></i></a>' +
                                '</td></tr>'
                            )
                        });
                    } 
                }
            })
        })
    

</script>
<script>
// $(document).ready(function(){
//   $("#member_search").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
//     $("#myTable tr").filter(function() {
//       $(this).toggle($(this.children[0]).text().toLowerCase().indexOf(value) > -1)
//     });
//   });

//   $("#branch_search").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
//     $("#myTable tr").filter(function() {
//       $(this).toggle($(this.children[1]).text().toLowerCase().indexOf(value) > -1)
//     });
//   });
// });
$(document).ready(function(){

    $("#pdf_export").click(function(){
        
        var to_date=new Date().toISOString().slice(0, 10);
        
        $("#pdf_export").attr("href","./emipayment_report/"+to_date);

    })
})
</script>

@endsection