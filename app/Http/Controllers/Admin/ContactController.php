<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ContactUs;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class ContactController extends Controller
{
    public function contactus()
    {
         $getdata = ContactUs::first();
        // dd($getdata);


        return view('admin.contact_us.contact',compact('getdata'));
    }

    // this method is not use for contact us
    public function showContactusss(Request $request)
    {
        $rules = [
            "contact" => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }
        $get = ContactUs::find($request->id);
        $getcount = ContactUs::count();
        
        if($getcount > 0){
            $get->contact = $request->contact;
            $get->update();
            if ($get) {

                return response()->json(array('status' => true, 'msg' => "Successfully Updated", 'location' => url('admin/contact-us')));
            } else {
                return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
            }
        }else{
            $new  = new ContactUs();
            $new->contact = $request->contact;
            $new->save();
            if ($new) {

                return response()->json(array('status' => true, 'msg' => "Successfully Save", 'location' => url('admin/contact-us')));
            } else {
                return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
            }
        }    

      

    }


    // method use for update contact us 
    public function showContactus(Request $request)
    {
        $rules = [
            'contactEmail' => 'required',
            'contactPhone' => 'required|integer',
            "contact" => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }
        $get = ContactUs::find($request->id);
        $getcount = ContactUs::count();
        
        if($getcount > 0){
            $get->email = $request->contactEmail;
            $get->phone_number = $request->contactPhone;
            $get->contact = $request->contact;
            $get->update();
            if ($get) {

                return response()->json(array('status' => true, 'msg' => "Successfully Updated", 'location' => url('admin/contact-us')));
            } else {
                return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
            }
        }else{
            $new  = new ContactUs();
            $get->email = $request->contactEmail;
            $get->phone_number = $request->contactPhone;
            $new->contact = $request->contact;
            $new->save();
            if ($new) {

                return response()->json(array('status' => true, 'msg' => "Successfully Save", 'location' => url('admin/contact-us')));
            } else {
                return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
            }
        }    

      

    }

    // method use for show page social media
    public function socialMediaPage()
    {
        $getdata = Setting::first();
        return view('admin.contact_us.social_media', compact('getdata'));
    }

    public function socialMediaUpdate(Request $request)
    {

        $get = Setting::find($request->id);
        $getcount = Setting::count();
        
        if($getcount > 0){
            $get->facebook_link = $request->facebook;
            $get->instagram_link = $request->instagram;
            $get->youtube_link = $request->youtube;
            $get->update();
            if ($get) {

                return response()->json(array('status' => true, 'msg' => "Successfully Updated", 'location' => route('admin.social_media_page')));
            } else {
                return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
            }
        }else{
            $new  = new Setting();
            $new->facebook_link = $request->facebook;
            $new->instagram_link = $request->instagram;
            $new->youtube_link = $request->youtube;
            $new->save();
            if ($new) {

                return response()->json(array('status' => true, 'msg' => "Successfully Save", 'location' => route('admin.social_media_page')));
            } else {
                return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
            }
        }    

    }


}

