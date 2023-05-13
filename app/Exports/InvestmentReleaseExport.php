<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\InvestmentPayDetails;

class InvestmentReleaseExport implements FromCollection,WithHeadings
{
    public function headings():array{
        return[
            'MEMBER CODE',
            'MEMBER NAME',
            'BRANCH',
            'TENURE NO',
            'PRINCIPAL',
            'MATURITY AMOUNT',
            'INTEREST EARNED',
            'INT. PER TENURE',
            'RELEASE DATE',
            'BALANCE PRINCIPAL',

        ];
    } 
    protected $to_date;

    public function __construct(string $to_date)
    {
       
        $this->to_date = $to_date;
    

    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $this->to_date;
        $details = InvestmentPayDetails::select(
            'member_management.member_id_code',
            'member_management.first_name',
            'company_branches.branch_name',
            'investment_pay_details.tenure_no',
            'investment_pay_details.principal_amt',
            'investment_pay_details.maturity_amount',
            'investment_pay_details.interest_earned',
            'investment_pay_details.int_per_tenure',
            'investment_pay_details.period',
            'investment_pay_details.bal_principal',

           
        )
         ->join('investment_creates', 'investment_creates.id', '=', 'investment_pay_details.createInvestment_id')

         ->join('member_management', 'member_management.member_id', '=', 'investment_creates.member')
         ->join('company_branches', 'company_branches.id', '=', 'investment_creates.branch')
       
         ->where('investment_pay_details.status', '=', "Pending")
         ->where('investment_pay_details.period', $this->to_date)
        ->get();
        return $details;
    }
}
