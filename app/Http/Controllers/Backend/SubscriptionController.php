<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(){

    }

    public function subscripe(Request $request){
        $client_id = env('CASHFREE_CLIENT_ID');
        $client_secret = env('CASHFREE_CLIENT_SECRET');

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $charactersLength; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
       // return $randomString;
       $mobile = $request->moblie;
       return $mobile;
       $email = $request->email;
       if (!isset($email)){
            $email = "babu.alsoltech.astw008@gmail.com";
       }
    //    if(!isset($mobile)){
    //         $mobile = "7003621966";
    //    }
       $date = $request->date;
       $date = date('Y-m-d h:i:s', strtotime($date));
      // return $date;

        $curl = curl_init();

        
        $X = '{
            "subscriptionId" : "'.$randomString.'",
            "planId": "0100",
            "customerEmail":"'.$email.'",
            "customerPhone": "'.$mobile.'",
            "expiresOn" : "'.$date.'",
            "returnUrl": "http://localhost/handleResponse.php"
        } ';
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://test.cashfree.com/api/v2/subscriptions',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$X,
        CURLOPT_HTTPHEADER => array(
            'X-Client-Id: 198224d081bf87d92ae7ac88a4422891',
            'X-Client-Secret: TEST3c4f17d34326f1540e3c25f142b4674bd08a52d3',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
