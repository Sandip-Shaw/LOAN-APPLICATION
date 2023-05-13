<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <Header class="container">
        <div class="row" style="display: flex;">
            <div style="width: 65%;">
                <div>
                    <H1 style="color: #07396c; font-weight: 700; margin: 0; letter-spacing: 1px;">BOUNDPARIVAR NIDHI
                        LIMITED</H1>
                    <h5 style="font-size: 16px; font-weight: 600; color: #07396c; margin-bottom: 5px; margin-top: 10px;">Reg No:
                        U65929WB2020PLN237607</h5>
                    <hr style="margin-top:5px !important; ; margin: 0; background: #a93d3a; height: 3px; opacity: 100%; border: 0 solid #a93d3a ;">
                    <p style="font-size: 16px; font-weight: 500; color: #084480; margin: 10px 0;">NASARATPUR,NADANGHAT
                        BARDHAMAN PURBA BARDHAMAN West Bengal -713519</p>
                    <a style="color: #084480; text-decoration: none; font-weight: 600; font-size: 16px; margin-bottom: 10px 0;" href="tel: 7001905055"><span style="font-weight: 600;">Tel :</span> 7001905055
                    </a><br>
                    <a style="color: #084480; text-decoration: none; font-weight: 600; font-size: 16px;" href="mailTo: support@boundparivarnidhi.com"><span style="font-weight: 600;">Email :</span>
                        support@boundparivarnidhi.com
                    </a>
                </div>
            </div>
            <div style="display:flex; justify-content: flex-end; align-items: flex-start; width: 35%;">
                <img src={{ public_path('images/pdf_logo.jpeg') }} style="width: 200px;">
            </div>
        </div>
    </Header>

    <div class="container">
        <h1 style="text-align: center;font-size: 32px; font-weight: 700;">Form No. SH - 1</h1>
        <h1 style="text-align: center;font-size: 28px; font-weight: 700; margin-top: 20px;">SHARE CERTIFICATE</h1>
        <h1 style="text-align: center;font-size: 28px; font-weight: 700; margin-top: 20px;">[Pursuant to sub-section (3)
            of section 46 of the Companies Act, 2013 and rule
            5(2) of the Companies (Share Capital and Debentures) Rules 2014]</h1>
        <p style="margin-top: 50px;">This is to certify that the person(s) named in this Certificate is/are the
            Registered Holder(s) of the within
            mentioned
            share(s) bearing the distinctive number(s) herein specified in the above named Company subject to the
            Memorandum
            and Articles of Association of the Company and the amount endorsed herein has been paid up on each such
            share.</p>
        <div style="border: 3px solid #333; padding: 20px;">
            <h6>EQUITY SHARES EACH OF RUPEES <span> 10/- (TEN ONLY) </span> (Nominal value)</h6>
            <h6>EQUITY SHARES EACH OF RUPEES <span> 10/- (TEN ONLY) </span> (Nominal value)</h6>
        </div>
        <div style="border: 3px solid #333; padding: 20px; margin-top: 30px;">
            <Div style="display: flex; justify-content: space-between;">
                <h6>Reg. Folio No: <span> 1</span></h6>
                <h6>Certificate No: <span> 10</span></h6>
            </Div>
            <h6>Name(s) of the Holder(s):<span> {{$memberdetails[0]->first_name}}</span></h6>
            <h6>No. of Shares Held:<span> {{$membarpayment->shares}} (in figures)</span></h6>
            <h6>Distinctive No (s): <span> From 74 to 82 (Both inclusive)</span></h6>
        </div>

        <div style="margin-top: 20px">
            <div>
                <h6>Given under the common seal of the Company on <span>21/05/2022</span></h6>
                <p style="margin-top: 50px; margin-bottom: 50px;">1. Secretary/ any other Authorised person :</p>
            </div>
            <div style="overflow-x: auto;">
                <table>
                    <caption class="tableCaption">MEMORANDUM OF TRANSFERS</caption>
                    <tr class="font-weight-bold">
                        <th>Name of Transferor</th>
                        <th>Name of Transferee</th>
                        <th>Reg.<br> Ledger <br> Folio No. of Transferee</th>
                        <th>Number of Shares</th>
                        <th>Date of Transfer</th>
                        <th>Signature of Authorised Signatory</th>
                    </tr>
                    <tr>
                        <td>{{$memberdetails[0]->first_name}}</td>
                        <td>{{$sharefrom[0]->director_name}}</td>
                        <td>9</td>
                        <td>{{$membarpayment->shares}}</td>
                        <td>{{$alloc_date[0]}}</td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <h6 style="font-weight: 400; font-size: 26px;">Note: No transfer of the Share(s) comprised in the Certificate can be registered unless accompanied by this
                Certificate</h6>
        </div>
    </div>
</body>

</html>