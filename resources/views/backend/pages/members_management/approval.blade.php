
@extends('backend.layouts.master')

@section('title')
Member Approval - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Approval - Member's Application </h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Approval's List</span></li>
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
                    <h4 class="header-title float-left">Approval's List</h4>
                    <!-- <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.loan_application.create') }}">Create Loan Application</a>
                    </p> -->
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr style="font-size: 15px;">
                                   
                                    <th width="10%">BRANCH</th>
                                    <th width="10%">MEMBER NO.</th>
                                    <th width="10%">MEMBER NAME</th>
                                    <th width="10%">ENROLL DATE</th>
                                    <th width="10%">MOBILE NO.</th>
                                    <th width="10%">STATUS</th>
                                    <th width="10%">REMARKS</th>                                  
                                    <th width="10%">ACTION</th>
                                </tr>
                            </thead>

                            <tbody>
                               @foreach($member as $members)
                                <tr>
                                    <td>{{ $members->branchdet->branch_name }}</td> 
                                    <td> <a href="{{ route('admin.members_management.show',$members->member_id) }}">{{ $members->member_id }}</a></td>

                                    <td>{{ $members->first_name }}</td> 

                                    <td>{{ $members->emr_date }}</td>  
                                    <td>{{ $members->mobile }}</td> 
                                    
                                    
                                    <td>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">Choose One</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="remarks" id="remarks" class="form-control" 
                                        value="{{$members->remarks}}" />
                                    </td> 
                                    <td>
                                        <button id="approval" class="btn btn-success">DONE</button>
                                    </td>
                                    <input type="hidden" name="member_id" id="member_id" class="form-control" 
                                        value="{{$members->member_id}}" />
                                </tr>
                              @endforeach  
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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     
     <script>
         /*================================
        datatable active
        ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }

     </script>

<script>

    $(document).ready(function(){
        $("#dataTable").on('click','#approval',function(){
            var currentRow=$(this).closest("tr"); 
            var member_id=currentRow.find("#member_id").val();
           
            var status=currentRow.find("#status").val();
            var remarks=currentRow.find("#remarks").val();
            //console.log(member_id);
        
            $.ajax({
                url: "member_approvalUpdate/"+member_id,
                type: 'GET',
                data: {member_id:member_id,
                    status: status,
                    remarks: remarks
                },
                    success:function(res){  
                        //console.log(res);
                        window.location.href = "member_approval"
                    
                    
                }
            })
        })
    })

</script>
@endsection