<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\EmiDetails;

class EmiPaymentCollectionExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'Member Name',
            'Branch',
            'Emi No.',
            'Emi Date',
            'Emi Due Date',
            'Principal',
            'Interest',
            'Other Charge',
            'Emi',
            'Bal Principal',
            'Status'
        ];
    } 
    protected $to_date;

    public function __construct(string $to_date)
    {
        // $this->from_date = $from_date;
        $this->to_date = $to_date;
        // $this->branch = $branch;

      // return $this;

    }
    public function collection()
    {
        $emi_details = EmiDetails::select(
            'member_management.first_name',
            'company_branches.branch_name',
            'emi_details.emi_no', 
            'emi_details.emi_date',
            'emi_details.emi_due_date',
            'emi_details.principal_amt', 
            'emi_details.interest',
            'emi_details.other_charges', 
            'emi_details.emi_amt',      
            'emi_details.bal_principal',      
            'emi_details.status',      

        )
        ->join('loan_disbursements', 'loan_disbursements.id', '=', 'emi_details.loan_disbursement_id')
        ->join('loan_applications', 'loan_applications.loanApplication_id', '=', 'loan_disbursements.loanApplication_id')
        ->join('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->join('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->where('loan_applications.status', '=', "Disbursed")
        ->where('emi_details.status', '=', "Pending")
        ->where('emi_details.emi_date', $this->to_date)
        ->get();
        //dd($emi_details);
        return $emi_details;
    }
}
