<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SubscriptionPackage;
use App\Models\Admin\SubscriptionPackageDetails;
use App\Models\Offer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OffersController extends Controller
{
    public function  offerPage()
    {
        $data = Offer::all();
        
        $datapackeg = SubscriptionPackage::all();
        return view('admin.offers.offer', compact('data', 'datapackeg'));
    }

    public function offerSave(Request $request)
    {
        $rules = [

            "name" => "required|max:20",
            "type_name" => "required",
            "start_date" => "required",
            "Expire_date" => "required"
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('staus' => false, 'msg' => $validator->errors()->first()));
            exit;
        }

        if (isset($request->percentage)) {
            $price = $request->percentage;
        }else{
            $price = $request->pr_price;
        }
        $save = new  Offer();
             
        $save->package_id   = $request->name;
        $save->type    = $request->type_name;
        $save->price   = $price;
        $save->start_date    = $request->start_date;
        $save->expire_date   = $request->Expire_date;
        // dd($save);
        $save->save();
        
        if ($save) {
            return response()->json(array('status' => true, 'msg' => 'Successfully Added', 'location' => route('admin.offer')));
        } else {
            return response()->json(array('status' => false, 'mag' => 'Something went wrong, please try again'));
        }

    }

    public function offerUpdates(Request $request)
    {     
        //  dd($request->all());      
        if(isset($request->percent)){
            $pr = $request->percent;
        } else{
            $pr = $request->price;
        }                
        $updateoffer = Offer::find($request->id);
        $updateoffer->package_id = $request->package_id;
        $updateoffer->type = $request->type_name;
        $updateoffer->price = $pr;
        $updateoffer->start_date = $request->start_date;
        $updateoffer->expire_date = $request->expire;

        $updateoffer->update();
        if ($updateoffer) {

            return response()->json(array('status' => true, 'msg' => "Successfully Updated", 'location' => route('admin.offer')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }

    public function offerDelete(Request $request)
    {
        $offerdelete = Offer::find($request->id);
        if($offerdelete)
        {
            $offerdelete->delete();
            return response()->json(array('status' => true, 'msg' => "Successfully Deleted"));
            exit;
        }
        else
        {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }
}
