<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>cpaybill</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' href='cpaybill.css'>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet"> -->
    <!--for bootstarp ---->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        tbody, td {
    border: none;
}

.p1 {
    font-size: 20px;

}

.b1 {
    border: 2px dashed #c9c9c9;
    border-left: transparent;
    border-right: transparent;
    font-size: 12px;

}

.df {
    /* display: flex; */
    width: 100%;
}

.table_col {
    display: flex;
    flex-direction: row;
}
.m1 {
    margin-top: -18px;
}
    </style>
</head>
<body>
    <header>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center pl-5 df">
                        <h5 class="p1">{{$company_details[0]->company_name}}</h5>
                        <span style="font-size: 14px; float: right;"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center  pr-5">
                        <h5 class="p1 pl-5"><u>PAY SLIP</u></h5>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row pt-5">
                    <div class="col-md-6">
                        <h5 class="p1">Name: <span class="pl-4"> {{$slip[0]->name}}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="p1">Bill No.: <span class="pl-4">{{$slip[0]->id}}</span></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="p1">Employee Code: <span class="pl-4">{{$slip[0]->emp_code}}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="p1">Bill Date: <span class="pl-4">{{$slip[0]->pay_date}}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="p1">Designation: <span class="pl-4">{{$slip[0]->designation}}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="p1">Gross Bill Amt.: <span class="pl-4">{{$slip[0]->gross_pay}}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="p1">E-Mail: <span class="pl-4">{{$slip[0]->email}}</span></h5>
                    </div> 
                    <div class="col-md-6">
                        <h5 class="p1">Net Bill Amt.: <span class="pl-4">{{$slip[0]->amt_to_pay}}</span></h5>
                    </div>
                </div>
                </div>
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-6">
                        <h5 class="p1">PAN No.: <span class="pl-4">{{$slip[0]->pan_no}}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="p1">Working Day.: <span class="pl-4">{{$slip[0]->working_day}}</span></h5>
                    </div>
                    <!-- <div class="col-md-6">
                        <h5 class="p1">DDO Code: <span class="pl-4">( PUAHMP003 )</span></h5>
                    </div> -->
                </div>
                    <!--<div class="col-md-6">
                        <h5 class="p1">Token No / Date: <span class="pl-4">15324</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<span class="pl-4">20/10/2022</span></h5>
                    </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="p1">T.V. No / Date: <span class="pl-4">2055/30</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/<span class="pl-4">20/10/2022</span></h5>
                    </div>
                </div>
                <div class="row">
                    <<div class="col-md-6">
                        <h5 class="p1">TAN No.: <span class="pl-4">CALS17174D</span></h5>
                    </div>
                   <div class="row">
                   </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="p1">Pay Head: <span class="pl-4">68-2055-00-109-001-01-V</span></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="p1">Cadre: <span class="pl-4">Others</span></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="p1">Scale or level: <span class="pl-4">6</span></h5>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="p1">Group:<span class="pl-4">C</span></h5>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6><span>{{ Carbon\Carbon::parse($slip[0]->month_year)->format('F-Y')}}</span></h6>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 table_col">
                        <table class="table table-bordered w-75">
                            <thead>
                              <tr>
                                <th class="text-center" scope="col" colspan="3">Earnings (Rs.)</th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Item</th>
                                    <th>Amount</th>
                                    <th>Cumulative</th>
                                </tr>
                                <tr>
                                    <td>Basic</td>
                                    <td><span>{{($slip[0]->basic)}}</span></td>
                                    <td><span>{{($slip[0]->basic * 12)}}</span></td>
                                </tr>
                                <tr>
                                    <td>HRA</td>
                                    <td><span>{{($slip[0]->HRA)}}</span></td>
                                    <td><span>{{($slip[0]->HRA *12)}}</span></td>
                                </tr>
                                <tr>
                                    <td>Fuel</td>
                                    <td><span>{{($slip[0]->fuel)}}</span></td>
                                    <td><span>{{($slip[0]->fuel * 12)}}</span></td>
                                
                                </tr>
                                <tr>
                                    <td><span>DA</span></td>
                                    <td><span>{{($slip[0]->DA)}}</span></td>
                                    <td><span>{{($slip[0]->DA *12)}}</span></td>
                                </tr>
                                <tr>
                                    <td><span>Allowance </span></td>
                                    <td><span>{{($slip[0]->allowance)}}</span></td>
                                    <td><span>{{($slip[0]->allowance *12)}}</span></td>
                                </tr>
                                <tr>
                                    <td><span>TA</span></td>
                                    <td><span>{{($slip[0]->TA)}}</span></td>
                                    <td><span>{{($slip[0]->TA *12)}}</span></td>
                                </tr>
                                <tr>
                                    <td><span>Others</span></td>
                                    <td><span>{{($slip[0]->others)}}</span></td>
                                    <td><span>{{($slip[0]->others *12)}}</span></td>
                                </tr>
                                <tr>
                                    <td>GROSS PAY</td>
                                    <td>{{($slip[0]->gross_pay)}}</td>
                                    <td>{{($slip[0]->gross_pay * 12)}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered w-75">
                            <thead>
                                <tr>
                                  <th class="text-center" scope="col" colspan="3">Deductions (Rs.)</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <th>Item</th>
                                      <th>Amount</th>
                                      <th>Cumulative</th>
                                  </tr>
                                  <tr>
                                        <td>PF</td>
                                        <td>{{($slip[0]->PF)}}</td>
                                        <td>{{($slip[0]->PF * 12)}}</td>

                                    </tr>
                                    <tr>
                                        <td>ESI</td>
                                        <td>{{($slip[0]->ESI)}}</td>
                                        <td>{{($slip[0]->ESI * 12)}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>{{($slip[0]->net_pay)}}</td>
                                        <td>{{($slip[0]->net_pay * 12)}}</td>
                                    </tr>
                                </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                  <th class="text-center" scope="col" colspan="4">Recoveries of Loan (Rs.)</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                      <th>Item</th>
                                      <th>Inst. No.</th>
                                      <th>Amount</th>
                                      <th>Cumulative</th>
                                </tr>
                                <tr>
                                      <td style="width:30%">-</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                </tr>
                                <tr>
                                      <td></td>
                                      <td>-</td>
                                      <td></td>
                                      <td></td>
                                </tr>
                                <tr>
                                      <td></td>
                                      <td>-</td>
                                      <td></td>
                                      <td></td>
                                </tr>
                                      <td></td>
                                      <td>-</td>
                                      <td></td>
                                      <td></td>
                                <tr>
                                      <td></td>
                                      <td>-</td>
                                      <td></td>
                                      <td></td>
                                </tr>
                                    <tr>
                                    <td></td>
                                    <td>-</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>-</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered w-50">
                            <thead>
                                <tr>
                                  <th class="text-center" scope="col" colspan="3">Out of Account Deduction</th>
                                </tr>
                              </thead>
                              <tbody>
                                    <tr>
                                      <th>Item</th>
                                      <th>Amount</th>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td>-</td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td>-</td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td>-</td>
                                    </tr>
                                      <td></td>
                                      <td>-</td>
                                    <tr>
                                      <td></td>
                                      <td>-</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>-</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                        <div class="container-fluid m1">
                            <div class="col-md-12 border">

                                <p>Net Pay &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;{{($slip[0]->amt_to_pay)}} &nbsp; &nbsp; &nbsp; &nbsp; <?php $totalAmount = ($slip[0]->amt_to_pay);
                                     $amountInWords = ucwords((new NumberFormatter('en_IN', NumberFormatter::SPELLOUT))->format($totalAmount));?>  {{($amountInWords)}} Only.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="container-fluid">
            <div class="text-right">
                <p class="mr-5 t1">{{$company_details[0]->company_name}}</p>
            </div>
           
            <div class="b1 mx-3">
                <p>BP:Basic/ Band/ Deputation Pay * DA:Dearness Allowance *  HRA:House Rent Allowance * TA: Travel Allowance
                 <br>PF:Employees' Provident Fund Organisation  * ESI: Employees' State Insurance Scheme of India</p>
            </div>
            <p class="pt-5">* System generated report and does not require signature.</p>
            <div class="container-fluid">
                <div class="row">
                    <!-- <div class="col-md-6">
                        <p class="text-left pt-5">Printed by: SYSTEM_GENERATED</p>
                    </div> -->
                    <!--<div class="col-md-6">
                       <p class="text-right pt-5">Print Date & Time : 03/11/2022 10.28 PM</p>
                    </div>-->
                </div>
            </div>
        </div>
        </section>
    </header>
</body>
</html>