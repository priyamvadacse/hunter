<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Admin\ContactUs;
use App\Models\Admin\Faq;
use App\Models\Admin\PrivacyPolicy;
use App\Models\Admin\Termcondition;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function landingPage()
    {
      
        return view('front.index');
    }


    public function contactUs(){

        $contactUs = ContactUs::first();
        
        return view('front.contact', compact('contactUs'));
    }

    public function storypage()
    {
        
        return view('front.story');


    }

    public function aboutpage()
    {
        $about_us = AboutUs::first();

        return view('front.about', compact('about_us'));
    }

    public function faqPage()
    {

        $faq = Faq::where('status', '0')->get();
        return view('front.cms.faq', compact('faq'));
    }

    // method use for privacy policy
    public function privacyPolicya()
    {
        $privacy_policy = PrivacyPolicy::first();
        return view('front.privacy_policy', compact('privacy_policy'));
    }
    

    // method use for data get terms and conditions
    public function termAndCondition()
    {
        $termConditions = Termcondition::first();
        return view('front.terms_and_condition', compact('termConditions'));
    }

}
