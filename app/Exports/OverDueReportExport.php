<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\LoanApplication;

class OverDueReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'EMI NO.',
            'EMI DATE',
            'EMI DUE DATE',
            'PRINCIPAL',
            'INTEREST',
            'EMI AMOUNT',
            'STATE',
            'LOAN ID',
            'MEMBER NO.',
            'MEMBER NAME',
            'MOBILE NUMBER',
            'BRANCH'

        ];
    } 
    protected $branch,$from_date,$to_date;

    public function __construct(string $from_date,string $to_date, string $branch)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->branch = $branch;

      // return $this;

    }


    public function collection()
    {
        $this->from_date;
        $this->to_date;
        $this->branch;

        $overdue_report= LoanApplication::select(
            'emi_details.emi_no',
            'emi_details.emi_date',
            'emi_details.emi_due_date',
            'emi_details.principal_amt',
            'emi_details.interest',
            'emi_details.emi_amt',
            'emi_details.status',

            'emi_details.loan_disbursement_id',
            'member_management.member_id_code',
            'member_management.first_name',
            'member_management.mobile',
            'company_branches.branch_name',

        )
        ->leftjoin('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
        ->leftjoin('emi_details', 'emi_details.loan_disbursement_id', '=', 'loan_disbursements.id')
        ->leftjoin('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->leftjoin('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->where([
            ['emi_details.status', '=', "overDue"],
            ['loan_applications.branch', '=',$this->branch],

            ])
    
        ->whereBetween('emi_details.emi_due_date', array($this->from_date,$this->to_date))
     
        ->get();
       //dd($due_report);
        return $overdue_report;
        
    }
}
