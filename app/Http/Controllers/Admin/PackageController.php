<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\BoostPackage;
use App\Models\Admin\SubscriptionPackage;
use App\Models\Admin\SubscriptionPackageDetails;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function package()
    {
        $package = SubscriptionPackage::all();
        return view('admin.package.index',compact('package'));
    }

    public function addPackage(Request $request)
    {

        $rules = [

            "package" => "required|max:128|unique:subscription_packages",
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }
    
        if ($request->file('image') != "") {
            $favicon = uniqid(time()) . '.' . $request->image->extension();
            $request->image->move(public_path('assets/admin/package/img/'), $favicon);
            $favicon = "/assets/admin/package/img/" . $favicon;
        }
        
     
        // $data = $request->validated();
        $addsubscription = new SubscriptionPackage();
        $addsubscription->package = $request->package;
        $addsubscription->duration = $request->duration;
        // $addsubscription->price = $request->duration == 90 ? $request->price*3 : ($request->duration == 180 ? $request->price*6 : ($request->duration == 270 ? $request->price*9 : $request->price*12  ));
        $addsubscription->price = $request->price;    
        $addsubscription->monthly_price = $request->price; 
        $addsubscription->type = $request->type == '' ? 0 : 1; 
        $addsubscription->like = $request->like;
        $addsubscription->boost = $request->boost;

        // $addsubscription->image = $favicon;
        $addsubscription->save();
        // return redirect()->back()->with('status','addsubscription Added Successfully');

        if ($addsubscription) {

            return response()->json(array('status' => true, 'msg' => "Successfully Added", 'location' => url('admin/admin-package')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }

    public function updatePackage(Request $request)
    {
        $rules = [
            "package" => 'required|max:128|unique:subscription_packages,package,'.$request->id,
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }
        $upadesubscription = SubscriptionPackage::find($request->id);

        if ($request->file('image') != "") {
            $favicon = uniqid(time()) . '.' . $request->image->extension();
            $request->image->move(public_path('assets/admin/package/img/'), $favicon);
            $favicon = "/assets/admin/package/img/" . $favicon;
        } else{
            $favicon = $upadesubscription->image;
        }

        $upadesubscription->package = $request->package;
        $upadesubscription->duration = $request->duration;
        // $upadesubscription->price = $request->duration == 90 ? $request->price*3 : ($request->duration == 180 ? $request->price*6 : ($request->duration == 270 ? $request->price*9 : $request->price*12  ));
        $upadesubscription->price = $request->price;
        $upadesubscription->monthly_price = $request->price;
        $upadesubscription->type = $request->type ? 1 : 0;
        $upadesubscription->like = $request->like_edit;
        $upadesubscription->boost = $request->boost_edit;
        $upadesubscription->image = $favicon;
        
        $upadesubscription->update();        

        if ($upadesubscription) {

            return response()->json(array('status' => true, 'msg' => "Successfully Updated", 'location' => url('admin/admin-package')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }

    public function deletePackage(Request $request)
    {
        $user = SubscriptionPackage::find($request->id);
        if($user)
        {
            $user->delete();
            return response()->json(array('status' => true, 'msg' => "Successfully Deleted"));
            exit;
        }
        else
        {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }


    // Package Details
    public function PackageDetails()
    {
        $package = SubscriptionPackageDetails::all();
        return view('admin.package.package_details',compact('package'));
    }

    public function addPackageDetails()
    {
        $package = SubscriptionPackage::all();
        return view('admin.package.add_package_details',compact('package'));
    }

    public function storePackageDetails(Request $request)
    {

        // dd($request->all());

        $rules = [
            "price" => "required|max:128|unique:subscription_package_details",

        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }
        // $data = $request->validated();
        $storesubscription = new SubscriptionPackageDetails();
        $storesubscription->package_id = $request->id;
        $storesubscription->package_duration = $request->duration;
        $storesubscription->price = $request->duration == 90 ? $request->price*3 : ($request->duration == 180 ? $request->price*6 : $request->price*12);
        $storesubscription->save();
        // return redirect()->back()->with('status','storesubscription storeed Successfully');

        if ($storesubscription) {

            return response()->json(array('status' => true, 'msg' => "Successfully Added", 'location' => url('admin/package-details-list')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }


    // method use for index 
    public function index()
    {
        $package = BoostPackage::all();
        return view('admin.boost.index', compact('package'));
    }

    // list of user boost
    public function saveUserBoost(Request $request)
    {
        $rules = [

            "boost_package" => "required|max:128|unique:boost_packages",
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }

        $addsubscription = new BoostPackage();
        $addsubscription->boost_title = $request->boost_title;
        $addsubscription->boost_package = $request->boost_package;
        $addsubscription->duration = $request->duration;        
        $addsubscription->price = $request->price;
        $addsubscription->type = $request->type == '' ? 0 : 1; 
        
        $addsubscription->save();        

        if ($addsubscription) {

            return response()->json(array('status' => true, 'msg' => "Successfully Added", 'location' => url('admin/boost-package-index')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }


    // method use for update boost package
    public function updateBoostPackage(Request $request)
    {

        $rules = [

            "boost_package_edit" => 'required|max:128|unique:boost_packages,boost_package,'.$request->id,

        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }

        $upadesubscription = BoostPackage::find($request->id);            
        $upadesubscription->boost_title = $request->boost_title_edit;
        $upadesubscription->boost_package = $request->boost_package_edit;
        $upadesubscription->duration = $request->duration;
        // $upadesubscription->price = $request->duration == 90 ? $request->price*3 : ($request->duration == 180 ? $request->price*6 : ($request->duration == 270 ? $request->price*9 : $request->price*12  ));
        $upadesubscription->price = $request->price;
        $upadesubscription->type = $request->type ? 1 : 0;                
        $upadesubscription->update();
        // return redirect()->back()->with('status','upadesubscription upadeed Successfully');

        if ($upadesubscription) {

            return response()->json(array('status' => true, 'msg' => "Successfully Updated", 'location' => url('admin/boost-package-index')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }


    // method use for delete boost package
    public function deleteBoostPackage(Request $request)
    {
        
        $boostPckge = BoostPackage::find($request->id);
        if($boostPckge)
        {
            $boostPckge->delete();
            return response()->json(array('status' => true, 'msg' => "Successfully Deleted"));
            exit;
        }
        else
        {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }

}
