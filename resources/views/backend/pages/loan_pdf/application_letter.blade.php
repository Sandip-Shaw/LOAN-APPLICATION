<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>loanapi form</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel="stylesheet" href="styles.css">

    <style>
        .c1 {
            background-color: #D8D3D1;
        }
        .f1 {

            font-size: 15px;
        }
        table {
          border: 2px solid black;
          border-collapse: collapse;
        }
        td, th {
            border: 2px solid black;
            text-align: left;
            padding: 8px;
}

    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div style="text-align: center;">
                <h1>{{$company_details->company_name}}</h1>
                <h6>(Registered Under Companies Act, 2013)</h6>
                <h4>Regd. Office: {{$company_details->address}} (CIN) {{$company_details->cin_no}}</h4>
            </div>
            <div style="text-align: center;">
                <h6><u>APPLICATION FORM</u></h6>
            </div>
        </div>
        <div class="c1">
            <h5>PERSONAL DETAILS :</h5>
        </div>
            <p class="f1">C/O Name : {{$applications[0]->nominee_name}} /  {{$applications[0]->nominee_relation}}</p>
            <p class="f1">Residence Address : {{$applications[0]->address}}</p>
            <p class="f1">Member Code : {{$applications[0]->member_id_code}}</p>
            <p class="f1">Phone No. : {{$applications[0]->mobile}}</p>
            <p class="f1">Borrower Name : {{$applications[0]->first_name}}</p>
        <div class="c1" >
            <h5>LOAN DETAILS :</h5>
        </div>
            <p class="f1">Loan ID : {{$applications[0]->id}}</p>
            <p class="f1">Loan Date : {{$applications[0]->loan_disburse_date}}</p>
            <p class="f1">Branch : {{$applications[0]->branch_name}}</p>  
            <p class="f1">Loan Amount : {{$applications[0]->amt_approved}} /-</p>
            <p class="f1">Plan Name : {{$applications[0]->schema_name}} </p>
            <p class="f1">PlanCode :{{$applications[0]->schema_code}}</p>
            <p class="f1">Net Disbursement : {{$applications[0]->final_disburse_amt}} /-</p>
            <p class="f1">Tenure : {{$applications[0]->tenure_months}} {{$applications[0]->tenure_type}}</p>
            <p class="f1">ROI (% p.a.) :{{$applications[0]->ann_rate_int}} %</p>
       <div class="c1">
              <h5>GOLD LOAN DETAILS :</h5>
            </div>
      <table>
        <thead>
          <tr>
            <th style="text-align: center;" scope="col">Item Type</th>
            <th style="text-align: center;" scope="col">Item Name</th>
            <th style="text-align: center;" scope="col">Qty</th>
            <th style="text-align: center;" scope="col">Rate</th>
            <th style="text-align: center;" scope="col">Net Wt.</th>
          </tr>
        </thead>
      <tbody>
          <tr>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
          </tr>
      </tbody>
    </table>
            
        
    
    
        <div class=" c1">
            <h5>DECLARATION</h5>
        </div>
        <div class="row f1">
            <p>I, the Undersigned hereby acknowledge the receipt of the loan amount as mentioned above against Gold Pledged as Colleteral with {{$company_details->company_name}}. I/We hereby confirm that the above details of the Gold, items deposited/pledged by me/us,are 
                complete and <br>accurate and the same binding upon me/us.I agree and understand all the schedule of charges and agree to abide by them.I am fully aware <br>that delayed payments will/may incur additional charges as listed in the schedule of charges policy at
                {{$company_details->company_name}} . <br>I agree and accept all the information listed above as accurate and that I will abide by all the terms and conditions as countersigned by me <br>on this form.
            </p>
        <div class="container">
            <div class="row">
                  <table>
                        <tr>
                            <th style="text-align: left;" scope="col">Borrower Name</th>
                            <td>__________________________</td>
                         </tr>
                        <tr>
                            <th style="text-align: left;" scope="col">Signature & Date</th>
                            <td>__________________________</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class=" c1" style="text-align: center;" >
            <h5>Appraiser Declaration & Authorized Signatory - {{$company_details->company_name}}</h5>
        </div>
        <div class="row  f1 ">
            <p>I/We hereby Certify that the Gold Items as listed above as genuine with the specified attributes of quality & quantity and the<br> valuation has been done with prevailing Market Valuations standards and as per M/s. BAOUND PORIBHAR NIDHI LIMITED's internal<br> Valuation Policies.I have also verified all the relevant documents against the Originals. I/We have followed all the relevant M/s.<br> BAOUND PORIBHAR NIDHI LIMITED. Policies and Processes and all the above information is accurate to the best of my knowledge.
            </p>
        </div>
        <div class="col-md-6 ">
            <table>
                <tr>
                    <th style="text-align: left;" scope="col">Valuer Name  </th>
                    <td>__________________________</td>
                 </tr>
                <tr>
                    <th style="text-align: left;" scope="col">Appraiser Name  </th>
                    <td>__________________________</td>
                </tr>
                <tr>
                    <th style="text-align: left;" scope="col">Authoriser Name</th>

                    <td>__________________________</td>
                 </tr>
            </table>
        </div>
    </div>
</body>
</html>