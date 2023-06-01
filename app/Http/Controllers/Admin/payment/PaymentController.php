<?php

namespace App\Http\Controllers\Admin\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentPage()
    
        {
            
       
            return view('admin.payment.payment');

        }

        public function invoicesPage()
        {
            
            return view('admin.payment.invoice');
        }

    public function pendindList()
    {
        return view('admin.payment.pending');
    } 
}
