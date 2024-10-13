<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    function index()
    {
        return view('payment.index');
    }

    function payment_callback()
    {
        $response = json_decode($this->verify_payment(request('reference')));

        // dd($response);
        if ($response) {
            if ($response->status) {
                $data = $response->data;
                return view('payment.callback', compact('data'));
                // dd($response);
                // return redirect($pay->data->authorization_url);
            } else {
                return back()->withError($response->message);
                // return view('payment.callback');
            }
        } else {
            return back()->withError("something went wrong!");
        }
    }

    function make_payment(Request $request)
    {
        $formData = [
            'email' => $request->email,
            'amount' => $request->amount * 100,
            'callback_url' => route('pay.callback'),
        ];

        $pay = json_decode($this->initiate_payment($formData));
        if ($pay) {
            if ($pay->status) {
                // dd($pay);
                return redirect($pay->data->authorization_url);
            } else {
                return back()->withError($pay->message);
            }
        } else {
            return back()->withError("something went wrong!");
        }
    }

    public function initiate_payment($formData)
    {
        $url = "https://api.paystack.co/transaction/initialize";
        $fields_string = http_build_query($formData);
        //set the url, number of POST vars, POST data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . env("PAYSTACK_SECRET_KEY"),
            "Cache-Control: no-cache",
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function verify_payment($reference)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . env("PAYSTACK_SECRET_KEY"),
                "Cache-Control: no-cache",
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    // $url = "https://api.paystack.co/transaction/initialize";

    // $fields = [
    //   'email' => "customer@email.com",
    //   'amount' => "500000"
    // ];

    // $fields_string = http_build_query($fields);

    // //open connection
    // $ch = curl_init();

    // //set the url, number of POST vars, POST data
    // curl_setopt($ch,CURLOPT_URL, $url);
    // curl_setopt($ch,CURLOPT_POST, true);
    // curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //   "Authorization: Bearer SECRET_KEY",
    //   "Cache-Control: no-cache",
    // ));

    // //So that curl_exec returns the contents of the cURL; rather than echoing it
    // curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

    // //execute post
    // $result = curl_exec($ch);
    // echo $result;
}
