<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\LoanApplication;


class NotApprovalReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'Application No.',
            'Member Code',
            'Member Name',
            'Application Date',
            'Branch',
            'Scheme Name',
            'Loan Amount',
            'Term',
            'Mode',
            'ROI',
            'EMI',
            'Status'

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

        $application= LoanApplication::select(
            'loan_applications.loanApplication_id',
            'member_management.member_id_code',
            'member_management.first_name',
            'loan_applications.application_date',
            'company_branches.branch_name',
            'loan_schemas.schema_name',

            'loan_applications.amt_approved',
            'loan_applications.tenure_months',
            'loan_applications.tenure_type',
            'loan_schemas.ann_rate_int',
            'loan_applications.emi_amount_total',
            'loan_applications.status',


        )
        ->leftjoin('loan_schemas', 'loan_schemas.loanSchema_id', '=', 'loan_applications.loan_schema')
        //->leftjoin('loan_disbursements', 'loan_disbursements.loanApplication_id', '=', 'loan_applications.loanApplication_id')
         ->leftjoin('member_management', 'member_management.member_id', '=', 'loan_applications.member')
         ->leftjoin('company_branches', 'company_branches.id', '=', 'loan_applications.branch')
         ->where([
             ['loan_applications.status', '=', "NotApproved"],      
             ['loan_applications.branch', '=',$this->branch],

             ])
    
         ->whereBetween('loan_applications.application_date', array($this->from_date, $this->to_date))
     
        ->get();
        //dd($application);
        return $application;
    }
}
