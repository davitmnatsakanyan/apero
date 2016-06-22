<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Paypalpayment;
use Redirect;

class PaypalController extends Controller{
    
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
    $amount->setTotal(42); // This is the simple way,
    // you can alternatively describe everything in the order separately;
    // Reference the PayPal PHP REST SDK for details.

    $transaction = Paypalpayment::Transaction();
    $transaction->setAmount($amount);
    $transaction->setDescription('What are you selling?');

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

    return Redirect::to( $redirectUrl );
}

public function getDone()
{
    $id = request()->get('paymentId');
    $token = request()->get('token');
    $payer_id = request()->get('PayerID');
    $payment = Paypalpayment::getById($id, $this->_apiContext);

    $paymentExecution = Paypalpayment::PaymentExecution();

    $paymentExecution->setPayerId($payer_id);
    $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

    // Clear the shopping cart, write to database, send notifications, etc.
     dd('sucsess');
    // Thank the user for the purchase
    return view('checkout.done');
}

public function getCancel()
{
    dd('cancle');
    // Curse and humiliate the user for cancelling this most sacred payment (yours)
    return view('checkout.cancel');
}

}

