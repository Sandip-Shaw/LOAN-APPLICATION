<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>EMI RECEIPT</title>
    <link rel="stylesheet" href="style.css">
    <style>
        i {
            /* margin-top: 12px; */
        }
    </style>
</head>


<body> <a href="#"></a>
    <!--delete this -->

    <p class="s1" style="padding-top:1pt; padding-left: 123pt; text-indent: 0pt; text-align: center;">
        {{ $company_details[0]->company_name }}</p>
    <div class="logo" style="text-indent: 0pt;text-align: left;">
        <img width="100" height="39" src="logo.png" />
    </div>
    <p class="s2" style="padding-left:90pt;text-indent: 0pt;text-align: center;margin-top: -36px;">
        REG.OFFICE:
        <span class="s3">{{ $company_details[0]->address }}</span>
    </p>
    <p class="s2" style="padding-top: 1pt;padding-left: 123pt;text-indent: 0pt;text-align: center;">
        EMI RECEIPT
    </p>


    <div style="text-align: right; margin-bottom: -9px;">Branch : {{ $emi_det[0]->branch_name }}</div>
    <div style="padding-left: 5pt;text-indent: 0pt;line-height: 2pt;text-align: left;"> Printed On :
        {{ Carbon\Carbon::today()->format('d/m/Y') }}</div>
    </div>
    <hr>
    <br><br>
    <p>
        Emi No: {{ $emi_det[0]->emi_no }}
    </p>
    <table>
        <tr>
            <td colspan="2">MEMBER</td>
            <td>:</td>
            <td>{{ $emi_det[0]->member_id_code }} - {{ $emi_det[0]->first_name }}</td>

        </tr>
        <tr>
            <td colspan="2">Account No</td>
            <td>:</td>
            <td>{{ $emi_det[0]->loan_disbursement_id }}</td>

        </tr>
        <tr>
            <td colspan="2">Principal Amount</td>
            <td>:</td>
            <td><i class="fa fa-inr" aria-hidden="true"></i> {{ $emi_det[0]->principal_amt }}</td>

        </tr>
        <tr>
            <td colspan="2">Interest Amount</td>
            <td>:</td>
            <td> <i class="fa fa-inr" aria-hidden="true"></i>{{ $emi_det[0]->interest }}</td>

        </tr>
        <tr>
            <td colspan="2">Other Charges</td>
            <td>:</td>
            <td> <i class="fa fa-inr" aria-hidden="true"></i>{{ $emi_det[0]->other_charges }}</td>

        </tr>
        <tr>
            <td colspan="2">EMI Amount</td>
            <td>:</td>
          <td><i class="fa fa-inr" aria-hidden="true" ></i>{{ $emi_det[0]->emi_amt }} </td>

        </tr>
        <tr>
            <td colspan="2">Panelty Charges </td>
            <td>: </td>
            <td> <i class="fa fa-inr" aria-hidden="true"></i>{{ $emi_det[0]->fine_amt }}</td>

        </tr>
        <tr>
            <td colspan="2">Total Amount </td>
            <td>: </td>
            <td><i class="fa fa-inr" aria-hidden="true" style="margin-top: 12px;"></i>{{ $emi_det[0]->amt_collect }}</td>

        </tr>
        <tr>
            <td colspan="2">Status</td>
            <td>:</td>
            <td>{{ $emi_det[0]->status }}</td>

        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <table>
        
        <tr>
            <td style="width: 300px;">Approved by</td>
          
            <td  style="width: 300px;">Verified by</td>
           
            <td  style="width: 300px;">Posted by</td>
          
        </tr>
    </table>
    <hr>
    <p style="text-align: center">Thank You for your business</p>
</body>

</html>
