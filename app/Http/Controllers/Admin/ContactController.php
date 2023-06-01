<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ContactUs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contactus()
    {
         $getdata = ContactUs::first();
        // dd($getdata);


        return view('admin.contact_us.contact',compact('getdata'));
    }

    public function showContactus(Request $request)
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
}

