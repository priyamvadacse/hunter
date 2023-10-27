<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Admin\ContactUs;
use App\Models\Admin\Faq;
use App\Models\Admin\PrivacyPolicy;
use App\Models\Admin\Termcondition;
use App\Models\Story;
use App\Models\User\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class LandingPageController extends Controller
{
    public function landingPage()
    {
        $storyget = Story::where('status', 'ACTIVE')->get();
        $userpic = User::where('status', 'ACTIVE')->orderBy('id', 'desc')
        ->limit(10)
        ->get();

        $total = User::where('status', 'ACTIVE')->count(); // Reset the query
        
        $totalman = User::where('gender', 'male')->count();
        
        $totalwoman = User::where('gender', 'female')->count();

        // $userpic = $userpic->

        return view('front.index', compact('storyget', 'userpic', 'total', 'totalwoman', 'totalman'));
    }


    public function contactUs()
    {

        $contactUs = ContactUs::first();

        return view('front.contact', compact('contactUs'));
    }

    public function storypage()
    {
        $storyget = Story::where('status', 'ACTIVE')->get();
        return view('front.story', compact('storyget'));
    }

    public function storyDetailPage($id)
    {
        $getdetailsStory = Story::where('id', $id)->first();
        return view('front.story_details_page', compact('getdetailsStory'));
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
