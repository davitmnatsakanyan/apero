<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Paypalpayment;
use Redirect;

class PaypalController extends Controller
{

    private $_apiContext;

    public function __construct()
    {
        $this->_apiContext = Paypalpayment::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('../storage/logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }


    public function getCheckout()
    {
        $payer = Paypalpayment::Payer();
        $payer->setPaymentMethod('paypal');

        $amount = Paypalpayment:: Amount();
        $amount->setCurrency('EUR');
        $amount->setTotal(12); // This is the simple way,
        // you can alternatively describe everything in the order separately;
        // Reference the PayPal PHP REST SDK for details.

        $transaction = Paypalpayment::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('What are you bying?');

        $redirectUrls = Paypalpayment:: RedirectUrls();
        $redirectUrls->setReturnUrl(url('paypal/done'));
        $redirectUrls->setCancelUrl(url('paypal/cancel'));

        $payment = Paypalpayment::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;
//        return Redirect::to($redirectUrl);
        return response()->json(['redirectUrl' => $redirectUrl]);
    }

    public function getDone(Request $request)
    {
        dd($request->all());
        $id = $request->paymentId;
        $token = $request->token;
        $payer_id = $request->PayerID;

        dd($id, $token, $payer_id);
        $payment = Paypalpayment::getById($id, $this->_apiContext);

        $paymentExecution = Paypalpayment::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        dd('sucsess');
    }

    public function getCancel()
    {
        dd('cancle');
    }

}



