<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\BoostPackage;
use App\Models\Admin\SubscriptionPackage;
use App\Models\BoostPlan;
use App\Models\Feedback;
use App\Models\LikeStatus;
use App\Models\Offer;
use App\Models\PaymentTransaction;
use App\Models\User\User;
use App\Models\UserImage;
use App\Models\UserPlan;
use DateTime;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Razorpay\Api\Api;

use function PHPSTORM_META\elementType;

class UserApiController extends Controller
{
    //method use for user update profile
    public function updateProfile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // 'user_id' => 'required|exists:users,id',
            "first_name" => 'required',
            "gender" => 'required',
            // "lastName"=> 'required',
            "dob" => 'required',
            "interested_in" => 'required',
            // "interests" => 'required',
            // "latitude" => 'required',
            // "longitude" => 'required',
            // "profilePhoto" => 'required',
            // "interestedAge" => 'required',
            // "distance" => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }

        $userId = Auth::user()->id;
        $user = User::find($userId);
        // dd($user);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if ($request->file('profilePhoto') != "") {
            $favicon = uniqid(time()) . '.' . $request->profilePhoto->extension();
            $request->profilePhoto->move(public_path('assets/user/assets/img/'), $favicon);
            $favicon = "/assets/user/assets/img/" . $favicon;
        } else {
            $favicon = Null;
        }

        $user->pic1  = $favicon;
        // $user->email = $request->email;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->interested_in = $request->interested_in;
        $user->interested_min_age = $request->interested_min_age;
        $user->interested_max_age = $request->interested_max_age;
        $user->distance = $request->distance;
        $user->relationship_type = $request->relationship_type;
        $user->update();
        // return redirect()->back()->with('status','User Added Successfully');

        if ($user) {
            // dd('hello');
            $datam = [
                'screen' => "newlead",
                'params' => [
                    'refresh' => true
                ]
            ];
            $this->sendNotification($userId, 'Register', 'Congratulations,Your profile is updated Successfully ', 'user', $datam);

            return response()->json(array('status' => true, 'msg' => "Successfully Updated"));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }

    // method use for get user profile
    public function getProfile()
    {
        $userId = Auth::user()->id;
        $data = User::where('id', $userId)->first();
        if ($data) {
            return response()->json(array('status' => true, 'msg' => 'Success', 'data' => $data));
        } else {
            return response()->json(array('status' => false, 'msg' => 'User does not exist', 'data' => []));
        }
    }


    // method use for get match nearby locations
    public function getMatchNearbyLocation(Request $request)
    {
        $lat = $request->get('lat');
        $lng = $request->get('lng');

        $loggedInUserId = Auth::user()->id;

        $radius = 6371; // Earth's radius in kilometers

        // Calculate the distance using the Haversine formula and retrieve user details
        $results = User::select('users.*')
        ->selectRaw("(2 * $radius * ASIN(SQRT(POWER(SIN((latitude - $lat) * PI() / 180 / 2), 2) + COS(latitude * PI() / 180) * COS($lat * PI() / 180) * POWER(SIN((longitude - $lng) * PI() / 180 / 2), 2)))) AS distance")
        ->leftJoin('boost_plans', 'users.id', '=', 'boost_plans.user_id')
        ->where('users.id', '!=', $loggedInUserId)
        ->orderByRaw('CASE WHEN boost_plans.user_id IS NOT NULL THEN 0 ELSE 1 END, distance')
        ->paginate(10)
        ->map(function ($user) {
            $user->distance = round($user->distance, 2);
            $user->age = now()->diffInYears($user->dob);
            return $user;
        });


        return response()->json(['status' => true, 'message' => 'Success', 'data' => $results]);
    }


    // method use for save or update like api
    public function likeApiSave(Request $request)
    {

        $currentDate = Carbon::today();
        $user = Auth::user();

        $likesCount = LikeStatus::where('user_id', $user->id)
            ->whereDate('created_at', $currentDate)
            ->count();

        $find = LikeStatus::where(['like_id' => $request->like_id, 'user_id' => $user->id])
            ->first();

        if ($find) {
            return response()->json(['status' => false, 'message' => 'You have already liked']);
        }

        $check = UserPlan::where('user_id', $user->id)->first();
        
        if (!empty($check)) {

            if (!$check) {
                return response()->json(['status' => false, 'message' => 'You are not subscribed to any package']);
            }

            $maxLikesPerDay = $check->like;
            
            if ($maxLikesPerDay == 'Unlimited') {

                // Create a new like status with the user and like relationship
                $likeStatus = new LikeStatus();
                $likeStatus->user_id = $user->id;
                $likeStatus->like_id = $request->like_id;
                $likeStatus->status = '1';
                $likeStatus->save();
                $datam = [
                    'screen' => "newlead",
                    'params' => [
                        'refresh' => true
                    ]
                ];
                $this->sendNotification($request->like_id, 'Like', 'Congratulations,Like successfully ', 'user', $datam);
    
                return response()->json(['status' => true, 'message' => 'Like successfully', 'data' => $likeStatus]);
            }

            if ($likesCount >= $maxLikesPerDay) {
                return response()->json(['status' => false, 'message' => 'You have reached the maximum ' . $maxLikesPerDay . ' limit of likes for today']);
            }


            // Create a new like status with the user and like relationship
            $likeStatus = new LikeStatus();
            $likeStatus->user_id = $user->id;
            $likeStatus->like_id = $request->like_id;
            $likeStatus->status = '1';
            $likeStatus->save();
            $datam = [
                'screen' => "newlead",
                'params' => [
                    'refresh' => true
                ]
            ];
            $this->sendNotification($request->like_id, 'Like', 'Congratulations,Like successfully ', 'user', $datam);

            return response()->json(['status' => true, 'message' => 'Like successfully', 'data' => $likeStatus]);
        } else {

            if ($likesCount >= 20) {
                return response()->json(['status' => false, 'message' => 'You have reached the maximum 20 limit of likes for today']);
            }

            $likeStatus = new LikeStatus();
            $likeStatus->user_id = $user->id;
            $likeStatus->like_id = $request->like_id;
            $likeStatus->status = '1';
            $likeStatus->save();

            return response()->json(['status' => true, 'message' => 'Like successfully', 'data' => $likeStatus]);
        }
    }

    // method use for get liked list
    public function getLikedList(Request $request)
    {
        $user = Auth::user();
        $getlike = LikeStatus::select('like_statuses.*', 'users.first_name', 'users.last_name', 'users.pic1', 'users.gender', 'users.dob', 'users.latitude', 'users.longitude')
            ->join('users', 'like_statuses.like_id', '=', 'users.id')
            ->where(['user_id' => $user->id, 'like_statuses.status' => '1'])->get();
        return response()->json(['status' => true, 'message' => 'Success', 'data' => $getlike]);
    }

    // method use for get user details
    public function getUserDetails($id)
    {
        $getUserDetails = User::where('id', $id)->first();
        if (!empty($getUserDetails)) {

            return response()->json(['status' => true, 'message' => 'success', 'data' => $getUserDetails]);
        } else {
            return response()->json(['status' => false, 'message' => 'Data Not Found !!', 'data' => '']);
        }
    }



    // merhod use for delete in likes list
    public function deleteLike(Request $request)
    {
        $rules = [
            'like_id' => 'required|exists:like_statuses,like_id',
        ];

        $customs = [

            'like_id.required' => 'Like ID is required',
            'like_id.exists' => "Like ID does not exist",
        ];

        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
        } else {
            $user = Auth::user();
            if (LikeStatus::where(['like_id' => $request->like_id, 'user_id' => $user->id])->first()) {
                $delete = LikeStatus::where(['like_id' => $request->like_id, 'user_id' => $user->id])->delete();

                if ($delete) {
                    return response()->json(array('status' => true, 'msg' => "Deleted from like list"));
                } else {
                    return response()->json(array('status' => false, 'msg' => "Something went wring, please try again"));
                }
            } else {
                return response()->json(array('status' => false, 'msg' => "Invalid Request"));
            }
        }
    }

    // get package

    public function getPackage()
    {
        $packages = SubscriptionPackage::all();
        $today = date('Y-m-d');
        $packageIds = $packages->pluck('id')->toArray();
        $offers = \App\Models\Offer::whereIn('package_id', $packageIds)->get();

        $packages = $packages->map(function ($package) use ($offers, $today) {
            $offer = $offers->where('package_id', $package->id)->first();
            if ($offer) {
                $discountedPrice = $package->monthly_price - ($package->monthly_price * ($offer->price / 100));
                if($offer->type == 'pr'){
                    $percentage = $offer->price;
                    $percentage = rtrim($percentage, '%'); // Remove the percentage symbol
                    $percentage = (float) $percentage; // Convert the string to a float
                    $percentage = number_format($percentage, 0); // Format the float to remove decimal places
                    $package->off = $percentage . '% off';

                    // $package->off = $offer->price . "%";
                    
                }else{
                    $package->off = $offer->price; 
                }

                $package->offer_price =  number_format($discountedPrice, 0);
                $package->has_offer = true;

                // Check if the offer is valid until the current date
                $expireDate = strtotime($offer->expire_date); // Convert the expire_date to a timestamp
                $isOfferValid = ($expireDate >= strtotime($today));
                $package->is_offer_valid = $isOfferValid;
            } else {
                $package->has_offer = false;
            }
            return $package;
        });

        return response()->json(['status' => true, 'message' => 'Success', 'data' => $packages]);
    }

    // method use for active package
    public function activePackage(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'package_id' => 'required|exists:subscription_packages,id',

        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['status' => false, 'message' => $validator->errors()]);
        // }

        $user = Auth::user();
        if ($request->package_id) {

            $checkPlan = UserPlan::where('user_id', $user->id)->first();
            if ($checkPlan) {
                return response()->json(['status' => false, 'message' => 'you have already take a plan']);
            } else {

                $getPackage = SubscriptionPackage::where('id', $request->package_id)->first();

                $currentDateTime = Carbon::now();
                $formattedDateTime = $currentDateTime->format('Y-m-d');

                $futureDate = $currentDateTime->addMonths($getPackage->duration);

                $futureDateTime = $futureDate->format('Y-m-d');

                // $futureYear = $futureDate->format('Y');
                // $futureDay = $futureDate->format('d');

                // $val= "The date 8 months from now will be: " . $futureMonth . " " . $futureDay . ", " . $futureYear;            
                // dd($val);            

                $randomNumber = time();
                $activePlan = new UserPlan();
                $activePlan->user_id = $user->id;
                $activePlan->package_id = $request->package_id;
                $activePlan->order_number = 'order_no' . $randomNumber;
                $activePlan->package_amount = $request->amount;
                $activePlan->package_active_date = $formattedDateTime;
                $activePlan->package_expire_date = $futureDateTime;
                $activePlan->package_duration = $getPackage->duration;
                $activePlan->boost_avail = $getPackage->boost;
                $activePlan->like = $getPackage->like;
                $activePlan->package_status = 'Active';
                $results = $activePlan->save();

                if ($results) {
                    $input = $request->all();
                    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                    $payment = $api->payment->fetch($input['razorpay_payment_id']);
                    $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                    $transaction = new PaymentTransaction();
                    $transaction->user_id =  $activePlan->user_id;
                    $transaction->package_id =  $activePlan->package_id;
                    $transaction->r_payment_id =  $input['razorpay_payment_id'];;
                    $transaction->method =  'online';
                    $transaction->currency =  'INR';
                    $transaction->amount =  $activePlan->package_amount;
                    $transaction->json_response =  json_encode((array)$response);

                    $transaction->save();
                    // $transaction->user_id =  $activePlan->user_id;
                    return response()->json(['status' => true, 'message' => 'Success', 'Data' => $activePlan]);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something Went Wrong!!', 'data' => '']);
                }
            }
        } elseif ($request->boost_id) {

            $checkPlan = BoostPlan::where('user_id', $user->id)->first();
            if ($checkPlan) {
                return response()->json(['status' => false, 'message' => 'you have already take a plan']);
            }
            $getBoostPackage = BoostPackage::where('id', $request->boost_id)->first();
            $randomNumber = time();
            $boostPlan = new BoostPlan();
            $boostPlan->user_id = $user->id;
            $boostPlan->boost_id = $request->boost_id;
            $boostPlan->order_number = 'orderno_' . $randomNumber;
            $boostPlan->boost_package_amount = $request->amount;
            // $boostPlan->package_active_date = $formattedDateTime;
            // $boostPlan->package_expire_date = $futureDateTime;
            // $boostPlan->boost_package_duration = $getBoostPackage->boost_package;
            $boostPlan->boost_available = $getBoostPackage->boost_package;
            $boostPlan->boost_status = 'Active';

            $results = $boostPlan->save();

            if ($results) {
                $input = $request->all();
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $payment = $api->payment->fetch($input['razorpay_payment_id']);
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                $transaction = new PaymentTransaction();
                $transaction->user_id =  $boostPlan->user_id;
                $transaction->boost_id =  $boostPlan->boost_id;
                $transaction->r_payment_id =  $input['razorpay_payment_id'];
                $transaction->method =  'online';
                $transaction->currency =  'INR';
                $transaction->amount =  $boostPlan->boost_package_amount ;
                $transaction->json_response =  json_encode((array)$response);

                $transaction->save();
                // $transaction->user_id =  $activePlan->user_id;
                return response()->json(['status' => true, 'message' => 'Success', 'Data' => $boostPlan]);
            } else {
                return response()->json(['status' => false, 'message' => 'Something Went Wrong!!', 'data' => '']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong!!', 'data' => '']);
        }
    }

    //method use for check my subscription
    public function checkMySubscription(Request $request)
    {
        $user = Auth::user();
        $getActivePackage = UserPlan::where(['user_id' => $user->id, 'package_status' => 'ACTIVE'])->get();

        return response()->json(['status' => true, 'message' => 'success', 'data' => $getActivePackage]);
    }



    // method use for search by user name 
    public function userSearchByname(Request $request, $username)
    {

        $name = $username;

        $users = User::where('first_name', 'like', '%' . $name . '%')
            ->get();
        if ($users->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'User not found']);
        }
        return response()->json(['status' => true, 'message' => 'success', 'data' => $users]);
    }

    //method use for get user list
    public function userList()
    {
        $authUser = Auth::user();
        
        $lat = $authUser->latitude;
        $lng = $authUser->longitude;

        $radius = 6371;
        $minAge = $authUser->interested_min_age; // Minimum age condition
        $maxAge = $authUser->interested_max_age; // Maximum age condition

        $users = DB::table('users')->select('users.*')
            ->selectRaw("(2 * $radius * ASIN(SQRT(POWER(SIN((latitude - $lat) * PI() / 180 / 2), 2) + COS(latitude * PI() / 180) * COS($lat * PI() / 180) * POWER(SIN((longitude - $lng) * PI() / 180 / 2), 2)))) AS distance")
            ->where('id', '!=', $authUser->id)
            ->orderBy('dob', 'desc')
            // ->orderBy('distance')
            ->get();

        $usersWithAge = $users->map(function ($user) use ($minAge, $maxAge) {

            $user->distance = round($user->distance, 2);
            $dob = Carbon::parse($user->dob);
            $age = $dob->age;

            if ($age >= $minAge || $age <= $maxAge) {
                $user->age = $age;
                $user->images = UserImage::where('user_id', $user->id)->get();
                return $user;
            }

            return null;
        })->filter(); // Filter out null values

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $usersWithAge,
        ]);
    }


    // multipale image save 
    public function multiImgeStore(Request $request)
    {

        $rules = [
            'images' => 'required',
        ];
        $customs = [

            'images.required' => 'Images are required',
            // 'images.mimes' => "Only JPEG, JPG and PNG are allowed"
        ];

        $validator = Validator::make($request->all(), $rules, $customs);
        // dd($validator);
        if ($validator->fails()) {
            return response()->json(array('status' => false, 'message' => $validator->errors()));
            exit;
        } else {
            if ($request->hasFile('images')) {
                $affected = false;
                foreach ($request->images as $images) {
                    $gallery = new UserImage();
                    $id = Auth::user()->id;
                    $imageName = uniqid($id) . '.' . $images->extension();
                    $images->move(public_path('assets/multi_img'), $imageName);
                    $input['image_path'] = "/assets/multi_img/" . $imageName;
                    $input['title'] = $request->title;
                    $input['user_id'] = $id;
                    $affected = $gallery->fill($input)->save();
                }
                if ($affected) {
                    return response()->json(array('status' => true, 'message' => "Gallery Images Uploaded Successfully"));
                } else {
                    return response()->json(array('status' => false, 'message' => "Something went wrong, please try again"));
                }
            } else {
                return response()->json(array('status' => false, 'message' => "Something went wrong, please try again!"));
            }
        }
    }


    //fetch user  images
    public function fetchUserImages(Request $request)
    {
        $user_id = Auth::User()->id;

        $userImg = UserImage::where('user_id', $user_id)->get();

        return response()->json(array('status' => true, 'message' => "Success", 'data' => [
            'images' => $userImg,
            'url' => url('/') . '/'
        ]));
    }


    // user apply fillter
    public function applyFillter(Request $request)
    {
        $latitude = $request->input('latitude'); // User's latitude
        $longitude = $request->input('longitude'); // User's longitude
        $radius = $request->input('radius');
        $interest = $request->input('interested_in');
        $query = User::query();

        if ($request->has('min_age')) {
            $minAge = $request->input('min_age');
            $minDob = now()->subYears($minAge)->format('Y-m-d');
            $query->where('dob', '<=', $minDob);
        }

        if ($request->has('max_age')) {
            $maxAge = $request->input('max_age');
            $maxDob = now()->subYears($maxAge + 1)->format('Y-m-d');
            $query->where('dob', '>', $maxDob);
        }

        if ($request->has('interested_in')) {
            $query->where('gender', $request->input('interested_in'));
        }

        $query->selectRaw(
            'users.*,
            (6371 * acos(cos(radians(?)) *
            cos(radians(latitude)) *
            cos(radians(longitude) - radians(?)) +
            sin(radians(?)) *
            sin(radians(latitude))))
            AS distance',
            [$latitude, $longitude, $latitude]
        )->where('id', '!=', Auth::user()->id)
            ->having('distance', '<', $radius)
            ->orderBy('distance', 'ASC')
            ->orderBy('dob', 'ASC'); // Order by age in ascending order

        $users = $query->simplePaginate(10);

        $updatedUsers = $users->map(function ($user) {
            $dob = Carbon::parse($user->dob);
            $age = $dob->diffInYears(now());            
            $user->age = $age;
            $user->images = UserImage::where('user_id', $user->id)->get();
            return $user;
        });

        if ($updatedUsers->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'Data Not Found'], 404);
        }

        return response()->json(['status' => true, 'message' => 'success', 'data' => $updatedUsers], 200);
    }


    // method use for user update profile
    public function userUpdateProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            // 'user_id' => 'required|exists:users,id',
            "first_name" => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userId)
            ],
            "dob" => 'required',
            'phone_no' =>  [
                'required',
                'numeric',

                Rule::unique('users', 'phone')->ignore($userId)
            ],
            "address"  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }

        $userId = Auth::user()->id;
        $user = User::find($userId);
        // dd($user);       

        if ($request->file('profilePhoto') != "") {
            $favicon = uniqid(time()) . '.' . $request->profilePhoto->extension();
            $request->profilePhoto->move(public_path('assets/user/assets/img/'), $favicon);
            $favicon = "/assets/user/assets/img/" . $favicon;
        } else {
            $favicon = $user->pic1;
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone_no;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->latitude =  isset($request->latitude) ? $request->latitude : $user->latitude;
        $user->longitude =  isset($request->longitude) ? $request->longitude : $user->longitude;
        $user->education = $request->education;
        $user->work = $request->work;
        $user->about = $request->about;
        $user->pic1 = $favicon;
        $user->update();

        if ($user) {

            return response()->json(array('status' => true, 'message' => "profile Updated", 'data' => $user));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again", 'data' => ''));
        }
    }

    // method use for get fillter data
   
    public function getFillterData(Request $request)
    {
        
        $latitude = $request->input('latitude'); // User's latitude
        $longitude = $request->input('longitude'); // User's longitude
        $radius = $request->input('radius');
        $interest = $request->input('interested_in');
        $query = User::query();

        if ($request->has('min_age')) {
            $minAge = $request->input('min_age');
            $minDob = now()->subYears($minAge)->format('Y-m-d');
            $query->where('dob', '<=', $minDob);
        }

        if ($request->has('max_age')) {
            $maxAge = $request->input('max_age');
            $maxDob = now()->subYears($maxAge + 1)->format('Y-m-d');
            $query->where('dob', '>', $maxDob);
        }

        if ($request->has('interested_in')) {
            $query->where('gender', $request->input('interested_in'));
        }

        $query->selectRaw(
            'users.*,
            (6371 * acos(cos(radians(?)) *
            cos(radians(latitude)) *
            cos(radians(longitude) - radians(?)) +
            sin(radians(?)) *
            sin(radians(latitude))))
            AS distance',
            [$latitude, $longitude, $latitude]
        )->where('id', '!=', Auth::user()->id)
            ->having('distance', '<', $radius)
            ->orderBy('distance', 'ASC')
            ->orderBy('dob', 'ASC'); // Order by age in ascending order

        $users = $query->get();

        $updatedUsers = $users->map(function ($user) {
            $dob = Carbon::parse($user->dob);
            $age = $dob->diffInYears(now());            
            $user->age = $age;
            $user->images = UserImage::where('user_id', $user->id)->get();
            return $user;
        });
      
        return response()->json(['status' => true, 'message' => 'success', 'data' => $updatedUsers], 200);
    }

    // check my subcription plan cron job
    public function subcriptionPlanExpire()
    {
        $userPlan = UserPlan::where('package_status', 'ACTIVE')->get();
        if (!empty($userPlan)) {

            $todayDate = Carbon::now();

            foreach ($userPlan as $plan) {
                $expired_date = $plan->package_expire_date;

                if ($todayDate >= $expired_date) {
                    $plan->package_status = 'inactive';
                    $plan->save();
                    return response()->json(array('status' => true, 'message' => "Your Plan has been expired"));
                } else {
                    return response()->json(array('status' => true, 'message' => "Your Plan expire on " . $expired_date));
                }
            }
        } else {
            return response()->json(array('status' => true, 'message' => "Your have no plan "));
        }
    }


    // method use for feedback send
    public function sendFeedback(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric',

        ]);

        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $feedback = new Feedback();
        $feedback->user_id = Auth::user()->id;
        $feedback->rating = $request->rating;
        $feedback->description = $request->message;
        $result = $feedback->save();

        // Return a success response
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Thank You For Feedback', 'data' => $feedback]);
        } else {
            return response()->json(['status' => false, 'message' => 'something went wrong!!']);
        }
    }

    // method use for get user like list
    public function getUserLike()
    {
        $getUserLike = LikeStatus::select('like_statuses.*', 'users.first_name','users.last_name', 'users.pic1 as image',
        'users.dob', 'users.gender', 'users.about', 'users.mobile_verified', 'users.email_verified','users.verify_image')
        ->join('users','like_statuses.user_id', '=', 'users.id')
        ->where('like_statuses.like_id', '=', Auth::user()->id)
        ->get();
        return response()->json(['status'=>true, 'message'=> 'success', 'data'=>$getUserLike]);
    }
    
    public function paymentCheck(Request $request)
    {
        print_r($request);
        exit;

        // $transaction = Transaction::where('transaction_id',$request->merchTxnId)->first();
        // if(!empty($transaction)){
        //     echo'success';exit;
        // } else {
        //     $new_transaction = new Transaction;
        //     $new_transaction->user_id = $request->merchId;
        //     $new_transaction->transaction_id = $request->merchTxnId;
        //     $new_transaction->amount = $request->amount;
        //     $new_transaction->sur_charge = $request->
        //     $new_transaction->total_amount = $request->surchargeAmount;
        //     $new_transaction->bank_transaction_id = $request->bankTxnId;
        //     $new_transaction->transaction_date = $request->merchTxnDate;
        //     $new_transaction->save(); 
        // }
        // // $response = json_decode($request);
    }

}
