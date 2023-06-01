<?php

namespace App\Http\Controllers\Admin\kyc;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kyc;
use Illuminate\Http\Request;

class KycController extends Controller
{
public function kycVerifiedlist()
{
    $verfied = Kyc::all();
    return view('admin.kyc.verified', compact('verfied'));
}
public function kycUnverifiedlist()
{
    return view('admin.kyc.unverified');
}

public function kycVerifiedAjax(Request $request){
 
  // return view('admin.kyc.Unverified');
}

}
