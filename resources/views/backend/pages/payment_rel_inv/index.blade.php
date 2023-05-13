
@extends('backend.layouts.master')

@section('title')
Payment Release - Admin Panel
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
                <h4 class="page-title pull-left">Investment Payment Release</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Payment Details</span></li>
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
  
   

    <!-------------- EMI Details Table------------>

    <div class="card mt-5">
        <div class="card-body" style="border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
        <div>
        
        <h4 class="header-title">Payment Details:-</h4>
        <div class="float-right">
        <a href="" id="pdf_export" class="btn btn-danger" style="text-align:right;"><i class="fa fa-download" aria-hidden="true"></i>  xlsx file</a></div>
        </div>

        <div class="clearfix"></div>
            <div class="data-tables" id="emi_collection" style="overflow-x: auto;">
                <table style=" width: 100%" id="dataTable" class="text-center" >
                    <thead class="bg-light text-capitalize">
                        <tr style="font-size: 15px;">
                            <th>Member Code & Name</th>
                            <th>Branch</th>
                            <th>Tenure No</th>

                            <th>Principal</th>
                            <th>Maturity Amount </th>
                            <th>Interest Earned</th>
                            <th>Int Per Tenure</th>

                            <th>Release Date</th>
                            <th>Bal Principal</th>
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
            url: "search_date",
            type: 'GET',
            data: {
                to_date: to_date,
            },
                success:function(res){  
                   console.log(res);
                   console.log(typeof(res));


                    if(res.length){
                        $('tbody').empty();
                    
                        const obj = res;
                        Object.entries(obj).forEach((entry) => {
                            const [key, value] = entry;
                            //console.log(`${key}: ${value.created_at}`);
                            
                            $('#emi_collection tbody').append(
                                '<tr><td>' + `${value.member_id_code}` + `-`+`${value.first_name}` +
                                '</td><td>' + `${value.branch_name}` +
                                '</td><td>' + `${value.tenure_no}` +

                                '</td><td>' + `${value.principal_amt}` +
                                '</td><td>' + `${value.maturity_amount}` +
                                '</td><td>' + `${value.interest_earned}` +
                                '</td><td>' + `${value.int_per_tenure}` +

                                '</td><td>' + `${value.period}` +
                                '</td><td>' + `${value.bal_principal}` +
                               
                                '</td><td>' + '<a href="'+`./investment_accnt/`+`${value.id}`+`/pay/`+'" target="_blank"><i class="fa fa-money" aria-hidden="true"></i></a>' +
                                '</td></tr>'
                            )
                        });
                    }else{
                        $('tbody').empty();
                        $('#emi_collection tbody').append(
                            '<tr><td>' + `` +
                                '</td><td>' + `` +
                                '</td><td>' + `` +
                                '</td><td>' + `` +

                                '</td><td>' + `No Payment to Release` +
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
    

</script>
<script>

$(document).ready(function(){

    $("#pdf_export").click(function(){
        
        var to_date=new Date().toISOString().slice(0, 10);
        
        $("#pdf_export").attr("href","./inv_payment_report/"+to_date);

    })
})
</script>

@endsection