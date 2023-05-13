<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\MemberManagement;
use App\Models\Groups;
use App\Models\CompanyBranch;
use App\Models\HrManagement ;
use App\Models\LoanApplication ;
use App\Models\EmiDetails ;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Helpers\Helper;
use App\Models\CompanyProfile;
use App\Models\NoticeBoard;


class DashboardController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function index()
    {
        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view dashboard !');
        }

        $total_roles = count(Role::select('id')->get());
        $total_admins = count(Admin::select('id')->get());
        $total_permissions = count(Permission::select('id')->get());
        $members = count(MemberManagement::select('member_id')->get());
        $groups = count(Groups::select('id')->get());
        $branchs = count(CompanyBranch::select('id')->get());
        $employee = count(HrManagement::select('hrmanagement_id')->get());
        $loanAccount = count(LoanApplication::select('loanApplication_id')->where('status','=','Disbursed')->get());
    
        $notice_board = NoticeBoard::select('*')
        ->where('created_at', '>=', Carbon::now()->startOfDay())
        ->where('created_at', '<=', Carbon::now()->endOfDay())
        ->orderBy('id', 'asc')
        ->get();
    
      $balance = EmiDetails::select(
            'loan_applications.loanApplication_id',
            'loan_applications.branch',
            'loan_disbursements.id',
            'emi_details.total_amt',
             'emi_details.pay_mode',
             'company_branches.branch_name',
            
            
      )
        ->join('loan_disbursements', 'loan_disbursements.id', '=', 'emi_details.loan_disbursement_id')
        ->join('loan_applications', 'loan_applications.loanApplication_id', '=', 'loan_disbursements.loanApplication_id')
        ->join('company_branches', 'company_branches.id', '=', 'loan_applications.branch')

        ->groupBy('branch')
        ->selectRaw('SUM(total_amt) as total_amt')
        ->where('pay_mode','=','Cash')
        ->get();
   //dd($balance);
   $paid_capiltal = CompanyProfile::select('paid_ip_capital')->get();
    //dd( $paid_capiltal);
      
        return view('backend.pages.dashboard.index', compact('total_admins', 'total_roles', 'total_permissions','members','groups','branchs','employee','loanAccount','balance','notice_board'));
    }

   
}
