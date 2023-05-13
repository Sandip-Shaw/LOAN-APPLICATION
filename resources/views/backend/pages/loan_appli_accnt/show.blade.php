@extends('backend.layouts.master')

@section('title')
    Account Loan - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css"
        rel="stylesheet" />
@endsection

<style>
    th {
        padding: 0 20px;
    }

    .actionbuttons {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }
</style>

@section('admin-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Loan Account</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="">Accounts</a></li>

                        <li><span>{{ $loan_account[0]->first_name }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->

    <div class="main-content-inner" style="margin-top: 10px">
        <div class="actionbuttons">
            <a class="btn btn-primary" data-toggle="tooltip" target="_blank"
                href="{{ route('admin.loan_agreement', $loan_account[0]->loanApplication_id) }}"><i
                    class="fa fa-print"></i>Loan Agreegemt</a>
            <a class="btn btn-secondary" data-toggle="tooltip" target="_blank"
                href="{{ route('admin.guaranty_letter', $loan_account[0]->loanApplication_id) }}"><i
                    class="fa fa-print"></i>Letter of Guaranty</a>
            <a class="btn btn-warning" data-toggle="tooltip" target="_blank"
                href="{{ route('admin.receipt_letter', $loan_account[0]->loanApplication_id) }}"><i
                    class="fa fa-print"></i>Loan Receipt</a>
            <!-- <a class="btn btn-danger" data-toggle="tooltip"  href="{{ route('admin.closed_loan', $loan_account[0]->id) }}">For Close Loan</a>  -->


            <form id="frmDelete-{{ $loan_account[0]->id }}" action="{{ route('admin.closed_loan', $loan_account[0]->id) }}"
                method="POST" style="display: none;">

                @csrf
            </form>

            <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Print Documents
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" target="_blank"
                        href="{{ route('admin.repayment_schedule', $loan_account[0]->loanApplication_id) }}">REPAYMENT
                        SCHEDULE</a>
                    <a class="dropdown-item" target="_blank"
                        href="{{ route('admin.loan_status', $loan_account[0]->loanApplication_id) }}">LOAN
                        STATUS</a>
                    <a class="dropdown-item" target="_blank"
                        href="{{ route('admin.loan_closing_req_letter', $loan_account[0]->loanApplication_id) }}">CLOSING
                        REQ LETTER</a>

                    <a class="dropdown-item" target="_blank"
                        href="{{ route('admin.overdueNotice', $loan_account[0]->loanApplication_id) }}">NOTICE
                        FOR OVERDUE</a>
                </div>
            </div>
            <button class="formConfirm btn btn-danger" data-form="#frmDelete-{{ $loan_account[0]->id }}"
                data-title="Closed Loan" data-message="Are you sure, you want to Closed this loan  ?">
                <i class="fa fa-times" aria-hidden="true"></i>&nbsp;Closed Loan

            </button>

            <a class="btn btn-success" data-toggle="tooltip" 
                href="">Pay OverDue Emi</a>
        </div>
        <div class="row">
            <!-- data table start -->
            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">
                        <!-- <h4 class="header-title float-left">Blogs List</h4> -->

                        <div class="clearfix"></div>



                        <div class="col-md-6" style="max-width:100%;">

                            @include('backend.layouts.partials.messages')
                            <table id="dataTable" class="table table-details" style=" margin-top: 0 !important">
                                <tbody>

                                    <tr>
                                        <td class="ft-600  font-weight-bold" style="width: 250px;">Member</td>
                                        <td>
                                            <a
                                                href="{{ route('admin.members_management.show', $loan_account[0]->member_id) }}">
                                                {{ $loan_account[0]->member_id_code }} -
                                                {{ $loan_account[0]->first_name }}</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ft-600  font-weight-bold" style="width: 250px;">Account No.</td>
                                        <td>
                                            {{ $loan_account[0]->id }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ft-600  font-weight-bold" style="width: 250px;">Application No.</td>
                                        <td>
                                            <a
                                                href="{{ route('admin.loan_application.show', $loan_account[0]->loanApplication_id) }}">
                                                {{ $loan_account[0]->loanApplication_id }}</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ft-600  font-weight-bold" style="width: 250px;">Open Date</td>
                                        <td>
                                            {{ Carbon\Carbon::parse($loan_account[0]->loan_disburse_date)->format('d-m-Y') }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ft-600  font-weight-bold" style="width: 250px;">First EMI Date</td>
                                        <td>
                                            {{ Carbon\Carbon::parse($loan_account[0]->first_emi_date)->format('d-m-Y') }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ft-600  font-weight-bold" style="width: 250px;">Scheme</td>
                                        <td>

                                            {{ $loan_account[0]->schema_name }}

                                        </td>
                                    </tr>



                                    <tr>
                                        <td class="ft-600  font-weight-bold" style="width: 250px;">Loan Amount</td>
                                        <td>
                                            INR {{ $loan_account[0]->amt_approved }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ft-600  font-weight-bold" style="width: 250px;">Current Debt</td>
                                        <td>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ft-600  font-weight-bold" style="width: 250px;">Status</td>
                                        <td>
                                            {{ $loan_account[0]->loan_status }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ft-600  font-weight-bold" style="width: 250px;">Close Date</td>
                                        <td>
                                            {{ $loan_account[0]->loan_close_date }}
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>



                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div id="accordion">
                    <div class="card" style="width:100%; margin-top: 5px">
                        <div class="card-header" style="background-color: dodgerblue;">
                            <a class="card-link" style="color: #fff" data-toggle="collapse" href="">
                                Scheme Details
                            </a>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                <table id="dataTable" class="table table-details">
                                    <tbody>
                                        <tr>
                                            <td class="ft-100 font-weight-bold" style="width: 150px;">Branch
                                            </td>
                                            <td>
                                                {{ $loan_account[0]->branch_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ft-200 font-weight-bold" style="width: 250px;">Loan
                                                Amount</td>
                                            <td>
                                                {{ $loan_account[0]->amt_approved }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ft-200 font-weight-bold" style="width: 250px;">Annual
                                                Interest Rate
                                            </td>
                                            <td>
                                                {{ $loan_account[0]->ann_rate_int }}%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ft-200 font-weight-bold" style="width: 250px;">Credit
                                                Period</td>
                                            <td>
                                                {{ $loan_account[0]->grace_period }} Day
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ft-200 font-weight-bold" style="width: 250px;">
                                                Interest Type</td>
                                            <td>
                                                {{ $loan_account[0]->int_type }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ft-200 font-weight-bold" style="width: 250px;">EMI
                                                Payout</td>
                                            <td>
                                                {{ $loan_account[0]->tenure_type }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ft-200 font-weight-bold" style="width: 250px;">Tenure
                                                of Loan</td>
                                            <td>
                                                {{ $loan_account[0]->tenure_months }}
                                                {{ $loan_account[0]->tenure_type }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ft-200 font-weight-bold" style="width: 250px;">
                                                Processing Fee </td>
                                            <td>
                                                INR {{ $loan_account[0]->processing_charges }}

                                            </td>

                                        </tr>

                                        <tr>
                                            <td class="ft-200 font-weight-bold" style="width: 250px;">Stamp
                                                Charge </td>
                                            <td>
                                                INR {{ $loan_account[0]->stamp_fee }}

                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="ft-200 font-weight-bold" style="width: 250px;">
                                                Insurance Fees</td>
                                            <td>
                                                INR {{ $loan_account[0]->insurance_charge }}

                                            </td>

                                        </tr>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- data table end -->

            <!-- delete modal bootstrap -->
            <div class="modal fade" id="formConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="frm_title">Closed Loan </h4>

                            <button type="button" class="close" data-dismiss="modal"><span
                                    aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        </div>
                        <div class="modal-body" id="frm_body">Are you sure, you want to Closed this loan ?</div>
                        <div class="modal-footer">
                            <button style='margin-left:10px;' type="button" class="btn btn-danger col-sm-2 pull-right"
                                id="frm_submit">Confirm</button>
                            <button type="button" class="btn btn-primary col-sm-2 pull-right" data-dismiss="modal"
                                id="frm_cancel">Back</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->



            <div class="card mt-5">
                <div class="card-body">
                    <h4 class="header-title">Payment Schedule</h4>
                    <div class="clearfix"></div>
                    <div class="data" id="payment_collection_details" style="overflow-x: auto;">
                        <table style=" width: 100%" id="dataTable" class="text-center" id="">
                            <thead class="text-white bg-info">
                                <tr style="font-size: 17px;">
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
                            <tbody>
                                @foreach ($emi_details as $emi)
                                    <tr>
                                        <td>{{ $emi->emi_no }}</td>
                                        <td>{{ $emi->emi_date }}</td>
                                        <td>{{ $emi->emi_due_date }}</td>
                                        <td>{{ $emi->principal_amt }}</td>
                                        <td>{{ $emi->interest }}</td>
                                        <td>{{ $emi->other_charges }}</td>
                                        <td>{{ $emi->emi_amt }}</td>
                                        <td>{{ $emi->bal_principal }}</td>
                                        <td>{{ $emi->status }}</td>
                                        <td>
                                            <a class="btn btn-success text-white" @php if($emi->status == "Paid") { @endphp
                                                style="display: none"; @php } @endphp
                                                id="emi_{{ $emi->emi_id }}"
                                                href="{{ route('admin.loan_emi_pay', $emi->emi_id) }}"><i
                                                    class="fa fa-money" aria-hidden="true"></i>&nbsp;EMI Pay</a>
                                            <a class="btn" @php if($emi->status != "Paid") { @endphp
                                                style="display: none"; @php } @endphp
                                                id="emi_{{ $emi->emi_id }}" target="_blank"
                                                href="{{ route('admin.loan_emi_print', $emi->emi_id) }}"><i
                                                    class="fa fa-print" aria-hidden="true"></i>&nbsp;</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

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
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->


        <script>
            /*================================
                                                                                                                                    datatable active
                                                                                                                                    ==================================*/

            // $(document).ready(function(){
            //     if ($('#dataTable').length) {
            //     $('#dataTable').DataTable({
            //         responsive: true
            //     });
            // }
            // });
        </script>

        <script>
            $(document).ready(function() {
                $('.formConfirm').on('click', function(e) {
                    //  alert("hii");
                    e.preventDefault();
                    var el = $(this);
                    //  alert(el);
                    var title = el.attr('data-title');
                    var msg = el.attr('data-message');
                    var dataForm = el.attr('data-form');
                    // console.log(dataForm);
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
