<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer Letter</title>
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
        <h1 style="text-align: center;font-size: 25px; font-weight: 500;color: Black">{{$company_details[0]->company_name}}</h1>
        <p style="text-align: center;font-size: 18px;color: Black">{{$company_details[0]->address}}</p>
        <h1 style="text-align: center;font-size: 20px; margin-top: 20px;"><u>OFFER LETTER</u></h1>
        <hr>
        <p style="font-size: 14px;text-align: left;"><b>Date: {{Carbon\Carbon::parse($employee_offer_letter->created_at)->format('d/m/Y H:i:s')}}<br><br>
        To, <br> <br>
        {{$employee_offer_letter->name}}    <br> <br>
        {{$employee_offer_letter->address}}    <br> <br>
        Mobile No.: {{$employee_offer_letter->mobile}} </b>
        </p>
        <p style="font-size: 16px;text-align: left; margin-top: 40px;">Dear<b>	
        {{$employee_offer_letter->name}},  </b>
        </p>
        <p style="font-size: 14px;text-align: left; margin-top: 30px;">
        Appointed as ({{$employee_offer_letter->designationdet->designation_name}})
        </p>
        <p style="font-size: 14px;text-align: left; margin-top: 30px;">
        As per the decision of the management of the company we are pleased to offer you the post of {{$employee_offer_letter->designationdet->designation_name}}.
        The stipulated services to be rendered by you along with the other terms & conditions are furnished here under: -
        </p>

        <p style="font-size: 15px;text-align: justify; margin-top: 30px;">
        1. Post : {{$employee_offer_letter->designationdet->designation_name}} <br>
        2. You will be assigned for a probation period of six months and after successful completion of the stipulated period you will
            be permanently absorbed in our company and that will be solely decided by the management of the company.<br>
        3. Your date of Joining will be affected from {{$employee_offer_letter->dateofjoining}} <br>
        4. You shall be treated in service of the company for whole of the time and you shall not engage yourself in other business
            of services directly or in directly.<br>
        5. Your continuance in the service of the company is subject to your remaining physically and mentally fit.<br>
        6. You shall be enlighten to 8 days casual, 7 days sick and 15 days earned leave per Annum after completion of the
            probation period. During the first year of services leave eligibility will be onpro-data.<br>
        7. You shall be governed by the rules and regulations framed from time to time by the company.<br>
        8. Your salary will be Rs. {{$employee_offer_letter->monthlysalary}} /- Per month<br>
        9. You are accountable of the management for reporting the proper discharge of your official duty and responsibilities.<br>
        10. Term & condition of this appointment will reviewed from time to time and suitable may be carried out as and when
            the company may find it necessary. You are requested to submit "No Objection Certificate"(NOC) from your previous
            employer / Resignation letter dully accepted by your previous employer within 15 days from the date of joining.<br>
        11. You are to submitting to two passport size photographs and self-attested photocopies of Pan Card and aadhar card.<br>
        12.The Branch Manager will be responsible for all the functional/administrative functions of the Branch.<br>
        </p>
        
        <p style="font-size: 15px;text-align: left; margin-top: 50px;">Thanking you, <br>
            Yours faithfully</p>   
        <p style="font-size: 17px;text-align: left; margin-top: 30px;">__________________________</p> 
        <p style="font-size: 17px;text-align: right; margin-top: 1px;">__________________________</p>   

        <p style="font-size: 17px;text-align: left; margin-top: 1px;">Employee Signature</p>   
        <p style="font-size: 17px;text-align: right; margin-top: 1px;">Authorised Signature</p>   
        
    </div>
</body>

</html>