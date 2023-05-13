
@extends('backend.layouts.master')

@section('title')
Loan Application - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection
<style>
  .doc-img{
        padding: 0.25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        max-width: 100%;
        height: auto;
        object-fit: cover;
        object-position: top;
        cursor: pointer;
}
#Fullscreen {
  width: 100%;
  display: none;
  position:fixed;
  top:0;
  right:0;
  bottom:0;
  left:0;
  background: transparent url('../Images/bgTile_black50.png') repeat;
}
#Fullscreen::before{
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100vw;
  background-color: #00000090;
  z-index: -1;
}
#Fullscreen img {
  display: block;
    height: 90vh;
    width: 50vw;
    object-fit: contain;
    object-position: center;
    margin: auto;
    transform: translate(0%, 6%);
}
#Fullscreen h1{
  line-height: 1.4;
  font-size: 38px;
  position: absolute;
  top: 15px;
  right: 15%;
  cursor: pointer;
  border: 2px solid #333;
  height: 54px;
  width: 54px;
  text-align: center;
  font-weight: 600;
  background: #333;
  color: #fff;
  border-radius: 6px;
}

</style>

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Loan Application</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.loan_application.index') }}"> Loan Application</a></li>
                    <li><span>   {{$applications->loanApplication_id}} </span></li>
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
        
        <div class="col-md-6">
            <div class="box">
                <div class="box-body" style='padding: 1rem;
    background-color: white;
    border-top: 2px solid #8914fe;
    box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);
    margin: 2rem 0;'>

                <a class="btn btn-primary" data-toggle="tooltip" target="_blank" href="{{ route('admin.sanction_letter',$applications->loanApplication_id)}}"><i class="fa fa-print"></i>Sanction Letter</a> &nbsp;
                <a class="btn btn-secondary" data-toggle="tooltip" target="_blank" href="{{ route('admin.application_letter',$applications->loanApplication_id)}}"><i class="fa fa-print"></i>Application Letter</a> &nbsp;
                <a class="btn btn-warning" data-toggle="tooltip" target="_blank" href="{{ route('admin.promissory_letter',$applications->loanApplication_id)}}"><i class="fa fa-print"></i>Promissory Letter</a> &nbsp;
                <a class="btn btn-danger" style="margin-top: 10px;" data-toggle="tooltip" target="_blank" href="{{ route('admin.undertaking_letter',$applications->loanApplication_id)}}"><i class="fa fa-print"></i> Letter of Undertaking</a> &nbsp;
                
                    <div class="clearfix"></div>
                        <div class="row">
                        <div class=col-md-11>
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-details">
                            <tbody>
                          
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Member </td>
                                    <td> 
                                    {{ $applications->memberdetails->first_name }} 
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"> Application No.</td>
                                    <td> 
                                    {{$applications->loanApplication_id}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Application Date</td>
                                    <td> 
                                    {{ Carbon\Carbon::parse($applications->application_date)->format('d-m-Y') }}

                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Other Loan Scheme</td>
                                    <td> 
                                    {{ $applications->loanSchema->schema_name }}
                                    </td>
                                </tr>

                      

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Amount Approved</td>
                                    <td> 
                                   INR  {{$applications->amt_approved}}
                                    </td>
                                </tr>

                               
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;">Status</td>
                                    <td> 
                                    {{$applications->status}}
                                    </td>
                                </tr>

                            </tbody>
                            
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
        <div class="col-md-6">
            <div class="box" style="border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07); background-color: white; margin:33px 0;">
                <div class="box-body">
                    <div class="row">
                        <div class=col-md-12>
                            <table class="table" style="height: 150; ">
                            <thead class="thead-light">
                                <tr>
                                
                                    <th scope="col">Status</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                
                                    <td>{{$applications->status}}</td>
                                    <td>{{$applications->remarks}}</td>
                                    <td>{{$applications->updated_at}}</td>
                                </tr>
                                
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-6">
          
          <div id="accordion">
              <div class="card" style="width: 91%;margin-top: 5px;box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                    <div class="card-header" style="background-color:#47719b;">
                         <a class="card-link" style="color: #fff" data-toggle="collapse" href="#collapseOne">
                             Other Loan Scheme Info
                        </a>
                    </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                  <div class="card-body" style="height: 15rem;overflow: scroll;">
                  <table id="dataTable" class="table table-details">
                  <tbody>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Scheme Name</td>
                          <td> 
                          {{ $applications->loanSchema->schema_name }}
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Scheme Code</td>
                          <td> 
                          {{ $applications->loanSchema->schema_code }}
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Max. Loan Amount</td>
                          <td> 
                          INR {{ $applications->loanSchema->max_loan_amt }}
                         
                          </td>
                      </tr>
                      
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Interest Rate</td>
                          <td> 
                         
                          {{ $applications->loanSchema->ann_rate_int }}%
                          </td>
                      </tr>
                     
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Fore Closure Charges</td>
                          <td> 
                          {{ $applications->loanSchema->fore_closure_charge }}
                       
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Processing Fee</td>
                          <td> 
                          {{ $applications->loanSchema->process_fee }}%
                      
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Sms Charges per EMI</td>
                          <td> 
                         
                          INR {{ $applications->loanSchema->sms_charges }}
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Fuel Charges per EMI</td>
                          <td> 
                         
                          INR  {{ $applications->loanSchema->fuel_charge }}
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Stationary Charges per EMI</td>
                          <td> 
                          INR {{ $applications->loanSchema->stationary_charges }}
                      
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Maintenance Charges per EMI</td>
                          <td> 
                          INR {{ $applications->loanSchema->maintenance_charge }}
                      
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Collection Charges per EMI</td>
                          <td> 
                          INR  {{ $applications->loanSchema->collection_charge }}
                      
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Insurance Charges per EMI</td>
                          <td> 
                          INR  {{ $applications->loanSchema->insurance_charge }}
                      
                          </td>
                      </tr>
                      
                     
                     
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card" style="width:91%;margin-top: 5px; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
              <div class="card-header" style="background-color: dodgerblue;">
                  <a class="card-link" style="color: #fff" data-toggle="collapse" href="#collapseTwo">
                  Other Loan Application Info
                  </a>
              </div>
              <div id="collapseTwo" class="collapse " data-parent="#accordion">
                  <div class="card-body" style="height: 15rem;overflow: scroll;">
                  <table id="dataTable" class="table table-details">
                  <tbody>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Branch</td>
                          <td> 
                          {{$applications->branchdetails->branch_name}}
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Amount Requested</td>
                          <td> 
                         INR {{$applications->loan_requested}}
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Max. Amount can be Approved</td>
                          <td> 
                       
                         INR {{ $applications->loanSchema->max_loan_amt }}
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Loan Amount</td>
                          <td> 
                          INR {{$applications->amt_approved}}
                   
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Amount Approved</td>
                          <td> 
                         INR {{$applications->amt_approved}}
                       
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Interest Amount</td>
                          <td> 
                         INR {{$applications->interest_amount}}
                       
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Other Charges</td>
                          <td> 
                         INR {{$applications->other_charges}}
                       
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Annual Interest Rate</td>
                          <td> 
                        
                          {{ $applications->loanSchema->ann_rate_int }}%
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Interest Type</td>
                          <td> 
                          {{ $applications->loanSchema->int_type }}
                      
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Credit Period</td>
                          <td> 
                     
                          {{$applications->credit_period}}Days
                          </td>
                      </tr>
                      
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Total Amount to Recover</td>
                          <td> 
                         INR {{$applications->total_amount_coll}}
                     
                      
                          </td>
                      </tr>
                     
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">EMI Amount</td>
                          <td> 
                         INR {{$applications->emi_amount_total}}
                     
                      
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">No. of EMIs</td>
                          <td> 
                          {{$applications->no_of_emis}}
                     
                      
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Processing Fee</td>
                          <td> 
                          {{$applications->processing_charges}}
                     
                      
                          </td>
                      </tr>
                      <tr>
                          <td class="ft-200 font-weight-bold" style="width: 250px;">Tenure of Loan</td>
                          <td> 
                     
                          {{$applications->tenure_months}}
                      
                          </td>
                      </tr>
                     
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>
            
                    <div class="card" style="width:91%;margin-top: 5px; box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);" >
                        <div class="card-header" style="background-color: #4868d1;">
                            <a class="collapsed card-link" style="color: #fff" data-toggle="collapse" href="#collapseFour">
                                    Documents
                            <a  class="pull-right" href="{{route('admin.upload_application_doc',[$applications->loanApplication_id])}}"><i class="fa fa-upload" style="color: #fff"></i></a>
                            </a>
                        </div>
                        <div id="collapseFour" class="collapse" data-parent="#accordion">
                            <div class="card-body" style="height: 15rem;overflow: scroll;">
                                <table id="dataTable" class="table table-details">
                                    <tr>
                                        <th>Name</th>
                                        <th>Doc</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody>
                                        @foreach($doc as $docs)
                                            <tr>
                                                <td class="ft-200" style="width: 250px;">{{$docs->doc_name}}</td>
                                                <td>@if(isset($docs->doc_file))
                                                    <img src="{{asset('/images/loanApplicationDocUpload/'.$docs->doc_file)}}" width="80" class="doc-img">
                                                    @endif
                                                </td>
                                                <td>@if(isset($docs->doc_file))
                                                <a class="btn" data-toggle="tooltip" href="{{ route('admin.del_doc',$docs->id) }}"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div id="Fullscreen"><img src="" alt="" /> <h1>X</h1></div>
                            </div>
                        </div>
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
     
     <script>
         /*================================
        datatable active
        ==================================*/
        // if ($('#dataTable').length) {
        //     $('#dataTable').DataTable({
        //         responsive: true
        //     });
        // }
        $(document).ready(function(){

        $('#Fullscreen').css('height', $(document).outerWidth() + 'px');
        $('.doc-img').click(function(){
            var src = $(this).attr('src');
            $('#Fullscreen img').attr('src', src);
            $('#Fullscreen').fadeIn();
        });
        $('#Fullscreen').click(function(){
            $(this).fadeOut();
        });
        });

     </script>
@endsection