<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InlinePaymentController extends Controller
{
    function inlinePay(){
        return view('payment.inlinepayment');
    }
}
