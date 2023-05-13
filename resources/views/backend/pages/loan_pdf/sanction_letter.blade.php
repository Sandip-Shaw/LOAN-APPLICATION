<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SANCTION LETTER</title>
    <Style>
        *{
            box-sizing: border-box;
        }
        html,
        body {
            font-family: sans-serif !important;
        }

        .container {
            padding-left: 70px;
            padding-right: 70px;
        }

        table {
            width: 100%;
            position: relative;
            
            border-spacing: 0;
            border-collapse: collapse;
            border: 2px solid #000;
        }

        tr {
            width: 100%;
            height: 100px;
            text-align: center;
        }

        th {
            margin: 0;
            font-size: 26px;
            font-weight: 500;
            padding: 0 10px;
            border: 0 solid #000;
            border-width: 0 2px 2px 2px;
            border-collapse: collapse;
            overflow: auto;
        }

        th:nth-child(6) {
            border-width: 0px 0px 2px 0px;
        }

        td:nth-child(6) {
            border-width: 0px 0px 2px 0px;
        }

        td {
            margin: 0;
            font-size: 26px;
            font-weight: 500;
            border: 0 solid #000;
            border-width: 0 2px 2px 2px;
            border-collapse: collapse;
            overflow: auto;
        }

        h1 {
            letter-spacing: 1px;
        }

        h6 {
            font-size: 20px;
            font-weight: 500;
            margin: 10px 0;
        }

        span {
            font-weight: 700;
        }

        p {
            font-size: 18px;
        }

        .tableCaption {
            font-size: 52px;
            border: 3px solid #000;
            border-bottom: 0px;
            padding: 10px 0;
        }

        @media only screen and (min-width: 400px) {
            .container {
                padding-left: 40px;
                padding-right: 40px;
            }

            .tableCaption {
                font-size: 30px;
            }

            h6 {
                font-size: 14px;
                font-weight: 500;
                margin: 10px 0;
            }

            th {
                margin: 0;
                font-size: 14px;
                font-weight: 700;
                padding: 0 10px;
                overflow: auto;
            }

            td {
                margin: 0;
                font-size: 14px;
                font-weight: 500;
                overflow: auto;
            }
        }
    </Style>
</head>

<body>

    <div class="container">
        <h1 style="text-align: center;font-size: 32px; font-weight: 700;color: Gray">{{$company_details[0]->company_name}}</h1>
        <!-- <p style="text-align: center;font-size: 18px;color: Gray">(Registered Under Companies Act, 2013)</p> -->
        <h1 style="text-align: center;font-size: 24px; margin-top: 20px;"><u>SANCTION LETTER</u></h1>
        
        
        <p style="font-size: 16px;text-align: left; margin-top: 30px;"><b>	
           Date: {{Carbon\Carbon::parse(now())->format('d/m/Y')}} </b>
        </p>
        <p style="font-size: 16px;text-align: left; margin-top: 15px;">
            <b> Prospect Number:  </b>
        </p>

        <p style="font-size: 16px;text-align: left; margin-top: 15px;">
            <b> Applicant Name:  {{$applications->memberdetails->first_name}} </b>
        </p>

        <p style="font-size: 16px;text-align: left; margin-top: 15px;">
            <b>	Contact Address: {{$applications->memberdetails->address}}</b>
        </p>
        <p style="font-size: 16px;text-align: left; margin-top: 15px;">
            <b>	Contact Number: {{$applications->memberdetails->mobile}}</b>
        </p>
        <p style="font-size: 16px;text-align: left; margin-top: 15px;">
            <b>C/O Name : {{$applications->memberdetails->father_name}}</b>
        </p>
        <!-- <p style="font-size: 16px;text-align: left; margin-top: 30px;">
            <b>	Relation : Father</b>
        </p> -->
        <p style="font-size: 14px;text-align: left; margin-top: 20px;">
        Dear Customer, We thank you for choosing {{$company_details[0]->company_name}}.
         We are pleased to inform that with reference to your loan application 
         under above mentioned prospect number we have sanctioned your loan. Details
          of the said loan facility subject to the following terms and conditions are as under:

        </p>
        <p style="font-size: 16px;text-align: left; margin-top: 20px;">
            PRODUCTS: <br>
            _______________________________________________
        </p>
        <p style="font-size: 16px;text-align: left; margin-top: 10px;">
            <b>	Security (Property Detail) : </b> <br> <br> 
            <b>	Loan Amount Sanctioned : {{$applications->amt_approved}} /- ( @php  $f = new NumberFormatter("EN", NumberFormatter::SPELLOUT);
                    echo $f->format($applications->amt_approved);     @endphp ) </b> <br> <br> 
            <b>Purpose Of Loan :  </b> <br> <br> 
            <b>Loan Term : {{$applications->tenure_months}} {{$applications->tenure_type}}</b> <br> <br> 
            <b>	Interest Type : {{$applications->loanSchema->int_type}} </b> <br> <br> 
            <b>	Rate of Interest : {{$applications->loanSchema->ann_rate_int}} %</b> <br> <br> 
            <b>	Delayed Payment Charges : {{$applications->loanSchema->penalty}}</b> <br> <br> 
            <b>	Amount Of Each Instatements : {{$applications->emi_amount_total}}/{{$applications->tenure_type}}</b> <br> <br> 
            <b>	# of Advance EMI (If any)</b> <br> <br> 
            <b>	First EMI Date</b> <br> <br> 
            <b>	Processing Fees + GST :{{$applications->processing_charges}} /0</b> <br> <br> 
            <b>	Due date of EMIs : day of every month</b> <br> <br> 
        </p>
        
       
    </div>

    <div class="container">
        <h1 style="text-align: center;font-size: 32px; font-weight: 700;color: Gray;margin-top: 20px;">{{$company_details[0]->company_name}}</h1>
        <p style="text-align: center;font-size: 18px;color: Gray">(Registered Under Companies Act, 2013)</p>
        <p style="text-align: center;font-size: 18px;color: Gray">Regd. Office: {{$company_details[0]->address}} (CIN) {{$company_details[0]->cin_no}}</p>

        <h1 style="text-align: center;font-size: 24px; margin-top: 20px;"><u>SANCTION LETTER</u></h1>

        <p style="font-size: 15px;text-align: left; margin-top: 30px;">
        We have adopted risk based pricing, which is arrived by taking into account, broad parameters like the customers
         financial and credit profile. Applicable interest rates are arrived at taking into account the prevailing market 
         rates at the time of sanctioning. The details are also available on our website.
        </p>
        <p style="font-size: 15px;text-align: center; margin-top: 20px;">
            <b>	<u> A.    Sanction subject to below mentioned special terms and conditions:</u></b>
        </p>
        <p style="font-size: 15px;text-align: left; margin-top: 20px;">
            <b>	<u> The sanction of the loan shall stand revoked and cancelled in any of the following circumstances:</u></b>
        </p>
        <p style="font-size: 15px;text-align: left; margin-top: 30px;">
        1.      If any statement in the application or in loan and any other document(s) given by you or otherwise is found to be misleading or incorrect and/or <br>
        2.      If there is any material change in the process on the basis of which the loan has, in principle, been offered and/or, <br>
        3.      If any material fact concerning your income, employment, or ability to repay or any other relevant aspect of your proposal for the loan is suppressed or concealed and/or <br>
        4.      If document(s)submitted by you and the information contained in the document(s) are not in confirmation with the information provided in the application form submitted by you and/or <br>
        5.      If you fail to submit the documents as required by the company. <br>
        6.      Any other reason at the sole discretion of the Lender. <br>

        </p>
        <p style="font-size: 15px;text-align: center; margin-top: 30px;">
            <b>	<u> B.     Other terms &conditions:</u></b>
        </p>
        <p style="font-size: 15px;text-align: left; margin-top: 20px;">
        1.      Company reserves the right to amend any of the terms & conditions or cancel and recall the loan at anytime. <br>
        2.      In case of any difference in the above mentioned terms & conditions with the loan agreement; please treat these terms & conditions as the revised one. <br>

        </p>

        <p style="font-size: 15px;text-align: left; margin-top: 20px;">
        Please note that this sanction shall lapse unless and until definitive documents are executed and satisfactory security furnished within 14 days of the date of this letter. <br><br>

        Kindly use the prospect number in all your further communications with us.<br><br>

        Please put your signature as a token of your acceptance of the above stated terms and conditions and retain a copy with yourself.<br><br>

        In case of any query or assistance please contact us, at the below mentioned address or alternatively you can email us .<br><br>

        </p>

        <p style="font-size: 15px;text-align: left; margin-top: 40px;">
            <b>	For {{$company_details[0]->company_name}}</b>
        </p>
        <p style="font-size: 15px;text-align: left; margin-top: 80px;">
            <b>	Signature</b>
        </p>
        <p style="font-size: 15px;text-align: left; margin-top: 20px;">
        Accepted the above Terms and Conditions of the Loan and affixed our signature in token thereof.
        </p>
        <div class="col-md-2" style="font-size: 15px;text-align: left; margin-top: 40px;">
        _____________________________ <br>Applicant
        </div>
        <div class="col-md-2" style="font-size: 15px;text-align: right; margin-top: 10px;">
        _____________________________ <br>Co-Applicant
        </div>
    </div>
</body>

</html>