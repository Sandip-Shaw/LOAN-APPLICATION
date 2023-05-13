<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@redirectAdmin')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
    Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users']);
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);
    Route::resource('blogs', 'Backend\BlogController', ['names' => 'admin.blogs']);
    Route::resource('supports', 'Backend\SupportController', ['names' => 'admin.support']);
    Route::resource('company', 'Backend\CompanyProfileController', ['names' => 'admin.company']);
    Route::resource('comp_branch', 'Backend\CompanyBranchController', ['names' => 'admin.comp_branch']);
    Route::resource('comp_director', 'Backend\CompanyDirectorController', ['names' => 'admin.comp_director']);
    Route::resource('hr_management', 'Backend\Hr_Management\HrManagementController', ['names' => 'admin.hr_management']);
    Route::resource('loan_application', 'Backend\Loan\LoanApplicationController', ['names' => 'admin.loan_application']);
    Route::resource('members_management', 'Backend\MembersManagement\MembersManagementController', ['names' => 'admin.members_management']);
    Route::resource('loan_schema', 'Backend\Loan\LoanSchemaController', ['names' => 'admin.loan_schema']);
    Route::resource('loan_disbursements', 'Backend\Loan\LoanDisbursementController', ['names' => 'admin.loan_disbursements']);
    Route::get('scheme_details/{id}', 'Backend\Loan\LoanSchemaController@loan_details', ['names' => 'admin.scheme_details']);
    Route::get('application_details/{id}', 'Backend\Loan\LoanApplicationController@loan_appli_details', ['names' => 'admin.application_details']);
    Route::get('kyc_status/{id}', array('uses' => 'Backend\MembersManagement\MembersManagementController@updateKYCStatus', 'as' => 'admin.kyc_statusUpdate'));
    Route::get('member_details/{id}', 'Backend\MembersManagement\MembersManagementController@member_details', ['names' => 'admin.member_details']);
    Route::get('loan_application/{id}/doc-upload', array('uses' => 'Backend\Loan\LoanApplicationController@uploadDoc', 'as' => 'admin.upload_application_doc'));
    Route::patch('doc_uploaded', array('uses' => 'Backend\Loan\LoanApplicationController@loan_doc_upload', 'as' => 'admin.uploaded_doc'));
    // Route::get('search', array('uses'=>'Backend\MembersManagement\MembersManagementController@search', 'as' => 'admin.search'));
    //  Route::post('filter-loan-application', array('uses'=>'Backend\Loan\LoanApplicationController@filterSearch', 'as' => 'admin.searchloan'));
    // Route::post('cancel-loan/{id}', 'Backend\Loan\LoanDisbursementController@cancelLoan', ['names' => 'admin.cancelLoan']);
    Route::post('cancel-loan/{id}', array('uses' => 'Backend\Loan\LoanDisbursementController@cancelLoan', 'as' => 'admin.cancelLoan'));

    Route::resource('salary_disbursement', 'Backend\Hr_Management\SalaryDisbursementController', ['names' => 'admin.salary_disbursement']);
    Route::get('employeeDetails/{id}', 'Backend\Hr_Management\HrManagementController@employee_details', ['names' => 'admin.employeeDetails']);

    # Route::resource('approval_loan_application', 'Backend\Loan\LoanApplicationApproval', ['names' => 'admin.approval_loan_application']);
    Route::get('loan_approval', array('uses' => 'Backend\Loan\LoanApplicationController@approval', 'as' => 'admin.loan_approval'));
    Route::get('loan_approvalUpdate/{id}', array('uses' => 'Backend\Loan\LoanApplicationController@updateStatus', 'as' => 'admin.loan_approvalUpdate'));
    Route::resource('loan_appli_accnt', 'Backend\Loan\LoanAccountController', ['names' => 'admin.loan_appli_accnt']);
    Route::get('salaryDisburse_approval', array('uses' => 'Backend\Hr_Management\SalaryDisbursementController@approval', 'as' => 'admin.salaryDisburse_approval'));
    Route::get('salaryDisburse_approvalUpdate/{id}', array('uses' => 'Backend\Hr_Management\SalaryDisbursementController@updateStatus', 'as' => 'admin.salaryDisburse_approvalUpdate'));
    Route::get('loan_appli_accnt/{id}/emi_pay', array('uses' => 'Backend\Loan\LoanAccountController@emiPay', 'as' => 'admin.loan_emi_pay'));

    #Route::resource('loan_disbursement_approval', 'Backend\Loan\LoanDisbursementController', ['names' => 'admin.loan_disbursement_approval']);

    Route::get('loan_appli_accnt/{id}/emi-pay-print', array('uses' => 'Backend\Loan\LoanAccountController@emiPrint', 'as' => 'admin.loan_emi_print'));

    Route::resource('loan_disbursement_approval', 'Backend\Loan\LoanDisbursementController', ['names' => 'admin.loan_disbursement_approval']);

    Route::resource('ledger_group', 'Backend\Accounts\LedgerGroupController', ['names' => 'admin.ledger_group']);
    Route::resource('ledger_account', 'Backend\Accounts\LedgerAccountController', ['names' => 'admin.ledger_account']);
    Route::get('member_approval', array('uses' => 'Backend\MembersManagement\MembersManagementController@approval', 'as' => 'admin.member_approval'));
    Route::get('member_approvalUpdate/{id}', array('uses' => 'Backend\MembersManagement\MembersManagementController@updateStatus', 'as' => 'admin.member_approvalUpdate'));
    Route::resource('account_entries', 'Backend\Accounts\AccountEntriesController', ['names' => 'admin.account_entries']);

    //report section
    Route::resource('report_account', 'Backend\Loan_Report\LoanEMIReportController', ['names' => 'admin.report_account']);
    Route::get('searchFromDatetoDate', array('uses' => 'Backend\Loan_Report\LoanEMIReportController@searchByDate', 'as' => 'admin.searchFromDatetoDate'));
    Route::get('emi_report_export/{from_date}/{to_date}/{branch}/{accnt_status}', array('uses' => 'Backend\Loan_Report\LoanEMIReportController@export', 'as' => 'admin.emi_report_export'));
    Route::resource('loan_due_report', 'Backend\Loan_Report\LoanDueReportController', ['names' => 'admin.loan_due_report']);

    Route::get('due_report_search', array('uses' => 'Backend\Loan_Report\LoanDueReportController@searchByDate', 'as' => 'admin.due_report_search'));
    Route::get('emi_due_report_export/{from_date}/{to_date}/{branch}', array('uses' => 'Backend\Loan_Report\LoanDueReportController@export', 'as' => 'admin.emi_due_report_export'));
    Route::get('emi_due_report_exportPdf/{from_date}/{to_date}/{branch}', array('uses' => 'Backend\Loan_Report\LoanDueReportController@pdf_export', 'as' => 'admin.emi_due_report_exportPdf'));

    Route::resource('loan_overDue_report', 'Backend\Loan_Report\LoanOverDueReportController', ['names' => 'admin.loan_overDue_report']);
    Route::get('overdue_report_search', array('uses' => 'Backend\Loan_Report\LoanOverDueReportController@searchByDate', 'as' => 'admin.overdue_report_search'));
    Route::get('emi_overdue_report_export/{from_date}/{to_date}/{branch}', array('uses' => 'Backend\Loan_Report\LoanOverDueReportController@export', 'as' => 'admin.emi_overdue_report_export'));
    Route::get('emi_overdue_report_exportPdf/{from_date}/{to_date}/{branch}', array('uses' => 'Backend\Loan_Report\LoanOverDueReportController@pdf_export', 'as' => 'admin.emi_overdue_report_exportPdf'));

    Route::resource('loan_npa_report', 'Backend\Loan_Report\NPAReportController', ['names' => 'admin.loan_npa_report']);
    Route::get('npa_report_search', array('uses' => 'Backend\Loan_Report\NPAReportController@searchByDate', 'as' => 'admin.npa_report_search'));
    Route::get('npa_report_export/{from_date}/{to_date}/{branch}', array('uses' => 'Backend\Loan_Report\NPAReportController@export', 'as' => 'admin.npa_report_export'));
    Route::get('npa_report_exportPdf/{from_date}/{to_date}/{branch}', array('uses' => 'Backend\Loan_Report\NPAReportController@pdf_export', 'as' => 'admin.npa_report_exportPdf'));

    Route::resource('report_loan', 'Backend\Loan_Report\LoanReportController', ['names' => 'admin.report_loan']);
    Route::get('application_report_search', array('uses' => 'Backend\Loan_Report\LoanReportController@searchByDate', 'as' => 'admin.application_report_search'));
    Route::get('not_approval_report_export/{from_date}/{to_date}/{branch}', array('uses' => 'Backend\Loan_Report\LoanReportController@export', 'as' => 'admin.not_approval_report_export'));
    Route::get('not_approval_report_exportPdf/{from_date}/{to_date}/{branch}', array('uses' => 'Backend\Loan_Report\LoanReportController@pdf_export', 'as' => 'admin.not_approval_report_exportPdf'));

    Route::resource('approval_report', 'Backend\Loan_Report\LoanApprovalReportController', ['names' => 'admin.approval_report']);
    Route::get('approval_report_search', array('uses' => 'Backend\Loan_Report\LoanApprovalReportController@searchByDate', 'as' => 'admin.approval_report_search'));
    Route::get('approval_report_export/{from_date}/{to_date}/{branch}', array('uses' => 'Backend\Loan_Report\LoanApprovalReportController@export', 'as' => 'admin.approval_report_export'));
    Route::get('approval_report_exportPdf/{from_date}/{to_date}/{branch}', array('uses' => 'Backend\Loan_Report\LoanApprovalReportController@pdf_export', 'as' => 'admin.approval_report_exportPdf'));

    Route::resource('ledger_account_report', 'Backend\Ledger_Report\LedgerAccountReportController', ['names' => 'admin.ledger_account_report']);
    Route::resource('ledger_voucher', 'Backend\Ledger_Report\LedgerVoucherController', ['names' => 'admin.ledger_voucher']);

    Route::resource('cibil-report', 'Backend\Cibil_Report\CibilReportController', ['names' => 'admin.cibil_report']);

    //end of report section 

    //loan pdf
    //Route::get('loan_agreement/{id}', 'Backend\Loan\LoanAccountController@loan_agreement_pdf', ['names' => 'admin.loan_agreement']);
    Route::get('loan_appli_accnt/{id}/loan_agreement', array('uses' => 'Backend\Loan\LoanAccountController@loan_agreement_pdf', 'as' => 'admin.loan_agreement'));
    Route::get('loan_appli_accnt/{id}/guaranty_letter', array('uses' => 'Backend\Loan\LoanAccountController@guaranty_letter_pdf', 'as' => 'admin.guaranty_letter'));
    Route::get('loan_application/{id}/promissory_letter', array('uses' => 'Backend\Loan\LoanApplicationController@promissory_letter_pdf', 'as' => 'admin.promissory_letter'));
    Route::get('loan_application/{id}/undertaking_letter', array('uses' => 'Backend\Loan\LoanApplicationController@undertaking_letter_pdf', 'as' => 'admin.undertaking_letter'));
    Route::get('loan_application/{id}/sanction_letter', array('uses' => 'Backend\Loan\LoanApplicationController@sanction_letter_pdf', 'as' => 'admin.sanction_letter'));
    Route::get('loan_appli_accnt/{id}/receipt_letter', array('uses' => 'Backend\Loan\LoanAccountController@receipt_letter_pdf', 'as' => 'admin.receipt_letter'));
    Route::get('loan_application/{id}/application_letter', array('uses' => 'Backend\Loan\LoanApplicationController@application_letter_pdf', 'as' => 'admin.application_letter'));


    Route::get('loan_appli_accnt/{id}/repayment-schedule', array('uses' => 'Backend\Loan\LoanAccountController@repayment_pdf', 'as' => 'admin.repayment_schedule'));
    Route::get('loan_appli_accnt/{id}/loan-status', array('uses' => 'Backend\Loan\LoanAccountController@loanStatus_pdf', 'as' => 'admin.loan_status'));
    Route::get('loan_appli_accnt/{id}/loan-closing-request', array('uses' => 'Backend\Loan\LoanAccountController@loanClosingLetter_pdf', 'as' => 'admin.loan_closing_req_letter'));
    Route::get('loan_appli_accnt/{id}/overdue-notice', array('uses' => 'Backend\Loan\LoanAccountController@overdue_notice_pdf', 'as' => 'admin.overdueNotice'));
    
    //for closed loan
    Route::post('loan_appli_accnt/{id}/closed-loan', array('uses' => 'Backend\Loan\LoanAccountController@closedLoan', 'as' => 'admin.closed_loan'));

    // series setting
    Route::resource('series-setting', 'Backend\SeriesSettingController', ['names' => 'admin.series-setting']);

// end series setting

    Route::resource('collec_branch', 'Backend\Collection_Center\CollectionCenterController', ['names' => 'admin.collec_branch']);
    Route::resource('groups', 'Backend\Groups\GroupsController', ['names' => 'admin.groups']);
    Route::resource('members_payment', 'Backend\MembersManagement\MembersPaymentController', ['names' => 'admin.members_payment']);
    Route::get('members_payment/{id}/{member_id}', 'Backend\MembersManagement\MembersPaymentController@show', ['names' => 'admin.members_payment']);
    Route::resource('payment_collection', 'Backend\Payment_Collection\PaymentCollectionController', ['names' => 'admin.payment_collection']);

    Route::get('del_doc/{id}', array('uses' => 'Backend\Loan\LoanApplicationController@del_doc', 'as' => 'admin.del_doc'));
    Route::get('emipayment_report/{to_date}', array('uses' => 'Backend\Payment_Collection\PaymentCollectionController@export', 'as' => 'admin.emipayment_report'));

    // Route::post('member-update', [App\Http\Controllers\Backend\Groups\GroupsController::class, 'memberupdate']);
    Route::post('member-update/{id}', 'Backend\Groups\GroupsController@memberupdate', ['names' => 'admin.memberupdate']);
    Route::get('member_details/{id}', 'Backend\Groups\GroupsController@member_details', ['names' => 'admin.member_details']);
    Route::get('payment_details/{id}', 'Backend\MembersManagement\MembersPaymentController@payment_details', ['names' => 'admin.payment_details']);
    Route::get('downloadCertificate/{id}/{member_id}', 'Backend\MembersManagement\MembersPaymentController@downloadCertificate', ['names' => 'admin.downloadCertificate']);
    // Route::get('/download-pdf', [MembersPaymentController::class, 'downloadCertificate']);
    //Route::get('disbursement_approval', 'Backend\Loan\LoanApplicationController@disbursement_approval', ['names' => 'admin.disbursement_approval']);
    Route::get('disbursement_approval', array('uses' => 'Backend\Loan\LoanApplicationController@disbursement_approval', 'as' => 'admin.disbursement_approval'));
    Route::patch('loan_appli_accnt/{id}/paynow', array('uses' => 'Backend\Loan\LoanAccountController@paynow', 'as' => 'admin.loan_paynow'));
    Route::get('searchByDate', array('uses' => 'Backend\Payment_Collection\PaymentCollectionController@searchByDate', 'as' => 'admin.searchByDate'));
    Route::get('account/tree', array('uses' => 'Backend\Accounts\LedgerAccountController@tree', 'as' => 'admin.ledger_account.tree'));
    Route::get('group_details/{id}', 'Backend\Accounts\LedgerAccountController@group_details', ['names' => 'admin.group_details']);
    Route::get('acc_details/{id}', array('uses' => 'Backend\Accounts\AccountEntriesController@acc_details', 'as' => 'admin.acc_details'));
    Route::get('account/trial__balance', array('uses' => 'Backend\Accounts\LedgerAccountController@trial_balance', 'as' => 'admin.ledger_account.trial_balance'));
    Route::get('account/profit_and_loss', array('uses' => 'Backend\Accounts\LedgerAccountController@profit_loss', 'as' => 'admin.ledger_account.profit_and_loss'));
    Route::get('search_profit_loss', array('uses' => 'Backend\Accounts\LedgerAccountController@search_profit_loss', 'as' => 'admin.search_profit_loss'));
    Route::get('account/income_statement', array('uses' => 'Backend\Accounts\LedgerAccountController@income_statement', 'as' => 'admin.ledger_account.income_statement'));

    //calender events
    Route::get('calendar-event', array('uses' => 'Backend\CalenderController@index', 'as' => 'admin.calendar-event'));
    // Route::post('calendar-crud-ajax',array('uses'=>'Backend\CalenderController@calendarEvents','as'=> 'calendar-crud-ajax'));
    // Route::get('calendar-event', [Backend\CalenderController::class, 'index']);
    Route::post('calendar-crud-ajax', [Backend\CalenderController::class, 'calendarEvents']);
    Route::resource('add-notice', 'Backend\NoticeController', ['names' => 'admin.add_notice']);



    //payroll management
    Route::resource('add_designation', 'Backend\Hr_Management\AddDesignationController', ['names' => 'admin.add_designation']);
    Route::resource('employee_leave', 'Backend\Hr_Management\EmployeeLeaveController', ['names' => 'admin.employee_leave']);
    Route::resource('salary_details', 'Backend\Hr_Management\SalaryDetailsController', ['names' => 'admin.salary_details']);
    Route::resource('bond_letter', 'Backend\Hr_Management\BondLetterController', ['names' => 'admin.bond_letter']);
    // Route::get('bond_letter/test', array('uses'=>'Backend\Hr_Management\BondLetterController@bond_pdf', 'as' => 'admin.bond_letter_pdf'));
    Route::get('bond_letter_pdf/{id}', 'Backend\Hr_Management\BondLetterController@bond_pdf', ['names' => 'admin.bond_letter_pdf']);

    Route::resource('offer_letter', 'Backend\Hr_Management\OfferLetterController', ['names' => 'admin.offer_letter']);
    Route::get('offer_letter_pdf/{id}', 'Backend\Hr_Management\OfferLetterController@offer_pdf', ['names' => 'admin.bond_letter_pdf']);
    Route::resource('holiday_master', 'Backend\Hr_Management\HolidayMasterController', ['names' => 'admin.holiday_master']);
    Route::resource('leave_adjustment', 'Backend\Hr_Management\LeaveAdjustmentController', ['names' => 'admin.leave_adjustment']);
    Route::get('leave_adjustment_approval', array('uses' => 'Backend\Hr_Management\LeaveAdjustmentController@approval', 'as' => 'admin.leave_adjustment_approval'));
    Route::get('leave_adjustment_approvalUpdate/{id}', array('uses' => 'Backend\Hr_Management\LeaveAdjustmentController@updateStatus', 'as' => 'admin.leave_adjustment_approvalUpdate'));
    Route::resource('attendence', 'Backend\Hr_Management\EmpAttendenceController', ['names' => 'admin.attendence']);
    Route::resource('salary_payment', 'Backend\Hr_Management\SalaryPaymentController', ['names' => 'admin.salary_payment']);
    Route::get('salary_detail/{hrmanagement_id}', 'Backend\Hr_Management\SalaryDetailsController@salarydetail', ['names' => 'admin.salary_detail']);

    // Route::get('atten_type', 'Backend\Hr_Management\SalaryPaymentController@attendenceForMonth', ['names' => 'admin.atten_type']);
    Route::get('atten_type/{employee_id}/{month_year}', array('uses' => 'Backend\Hr_Management\SalaryPaymentController@attendenceForMonth', 'as' => 'admin.atten_type'));

    Route::get('filter_attendance', array('uses' => 'Backend\Hr_Management\EmpAttendenceController@filter', 'as' => 'admin.filter_attendance'));
    Route::resource('salary_report', 'Backend\Hr_Management\SalaryReportController', ['names' => 'admin.salary_report']);

    Route::get('salary_report_search', array('uses' => 'Backend\Hr_Management\SalaryReportController@searchBy', 'as' => 'admin.salary_report_search'));
    Route::get('salary_report_export/{month_year}/{branch}', array('uses' => 'Backend\Hr_Management\SalaryReportController@export', 'as' => 'admin.salary_report_export'));
    Route::get('salary_report_exportPdf/{month_year}/{branch}', array('uses' => 'Backend\Hr_Management\SalaryReportController@pdf_export', 'as' => 'admin.salary_report_exportPdf'));
    Route::get('salary/{id}/pay_slip', array('uses' => 'Backend\Hr_Management\SalaryReportController@pay_slip_pdf', 'as' => 'admin.payslip_pdf'));

    //investment
    Route::resource('investment_scheme', 'Backend\Investment\SchemeController', ['names' => 'admin.investment_scheme']);
    Route::resource('create_investment', 'Backend\Investment\CreateInvestmentController', ['names' => 'admin.create_investment']);
    Route::get('inv_scheme_detail/{id}', 'Backend\Investment\CreateInvestmentController@schmeDetails', ['names' => 'admin.inv_scheme_detail']);
    Route::get('investment_approval', array('uses' => 'Backend\Investment\CreateInvestmentController@approval', 'as' => 'admin.investment_approval'));
    Route::get('investment_approvalUpdate/{id}', array('uses' => 'Backend\Investment\CreateInvestmentController@updateStatus', 'as' => 'admin.investment_approvalUpdate'));
    Route::get('investment_details/{id}', 'Backend\Investment\CreateInvestmentController@create_investment_details', ['names' => 'admin.investment_details']);
    // Route::post('investment', 'Backend\Investment\CreateInvestmentController@tenure_store', ['names' => 'admin.investment']);
    Route::post('investment', array('uses' => 'Backend\Investment\CreateInvestmentController@tenure_store', 'as' => 'investment.tenure_store'));
    Route::resource('investment_accnt', 'Backend\Investment\InvestmentAccountController', ['names' => 'admin.investment_accnt']);

    Route::get('investment_accnt/{id}/pay', array('uses' => 'Backend\Investment\InvestmentAccountController@Pay', 'as' => 'admin.interest_pay'));
    Route::patch('investment_accnt/{id}/paynow', array('uses' => 'Backend\Investment\InvestmentAccountController@paynow', 'as' => 'admin.interest_paynow'));
    Route::resource('payment_release', 'Backend\Investment\PaymentReleaseController', ['names' => 'admin.payment_release']);
    Route::get('search_date', array('uses' => 'Backend\Investment\PaymentReleaseController@searchByDate', 'as' => 'admin.search_date'));
    Route::get('inv_payment_report/{to_date}', array('uses' => 'Backend\Investment\PaymentReleaseController@export', 'as' => 'admin.inv_payment_report'));

    Route::get('leave-type/{emp_id}', array('uses' => 'Backend\Hr_Management\LeaveAdjustmentController@getLeave', 'as' => 'admin.leave_type'));

    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Routes
    // Route::get('/password/reset', 'Backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');

    Route::get('processing-fee', array('uses' => 'Backend\CronLoanController@processingFee', 'as' => 'admin.processingFee'));
    Route::get('insurance-fee', array('uses' => 'Backend\CronLoanController@insuranceCharge', 'as' => 'admin.insuranceCharge'));
    Route::get('loan-other-charge', array('uses' => 'Backend\CronLoanController@loanOtherCharge', 'as' => 'admin.loanOtherCharge'));
    Route::get('loan-panelty-charge', array('uses' => 'Backend\CronLoanController@loanPaneltyCharge', 'as' => 'admin.loanPaneltyCharge'));
    Route::get('loan-stamp-fee', array('uses' => 'Backend\CronLoanController@loanStampCharge', 'as' => 'admin.loanStampCharge'));
    Route::get('emi-round-off', array('uses' => 'Backend\CronLoanController@EmiroundOff', 'as' => 'admin.EmiroundOff'));
    Route::get('loan-interest-amount', array('uses' => 'Backend\CronLoanController@EmiInterstAmt', 'as' => 'admin.loanEmiInterestamount'));
    Route::get('loan-principle-amount', array('uses' => 'Backend\CronLoanController@EmiPrincipleAmt', 'as' => 'admin.loanPrincipleamount'));
    Route::get('membership-fee', array('uses' => 'Backend\CronLoanController@membershipFee', 'as' => 'admin.membershipFee'));
    Route::get('employee-salary', array('uses' => 'Backend\CronLoanController@empSalary', 'as' => 'admin.empSalary'));
    Route::get('employee-pf', array('uses' => 'Backend\CronLoanController@empPF', 'as' => 'admin.empPF'));
    Route::get('employee-esi', array('uses' => 'Backend\CronLoanController@empESI', 'as' => 'admin.empESI'));
    Route::get('cashbook', array('uses' => 'Backend\CronLoanController@empESI', 'as' => 'admin.cashbook'));
    Route::get('asset-other-loan', array('uses' => 'Backend\CronLoanController@AssetOtherLoan', 'as' => 'admin.AssetOtherLoan'));


    Route::get('/aadharotp', 'CurlController@aadharsendotp');
    Route::get('/verifyotp', 'CurlController@adharverifyOtp');
    Route::resource('ip-address', 'Backend\IPaddress\IPaddressController', ['names' => 'admin.ip-address']);

    // subscription for members
    Route::get('/cashfree-subscription', [App\Http\Controllers\Backend\SubscriptionController::class, 'index']);
    Route::post('/cashfree-subscription', [App\Http\Controllers\Backend\SubscriptionController::class, 'subscripe'])->name('cashfree.subscribe');
   
    // Route::resource('payment_release', 'Backend\Investment\PaymentReleaseController', ['names' => 'admin.payment_release']);
    // Route::post('/password/reset/submit', 'Backend\Auth\ForgetPasswordController@reset')->name('admin.password.update');
});
Route::get('verificationform', 'CurlController@form');
// Route::post('aadharotp', 'CurlController@aadharsenotp');

Route::post('create-plan', 'CurlController@createplan')->name('create-plan.createplan');
// Route::post('create-plan/{planId}/{planName}/{type}/{amount}/{intervalType}/{intervals}', 'CurlController@createplan')->name('create-plan.createplan');
Route::post('Create_Subscription/{sub_id}', 'CurlController@createsubscription')->name('Create_Subscription.createsubscription');
Route::get('Subscriptioninfo/{sub_id}', 'CurlController@getSubscriptioninfo')->name('Subscriptioninfo.getSubscriptioninfo');
Route::get('Allsubscription_payments/{sub_id}/{last}/{count}
', 'CurlController@getAllSubscriptionPayments')->name('Allsubscription_payments.getAllSubscriptionPayments');
Route::post('Cancel_Subscription/{sub_id}', 'CurlController@cancelSubscription')->name('Cancel_Subscription.cancelSubscription');
Route::post('authenticate', 'CurlController@authenticate')->name('authenticate.authenticate');
Route::post('Token', 'CurlController@authenticateTocane')->name('Token.authenticateTocane');
Route::post('Beneficiary__add/{beneid}, {name}, {email}, {phone}, {account}, {ifsc}, {address}, {city}, {state}, {pin}', 'CurlController@addBeneficiary')->name('Beneficiaryadd.addBeneficiary');
Route::post('Beneficiary_delete/{beneid}', 'CurlController@removeBeneficiary')->name('Beneficiary_delete.removeBeneficiary');
Route::get('Beneficiary_detail', 'CurlController@getBeneficiary')->name('Beneficiary_detail.getBeneficiary');
Route::get('Beneficiary_by_Id', 'CurlController@getBeneficiaryId')->name('Beneficiary_by_Id.getBeneficiaryId');
Route::post('request_TransferSync', 'CurlController@requestTransferSync')->name('request_TransferSync.requestTransferSync');
Route::get('get_Transferstatus', 'CurlController@getTransferstatus')->name('get_Transferstatus.getTransferstatus');
//ipaddress

