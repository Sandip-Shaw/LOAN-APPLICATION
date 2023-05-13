 <!-- sidebar menu area start -->
 @php
     $usr = Auth::guard('admin')->user();
 @endphp
 <style>
     .user-info {
         display: flex;
         align-items: center;
         padding: 20px;
     }

     .user-info img {
         width: 50px;
         height: 50px;
         border-radius: 50%;
         margin-right: 10px;
     }

     .user-info h2 {
         font-size: 18px;
         margin-left: 12px;
         color: white;
     }
     .d-none{
        display: none;
     }
     
    .sidebar-menu::-webkit-scrollbar{
        width: 0;
    }
    .toggle-btn{
        display: none;
    }
    @media screen and (max-width: 1364px) {
        .toggle-btn{
            display: block;
      position: absolute;
      top: 50%;
      opacity: 50%;
      transform: translateY(-50%);
      transform: translateY(-50%);
      right: -23px;
      z-index: 99;
      background-color: #212529;
      color: white;
      border: none;
      font-size: 29px;
      padding: 5px 3px;
      border-top-right-radius: 0.8rem;
    border-bottom-right-radius: 0.8rem;
    }
    }
    .medscr{
        transform: translateX(-306px); 
    }
    .smscr{
        transform: translateX(-365px); 
    }
    .xmscr{
        transform: translateX(-290px); 
    }
    @media screen and (max-width: 479px){
        .sidebar-menu{
            width: 290px !important;
        }
    }
   
    @media (min-width: 240px) and (max-width: 479px){
        .sbar_collapsed .sidebar-menu {
           left: 0;
         }
    }
  
       @media  (min-width: 480px) and (max-width: 767px){
.sbar_collapsed .sidebar-menu {
    left: 0;
}
    }
    @media (min-width: 768px) and (max-width: 991px){
.sbar_collapsed .sidebar-menu {
    left: 0;
}
    }
    @media (min-width: 992px) and (max-width: 1199px){
.sbar_collapsed .sidebar-menu {
    left: 0;
}
    }
    @media (min-width: 1200px) and (max-width: 1364px){
.sbar_collapsed .sidebar-menu {
    left: 0;
}
}
 </style>
  <div class="sidebar-menu" id="target" style="overflow: inherit;">
    <button class="toggle-btn" id="toggle-btn-menu">></button>
     {{-- <div class="sidebar-header">
        <div class="logoimg"><img src="{{asset('/image/profile.jpg')}}" alt=""></div>
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="text-white">Admin</h2>
            </a>
        </div>
    </div> --}}
     <div class="user-info">
         <img src="{{ asset('/images/profile.jpg') }}" alt="Profile Picture">
         <a href="{{ route('admin.dashboard') }}">
             <h2 class="text-white">{{ Auth::guard('admin')->user()->name }}</h2>
         </a>
     </div>
     <div class="main-menu">
         <div class="menu-inner">
             <nav>
                 <ul class="metismenu" id="menu">

                     @if ($usr->can('dashboard.view'))
                         <li class="active">
                             <a href="{{ route('admin.dashboard') }}" aria-expanded="true"><i
                                     class="ti-dashboard"></i><span>Dashboard</span></a>
                             <!-- <ul class="collapse">
                            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ul> -->
                         </li>
                     @endif

                     @if ($usr->can('role.create') || $usr->can('role.view') || $usr->can('role.edit') || $usr->can('role.delete'))
                         <li>
                             <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                                     Roles & Permissions
                                 </span></a>
                             <ul
                                 class="collapse {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : '' }}">
                                 @if ($usr->can('role.view'))
                                     <li
                                         class="{{ Route::is('admin.roles.index') || Route::is('admin.roles.edit') ? 'active' : '' }}">
                                         <a href="{{ route('admin.roles.index') }}">All Roles</a>
                                     </li>
                                 @endif
                                 @if ($usr->can('role.create'))
                                     <li class="{{ Route::is('admin.roles.create') ? 'active' : '' }}"><a
                                             href="{{ route('admin.roles.create') }}">Create Role</a></li>
                                 @endif
                             </ul>
                         </li>
                     @endif


                     @if ($usr->can('admin.create') || $usr->can('admin.view') || $usr->can('admin.edit') || $usr->can('admin.delete'))
                         <li>
                             <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                                     User Management
                                 </span></a>
                             <ul
                                 class="collapse {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') || Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'in' : '' }}">

                                 @if ($usr->can('admin.view'))
                                     <li
                                         class="{{ Route::is('admin.admins.index') || Route::is('admin.admins.edit') ? 'active' : '' }}">
                                         <a href="{{ route('admin.admins.index') }}">All Users</a>
                                     </li>
                                 @endif

                                 @if ($usr->can('admin.create'))
                                     <li class="{{ Route::is('admin.admins.create') ? 'active' : '' }}"><a
                                             href="{{ route('admin.admins.create') }}">Create User Panel</a></li>
                                 @endif
                             </ul>
                         </li>
                     @endif



                     <!-- @if ($usr->can('support.view'))
<li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                            SUPPORT
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.support.index') || Route::is('admin.support.edit') || Route::is('admin.support.show') ? 'in' : '' }}">

                            @if ($usr->can('support.view'))
<li class="{{ Route::is('admin.support.index') || Route::is('admin.support.edit') ? 'active' : '' }}"><a href="{{ route('admin.support.index') }}">All Supports</a></li>
@endif


                        </ul>
                    </li>
@endif -->

                     <!-- -------------company profile ---------------------->
                     @if (
                         $usr->can('company_profile.create') ||
                             $usr->can('company_profile.view') ||
                             $usr->can('company_profile.edit') ||
                             $usr->can('company_branch.create') ||
                             $usr->can('company_branch.view') ||
                             $usr->can('company_branch.edit') ||
                             $usr->can('company_director.create') ||
                             $usr->can('company_director.view') ||
                             $usr->can('company_director.edit'))
                         <li>
                             <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-building-o"></i><span>
                                     COMPANY
                                 </span></a>
                             <ul
                                 class="collapse {{ Route::is('admin.company.create') ||
                                 Route::is('admin.company.index') ||
                                 Route::is('admin.company.edit') ||
                                 Route::is('admin.company.show') ||
                                 Route::is('admin.comp_branch.create') ||
                                 Route::is('admin.comp_branch.edit') ||
                                 Route::is('admin.comp_branch.show') ||
                                 Route::is('admin.comp_branch.index') ||
                                 Route::is('admin.comp_director.create') ||
                                 Route::is('admin.comp_director.index') ||
                                 Route::is('admin.comp_director.edit') ||
                                 Route::is('admin.comp_director.show')
                                     ? 'in'
                                     : '' }}">


                                 @if ($usr->can('company_profile.create'))
                                     <li class="{{ Route::is('admin.company.create') ? 'active' : '' }}"><a
                                             href="{{ route('admin.company.create') }}">Create Company </a></li>
                                 @endif

                                 @if ($usr->can('company_profile.view') || $usr->can('company_profile.create'))
                                     <li
                                         class="{{ Route::is('admin.company.create') || Route::is('admin.company.index') || Route::is('admin.company.edit') ? 'active' : '' }}">
                                         <a href="{{ route('admin.company.index') }}"> Company Profile</a>
                                     </li>
                                 @endif



                                 @if ($usr->can('company_branch.view') || $usr->can('company_branch.create'))
                                     <li
                                         class="{{ Route::is('admin.comp_branch.create') || Route::is('admin.comp_branch.index') || Route::is('admin.comp_branch.edit') || Route::is('admin.comp_branch.show') ? 'active' : '' }}">
                                         <a href="{{ route('admin.comp_branch.index') }}">Branch Profile</a>
                                     </li>
                                 @endif

                                 <!-- @if ($usr->can('company_branch.create'))
<li class="{{ Route::is('admin.comp_branch.create') ? 'active' : '' }}"><a href="{{ route('admin.comp_branch.create') }}">Branch Profile Create</a></li>
@endif -->

                                 @if ($usr->can('company_director.view') || $usr->can('company_director.create'))
                                     <li
                                         class="{{ Route::is('admin.comp_director.create') || Route::is('admin.comp_director.index') || Route::is('admin.comp_director.edit') || Route::is('admin.comp_director.show') ? 'active' : '' }}">
                                         <a href="{{ route('admin.comp_director.index') }}">Director Profile</a>
                                     </li>
                                 @endif

                                 <!-- @if ($usr->can('company_director.create'))
<li class="{{ Route::is('admin.comp_director.create') ? 'active' : '' }}"><a href="{{ route('admin.comp_director.create') }}">Director Profile Create</a></li>
@endif -->
                             </ul>
                         </li>
                     @endif
                     <!-- -------------end company profile ---------------------->

                     <!--------------- Collection Center  ------------>
                     <!-- @if (
                         $usr->can('members_management.create') ||
                             $usr->can('members_management.view') ||
                             $usr->can('members_management.edit') ||
                             $usr->can('members_management.delete'))
*/ -->
                     <li>
                         <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-indent"
                                 aria-hidden="true"></i><span>
                                 COLLECTION CENTER
                             </span></a>
                         <ul
                             class="collapse {{ Route::is('admin.collec_branch.create') || Route::is('admin.collec_branch.index') || Route::is('admin.collec_branch.edit') || Route::is('admin.collec_branch.show') ? 'in' : '' }}">

                             <!-- @if ($usr->can('members_management.view'))
-->
                             <li
                                 class="{{ Route::is('admin.collec_branch.index') || Route::is('admin.collec_branch.index') || Route::is('admin.collec_branch.edit') ? 'active' : '' }}">
                                 <a href="{{ route('admin.collec_branch.index') }}">Collection Centers</a>
                             </li>
                             <!--
@endif -->

                             <li class="{{ Route::is('admin.groups.create') ? 'active' : '' }}"><a
                                     href="{{ route('admin.groups.create') }}">Create Group</a></li>
                             <li class="{{ Route::is('admin.groups.index') ? 'active' : '' }}"><a
                                     href="{{ route('admin.groups.index') }}">Group View</a></li>

                         </ul>
                     </li>

                     <!--
@endif -->
                     <!---------------end Collection Center   ------------>

                     <!--------------- Members management    ------------>
                     @if (
                         $usr->can('members_management.create') ||
                             $usr->can('members_management.view') ||
                             $usr->can('members_management.edit') ||
                             $usr->can('members_management.delete') ||
                             $usr->can('members_payment.create') ||
                             $usr->can('members_payment.view'))
                         <li>
                             <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-users"></i><span>
                                     MEMBERS MANAGEMENT
                                 </span></a>
                             <ul
                                 class="collapse {{ Route::is('admin.members_management.create') || Route::is('admin.members_management.index') || Route::is('admin.members_management.edit') || Route::is('admin.members_management.show') ? 'in' : '' }}">
                                 @if ($usr->can('members_management.create'))
                                     <li class="{{ Route::is('admin.members_management.create') ? 'active' : '' }}"><a
                                             href="{{ route('admin.members_management.create') }}">Create Member</a>
                                     </li>
                                 @endif

                                 @if (
                                     $usr->can('members_management.view') ||
                                         $usr->can('members_management.edit') ||
                                         $usr->can('members_management.show') ||
                                         $usr->can('members_management.create'))
                                     <li
                                         class="{{ Route::is('admin.members_management.index') || Route::is('admin.members_management.edit') ? 'active' : '' }}">
                                         <a href="{{ route('admin.members_management.index') }}">Members Details</a>
                                     </li>
                                 @endif
                                 @if ($usr->can('members_payment.create'))
                                     <li class="{{ Route::is('admin.members_payment.create') ? 'active' : '' }}"><a
                                             href="{{ route('admin.members_payment.create') }}">Member
                                             Payment/Share</a></li>
                                 @endif
                                 @if ($usr->can('members_payment.view'))
                                     <li class="{{ Route::is('admin.members_payment.index') ? 'active' : '' }}"><a
                                             href="{{ route('admin.members_payment.index') }}">View Payment/Share
                                             Details</a></li>
                                 @endif

                             </ul>
                         </li>

                     @endif
                     <!---------------end Members management    ------------>

                     <!-- investment -->
                     <li>
                         <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-usd"></i><span>
                                 INVESTMENT
                             </span></a>
                         <ul
                             class="collapse {{ Route::is('admin.series-setting.create') || Route::is('admin.series-setting.index') ? 'in' : '' }}">

                             <li class=""><a href="{{ route('admin.investment_scheme.index') }}">Scheme</a></li>
                             <li class=""><a href="{{ route('admin.create_investment.index') }}">Create
                                     Investment</a></li>
                             <li class=""><a href="{{ route('admin.investment_accnt.index') }}">Account</a></li>
                             <li>
                                 <a href="{{ route('admin.payment_release.index') }}" aria-expanded="true">
                                     PAYMENTS TO RELEASE
                                 </a>

                             </li>
                         </ul>
                     </li>


                     <!-- end investment -->

                     <!--------------- loan management    ------------>
                     @if (
                         $usr->can('loan_application.create') ||
                             $usr->can('loan_application.view') ||
                             $usr->can('loan_schemes.create') ||
                             $usr->can('loan_schemes.view') ||
                             $usr->can('loan_schemes.edit') ||
                             $usr->can('loan_schemes.show') ||
                             ($usr->can('loan_disbursement.view') || $usr->can('loan_disbursement.show')) ||
                             ($usr->can('loan_account.view') || $usr->can('loan_account.show')))
                         <li>
                             <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-university"></i><span>
                                     LOAN
                                 </span></a>
                             <ul
                                 class="collapse {{ Route::is('admin.loan_schema.create') ||
                                 Route::is('admin.loan_schema.index') ||
                                 Route::is('admin.loan_schema.edit') ||
                                 Route::is('admin.loan_schema.show') ||
                                 Route::is('admin.loan_application.create') ||
                                 Route::is('admin.loan_application.index') ||
                                 Route::is('admin.loan_application.edit') ||
                                 Route::is('admin.loan_application.show') ||
                                 Route::is('admin.loan_disbursements.index') ||
                                 Route::is('admin.loan_appli_accnt.index')
                                     ? 'in'
                                     : '' }}">

                                 @if ($usr->can('loan_schemes.view') || $usr->can('loan_schemes.create'))
                                     <li
                                         class="{{ Route::is('admin.loan_schema.index') || Route::is('admin.loan_schema.edit') || Route::is('admin.loan_schema.create') ? 'active' : '' }}">
                                         <a href="{{ route('admin.loan_schema.index') }}">Schemes</a>
                                     </li>
                                 @endif

                                 @if ($usr->can('loan_application.view') || $usr->can('loan_application.create'))
                                     <li
                                         class="{{ Route::is('admin.loan_application.index') || Route::is('admin.loan_application.create') || Route::is('admin.loan_application.edit') || Route::is('admin.loan_application.show') ? 'active' : '' }}">
                                         <a href="{{ route('admin.loan_application.index') }}">Loan Application</a>
                                     </li>
                                 @endif

                                 @if ($usr->can('loan_disbursement.view') || $usr->can('loan_disbursement.show'))
                                     <li
                                         class="{{ Route::is('admin.loan_disbursements.index') || Route::is('admin.loan_disbursements.edit') || Route::is('admin.loan_disbursements.create') ? 'active' : '' }}">
                                         <a href="{{ route('admin.loan_disbursements.index') }}">Disbursements</a>
                                     </li>
                                 @endif

                                 @if ($usr->can('loan_account.view') || $usr->can('loan_account.show'))
                                     <li
                                         class="{{ Route::is('admin.loan_appli_accnt.index') || Route::is('admin.loan_appli_accnt.edit') || Route::is('admin.loan_appli_accnt.create') ? 'active' : '' }}">
                                         <a href="{{ route('admin.loan_appli_accnt.index') }}">Accounts</a>
                                     </li>
                                 @endif


                             </ul>
                         </li>

                     @endif
                     <!---------------end loan management    ------------>

                     <!--------------- Payment Collection  ------------>
                     @if ($usr->can('paynent_collect.view'))
                         <li>
                             <a href="{{ route('admin.payment_collection.index') }}" aria-expanded="true"><i
                                     class="fa fa-user"></i><span>
                                     PAYMENTS TO COLLECT
                                 </span></a>

                         </li>
                     @endif
                     <!---------------end Payment Collection   ------------>


                     <!---------------approval   ------------>

                     <li>
                         <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-users"></i><span>
                                 APPROVALS 
                             </span></a>
                         <ul
                             class="collapse {{ Route::is('admin.approval_loan_application.create') || Route::is('admin.approval_loan_application.index') || Route::is('admin.approval_loan_application.edit') || Route::is('admin.approval_loan_application.show') ? 'in' : '' }}">
                             @if ($usr->can('members_management.approve'))
                                 <li class=""><a href="{{ route('admin.member_approval') }}">Members
                                         Approval</a></li>
                             @endif
                             @if ($usr->can('loan_application.approve'))
                                 <li class=""><a href="{{ route('admin.loan_approval') }}">Loan
                                         Applications</a></li>
                             @endif
                             @if ($usr->can('loan_disbursement.approve'))
                                 <li class=""><a href="{{ route('admin.disbursement_approval') }}">Loan
                                         Disbursement Approval</a></li>
                             @endif

                             <li class=""><a href="{{ route('admin.leave_adjustment_approval') }}">Emp Leave
                                     Adjustment Approval</a></li>

                             <li class=""><a href="{{ route('admin.investment_approval') }}">Member Investment
                                     Approval</a></li>

                             <!-- <li class=""><a href="{{ route('admin.salaryDisburse_approval') }}">Salary Disbursement Approval</a></li> -->

                         </ul>
                     </li>

                     <!---------------end approval    ------------>

                     <!------------ account section ------------->
                     <li>
                         <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-university"></i><span>
                                 ACCOUNTS 
                             </span></a>
                         <ul
                             class="collapse {{ Route::is('admin.ledger_group.create') || Route::is('admin.ledger_group.index') || Route::is('admin.ledger_group.edit') || Route::is('admin.ledger_group.show') ? 'in' : '' }}">


                             <li
                                 class="{{ Route::is('admin.ledger_group.index') || Route::is('admin.ledger_group.create') || Route::is('admin.ledger_group.edit') || Route::is('admin.ledger_group.show') ? 'active' : '' }}">
                                 <a href="{{ route('admin.ledger_group.index') }}">Ledger Groups </a>
                             </li>
                             <li
                                 class="{{ Route::is('admin.ledger_account.index') || Route::is('admin.ledger_account.create') || Route::is('admin.ledger_account.edit') || Route::is('admin.ledger_account.show') ? 'active' : '' }}">
                                 <a href="{{ route('admin.ledger_account.index') }}">Ledger Account </a>
                             </li>
                             <li
                                 class="{{ Route::is('admin.account_entries.index') || Route::is('admin.account_entries.create') || Route::is('admin.account_entries.edit') || Route::is('admin.account_entries.show') ? 'active' : '' }}">
                                 <a href="{{ route('admin.account_entries.index') }}">Entries </a>
                             </li>
                             <li
                                 class="{{ Route::is('admin.ledger_account.trial_balance') || Route::is('admin.account_entries.create') || Route::is('admin.account_entries.edit') || Route::is('admin.account_entries.show') ? 'active' : '' }}">
                                 <a href="{{ route('admin.ledger_account.trial_balance') }}">Trial Balance</a>
                             </li>
                             <li
                                 class="{{ Route::is('admin.ledger_account.profit_and_loss') || Route::is('admin.account_entries.create') || Route::is('admin.account_entries.edit') || Route::is('admin.account_entries.show') ? 'active' : '' }}">
                                 <a href="{{ route('admin.ledger_account.profit_and_loss') }}">Profit And Loss(P &
                                     L)</a>
                             </li>
                             <li
                                 class="{{ Route::is('admin.ledger_account.income_statement') || Route::is('admin.account_entries.create') || Route::is('admin.account_entries.edit') || Route::is('admin.account_entries.show') ? 'active' : '' }}">
                                 <a href="{{ route('admin.ledger_account.income_statement') }}">Income Statement</a>
                             </li>
                             <li
                                 class="{{ Route::is('admin.ledger_account.tree') || Route::is('admin.ledger_account.create') || Route::is('admin.ledger_account.edit') || Route::is('admin.ledger_account.show') ? 'active' : '' }}">
                                 <a href="{{ route('admin.ledger_account.tree') }}">Tree </a>
                             </li>

                         </ul>
                     </li>
                     <!------------ end account section ----------->

                     <!------------ report section ------------->
                     @if (
                         $usr->can('report.loanDue.view') ||
                             $usr->can('report.loanOverdue.view') ||
                             $usr->can('report.loanNpa.view') ||
                             $usr->can('report.loanApproval.view') ||
                             $usr->can('report.loanNotapproval.view'))

                         <li>
                             <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user-plus"></i><span>
                                     REPORTS
                                 </span></a>
                             <ul
                                 class="collapse {{ Route::is('admin.loan_due_report.index') ||
                                 Route::is('admin.loan_overDue_report.index') ||
                                 Route::is('admin.loan_npa_report.index') ||
                                 Route::is('admin.report_loan.index') ||
                                 Route::is('admin.approval_report.index')
                                     ? 'in'
                                     : '' }}">
                                 @if ($usr->can('report.loanDue.view'))
                                     <li class="{{ Route::is('admin.loan_due_report.index') ? 'active' : '' }}"><a
                                             href="{{ route('admin.loan_due_report.index') }}"> Loan Due Report</a>
                                     </li>
                                 @endif
                                 @if ($usr->can('report.loanOverdue.view'))
                                     <li class="{{ Route::is('admin.loan_overDue_report.index') ? 'active' : '' }}"><a
                                             href="{{ route('admin.loan_overDue_report.index') }}"> Loan OverDue
                                             Report</a></li>
                                 @endif
                                 @if ($usr->can('report.loanNpa.view'))
                                     <li class="{{ Route::is('admin.loan_npa_report.index') ? 'active' : '' }}"><a
                                             href="{{ route('admin.loan_npa_report.index') }}"> Loan NPA Report</a>
                                     </li>
                                 @endif
                                 @if ($usr->can('report.loanNotapproval.view'))
                                     <li class="{{ Route::is('admin.report_loan.index') ? 'active' : '' }}"><a
                                             href="{{ route('admin.report_loan.index') }}">Not Approval Report</a>
                                     </li>
                                 @endif
                                 @if ($usr->can('report.loanApproval.view'))
                                     <li class="{{ Route::is('admin.approval_report.index') ? 'active' : '' }}"><a
                                             href="{{ route('admin.approval_report.index') }}"> Approval Report</a>
                                     </li>
                                 @endif

                                 <!-- <li class="{{ Route::is('admin.report_account.index') ? 'active' : '' }}"><a href="{{ route('admin.report_account.index') }}">Loan Account Report</a></li>
                        <li class="{{ Route::is('admin.ledger_account_report.index') ? 'active' : '' }}"><a href="{{ route('admin.ledger_account_report.index') }}">Ledger Account Report</a></li>
                        <li class="{{ Route::is('admin.ledger_voucher.index') ? 'active' : '' }}"><a href="{{ route('admin.ledger_voucher.index') }}">Ledger Voucher Report</a></li>
                        <li class="{{ Route::is('admin.report_account.index') ? 'active' : '' }}"><a href="">P & L Account Report</a></li>
                           -->

                        </ul>
                    </li>
                    @endif
 <!------------ end report section ----------->

 <!---------------- cibil report ------------->
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                            CIBIL REPORT
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.cibil_report.create') || Route::is('admin.cibil_report.index') ? 'in' : '' }}">

                                <li class=""><a href="{{ route('admin.cibil_report.index') }}">Download Cibil Report</a></li>

                        </ul>
                    </li>


 <!--------------- end cibil report ----------->

                    @if ($usr->can('hr_management.create') || $usr->can('hr_management.view') ||  $usr->can('hr_management.edit') ||  $usr->can('hr_management.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                            PAYROLL MANAGEMENT
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.hr_management.create') || Route::is('admin.hr_management.index') || Route::is('admin.hr_management.edit') || Route::is('admin.hr_management.show') ? 'in' : '' }}">

                            <li class="{{ Route::is('admin.salary_disbursement.index') || Route::is('admin.salary_disbursement.create') || Route::is('admin.salary_disbursement.edit') ? 'active' : '' }}"><a href="{{ route('admin.add_designation.index') }}">Add Designation</a></li>

                            @if ($usr->can('hr_management.view') || $usr->can('hr_management.create'))
                                <li class="{{ Route::is('admin.hr_management.index') || Route::is('admin.hr_management.create') || Route::is('admin.hr_management.edit') ? 'active' : '' }}"><a href="{{ route('admin.hr_management.index') }}"> Add Employees</a></li>
                            @endif
                            <li class="{{ Route::is('admin.salary_disbursement.index') || Route::is('admin.salary_disbursement.create') || Route::is('admin.salary_disbursement.edit') ? 'active' : '' }}"><a href="{{ route('admin.employee_leave.index') }}">Employee Leave Master</a></li>

                            <li class="{{ Route::is('admin.salary_disbursement.index') || Route::is('admin.salary_disbursement.create') || Route::is('admin.salary_disbursement.edit') ? 'active' : '' }}"><a href="{{ route('admin.salary_details.index') }}">Salary Details</a></li>
                            <li class="{{ Route::is('admin.salary_disbursement.index') || Route::is('admin.salary_disbursement.create') || Route::is('admin.salary_disbursement.edit') ? 'active' : '' }}"><a href="{{ route('admin.bond_letter.index') }}">Bond Letter</a></li>
                            <li class="{{ Route::is('admin.salary_disbursement.index') || Route::is('admin.salary_disbursement.create') || Route::is('admin.salary_disbursement.edit') ? 'active' : '' }}"><a href="{{ route('admin.offer_letter.index') }}">Offer Letter</a></li>
                            <li class="{{ Route::is('admin.salary_disbursement.index') || Route::is('admin.salary_disbursement.create') || Route::is('admin.salary_disbursement.edit') ? 'active' : '' }}"><a href="{{ route('admin.holiday_master.index') }}">Holiday Master</a></li>
                            <li class="{{ Route::is('admin.salary_disbursement.index') || Route::is('admin.salary_disbursement.create') || Route::is('admin.salary_disbursement.edit') ? 'active' : '' }}"><a href="{{ route('admin.leave_adjustment.create') }}">Leave Adjustment</a></li>
                            <li class="{{ Route::is('admin.salary_disbursement.index') || Route::is('admin.salary_disbursement.create') || Route::is('admin.salary_disbursement.edit') ? 'active' : '' }}"><a href="{{ route('admin.attendence.index') }}">Attendence</a></li>
                            <li class="{{ Route::is('admin.salary_disbursement.index') || Route::is('admin.salary_disbursement.create') || Route::is('admin.salary_disbursement.edit') ? 'active' : '' }}"><a href="{{ route('admin.salary_payment.index') }}">Salary Release</a></li>
                            <li class="{{ Route::is('admin.salary_disbursement.index') || Route::is('admin.salary_disbursement.create') || Route::is('admin.salary_disbursement.edit') ? 'active' : '' }}"><a href="{{ route('admin.salary_report.index') }}">Salary Report</a></li>


                            <!-- <li class="{{ Route::is('admin.salary_disbursement.index') || Route::is('admin.salary_disbursement.create') || Route::is('admin.salary_disbursement.edit') ? 'active' : '' }}"><a href="{{ route('admin.salary_disbursement.index') }}">Salary Disbursement</a></li> -->

                            <!-- @if ($usr->can('hr_management.create'))
                                <li class="{{ Route::is('admin.hr_management.create')  ? 'active' : '' }}"><a href="{{ route('admin.hr_management.create') }}">Create Employees</a></li>
                            @endif -->
                        </ul>
                    </li>

                    @endif

                    <!-- code series setting -->
                    @if ($usr->can('code_setting.view') || $usr->can('code_setting.create'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                        Code Series Setting
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.series-setting.create') || Route::is('admin.series-setting.index') ? 'in' : '' }}">
                        @if ($usr->can('code_setting.create'))

                            <li class="{{ Route::is('admin.series-setting.create') ? 'active' : '' }}"><a href="{{ route('admin.series-setting.create') }}">Create  </a></li>
                        @endif
                        @if ($usr->can('code_setting.view'))

                            <li class="{{ Route::is('admin.series-setting.index')? 'active' : '' }}"><a href="{{ route('admin.series-setting.index') }}">List </a></li>
                        @endif

                        </ul>
                    </li>
                    @endif


                    <!-- end code series setting -->


                     <!------------ setting section ----------->


                     <li>
                         <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                                 Settings
                             </span></a>
                         <ul
                             class="collapse {{ Route::is('admin.series-setting.create') || Route::is('admin.series-setting.index') ? 'in' : '' }}">
                             <li class=""><a href="{{route('admin.ip-address.index') }}">IP Address</a></li>

                             <li class=""><a href="{{ route('admin.calendar-event') }}">Event & Holiday
                                     Calender</a></li>

                            <li class=""><a href="{{ route('admin.add_notice.create') }}">Write Notice</a></li>
                            

                         </ul>
                     </li>


                 </ul>
             </nav>
         </div>
     </div>
 </div>
 <script>
    function removeFunc(){
        var sdM = document.getElementById("target");
    sdM.classList.remove("medscr");
    sdM.classList.remove("smscr");
    sdM.classList.remove("xmscr");
    }
   

  function handleClicks() {
    var viewportWidth = window.innerWidth;
    var sdM = document.getElementById("target");
    if (viewportWidth > 991 && viewportWidth < 1200) {
      sdM.classList.toggle("medscr");
    }else if (viewportWidth > 1199 && viewportWidth < 1365) {
      sdM.classList.toggle("smscr");
    } else if (viewportWidth > 767 && viewportWidth < 992) {
      sdM.classList.toggle("medscr");
    } else if (viewportWidth > 479 && viewportWidth < 768) {
      sdM.classList.toggle("smscr");
    } else if (viewportWidth < 480) {
      sdM.classList.toggle("xmscr");
    } 
  }
  var toggleBtn = document.getElementById("toggle-btn-menu");
  toggleBtn.addEventListener("click", handleClicks);
</script>
 <!-- <button id="toggle-button" style="    position: fixed;
    z-index: 1;
    transform: translateY(-50%);
    top: 50%;
    padding: 0.3rem 0.7rem;
    border-radius: 100%;
    background-color: #8914fe;
    color: white;">
    >
 </button>
 <script>
    const toggleButton = document.getElementById('toggle-button');
    const targetElement = document.getElementById('target');

    toggleButton.addEventListener('click', () => {
    targetElement.classList.toggle('d-none');
});

 </script> -->
 <!-- sidebar menu area end -->
