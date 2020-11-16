<?php

namespace App\Http\Controllers;

use App\Command;
use App\Payment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    public $gateway;
 
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }
    public function charge(Request $request){
        if($request->input('submit'))
        {
          
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $request->get('amount'),
                    'user_id'=> (Auth::user()->id),
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('paymentsuccess'),
                    'cancelUrl' => url('paymenterror'),
                ))->send();
                
          
                if ($response->isRedirect()) {

                    $response->redirect(); // this will automatically forward the customer
                   
                } else {
                    // not successful
                    return dd($response->getMessage());
                }
            } catch(Exception $e) {
                return dd($e->getMessage()); 
                
            }
            
        }
    }
    public function payment_success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
         
            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();
         
                // Insert transaction data into the database
                $isPaymentExist = Payment::where('payment_id', $arr_body['id'])->first();
                $userid = (Auth::user()->id);
                $count = DB::table('carts')->where('user_id','=',$userid)->count('product_id');
                $product_id = DB::table('carts')->where('user_id','=',$userid)->value('product_id');
                $quantity = DB::table('carts')->where('user_id','=',$userid)->value('quantity');
                $price = DB::table('carts')
                        ->where('user_id','=',$userid)
                        ->join('products','products.id','=','carts.product_id')
                        ->value('products.price');
         
                if(!$isPaymentExist)
                { 
                    $payment = new Payment;
                    $payment->payment_id = $arr_body['id'];
                    $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->user_id = (Auth::user()->id);
                    $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->currency = env('PAYPAL_CURRENCY');
                    $payment->payment_status = $arr_body['state'];
                    $payment->save();

                    for($i=0; $i<$count; $i++){
                    $command = new Command;
                    $command->user_id = $userid ;
                    $command->product_id = $product_id;
                    $command->quantity = $quantity;
                    $command->price =$price ;
                    $command->packaging = true;
                    $command->livraison = false;
                    $command->reception = false;
                    $command->save();
                    }
                    
                    DB::table('carts')->where('user_id','=',$userid)->delete();
                    // $command->save();
                }

                    return redirect('/PaymentStep')->with('successpayement','Votre paiment a ete fait avec success ');
            } else {
                return $response->getMessage();
            }
        } else {
            return redirect('/PaymentStep')->with('errorpayement','Veuillez verifier votre compte !!');
        }
        
    }
    public function payment_error()
    {
        return redirect('/PaymentStep')->with('errorpayement','Veuillez verifier votre compte !!');
    }
    
}