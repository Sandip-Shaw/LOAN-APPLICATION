<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> RECEIPT LETTER</title>
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
        <h1 style="text-align: center;font-size: 32px; font-weight: 500;color: Gray">{{$company_details[0]->company_name}}</h1>
        <!-- <p style="text-align: center;font-size: 18px;color: Gray">(Registered Under Companies Act, 2013)</p> -->
        <h1 style="text-align: center;font-size: 24px; margin-top: 40px;"><u>LOAN RECEIPT</u></h1>
        <hr>
        
        <p style="font-size: 16px;text-align: left; margin-top: 50px;"><b>	
           Date: {{Carbon\Carbon::parse(now())->format('d/m/Y')}} </b>
        </p>
        <p style="font-size: 14px;text-align: left; margin-top: 20px;">
        I <b>{{$application->memberdetails->first_name}} </b> do hereby acknowledge the receipt of an amount of <b> Rs.  {{$application->amt_approved}} /- ( @php  $f = new NumberFormatter("EN", NumberFormatter::SPELLOUT);
        echo $f->format($application->amt_approved);     @endphp ) </b>
 
        paid to me by {{$company_details[0]->company_name}} as Loan on the security of .


        </p>
        
       
    </div>
</body>

</html>