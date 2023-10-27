<?php

namespace App\Http\Controllers\Admin\payment;

use App\Http\Controllers\Controller;
use App\Models\Admin\BoostPackage;
use App\Models\Admin\SubscriptionPackage;
use App\Models\BoostPlan;
use App\Models\PaymentTransaction;
use App\Models\UserPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function paymentPage()
    {
        return view('admin.payment.payment');
    }

    public function paymentList()
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

        $category = DB::table('payment_transactions')
            ->select('payment_transactions.*', 'users.first_name', 'users.last_name')
            ->join('users', 'users.id', '=', 'payment_transactions.user_id')
            ->where(function ($query) use ($searchKeyword) {
                $query->where('users.id', 'LIKE', "%{$searchKeyword}%")
                    ->orWhere('users.first_name', 'LIKE', "%{$searchKeyword}%")
                    ->orWhere('users.last_name', 'LIKE', "%{$searchKeyword}%");
            })
            ->offset($ofset)
            ->limit($limit)
            ->orderBy($nameOrder, $orderType)
            ->get();

        $total = $category->count();

        $i = 1 + $ofset;
        $data = [];

        foreach ($category as $cate) {
            $url = route('admin.invoice', ['id' => $cate->id]);

            $package = NULL;
            if ($cate->package_id === null && $cate->boost_id === null) {
                // Handle the case when both package_id and boost_id are null
            } elseif ($cate->package_id === null) {
                $package = BoostPackage::select('boost_title')->where('id', $cate->boost_id)->first();
            } else {
                $package = SubscriptionPackage::select('package')->where('id', $cate->package_id)->first();
            }

            // Access the package name based on the condition
            $packageName = $package ? ($cate->package_id === null ? $package->boost_title : $package->package) : '';

            $data[] = array(
                $i++,
                $cate->first_name . ' ' . $cate->last_name,
                $packageName,
                Carbon::parse($cate->created_at)->format('Y-m-d'),
                $cate->r_payment_id,
                // $status,
                '<button class="btn btn-success btn-sm ">success</button>',
                '<a href=' . $url . ' class="btn btn-sm btn-primary text-white">View
                </a>',
                // '<a  href=' . $url . ' class="editCategory btn btn-info btn-sm "  data-id="' . $cate->id . '"><i class="zmdi zmdi-edit"></i></a> 
                //     <a href="#" class="btn btn-danger btn-sm delete_user" data-id="' . $cate->id . '"><i class="zmdi zmdi-delete"></i></a>',
                // $cate->created_at->format('y-m-d'),

            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        echo json_encode($records);
    }

    public function invoicesPage($id)
    {   
        
        $getiInvoice = DB::table('payment_transactions')
        ->select('payment_transactions.*', 'users.first_name', 'users.last_name', 'users.address', 'users.phone')
        ->join('users', 'users.id', '=', 'payment_transactions.user_id')        
        ->where('payment_transactions.id', $id)->first();
        // dd($getiInvoice);
        $package = NULL;
        if ($getiInvoice->package_id === null && $getiInvoice->boost_id === null) {
            // Handle the case when both package_id and boost_id are null
        } elseif ($getiInvoice->package_id === null) {
            
            $package = BoostPackage::select('boost_title', 'price', 'boost_package')->where('id', $getiInvoice->boost_id)->first();
        } else {
            $package = SubscriptionPackage::select('package', 'monthly_price' ,'price')->where('id', $getiInvoice->package_id)->first();
        }

        // Access the package name based on the condition
        $packageName = $package ? ($getiInvoice->package_id === null ? $package->boost_title : $package->package) : '';        
        
        return view('admin.payment.invoice', compact('getiInvoice','packageName', 'package'));
    }

    public function pendindList()
    {
        return view('admin.payment.pending');
    }
}
