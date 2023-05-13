
@extends('backend.layouts.master')

@section('title')
Investment - Admin Panel
@endsection

@section('styles')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection
<style>
    .editBtn{
        position: absolute;
        top: 10px;
        right: 100px;
        z-index: 100;
    } 
 </style>

@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Investment</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.create_investment.index') }}">Investment</a></li>

                    <li><span>{{$invest->mem_list->first_name}}</span></li>
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
        
        <div class="col-md-8">
            <div class="box">
                <div class="box-body">
                  
                 
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class=col-md-10    >
                        @include('backend.layouts.partials.messages')
                        <table id="dataTable" class="table table-details">
                            <tbody>
             
                                <tr>
                                    <td class="ft-600" style="width: 250px;"><b> Member Name & Code </b></td>
                                    <td> 
                                    <a href="{{ route('admin.members_management.show',$invest->mem_list->member_id) }}">{{$invest->mem_list->member_id_code}} - {{$invest->mem_list->first_name}}</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"><b> Scheme Name </b></td>
                                    <td> 
                                    {{$invest->inv_list->scheme_name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"> <b>Branch </b></td>
                                    <td> 
                                    {{$invest->branch_list->branch_name}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"><b>Tenure </b></td>
                                    <td> 
                                    {{$invest->tenure_val}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"> <b>Principal Amount </b> </td>
                                    <td> 
                                 INR   {{$invest->amt_approved}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"> <b>Interest Earned </b></td>
                                    <td> 
                                 INR   {{$invest->interest_earned}}
                                    </td>
                                </tr>

                      

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"> <b> Maturity Amount </b></td>
                                    <td> 
                                INR    {{$invest->maturity_amount}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"> <b>Interest Per Tenure</b></td>
                                    <td> 
                                        @if($invest->int_pay_mode == 'Monthly')
                                           INR  {{$invest->int_per_tenure}} per month
                                        @elseif($invest->int_pay_mode == 'Yearly')
                                          INR  {{$invest->int_per_tenure}} per year
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"><b>Fore Closed Charges (if any)</b></td>
                                    <td> 
                                  INR   {{$invest->fore_close_charge}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"><b>Interest Pay Mode</b></td>
                                    <td> 
                                    {{$invest->int_pay_mode}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"><b>Interest Rate</b></td>
                                    <td> 
                                    {{$invest->int_rate}}%
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ft-600 font-weight-bold" style="width: 250px;"><b>Status</b></td>
                                    <td> 
                                    {{$invest->status}}
                                    </td>
                                </tr>

                            </tbody>
                            
                        </table>
                     
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>



      
        <!-- data table end -->
        

    <div class="card mt-10" style="">
        <div class="card-body">
        <h4 class="header-title">Interest Payment Schedule</h4>
        <div class="clearfix"></div>
            <div class="data-tables" id="payment_collection_details" style="overflow-x: auto;">
                <table style=" width: 100%" id="dataTable" class="text-center" id="" >
                    <thead class="text-white bg-info">
                        <tr style="font-size: 17px;">
                            <th width="05%">Tenure</th>
                            
                            <th width="10%">Principal</th>
                            <th width="10%">Interest</th>
                            <th width="15%">Maturity Amount</th>
                            <th width="10%">Interest Per Tenure</th>
                            <th width="20%">Period</th>
                            <th width="20%">Balance Amount</th>
                            <!-- <th width="10%">Actions</th> -->

                        </tr>
                    </thead>
                   
                    <tbody id="list">
                       
                    </tbody>
                   
                </table>
            </div>
        </div>
   <form action="{{ route('investment.tenure_store') }}" method="POST" >
    @csrf
    <input type="hidden" name="loanApplication_id" id="" value="{{($invest->id)}}" class="form-control" >

    <input type="hidden", name="pay_details", id="pay_details", class="form-control">
</div>

    <div style="text-align:center;">
        <button type="submit"   class="btn btn-primary  pr-4 pl-4" @php if($invest->status == "Completed" ) {@endphp style="display: none"; @php } @endphp >Confirm </button>
        <a class="btn btn-danger" href="{{ route('admin.create_investment.index') }}">Back </a>
        
    

    </form>
@endsection
 

    </div>
</div>
</div>
</div>
</div>




@section('scripts')
     <!-- Start datatable js -->
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
     
     <script>
         /*================================
        datatable active
        ==================================*/
        // if ($('#dataTable').length) {
        //     $('#dataTable').DataTable({
        //         responsive: true
        //     });
        // }

     </script>

     <script>

      $(document).ready(function(){
        var id = {!! json_encode($invest->id) !!}; 

       // console.log(id);
       $.ajax({
                type:"GET",
                url:"../investment_details/"+id,
                success:function(res){  
                  // console.log(res);   
                if(res){
                  
                     const obj = JSON.parse(res);

                     Object.entries(obj).forEach((entry)=>
                     {
                        const [key,value]=entry;

                         create_date=`${value.create_date}`;
                    
                         amt_approved=`${value.amt_approved}`;
                         interest_earned=`${value.interest_earned}`;
                         maturity_amount=`${value.maturity_amount}`;
                         int_pay_mode=`${value.int_pay_mode}`;
                         tenure_val=`${value.tenure_val}`;
                         int_per_tenure=`${value.int_per_tenure}`;

                        
                    })
                    var days=0;
                    var d = new Date(create_date);
                    var first_date=0;
                    var paid_principal= 0;
                    var emiCount = {
                    "emi" : {}
                    }
                    

                   for (let i = 1; i <= tenure_val; i++) {

                    if(int_pay_mode=="Yearly"){
                        //days=365*tenure_val;

                        first_date = new Date(d.setMonth(d.getMonth() + 12));
                        newDate = moment(first_date,"MM/DD/YY").format("YYYY-MM-DD");
                    }else if(int_pay_mode=="Monthly"){
                       // days=30*tenure_val;

                        first_date = new Date(d.setMonth(d.getMonth() + 1));
                        newDate = moment(first_date,"MM/DD/YY").format("YYYY-MM-DD");
                    }

                    paid_principal=paid_principal+(interest_earned/tenure_val);
                   var bal_principal = maturity_amount - paid_principal;
                    //console.log(i+'-'+principal_per_emi.toFixed(2)+'-'+interest_per_emi.toFixed(2)+'-'+other_charges_per_emi.toFixed(2)+'-'+per_emi.toFixed(2)+'-'+newDate+'-'+due_date+'-'+bal_principal.toFixed(2));
                    console.log(i+'-'+amt_approved+'-'+interest_earned+'-'+maturity_amount+'-'+int_per_tenure+'-'+newDate+'-'+bal_principal);
                    
                    trHTML ='<tr><td>'+i+'</td><td>'+amt_approved+'</td><td>'+interest_earned +
                            '</td><td>'+maturity_amount +'</td><td>' + int_per_tenure +'</td><td>' +newDate +
                            '</td><td>' + bal_principal.toFixed(2) +'</td></tr>';

                    $('#list').append(trHTML);
                    


                    emiCount.emi["TENURE"+i] = {
                            "INVEST_ID":id,
                            "TENURE":i, 
                            "PRINCIPAL":amt_approved, 
                            "INTEREST_EARN":interest_earned, 
                            "MATURITY_AMOUNT":maturity_amount,
                            "INT_PER_TENURE":int_per_tenure,
                            "PERIOD":newDate,
                            "BAL_PRINCIPAL":bal_principal.toFixed(2),
                            
                        };
                   
                   }
                    // console.log(emiCount);
                    $('#pay_details').val(JSON.stringify(emiCount));
                   

                }
            }
        })

      });
     </script>
@endsection