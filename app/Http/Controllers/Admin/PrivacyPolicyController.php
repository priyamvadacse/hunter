<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PrivacyPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivacyPolicyController extends Controller
{
    public function privacy_policy()
    {
        $getdata =  PrivacyPolicy::first();

        return view('admin.privacy_policy.index', compact('getdata'));
    }

    public function addPolicy(Request $request)
    {
        $rules = [
            'title' => 'required',
            'policy' => 'required',

        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }

        $get = PrivacyPolicy::find($request->id);

        if(isset($get)){

        // $data = $request->validated();
        $get->title = $request->title;
        $get->policy = $request->policy;
        $get->update();
        }else
        {
            $get = new PrivacyPolicy();
            $get->title = $request->title;
            $get->policy = $request->policy;
            $get->save();
        }

        // return redirect()->back()->with('status','User Added Successfully');

        if ($get) {

            return response()->json(array('status' => true, 'msg' => "Successfully Updated", 'location' => url('admin/privacy-policy')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }

    }
}
