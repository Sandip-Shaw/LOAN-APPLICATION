<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurlController extends Controller
{
    public function form()
    {
        return view('verification_form');
    }
    // aadhar send otp to verify
    public function aadharsendotp(Request $request)
    {
        $aadhaar_number = $request->aadhar;
        //dd($aadhaar_number);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('AADHAR_API_BASE_URL') . '/verification/offline-aadhaar/otp',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "aadhaar_number" => $aadhaar_number
            )),
            CURLOPT_HTTPHEADER => array(
                "x-client-id: " . env('AADHAR_API_KEY'),
                "x-client-secret: " . env('AADHAR_API_SECRET'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // dd($response);
        echo $response;
    }


    // verify otp for adhar
    public function adharverifyOtp(Request $request)
    {
        //dd($request);
        $otp = $request->otp;
        $ref_id = $request->refId;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('AADHAR_API_BASE_URL') . '/verification/offline-aadhaar/verify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "otp" => $otp,
                "ref_id" => $ref_id,

            )),
            CURLOPT_HTTPHEADER => array(
                "x-client-id: " . env('AADHAR_API_KEY'),
                "x-client-secret: " . env('AADHAR_API_SECRET'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }


    // creat plan
    public function createplan(Request $request)
    {
        $planId = (string) $request->input('planId');
        $planName = (string) $request->input('planName');
        $type = strtoupper((string) $request->input('type'));
        $amount = (float) $request->input('amount');
        $intervalType = (string) $request->input('intervalType');
        $intervals = (int) $request->input('intervals');

        $curl = curl_init();

        $planData = array(
            "planId" => $planId,
            "planName" => $planName,
            "type" => $type,
            "amount" => $amount,
            "intervalType" => $intervalType,
            "intervals" => $intervals
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('PLAN_API_BASE_URL') . '/api/v2/subscription-plans',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($planData),
            CURLOPT_HTTPHEADER => array(
                "x-client-id: " . env('PLAN_API_KEY'),
                "x-client-secret: " . env('PLAN_API_SECRET'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    // create subscription
    public function createsubscription(Request $request, $subscriptionId, $planId, $customerEmail, $customerPhone, $expiresOn, $returnUrl)
    {
        $planData = array(
            "subscriptionId" => $subscriptionId,
            "planId" => $planId,
            "customerEmail" => $customerEmail,
            "customerPhone" => $customerPhone,
            "expiresOn" => $expiresOn,
            "returnUrl" => $returnUrl
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('PLAN_API_BASE_URL') . '/api/v2/subscriptions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($planData),
            CURLOPT_HTTPHEADER => array(
                "x-client-id: " . env('PLAN_API_KEY'),
                "x-client-secret: " . env('PLAN_API_SECRET'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function getSubscriptioninfo(Request $request, $sub_id)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  env('PLAN_API_BASE_URL') . '/api/v2/subscriptions/' . $sub_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "x-client-id: " . env('PLAN_API_KEY'),
                "x-client-secret: " . env('PLAN_API_SECRET'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function getAllSubscriptionPayments(Request $request, $sub_id, $last, $count)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  env('PLAN_API_BASE_URL') . '/api/v2/subscriptions/' . $sub_id . '/payments?lastId=' . $last . '&count=' . $count,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "x-client-id: " . env('PLAN_API_KEY'),
                "x-client-secret: " . env('PLAN_API_SECRET'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function cancelSubscription(Request $request, $sub_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('PLAN_API_BASE_URL') . '/api/v2/subscriptions/' . $sub_id . '/cancel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                "x-client-id: " . env('PLAN_API_KEY'),
                "x-client-secret: " . env('PLAN_API_SECRET'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function authenticate()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('PAYOUT_API_BASE_URL') . '/payout/v1/authorize',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                "x-client-id: " . env('Payout_API_KEY'),
                "x-client-secret: " . env('PAYOUT_API_SECRET'),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function authenticateToken(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('PAYOUT_API_BASE_URL') . '/payout/v1/verifyToken',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                env('PAYOUT_API_TOKEN'),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function addBeneficiary(Request $request, $beneid, $name, $email, $phone, $account, $ifsc, $address, $city, $state, $pin)
    {
        $userinfo = array(
            "beneId" => $beneid,
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "bankAccount" => $account,
            "ifsc" => $ifsc,
            "address1" => $address,
            "city" => $city,
            "state" => $state,
            "pincode" => $pin

        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('PAYOUT_API_BASE_URL') . '/payout/v1/addBeneficiary',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($userinfo),
            CURLOPT_HTTPHEADER => array(
                env('PAYOUT_API_TOKEN'),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function removeBeneficiary(Request $request, $beneid)
    {
        $userinfo = array(
            "beneId" => $beneid,
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('PAYOUT_API_BASE_URL') . '/payout/v1/removeBeneficiary',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($userinfo),
            CURLOPT_HTTPHEADER => array(
                env('PAYOUT_API_TOKEN'),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function getBeneficiarydetail(Request $request, $beneid)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  env('PAYOUT_API_BASE_URL') . '/payout/v1/getBeneficiary/' . $beneid,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                env('PAYOUT_API_TOKEN'),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function getBeneficiaryId(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('PAYOUT_API_BASE_URL') . '/payout/v1/getBeneId?bankAccount=9655000100023186&ifsc=PUNB0096500',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                env('PAYOUT_API_TOKEN'),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function requestTransferSync(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('PAYOUT_API_BASE_URL') . '/payout/v1/requestTransfer',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
   "beneId": "JOY18011343",
   "amount": "1.00",
   "transferId": "JUNOB2018"
 }',
            CURLOPT_HTTPHEADER => array(
                env('PAYOUT_API_TOKEN')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function getTransferstatus(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('PAYOUT_API_BASE_URL') . '/payout/v1/getTransferStatus?referenceId=54052731&transferId=JUNOB2018',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                env('PAYOUT_API_TOKEN')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
