<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;


class SetSmsGatewayController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function memberCreate($member_mobile,$mem_no,$name)
    {
        $response = Http::get('message.neodove.com/sendsms.jsp?user=BOUNDPAR&password=7c51237a44XX&senderid=BPTOPE&mobiles=+91'.$member_mobile.'&sms='.$name.' welcomes you to our family. Your membership no. is '.$mem_no.'. Kindly quote this membership no for future transactions. BOUNDPARIVAR');
        return $response;
    }

    public function loanAppliCreate($member_mobile,$member_name,$application_no,$amount)
    {
        
        $response = Http::get('message.neodove.com/sendsms.jsp?user=BOUNDPAR&password=7c51237a44XX&senderid=BPTOPE&mobiles=+91'.$member_mobile.'&sms=Dear '.$member_name.' your Loan application no'.$application_no.' successfully generated . Your loan amount '.$amount.'. BOUNDPARIVAR');
        return $response;
    }

    public function loanRejected($mobile_no,$loan_application_id)
    {
        $response = Http::get('message.neodove.com/sendsms.jsp?user=BOUNDPAR&password=7c51237a44XX&senderid=BPTCPE&mobiles=+91'.$mobile_no.'&sms=Dear Customer , Your Loan application '.$loan_application_id.' is rejected. BOUNDPARIVAR');
        return $response;
    }

    public function loanDisburse($name,$mobile,$amount)
    {
        $response = Http::get('message.neodove.com/sendsms.jsp?user=BOUNDPAR&password=7c51237a44XX&senderid=BPTOPE&mobiles=+91'.$mobile.'&sms=Dear '.$name.', your Loan amount '.$amount.' is successfully disbursement. BOUNDPARIVAR');
        return $response;

    }


}
