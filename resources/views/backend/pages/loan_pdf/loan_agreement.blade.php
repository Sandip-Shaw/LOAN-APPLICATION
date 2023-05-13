<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loan agreement</title>
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
    <!-- <Header class="container">
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
    </Header> -->

    <div class="container">
        <h1 style="text-align: center;font-size: 32px; font-weight: 600;">LOAN AGREEMENT</h1>
        <!-- <h1 style="text-align: center;font-size: 28px; font-weight: 700; margin-top: 20px;">SHARE CERTIFICATE</h1> -->
        <h3 style="text-align: center;font-size: 18px; font-weight: 500; margin-top: 20px;">
        (A) Lender (Fund Provider) :- 
        Name: {{$company_details[0]->company_name}}, Address: {{$company_details[0]->address}}  (CIN) {{$company_details[0]->cin_no}} </h3>
        <h3 style="text-align: center;font-size: 18px; font-weight: 500; margin-top: 20px;">
        (B) Borrower :- 
        Name: {{$application1->memberdetails->first_name}}, Address: {{$application1->memberdetails->address}}
        </h3>
        <p style="margin-top: 50px;font-size: 15px;">THIS AGREEMENT made and entered into at {{Carbon\Carbon::parse($application1->updated_at)->format('d-m-Y')}} hereinafter called "the Lender" AND hereinafter called "the Borrower" 
        and reference to the parties hereto shall mean and include their respective heirs, executors, administrators and assigns;
        </p>
        <p style="margin-top: 20px;font-size: 15px;">WHEREAS the Borrower is in need of funds and hence has approached the Lender to grant her  Rs. {{$application1->amt_approved}} /- @php  $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        echo $f->format($application1->amt_approved);     @endphp for a period of  {{$application1->tenure_months}} {{$application1->tenure_type}} ;
            The amount is interest-free / with interest @ {{$application1->loanSchema->ann_rate_int}} % p.a.

        </p>
        <p style="margin-top: 20px;font-size: 15px;">AND WHEREAS the Lender has agreed to grant a loan to the Borrower, free of interest/with interest ,
            as the Lender and the Borrower have known each other since several years;
        </p>
        <p style="margin-top: 20px;font-size: 15px;">
        AND WHEREAS the parties hereto are desirous of recording the terms and conditions of this loan in writing;
        </p>
        <p style="margin-top: 20px;text-align: center;font-size: 16px;">
       <b> NOW THIS AGREEMENT WITNESSETH and it is hereby agreed by and between the parties hereto as under:-</b>
        </p>
        <p style="margin-top: 20px;font-size: 15px;">
        1.The Borrower hereto, being in need of money, has requested the Lender to give her an interest-free/with interest loan of Rs. {{$application1->amt_approved}} /- @php  $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        echo $f->format($application1->amt_approved);     @endphp    @ {{$application1->loanSchema->ann_rate_int}}  %p.a. to enable her to purchase a residential flat, to which the Lender has agreed. <br><br>

        2.The said loan is required by the Borrower for a period of  {{$application1->tenure_months}} {{$application1->tenure_type}}, commencing {{Carbon\Carbon::parse($application1->updated_at)->format('d-m-Y')}} .<br><br>
        
        3.The Borrower hereby agrees and undertakes to return the loan of Rs. {{$application1->total_amount_coll}} /-  @php  $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        echo $f->format($application1->total_amount_coll);     @endphp in installments, within the aforesaid period of {{$application1->tenure_months}} {{$application1->tenure_type}} and gives her personal guarantee for the same.<br><br>
													
        4.The terms and conditions of this Agreement are arrived at by the mutual consent of the parties hereto.<br><br>
															
        5.That the borrower is known to the Lender as a (business /profession) person/friend/known person who just wanted to  use the amount of Loan for Personal/Business/Other purposes best known to the borrower.<br><br>
															
        6.As a security against the amount provided as per abovementioned details the borrower without any pressure and out of his own will has provided following :<br><br>
            - Blank cheque vide Cheque no._____________& ____________ of ____________Bank which is presently dated respectively as _____________& ______________ . This may be used after _______ years / months as per the terms mentioned above .
             The borrower undertakes alongwith this that he will never complaint to bank , police or other authority that these cheques were lost or fraudulent . Also that the borrower legally undertakes that the signature done is correct and 
             he will not change the bank signature and if he does so then he will provide us valid replacement cheques immediately ;<br><br>
            - Doing an agreement for the Property as per the following details _______________________________________________________________________ & alongwith the Agreement of property dated__________________- & Notarised dated _______________________ 
             the borrower is providing the following documents in original/copy for safekeeping till the borrowed amount is returned to the Lender. The borrower declares that in no case he will sale or alienate the property before payment to the Lender . Also 
             that the borrower will never make any duplicate of the												
		    property papers and will never compliant regarding the document lost of the property papers. Also that whenever the property is sold by anybody the first charge will be to pay the borrowed amount and then the surplus will be the right of the property owner / 
            borrower only. After payment(principle amount and any interest thereon) satisfaction , borrower has the complete legal right to get back the documents .<br><br><br>
            All the above information provided is true and verified by both the parties and for the truthfulness , the parties will be responsible.

        </p>
        <p style="margin-top: 20px;font-size: 15px;">
             IN WITNESS WHEREOF the parties hereto have hereunto set and subscribed their respective hands the day and year first hereinabove written.
        </p>
        <p style="text-align: left;font-size: 16px; margin-top: 50px;">
        SIGNED AND DELIVERED by the Within-<br>
        named Lender in the presence of(witness)
        </p>
        <p style="text-align: right;font-size: 16px;">
        Lender- Name & Signature
        </p>

        <p style="text-align: left;font-size: 16px; margin-top: 150px;">
        SIGNED AND DELIVERED by the Within-<br>
        named Borrower in the presence of(witness)
        </p>
        <p style="text-align: right;font-size: 16px;">
        Borrower - Name & Signature
        </p>
        
            
        
    </div>
</body>

</html>