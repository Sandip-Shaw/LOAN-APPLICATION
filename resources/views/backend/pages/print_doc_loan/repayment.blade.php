<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Loan repayment schedule</title>
 <link rel="stylesheet" href="style.css">
 <style>
    .table {
  border-collapse: collapse;
  width: 100%;
  max-width: 100%;
  margin-bottom: 1rem;
  background-color: transparent;
  border: 1px solid #050505;
}

.table td,
.table th {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #050505;
  text-align: center;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 1px solid #050505;
}

.table tbody + tbody {
  border-top: 1px solid #050505;
}

.table .table {
  background-color: #fff;
}

 </style>
</head>

<body>
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
        LOAN REPAYMENT SCHEDULE</p>
  </div>
        <hr>
    <p class="account">A/c No: {{$loan_account[0]->id}}
        ({{$loan_account[0]->first_name}})</p>
    <div class="date">
        <div style="text-align: right; margin-bottom: -9px;">Branch :  {{$loan_account[0]->branch_name}}</div>
    <div style="padding-left: 5pt;text-indent: 0pt;line-height: 2pt;text-align: left;"> Printed On :
        20/02/2023 18:00</div>
    </div>
    <br><br>
 <hr class="bottolinr" >
    <p style="padding-top: 3pt;padding-left: 5pt;text-indent: 0pt;line-height: 87%;text-align: left;">Repayment
        schedule: Repayable in {{$loan_account[0]->tenure_months}}  {{$loan_account[0]->tenure_type}} in arrears, rst payment of installment to be made on or before <br> <strong>{{$loan_account[0]->first_emi_date}} </strong> and each subsequent installment is made <strong>{{$loan_account[0]->tenure_type}}</strong>
        succeeding calendar month.</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>

    {{-- <table border="1">
        <thead>
        <tr>
            <td>
                <p class="s6" style="padding-left: 10pt;padding-right: 13pt;text-indent: 0pt;text-align: center;">EMI
                    No.</p>
            </td>
            <td>
                <p class="s6" style="padding-left: 15pt;padding-right: 14pt;text-indent: 0pt;text-align: center;">EMI
                    Date</p>
            </td>
            <td>
                <p class="s6" style="padding-left: 16pt;padding-right: 10pt;text-indent: 0pt;text-align: center;">EMI
                    Principle</p>
            </td>
            <!-- <td>
                <p class="s6" style="padding-left: 13pt;text-indent: 0pt;text-align: left;">EMI</p>
            </td> -->
            <td>
                <p class="s6" style="padding-left: 2pt;text-indent: 0pt;text-align: left;">Interest</p>
            </td>
            <td>
                <p class="s6" style="padding-left: 9pt;text-indent: 0pt;text-align: left;">Charges Per EMI</p>
            </td>
            <!-- <td
                style="width:27pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                <p class="s6" style="padding-left: 1pt;text-indent: 0pt;text-align: left;">EMI</p>
            </td> -->
            <td>
                <p class="s6" style="padding-left: 9pt;text-indent: 0pt;text-align: left;">EMI Amount</p>
            </td>
            <td>
                <p class="s6"
                    style="padding-top: 2pt;padding-left: 7pt;text-indent: 2pt;line-height: 83%;text-align: left;">
                    Balance Principle</p>
            </td>
        </tr>
        </thead>
        @foreach($emi_details as $emi)
        <tr>
            <td>
                <p class="s7" style="padding-top: 2pt;padding-right: 3pt;text-indent: 0pt;text-align: center;">{{$emi->emi_no}}</p>
            </td>
            <td>
                <p class="s7"
                    style="padding-top: 2pt;padding-left: 15pt;padding-right: 14pt;text-indent: 0pt;text-align: center;">
                    {{$emi->emi_date}}</p>
            </td>
            <td>
                <p class="s7"
                    style="padding-top: 2pt;padding-left: 16pt;padding-right: 10pt;text-indent: 0pt;text-align: center;">
                    {{$emi->principal_amt}}</p>
            </td>
            <td>
                <p class="s7"
                    style="padding-top: 2pt;padding-left: 32pt;padding-right: 27pt;text-indent: 0pt;text-align: center;">
                    {{$emi->interest}}</p>
            </td>
            <td>
                <p class="s7" style="padding-top: 2pt;padding-left: 39pt;text-indent: 0pt;text-align: left;">{{$emi->other_charges}}</p>
            </td>
            <td>
                <p class="s7" style="padding-top: 2pt;padding-left: 51pt;text-indent: 0pt;text-align: left;">{{$emi->emi_amt}}</p>
            </td>
            <td>
                
                <p class="s7"
                    style="padding-top: 2pt;padding-left: 14pt;padding-right: 8pt;text-indent: 0pt;text-align: center;">
                    {{$emi->bal_principal}}</p>
            </td>
        </tr>
        @endforeach
        <tr >
            <td>
                
                <p class="s8"
                    style="padding-top: 3pt;padding-left: 10pt;padding-right: 13pt;text-indent: 0pt;text-align: center;">
                    TOTAL</p>
            </td>
            <td>
                
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td
                style="width:91pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td>
                <p class="s8"
                    style="padding-top: 3pt;padding-left: 32pt;padding-right: 27pt;text-indent: 0pt;text-align: center;">
                    {{ $emi_details->sum('interest') }}</p>
            </td>
            <td>
                
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td>
                <p class="s8" style="padding-top: 3pt;padding-left: 47pt;text-indent: 0pt;text-align: left;">{{ $emi_details->sum('emi_amt') }}
                </p>
            </td>
            <td>
                
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
    </table> --}}
    <table class="table">
        <thead>
          <tr>
            <th>EMI No.</th>
            <th>EMI Date</th>
            <th>EMI Principle</th>
            <th>Interest</th>
            <th>Charges Per EMI</th>
            <th>EMI Amount</th>
            <th>Balance Principle</th>
          </tr>
        </thead>
        <tbody>
          @foreach($emi_details as $emi)
          <tr>
            <td>{{$emi->emi_no}}</td>
            <td>{{$emi->emi_date}}</td>
            <td>{{$emi->principal_amt}}</td>
            <td>{{$emi->interest}}</td>
            <td>{{$emi->other_charges}}</td>
            <td>{{$emi->emi_amt}}</td>
            <td>{{$emi->bal_principal}}</td>
          </tr>
          @endforeach
          <tr>
            <td>TOTAL</td>
            <td></td>
            <td></td>
            <td>{{ $emi_details->sum('interest') }}</td>
            <td></td>
            <td>{{ $emi_details->sum('emi_amt') }}</td>
            <td></td>
          </tr>
        </tbody>
      </table>

    <a href="#"></a>  <!--delete this -->
    <p>***End of Report***</p>
</center>
</body>

</html>
