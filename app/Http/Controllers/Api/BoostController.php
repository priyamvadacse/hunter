<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\BoostPackage;
use Illuminate\Http\Request;

class BoostController extends Controller
{
    //method use for  get boost package
    public function getBootsPackage()
    {
        $getboostpck = BoostPackage::all();
        return response()->json(['status'=>true, 'message'=>'success', 'data'=>$getboostpck]);
    }

}
