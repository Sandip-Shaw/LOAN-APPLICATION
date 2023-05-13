<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice For Overdue</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> <a href="#"></a>  <!--delete this -->
    <center>
        <div class="logo">
            <img width="111" height="39"
            src="logo.png" />
        </div>
        <div class="company">
            <p class="s1" >{{$company_details[0]->company_name}}</p>
            <p class="s2" >
                REG.OFFICE:
                <span class="s3">{{$company_details[0]->address}}</span>
            </p>
            <!-- <p class="s2" >
                BR.OFFICE: <span class="s3">Kolkata, KOLKATA Kolkata West Bengal - 713519</span>
            </p> -->
            
            <p class="s4" >
                NOTICE FOR OVERDUE</p>
          </div>
        <hr>
        <div class="date">
            <div style="text-align: right; margin-bottom: -9px;">Branch : {{$loan_account[0]->branch_name}}</div>
        <div style="padding-left: 5pt;text-indent: 0pt;line-height: 2pt;text-align: left;"> Printed On :
        {{ Carbon\Carbon::today()->format('d/m/Y') }}</div>
        </div>
        <br><br>
     <hr class="bottomline">
    </center>
    <p class="to">To,</p>
    <table class="sender">
        <tr>
            <th>NAME </th>
            <td>:</td>
            <td>{{$loan_account[0]->first_name}} ({{$loan_account[0]->member_id_code}})</td>
        </tr>
        <tr>
            <th>A/C No</th>
            <td>:</td>
            <td>{{$loan_account[0]->loanId}}</td>
        </tr>
        <tr>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;ADDRESS</th>
            <td>:</td>
            <td>{{$loan_account[0]->address}} {{$loan_account[0]->state}} {{$loan_account[0]->pincode}}</td>
        </tr>

    </table>
    <br>
    <table class="subject">
        <tr>
            <th>OBJECT:</th>
            <td> Notice For Overdue</td>
        </tr>
    </table>
    <br>
    <table >
        <tr>
            <td>Respected:</td>
            <td class="underline">{{$loan_account[0]->first_name}} </td>
        </tr>
    </table>
    <div class="mailbody1">
       <p> Please be advised that the undersigned is the holder of a certain promissory note made by you dated <br>
       <date>{{$loan_account[0]->loan_disburse_date}}</date> in the original principal amount of Rs {{$loan_account[0]->loan_amount}}</p>
    </div>
    <div class="mailbody2">
       <p> You are hereby notified that you have default under said note because you have failed to pay the <br>
        installment due amount of <date>{{$sum[0]->total_emi_amount}}</date> from <date>{{$sum[0]->emi_date}}</date>.</p>

    </div>
    <div class="mailbody3">
       <p> Therefore, demand is hereby made upon you for full payment of the entire balance due on said note in the <br>
amount of <date>{{$sum[0]->total_emi_amount}}</date> with panelty charge  accrued to update.
       </p>
    </div>
    <div class="mailbody4">
        <p>If the entire amount due is not received on or before <date>{{ Carbon\Carbon::today()->format('d/m/Y') }}</date>, I shall instruct legal counsel to
            commence legal proceeding against you..</p>
    </div>
    <div class="mailbody5">
        <p>We request you to make the payment on or before <date>{{ Carbon\Carbon::today()->format('d/m/Y') }}</date> without fail.
        </p>
    </div>
    <div class="mailbody4">
        <p>Please carefully review the note, which obligates you to pay in addition to the principal balance and interest,
            cost of collection, court and advocate's fees.</p>
    </div>
    <div class="end">
        <p>Your prompt attention to the foregoing is anticipated</p>
    </div>
    <br>
    <br>
    <div class="sendername">Yours Faithfully,
    </div>
</body>
</html>
