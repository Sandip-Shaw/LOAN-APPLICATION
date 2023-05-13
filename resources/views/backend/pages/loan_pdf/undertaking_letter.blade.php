<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> UNDERTAKING LETTER</title>
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
            font-size: 18px;
            font-weight: 250;
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
            font-size: 18px;
            font-weight: 250;
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
        <p style="text-align: center;font-size: 20px;color: Gray">(Registered Under Companies Act, 2013)</p>
        <h1 style="text-align: center;font-size: 28px; margin-top: 40px;"><u>LETTER OF UNDERTAKING</u></h1>
        <hr>
        
        <p style="font-size: 16px;text-align: left; margin-top: 30px;"><b>	
         Print Date: {{Carbon\Carbon::parse(now())->format('d/m/Y')}}  &nbsp; &nbsp;  Branch:{{$applications->branchdetails->branch_name}} </b>
        </p>
        <p style="font-size: 15px;text-align: left; margin-top: 20px;"><b>
       To,<br> The Cheif Loan Officer <br> {{$company_details[0]->company_name}} <br> {{$company_details[0]->address}} <br>(CIN) {{$company_details[0]->cin_no}}
    </b>
        </p>

        <p style="font-size: 15px;text-align: left; margin-top: 30px;"> 
        Dear Sir, <br> <br>Ref: POST DATED CHEQUES IN CONNECTION WITH REPAYMENT OF LOAN ACCOUNT ____________(Business/ Other Loan) Rs.{{$applications->amt_approved}} /-
        </p>
        
        <p style="font-size: 16px;text-align: justify; margin-top: 30px;"> 
        In consideration of your having agreed to grant continued to grant loan of <b> Rs.{{$applications->amt_approved}} /- (@php  $f = new NumberFormatter("EN", NumberFormatter::SPELLOUT);
        echo $f->format($applications->amt_approved);     @endphp ) </b> in the name(s) of 
        <b> {{$applications->memberdetails->first_name}} </b>  repayable in <b> {{$applications->tenure_type}} </b> installments of <b> Rs {{$applications->emi_amount_total}} /- </b> each along with the interest/ service charges as per contractual obligation. 
        I/We hereby deliver to you the post dated cheques with particulars as under to be enchased by you towards outstanding liability in aforesaid loan account.
        </p>

        <div style="margin-top: 05px">
           
            <div style="overflow-x: auto;">
                <table>
                
                    <tr>
                        <th>Sl. No.</th>
                        <th>Cheque No.</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Bank Name</th>
                        <th>Account No.</th>
                    </tr>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>


                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>


                    </tr>
                </table>
            </div>
        </div>

        <p style="font-size: 16px;text-align: justify; margin-top: 20px;"> 
        In case the above cheques are exhausted and other cheques are required in payment of the outstanding liability, I/We undertake to deliver the same to you.
        </p>

        <p style="font-size: 16px;text-align: justify; margin-top: 20px;"> 
        I/We hereby undertake to provide adequate balance in the account with the drawee Bank to ensure that the aforesaid cheques as well as other cheques which may
         be delivered by me/us in due course, as and when presented by you for payment, are honored and paid.
        </p>

        <p style="font-size: 16px;text-align: justify; margin-top: 20px;"> 
        I/We also undertake that in case any of the above cheque(s) is returned unpaid for any reason whatsoever, without prejudice to rights and privileges to recover 
        the money in default, shall be entitled to initiate the proceedings against me/us under section 138 of Negotiable Instruments Act, 1881 and other relevant provisions
         of law for the time being in force at our cost and consequences.
		

        </p>

        <p style="font-size: 16px;text-align: justify; margin-top: 20px;"> 
        I/We distinctly understand that it is at the faith and belief of this undertaking that you have agreed to grant loan of Rs.{{$applications->amt_approved}} /- in name(s) of : {{$applications->memberdetails->first_name}} (Name of Borrower Account)

        </p>


        <p style="font-size: 15px;text-align: left; margin-top: 30px;">Yours faithfully,</p>   
        <p style="font-size: 17px;text-align: left; margin-top: 60px;">--------------------------------------</p>   
        <p style="font-size: 17px;text-align: left; margin-top: 10px;">{{$applications->memberdetails->first_name}}<br>
        {{$applications->memberdetails->address}}
            </p>   
        
    </div>
</body>

</html>