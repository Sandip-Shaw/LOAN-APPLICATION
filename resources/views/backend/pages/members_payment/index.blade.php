
@extends('backend.layouts.master')

@section('title')
Branch Create - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


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
                <h4 class="page-title pull-left">Member Payment/Share</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Payment/Share Details</span></li>
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
        <div class="card-body" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
        <h4 class="header-title">Member Details</h4>
            <!-- @include('backend.layouts.partials.messages') -->

            <form>
            
            @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="search_by_member">Search By Member<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                        <select name="search_by_member" id="search_by_member" class="h-100 w-50" required>
                            <option value=""></option>
                            @foreach($member as $members)
                            <option value="{{$members->member_id}}" >{{$members->first_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!-------------- Group Member Table------------>

    <div class="card mt-5">
        <div class="card-body" style="border-top: 2px solid #8914fe; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
        <h4 class="header-title">Group Member Table</h4>
        <div class="clearfix"></div>
            <div class="data-tables" id="payment_details">
                <table style=" width: 100%" id="dataTable" class="text-center" id="" >
                    <thead class="bg-light text-capitalize">
                        <tr>
                            <th>M Code</th>
                            <th>Share AMT</th>
                            <th>No Of Share</th>
                            <th>Allocation Date</th>
                            <th>Share Certificate</th>
                        </tr>
                    </thead>
                   <tbody>

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
        $("#search_by_member").change(function(){
            var id=$(this).find(":selected").val();
            //console.log(id);
        
            $.ajax({
                    type:"GET",
                    url:"./payment_details/"+id,
                    
                    success:function(res){  
                        console.log(res);
                        
                    if(res){
                        $('tbody').empty();
                    
                        const obj = JSON.parse(res);
                        Object.entries(obj).forEach((entry) => {
                            const [key, value] = entry;
                            //console.log(`${key}: ${value.created_at}`);

                            $('#payment_details tbody').append(
                                '<tr><td>' + `${value.member_id}` +
                                '</td><td>' + `${value.share_amount}` +
                                '</td><td>' + `${value.shares}` +
                                '</td><td>' + `${value.created_at}` +
                                '</td><td>' + '<a href="'+`./members_payment/${value.id}/${value.member_id}`+'" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>' +
                                '</td></tr>'
                            )
                        });
                    }
                }
            })
        })
    })

</script>
@endsection