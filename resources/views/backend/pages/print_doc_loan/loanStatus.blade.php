<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">

    <title>LOAN STATUS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/brands.min.css" integrity="sha512-L+sMmtHht2t5phORf0xXFdTC0rSlML1XcraLTrABli/0MMMylsJi3XA23ReVQkZ7jLkOEIMicWGItyK4CAt2Xw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
       .masage{
        text-align: center;
       }
    </style>
</head>

<body> <a href="#"></a>  <!--delete this -->

    <p class="s1" style="padding-top:1pt; padding-left: 123pt; text-indent: 0pt; text-align: center;">{{$company_details[0]->company_name}}</p>
    <div class="logo" style="text-indent: 0pt;text-align: left;">
        <img width="111" height="39"
        src="logo.png" />
    </div>
    <p class="s2" style="padding-left: 123pt;text-indent: 0pt;text-align: center;margin-top: -36px;">
        REG.OFFICE:
        <span class="s3">{{$company_details[0]->address}}</span>
    </p>
    <p class="s2" style="padding-top: 1pt;padding-left: 123pt;text-indent: 0pt;text-align: center;">
        LOAN STATUS
    </p>


        <div style="text-align: right; margin-bottom: -9px;">Branch : {{$loan[0]->branch_name}}</div>
    <div style="padding-left: 5pt;text-indent: 0pt;line-height: 2pt;text-align: left;"> Printed On :
    {{ Carbon\Carbon::today()->format('d/m/Y') }}</div>
    </div>
    <hr>
    <br><br>

    <table>
        <tr>
            <td colspan="2">MEMBER</td>
            <td colspan="2">:</td>
            <td colspan="2">{{$loan[0]->member_id_code}}-{{$loan[0]->first_name}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td colspan="2" >ACCOUNT No</td>
            <td colspan="2">:</td>
            <td>{{$loan[0]->loanID}}</td>

        </tr>
        <tr>
            <td colspan="2">TOTAL EMIs</td>
            <td colspan="2">:</td>
            <td colspan="2">{{$loan[0]->no_of_emis}}</td>
            <td colspan="2">EMIs PAID</td>
            <td colspan="2">:</td>
            <td>{{$emiCounts->paid_count}}</td>
        </tr>
        <tr>
            <td colspan="2">EMIs DUE</td>
            <td colspan="2">:</td>
            <td colspan="2">{{$emiCounts->due_count}}</td>
            <td colspan="2">EMIs OVERDUE</td>
            <td colspan="2">:</td>
            <td>{{$emiCounts->overdue_count}}</td>
        </tr>
        <tr>
            <td colspan="2">LOAN AMT</td>
            <td colspan="2">:</td>
            <td colspan="2">&#8377; {{ $loan[0]->loan_amount }}</td>
            <td colspan="2">CURRENT DEBT</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">A/C STATUS</td>
            <td colspan="2">:</td>
            <td>{{$loan[0]->loan_status}}</td>
            <td></td>

        </tr>
    </table>
    <br>
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
    <p class="masage">Thank You for your business</p>
</body>

</html>
