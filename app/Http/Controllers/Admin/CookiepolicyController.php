<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Cookiepolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CookiepolicyController extends Controller
{
  public function cookiepolicyPage()
  {

    $getdata = Cookiepolicy::first();
    return view('admin.cookie_Policy.cookie_Policy ',compact('getdata'));
  } 
  
  public function updatecookiePolicy(Request $request)
  {
    $rules =[
        'cookiepolicy' => 'required',
    ];

    $validator = Validator::make($request->all(),$rules);

    if ($validator->fails()) {
       
        return response()->json(array('status' => false , 'mgs'=>$validator->errors()->first()));
    }

    
    $get =  Cookiepolicy::find($request->id);
    if(isset($get)){
      $get->cookie_policy = $request->cookiepolicy;
      $get->update();
    }else{
      $get = new Cookiepolicy();
      $get->cookie_policy = $request->cookiepolicy;
      $get->save(); 
    }

    if ($get) {
        return response()->json(array('status' => true , 'msg'=>'Success updated' , 'location' => route('admin.cookiepolicy')));
    }else{

        return response()->json(array('status' => false, 'msg' =>'Something went wrong,please try again'));
    }
  }

}
