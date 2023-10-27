<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Admin\PrivacyPolicy;
use App\Models\Admin\Termcondition;
use Illuminate\Http\Request;

class CmsApiController extends Controller
{
    //method use for updtew

    public function aboutUs()
    {
        $about_us = AboutUs::first();
    
        $cleanedResponse = strip_tags($about_us->content);
        
        return response()->json(['status' => true, 'message' => 'Success', 'data' => [
            'id' => $about_us->id,
            'title' => $about_us->title,
            'content' => $cleanedResponse
        ]]);
       
    }

    // 
    public function privacyPolicy()
    {
        $privacy_policy = PrivacyPolicy::first();
        $policy = strip_tags($privacy_policy->policy);
        return response()->json(['status' => true, 'message' => 'Success', 'data' =>[
            'id'=> $privacy_policy->id,
            'title'=> $privacy_policy->title,
             'policy'=>$policy]
            ]);
    }


    // method use for help center
    public function termsAndCondition()
    {
        $trmsAndCondition =  Termcondition::first();
        $data['termcondition'] = strip_tags($trmsAndCondition['termcondition']);
        return response()->json(['status'=>true , 'message'=>'success', 'data'=>$data]);
    }
    
}
