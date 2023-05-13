<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Closure Request</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <p> Date : {{ Carbon\Carbon::today()->format('d/m/Y') }}</p>
    <table class="riciver">
        <tr>
            <td>To</td>
        </tr>
        <tr>
            <td>The Branch Manager</td>
        </tr>
        <tr>
            <td>{{$company_details[0]->address}}</td>
        </tr>
       
    </table>
    <br>
    <br>

    <table class="subject">
        <tr>
            <th>Subject:</th>
            <td> Loan Closing Request Letter ({{$loan_account[0]->loanId}})</td>
        </tr>

    </table>
    <br>
    <table>
        <tr>
            <td>Respected</td>
            <td>Sir/Ma'am,</td>
        </tr>
    </table>
    <p class="mailbody1">This is to inform you that I/We {{$loan_account[0]->first_name}} had availed a Business/ Other Loan under account no
    {{$loan_account[0]->loanId}}
        from your renowned company. During the tenure of the loan, I was/We were completely satisfied with the
        services and response received and there are no grievances against the company, its employees, its
        directors etc.
    </p>
    <br>
    <table class="data">
        <tr>
            <th>Member's Name</th>
            <td>:</td>
            <td>Mr. {{$loan_account[0]->first_name}} (M00825)</td>
        </tr>
        <tr>
            <th>Loan Account No</th>
            <td>:</td>
            <td>{{$loan_account[0]->loanId}}</td>
        </tr>

    </table>
    <br>
    <p class="mailbody2">
        I/We hereby confirm that I wish to foreclose/close the loan, on my own free will. I/We hereby request you to
        accept this as a formal request to close the above mentioned loan account no subject to realization of total
        outstanding dues including any interest, charges, fees, costs etc. from me by the company.

    </p>
    <br>
    <br>
    <p>Thanking You</p>
    <div class="ending">
        <p>Date : {{ Carbon\Carbon::today()->format('d/m/Y') }} <br> Place : </p>
<p class="sender">YOURS FAITHFULLY <br>Mr. {{$loan_account[0]->first_name}}</p>
    </div>
    <a href="#"></a>  <!--delete this -->
</body>

</html>
