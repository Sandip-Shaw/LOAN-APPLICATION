<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\HrManagement;
use App\Models\MemberManagement;

class CibilReportExport implements FromCollection,WithHeadings
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
                 'member_management.father_name',
                 'member_management.member_id',  
                 'member_management.branch',
                 'member_management.emr_date',
                'member_management.title',
                'member_management.gender',
                 'member_management.first_name',
                 'member_management.dob',
    
                'member_management.qualification',
                 'member_management.occupation',
        )
    
        ->get();

        return $report;
    }
}
