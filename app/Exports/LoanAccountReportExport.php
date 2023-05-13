<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\LoanApplication;

class LoanAccountReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'Account No.',
            'Application No.',
            'Member Code',
            'Member Name',
            'Account Opening Date',
            'Branch',
            'Scheme Name',
            'Loan Amount',
            'Term',
            'Mode',
            'ROI',
            'EMI'
        ];
    } 

    protected $branch,$from_date,$to_date,$accnt_status;

    public function __construct(string $from_date,string $to_date, string $branch, string $accnt_status)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->branch = $branch;
        $this->accnt_status = $accnt_status;
      // return $this;

    }
    public function collection()
    {
        $this->from_date;
        $this->to_date;
        $this->branch;
        $this->accnt_status;

        $accnt_report= LoanApplication::select(
            'loan_disbursements.id',
            'loan_applications.loanApplication_id',
            'member_management.member_id',
            'member_management.first_name',
            'loan_disbursements.loan_disburse_date',
            'company_branches.branch_name',
           'loan_schemas.schema_name',
           'loan_applications.amt_approved',
           'loan_applications.tenure_months',
           'loan_applications.tenure_type',
           'loan_schemas.ann_rate_int',
            'loan_applications.emi_amount_total',
             )
        ->leftjoin('loan_schemas', 'loan_schemas.loanSchema_id', '=', 'loan_applications.loan_schema')

        ->leftjoin('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
        //->leftjoin('emi_details', 'emi_details.loan_disbursement_id', '=', 'loan_disbursements.id')
        ->leftjoin('member_management', 'member_management.member_id', '=', 'loan_applications.member')
        ->leftjoin('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
        ->where([
            ['loan_applications.status', '=', $this->accnt_status],
            ['loan_applications.branch', '=',$this->branch],

            ])

        ->whereBetween('loan_disbursements.loan_disburse_date', array($this->from_date, $this->to_date))
       
        ->get();
        
        return $accnt_report;
        
    
    }
}
