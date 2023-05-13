
@extends('backend.layouts.master')

@section('title')
 Payout - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

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
                <h4 class="page-title pull-left">Interest Payment </h4>
                <ul class="breadcrumbs pull-left">

                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <!-- <li><a href="">All Blogs</a></li> -->
                    <li><span>Interest Pay</span></li>
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
        <div class="col-md-7">
            <div class="card" style="border-top: 2px solid #8914fe;
         box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);">
                <div class="card-body">
                    <!-- <h4 class="header-title"> Create Schemes </h4> -->
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{route('admin.interest_paynow',$pay[0]->id)}}" method="post" data-parsley-validate>
                        @csrf
                        @method('PATCH')
                         
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b> Transaction Date </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="date" class="form-control" id="transaction_date" name="transaction_date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Interest Amount </b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="int_amt" name="int_amt" value="{{$pay[0]->int_per_tenure}}" readonly>
                                
                                </div>
                            </div>


                           

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Total Amount</b><span style="color:red; font-size: 18px;line-height:1;">*</span></label>
                            
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="total_amt" name="total_amt" value="{{$pay[0]->int_per_tenure}}" readonly>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Remarks (if any) </b></label>
                            
                                <div class="col-sm-6">
                                <textarea class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks (if any)"></textarea>
                                
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align: right" for="" ><b>Pay Mode </b><span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                <div class="form-group col-sm-6" >
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="disburse_transaction" id="Cash" value="Cash">
                                    <label class="form-check-label" for="disburse_transaction">Cash</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="disburse_transaction" id="Cheque" value="Cheque">
                                    <label class="form-check-label" for="disburse_transaction">Cheque</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="disburse_transaction" id="online_tr" value="online_tr" >
                                    <label class="form-check-label" for="disburse_transaction">Online Tr. </label>
                                </div>
                                
                                </div>
                            </div>
                            <div class="form-row" id="radio_btn">
                            
                            </div>

                            <div style="text-align:center;">
                                <button type="button" class="btn btn-primary  pr-4 pl-4" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;Pay</button>

                                <a class="btn btn-danger" href="{{route('admin.investment_accnt.index')}}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel </a>


                            </div>
                             <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" >
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
            
                                        <div class="modal-body">
                                                Are you sure to Pay?
                                          
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Yes </button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
        <!-- end modal -->
          
                </div>
            </div>
        </div>
        
<!-- data table end -->
        
                                 
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />



<script>
    // $(document).ready(function() {
    //     $('.select2').select2();
    // })
</script>

<script>
  $('#form').parsley();
</script>
<script>
$(document).ready(function() {
  


let result = document.querySelector('#radio_btn');
    document.body.addEventListener('change', function (e) {
        let target = e.target;
        tenure=target.id;
    
        //console.log(target.id);

        let message;
       
        //const options=[];
        switch (target.id) {
            case 'Cash':
        //console.log(result);
              
               result.innerHTML='';
              
                break;
            case 'Cheque':
                result.innerHTML=` <div class="col-md-7">
                                    <div class="box">
                                    <div class="box-body">
                                    <div class="row">
                                    <div class=col-md-12>
                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="" >Bank Name <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="text" name="cheque_bank_name" id="" value="" class="form-control" >

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="" >Cheque No. <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="text" name="cheque_no" id="" value="" class="form-control" >

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="" >Cheque Date <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="date" name="cheque_date" id="" value="" class="form-control" >

                                    </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                `;
      //  console.log(result.innerHTML);
               
                break;
            case 'online_tr':
               
                result.innerHTML=`<div class="col-md-7">
                                    <div class="box">
                                    <div class="box-body">
                                    <div class="row">
                                    <div class=col-md-12>
                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="" >Transfer Date<span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="date" name="onl_transfer_date" id="" value="" class="form-control" >

                                    </div>
                                </div><div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="" >UTR/ Transaction No. <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                    <div class="col-sm-8">
                                        <input type="text" name="onl_transaction_no" id="" value="" class="form-control" >

                                    </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="" >Transfer Mode  <span style="color:red; font-size: 18px;line-height:1">*</span></label>
                            
                                <div class="form-group col-sm-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="onl_transfer_mode" id="" value="IMPS">
                                    <label class="form-check-label" for="onl_transfer_mode">IMPS</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="onl_transfer_mode" id="" value="VPA">
                                    <label class="form-check-label" for="onl_transfer_mode">VPA</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="onl_transfer_mode" id="" value=" NEFT/RTGS" >
                                    <label class="form-check-label" for="onl_transfer_mode"> NEFT/RTGS  </label>
                                </div>
                                
                                </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            `;
                
                break;
        }
      

    });
});

</script>
@endsection
