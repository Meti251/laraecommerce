<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //get shop view page
    public function getShop(){
        return view('customer.pages.shop');
    }

    //get about view page
    public function getAbout(){
        return view('customer.pages.about');
    }

    // get services page
    public function getServices(){
        return view('customer.pages.services');
    }

    // get blog page
    public function getBlog(){
        return view('customer.pages.blog');
    }

    // get contact page
    public function getContact(){
        return view('customer.pages.contact');
    }

    // get cart page
    public function getCart(){
        return view('customer.pages.cart');
    }

    // get checkout page
    public function getCheckout(){
        return view('customer.pages.checkout');
    }

    // get thankyou page
    public function getThankyou(){
        return view('customer.pages.thankyou');
    }
}
