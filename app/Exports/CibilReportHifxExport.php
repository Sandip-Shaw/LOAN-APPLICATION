<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\HrManagement;
use App\Models\MemberManagement;

class CibilReportHifxExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'father_name',
            'member_id',
            'branch',
            'emr_date',
            'title',
            'gender',
            'first_name',
            'dob',
            'qualification',
            'occupation',

        ];
    } 
    protected $month_year,$branch;

    public function __construct(string $month_year,string $branch)
    {
       
        $this->month_year = $month_year;
        $this->branch = $branch;

    }

    public function collection()
    {
        
        $this->month_year;
        $this->branch;

        // $report= HrManagement::select(
        //     'company_branches.branch_name',
        //     'hr_management.emp_code',  
        //     'hr_management.name',
        //     'add_designations.designation_name',
        //     'hr_management.mobile',
        //     'hr_management.email',
        //     'employee_salary_releases.amt_to_pay',
        //     'employee_salary_releases.payment_by',

        //     'employee_salary_releases.month_year',
        //     'employee_salary_releases.status',

        // )
        // ->leftjoin('add_designations', 'hr_management.designation', '=', 'add_designations.id')
        // ->leftjoin('company_branches', 'company_branches.id', '=', 'hr_management.branch')

        // ->leftjoin('employee_salary_releases', 'hr_management.hrmanagement_id', '=', 'employee_salary_releases.employee')
   
        // ->where([
        //     ['employee_salary_releases.status', '=', "Paid"],
        //     ['employee_salary_releases.pay_branch', '=',$this->branch],
        //     ['employee_salary_releases.month_year', '=',$this->month_year],

        //     ])
    
        // ->get();
        $report= MemberManagement::select(
                 'member_management.Member_Identifier',
                 'member_management.Member_Name_1',  
                 'member_management.Member_Birth_Date',
                 'member_management.Member_Gender_Type',
                'member_management.Marital_Status_Type',
                'member_management.Pin_Code',
                 'member_management.Nominee_Name',
                 'member_management.Voters_ID',
    
                'member_management.Member_Permanent_Address',
                 'member_management.Nominee_relationship',
                 'member_management.Account_Number',
                 'member_management.Date_of_Account_Information',
                 'member_management.Application_date',
                 'member_management.Date_Opened_Disbursed',
                 'member_management.Date_Closed_if_closed',
                 'member_management.Applied_For_amount',
                 'member_management.Total_Amount_Disbursed_Rupees',
                 'member_management.Number_of_Installments',
                 'member_management.Repayment_Frequency',
                 'member_management.Current_Balance',
                 'member_management.Amount_Overdue_Rupees',

 
 
 
 
 
 
 
 

        )
    
        ->get();

        return $report;
    }
}
