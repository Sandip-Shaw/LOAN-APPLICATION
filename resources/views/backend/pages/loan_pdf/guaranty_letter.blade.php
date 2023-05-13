<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Letter of Guaranty</title>
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
        <!-- <p style="text-align: center;font-size: 20px;color: Gray">(Registered Under Companies Act, 2013)</p> -->
        <h1 style="text-align: center;font-size: 28px; margin-top: 40px;"><u>LETTER OF GUARANTEE</u></h1>
        <hr>
        <p style="font-size: 16px;text-align: left;"><b>{{$company_details[0]->company_name}}<br><br>
        {{$company_details[0]->address}} <br> (CIN) {{$company_details[0]->cin_no}} </b>
        </p>
        <p style="font-size: 16px;text-align: left; margin-top: 50px;"><b>	
            SUBJECT: GUARANTEE FOR THE REPAYMENT OF LOAN </b>
        </p>
        <p style="font-size: 14px;text-align: left; margin-top: 20px;">
        We, the undersigned, hereby irrevocably declare that we jointly and severally guarantee as primary guarantor on 
        behalf of <b> {{$application->memberdetails->first_name}} </b> payment to the <b> {{$company_details[0]->company_name}}</b> of <b> {{$application->amt_approved}} </b>. <br> <br> <br>
        Payment shall be made without objection or legal proceedings of any kind, upon receipt of your first written claim, 
        sent by registered letter with advice of delivery or equivalent, stating that the debtor has not fulfilled one of his 
        contractual obligations. We shall not delay the payment, nor shall we oppose it for any reason whatsoever. We shall inform
         you in writing as soon as payment has been made. <br> <br>
         Furthermore, we accept that no amendment to the terms of the loan agreement can release us from our obligation under the present
          guarantee. We waive our right to be informed of any change, addition or amendment to the agreement. <br> <br>
          We have taken note that the present financial guarantee shall remain in force until the debtor has made the payment 
          of the balance amount. The guarantor undertakes to release the guarantee within sixty (60) days following that payment. <br> <br>
          The present guarantee is governed by the law applicable in India. The courts having jurisdiction for matters relating to the loan
           agreement shall have jurisdiction in respect of matters relating to this guarantee.
        </p>
        
        <p style="font-size: 15px;text-align: left; margin-top: 40px;">The present guarantee shall come into force and shall take effect upon its signature.</p>   
        <p style="font-size: 17px;text-align: left; margin-top: 30px;">Sincerely</p>   
        <p style="font-size: 17px;text-align: left; margin-top: 80px;">Witnessed by:</p>   
        
    </div>
</body>

</html>