<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\HrManagement;

class SalaryReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'BRANCH',
            'EMP CODE',
            'EMP NAME',
            'DESIGNATION',
            'MOBILE NO',
            'EMAIL',
            'AMOUNT RELEASE',
            'MODE',
            'MONTH-YEAR',
            'STATUS',

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

        $report= HrManagement::select(
            'company_branches.branch_name',
            'hr_management.emp_code',  
            'hr_management.name',
            'add_designations.designation_name',
            'hr_management.mobile',
            'hr_management.email',
            'employee_salary_releases.amt_to_pay',
            'employee_salary_releases.payment_by',

            'employee_salary_releases.month_year',
            'employee_salary_releases.status',

        )
        ->leftjoin('add_designations', 'hr_management.designation', '=', 'add_designations.id')
        ->leftjoin('company_branches', 'company_branches.id', '=', 'hr_management.branch')

        ->leftjoin('employee_salary_releases', 'hr_management.hrmanagement_id', '=', 'employee_salary_releases.employee')
   
        ->where([
            ['employee_salary_releases.status', '=', "Paid"],
            ['employee_salary_releases.pay_branch', '=',$this->branch],
            ['employee_salary_releases.month_year', '=',$this->month_year],

            ])
    
        ->get();
    
        return $report;
    }
}
