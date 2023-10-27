<?php

namespace App\Http\Controllers\Admin\kyc;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kyc;
use App\Models\User\User;
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

  public function kycVerifiedAjax(Request $request)
  {
    if (isset($_GET['search']['value'])) {
      $search = $_GET['search']['value'];
    } else {
      $search = '';
    }
    if (isset($_GET['length'])) {
      $limit = $_GET['length'];
    } else {
      $limit = 10;
    }

    if (isset($_GET['start'])) {
      $ofset = $_GET['start'];
    } else {
      $ofset = 0;
    }

    $orderType = $_GET['order'][0]['dir'];
    $nameOrder = $_GET['columns'][$_GET['order'][0]['column']]['name'];

    $searchKeyword = $search;

    $storydata = User::select('first_name', 'last_name', 'image_verification', 'pic1', 'email', 'phone')
      ->where(['mobile_verified' => 'Yes', 'email_verified' => 'Yes', 'verify_image' => 'Yes', 'status' => 'ACTIVE'])
      ->where(function ($query) use ($searchKeyword) {
        $query->where('id', 'LIKE', "%{$searchKeyword}%")
          ->orWhere('first_name', 'LIKE', "%{$searchKeyword}%")
          ->orWhere('last_name', 'LIKE', "%{$searchKeyword}%")
          ->orWhere('email', 'LIKE', "%{$searchKeyword}%")
          ->orWhere('phone', 'LIKE', "%{$searchKeyword}%");
      });

    $total = $storydata->count();
    $category = $storydata->offset($ofset)->limit($limit)->orderBy($nameOrder, $orderType)->get();

    $i = 1 + $ofset;
    $data = [];

    foreach ($category as $cate) {

      // $status = '<button class="statusVerifiedClick btn ' . ($cate->status == 'ACTIVE' ? "btn-success btn-sm" : "btn-danger btn-sm") . '  " data-status="' . ($cate->status == 'ACTIVE'  ? 'INACTIVE' : 'ACTIVE') . '" data-id="' . $cate->id . '">' . ($cate->status == 'ACTIVE' ? "ACTIVE" : "INACTIVE") . '</button>';
      $data[] = array(
        $i++,
        $cate->first_name . ' ' . $cate->last_name,      
        '<img class="img-fluid" src="' . asset($cate->image_verification) . '"  width="70px;">',
        $cate->email,
        $cate->phone,
        'Verified <i class="zmdi zmdi-check"></i>'
        


      );
    }
    $records['recordsTotal'] = $total;
    $records['recordsFiltered'] =  $total;
    $records['data'] = $data;
    echo json_encode($records);
  }

  public function kycUnverifiedAjax(Request $request)
  {
    if (isset($_GET['search']['value'])) {
      $search = $_GET['search']['value'];
    } else {
      $search = '';
    }
    if (isset($_GET['length'])) {
      $limit = $_GET['length'];
    } else {
      $limit = 10;
    }

    if (isset($_GET['start'])) {
      $ofset = $_GET['start'];
    } else {
      $ofset = 0;
    }

    $orderType = $_GET['order'][0]['dir'];
    $nameOrder = $_GET['columns'][$_GET['order'][0]['column']]['name'];

    $searchKeyword = $search;

    $storydata = User::select('first_name', 'last_name', 'image_verification', 'email', 'phone')
      ->where(['mobile_verified' => 'No', 'email_verified' => 'No', 'verify_image' => 'No', 'status' => 'ACTIVE'])
      ->where(function ($query) use ($searchKeyword) {
        $query->where('id', 'LIKE', "%{$searchKeyword}%")
          ->orWhere('first_name', 'LIKE', "%{$searchKeyword}%")
          ->orWhere('last_name', 'LIKE', "%{$searchKeyword}%")
          ->orWhere('email', 'LIKE', "%{$searchKeyword}%")
          ->orWhere('phone', 'LIKE', "%{$searchKeyword}%");
      });

    $total = $storydata->count();
    $category = $storydata->offset($ofset)->limit($limit)->orderBy($nameOrder, $orderType)->get();

    $i = 1 + $ofset;
    $data = [];

    foreach ($category as $cate) {
      $dummyImageURL = url('public/front/images/kyc/dummy_man.png');
      $imageURL = !empty($cate->image_verification) ? asset($cate->image_verification) : $dummyImageURL;

      $data[] = array(
        $i++,
        $cate->first_name . ' ' . $cate->last_name,      
        '<img class="img-fluid" src="' . $imageURL . '" width="70px;">',
        // '<img class="img-fluid" src="' . asset($cate->image_verification) . '"  width="70px;">',
        $cate->email,
        $cate->phone,
        'Unverified <i class="zmdi zmdi-close"></i>'
        


      );
    }
    $records['recordsTotal'] = $total;
    $records['recordsFiltered'] =  $total;
    $records['data'] = $data;
    echo json_encode($records);
  }
}
