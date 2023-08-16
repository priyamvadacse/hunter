<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LikeStatus;
use App\Models\User\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        }
        
        $user->pic1  = $favicon;
        $user->email = $request->email;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->interested_in = $request->interested_in;
        $user->interested_age = $request->interestedAge;
        $user->distance = $request->distance;
        $user->relationship_type = $request->relationship_type;
        $user->update();
        // return redirect()->back()->with('status','User Added Successfully');

        if ($user) {

            return response()->json(array('status' => true, 'msg' => "Successfully Updated"));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
        
    }

    // method use for get user profile
    public function getProfile(){
        $userId = Auth::user()->id;
        $data = User::where('id', $userId)->first();
        if($data)
        {
            return response()->json(array('status' => true, 'msg' => 'Success', 'data' => $data));
        }
        else
        {
            return response()->json(array('status' => false, 'msg' => 'User does not exist', 'data' => []));
        }

    }

    // method use for get match nearby locations
    public function getMatchNearbyLocation(Request $request)
    {
        $lat = $request->get('lat');
        $lng = $request->get('lng');
        
        $radius = 6371; // Earth's radius in kilometers
        
        // Calculate the distance using the Haversine formula and retrieve user details
        $results = User::select('id',  'first_name','last_name','dob', 'email' , 'gender', 'pic1','latitude', 'longitude',)
            ->selectRaw("(2 * $radius * ASIN(SQRT(POWER(SIN((latitude - $lat) * PI() / 180 / 2), 2) + COS(latitude * PI() / 180) * COS($lat * PI() / 180) * POWER(SIN((longitude - $lng) * PI() / 180 / 2), 2)))) AS distance")
            ->orderBy('distance')
            ->get()
            ->map(function ($user) {
                $user->distance = round($user->distance, 2);
                return $user;
            });
        
        return response()->json(['status' => true, 'message' => 'Success', 'data' => $results]);
    }
    
    // method use for save or update like api
    public function likeApiSave(Request $request)
    {
          // Retrieve the authenticated user
          $user = Auth::user();
        //   dd($user);

          $find = LikeStatus::where(['like_id'=> $request->like_id, 'user_id'=>$user->id])->first();
          
          if($find){
            return response()->json(['status'=>false, 'message' => 'You have already liked',]);
          }

          // Create a new cart item with the image and user relationship
          $cartItem = new LikeStatus();
          $cartItem->user_id = $user->id;
          $cartItem->like_id = $request->like_id;
          $cartItem->status = '1';
          $cartItem->save();
  
          // Return a response indicating success
          return response()->json(['status'=>true, 'message' => 'Like successfully', 'data'=>$cartItem]);
        
    }

    // method use for get liked list
    public function getLikedList(Request $request)
    {
        $user = Auth::user();
        $getlike = LikeStatus::select('like_statuses.*', 'users.first_name','users.last_name','users.pic1','users.gender','users.dob', 'users.latitude','users.longitude')
        ->join('users', 'like_statuses.like_id' ,'=','users.id')
        ->where(['user_id'=>$user->id, 'like_statuses.status'=>'1'])->get();
        return response()->json(['status'=>true, 'message' => 'Success', 'data'=>$getlike]);
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

        $validator = Validator::make($request->all(),$rules,$customs);

        if($validator->fails())
        {
            return response()->json(array('status' => false ,'msg' => $validator->errors()->first()));
        }
        else
        {
            $user = Auth::user();
            if(LikeStatus::where(['like_id' => $request->like_id, 'user_id' => $user->id])->first())
            {
                $delete = LikeStatus::where(['like_id' => $request->like_id, 'user_id' => $user->id])->delete();

                if($delete)
                {
                    return response()->json(array('status' => true ,'msg' => "Deleted from like list"));
                }
                else
                {
                    return response()->json(array('status' => false ,'msg' => "Something went wring, please try again"));
                }
            }
            else
            {
                return response()->json(array('status' => false ,'msg' => "Invalid Request"));
            }
        }
    }

    public function paymentCheck(Request $request)
    {
        print_r($request);
        exit;

        // $response = json_decode($request);
    }
    
}
