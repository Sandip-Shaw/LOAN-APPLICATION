
@extends('backend.layouts.master')

@section('title')
Loan Disbursements - Admin Panel
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
                <h4 class="page-title pull-left"> Loan Disbursements</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><span>Loan Disbursements</span></li>
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
                    <!-- <h4 class="header-title float-left">Employee's List</h4> -->
                    <!-- <p class="float-right mb-2">
                        <a class="btn btn-primary text-white" href="{{ route('admin.hr_management.create') }}">Create Employee</a>
                    </p> -->
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                   
                                    <th width="15%">Application No.</th>
                                    <th width="10%">Member No.</th>
                                    <th width="10%">Member Name</th>
                                    <th width="20%">Branch</th>
                                    <th width="15%">Scheme </th>
                                    <th width="10%">Approved Amt. </th>
                                    <th width="10%">Status </th>
                                 
                                    <th width="10%">Actions</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                <tr>
                                  <td><a href="{{ route('admin.loan_application.show',$application->loanApplication_id) }}">{{$application->loanApplication_id }}</a></td> 
                                  <td><a href="{{ route('admin.members_management.show',$application->member) }}">{{$application->memberdetails->member_id_code}}</a></td> 
                                  <td>{{$application->memberdetails->first_name}}</td>
                                  <td>{{$application->branchdetails->branch_name}}</td> 
                                  <td>{{$application->loanSchema->schema_name}}</td>
                                
                                  <td>{{$application->amt_approved}}</td> 
                                  <td>{{$application->status}}</td> 

                                  <td>                                    
                                            <a class="btn btn-success text-white" href="{{ route('admin.loan_disbursements.show',$application->loanApplication_id) }}"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;Disburse</a>
                                            <!-- <button type="button" class="btn btn-primary text-white exampleModal" data="{{$application->loanApplication_id}}" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel Loan</a> 
                                           
                                            <form id="{{ $application->loanApplication_id }}" action="{{ route('admin.cancelLoan', $application->loanApplication_id) }}" method="POST" style="display: none;">
                                                   
                                            @csrf
                                            </form> -->

                                            <button class="formConfirm btn btn-danger" data-form="#frmDelete-{{$application->loanApplication_id}}" data-title="Cancel Application" data-message="Are you sure, you want to cancel this loan application ?" >
                                                <i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel Loan

                                                </button>

                                                <form id="frmDelete-{{ $application->loanApplication_id }}" action="{{ route('admin.cancelLoan', $application->loanApplication_id) }}" method="POST" style="display: none;">
                                                  
                                                    @csrf
                                                </form>
                                  </td>                                
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

   <!-- delete modal bootstrap -->
   <div class="modal fade" id="formConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="frm_title">Cancel Application</h4>

        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body" id="frm_body">Are you sure, you want to cancel this loan application ?</div>
      <div class="modal-footer">
        <button style='margin-left:10px;' type="button" class="btn btn-danger col-sm-2 pull-right" id="frm_submit">Confirm</button>
        <button type="button" class="btn btn-primary col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">Back</button>
      </div>
    </div>
  </div>
</div>   
<!-- end modal -->
@endsection


@section('scripts')
     <!-- Start datatable js -->
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     
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
    $('.formConfirm').on('click', function(e) {
    // alert("hii");
        e.preventDefault();
        var el = $(this);
        // alert(el);
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var dataForm = el.attr('data-form');
        
        $('#formConfirm')
        .find('#frm_body').html(msg)
        .end().find('#frm_title').html(title)
        .end().modal('show');
        
        $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
  });
  $('#formConfirm').on('click', '#frm_submit', function(e) {
        var id = $(this).attr('data-form');
       // alert(id);
        $(id).submit();
  });

  });

</script>
@endsection