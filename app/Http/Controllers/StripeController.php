<?php

namespace App\Http\Controllers;

use App\Events\restore;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Redirect;

//use Paypalpayment;
use Redirect;

class StripeController extends Controller
{
    public function getIndex()
    {
        return view('stripe');
    }

    public function register()
    {
        return Redirect::to('https://connect.stripe.com/oauth/authorize?response_type=code&client_id=ca_8yrhBrmSGJN7HKKmCXj1eUPUcE7hTryN&scope=read_write');
    }
    public function success(Request $request)
    {
     try {
         define('TOKEN_URI', 'https://connect.stripe.com/oauth/token');
         define('AUTHORIZE_URI', 'https://connect.stripe.com/oauth/authorize');

         if (isset($request->code)) { // Redirect w/ code
             $code = $request->code;

             $token_request_body = array(
                 'grant_type' => 'authorization_code',
                 'client_id' => 'ca_8yrhBrmSGJN7HKKmCXj1eUPUcE7hTryN',
                 'code' => $code,
                 'client_secret' => 'sk_test_nW4igLL1UY1We0a3zzFBHCs0'
             );

             $req = curl_init(TOKEN_URI);

             curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($req, CURLOPT_POST, true);
             curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));

             // TODO: Additional error handling
             $respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
             $a = curl_exec($req);
             if (FALSE === $a)
                 throw new \Exception(curl_error( $req), curl_errno($req));
             dd($a);

             $resp = json_decode(curl_exec($req), true);
             curl_close($req);

             echo $resp['access_token'];
         } else if (isset($_GET['error'])) { // Error
             echo $_GET['error_description'];
         } else { // Show OAuth link
             $authorize_request_body = array(
                 'response_type' => 'code',
                 'scope' => 'read_write',
                 'client_id' => 'ca_8yrhBrmSGJN7HKKmCXj1eUPUcE7hTryN'
             );

             dd('hasas');
             $url = AUTHORIZE_URI . '?' . http_build_query($authorize_request_body);
             echo "<a href='$url'>Connect with Stripe</a>";


         }
     }
     catch(\Exception $e) {

         trigger_error(sprintf(
             'Curl failed with error #%d: %s',
             $e->getCode(), $e->getMessage()),
             E_USER_ERROR);

     }
    }


    public function listAccounts()
    {
        \Stripe\Stripe::setApiKey("sk_test_nW4igLL1UY1We0a3zzFBHCs0");

        $m  =  \Stripe\Account::all(array("limit" => 3));
        dd($m);
    }
    public function registerOrder(Request $request)
    {
//        dd($request->all());
        \Stripe\Stripe::setApiKey("sk_test_nW4igLL1UY1We0a3zzFBHCs0");
        $token = $request->stripeToken;

        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => 1000, // amount in cents, again
                "currency" => "eur",
                "source" => $token,
                "description" => "Example charge"
            ));
        } catch(\Stripe\Error\Card $e) {
            // The card has been declined
        }

    }
}



