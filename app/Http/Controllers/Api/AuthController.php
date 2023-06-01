<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function userRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }

        $user = User::create([
            'first_name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',]);
    }

    public function registerWithPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_no' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }

        $user = User::where('phone', $request->mobile_no)->first();
        
        if (empty($user)) {
            $newCreate = User::create([
                'phone' => $request->mobile_no,
            ]);
            
            if($newCreate){    
                $userOtp = new UserOtp();        
                $save = ([
                    'user_id' => $newCreate->id,
                    'phone' => $newCreate->phone,
                    'otp' => rand(123456, 999999),
                    
                ]);
                $result = $userOtp->fill($save)->save();
                if($result){
                return response()->json(['status' => true, 'message'=>'New Otp Generated successfully', 'data'=>$save]);
                }else{
                    return response()->json(['status'=>false, 'message'=> 'Something Went Wrong!!', 'data', '']);
                }
            }
        }else{

            $find = UserOtp::where('user_id',$user->id)->first();
            
              $fill= [
                    'user_id' => $user->id,
                    'phone' =>  $user->phone,
                    'otp' => rand(123456, 999999),
                    
                ];
                $update = $find->update($fill);
                if($update){
                    return response()->json(['status' => true, 'message'=>'Otp Generated successfully', 'data'=>$fill]);
                }else{
                    return response()->json(['status' => true, 'message'=>'Something Went Wrong!!', 'data'=>""]);
                }       
        }

            /* User Does not Have Any Existing OTP */
            // $userOtp = UserOtp::where('user_id', $user->id)->latest()->first();
            
            // $now = now();

            // if ($userOtp && $now->isBefore($userOtp->expire_at)) {
            //     return  response()->json(['status' => true, 'data' => $userOtp]);
            // }
        
            
            // $now = now();
            
            /* Create a New OTP */
            // $save =  UserOtp::create([
            //     'user_id' => $user->id,
            //     'otp' => rand(123456, 999999),
            //     'expire_at' => $now->addMinutes(10)
            // ]);
            // return response()->json(['status' => true, 'message' => 'Success', 'data' => $save]);
        
    }

    public function loginWithOtp(Request $request)
    {  
        // dd(Auth::user());
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'otp' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }
        /* Validation Logic */
        $userOtp   = UserOtp::where('user_id', $request->user_id)->where('otp', $request->otp)->first();
  
        $now = now();
        if (!$userOtp) {
            return response()->json (['status'=>false,'message'=> 'Your OTP is not correct','data' =>'']);
        }
        // else if($userOtp && $now->isAfter($userOtp->expire_at)){
        //     return response()->json (['status'=>false, 'message' =>'Your OTP has been expired']);
        // }
    
        $user = User::whereId($request->user_id)->first();
        
  
        if($user){
            
            if ($request->otp == $userOtp->otp) {
                $success['api_token'] =  $user->createToken('MyApp')->plainTextToken;
                return response()->json(['status'=>true , 'message'=> 'Account Verified Successfully', 'data'=>$success ]);
            }else{

                return response()
                    ->json(['message' => 'Unauthorized'], 401);
            }
  
            // Auth::login($user);
  
            // return response()->json(['status'=>true , 'message'=> 'Account Verified Successfully', ]);
        }
  
        return response()->json (['status'=>false,'message'=> 'Your OTP is not correct','data' =>'']);
    }


    // method use for resend otp
    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_no' => 'required|exists:users,phone',           
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }
        $user = User::where('phone', $request->mobile_no)->first();
        if($user){
        
        $find = UserOtp::where('user_id',$user->id)->first();
                
            $fill= [                
                'phone' =>  $user->phone,
                'otp' => rand(123456, 999999),                
            ];
            $update = $find->update($fill);
            if($update){
                return response()->json(['status' => true, 'message'=>'Otp Generated successfully', 'data'=>$fill]);
            }else{
                return response()->json(['status' => true, 'message'=>'Something Went Wrong!!', 'data'=>""]);
            }
        }       
    }


    public function socialLoginType(Request $request)
    {
        $rule = [
            'uid' => 'required',
            'type' => 'required',
            'name' => 'required',
            'email' => 'email'
        ];

        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'data' => []
            ]);
        }

        $type = strtolower($request->type);

        if ($type === 'facebook') {
            $type_field = 'facebook_id';
        } else if ($type === 'google') {
            $type_field = 'google_id';
        } else if ($type === 'mobile') {
            $type_field = 'phone';
        }  else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Login type: facebook|google|mobile',
                'data' => []
            ]);
        }

        // Check if user exists with email and if already exists then attach social id, and generate token for login.
        if (!empty($request->email)) {
            $emailUser = User::where('email', $request->email)->first();

            if ($emailUser) {
                $emailUser->update([$type_field => $request->uid]);

                $token = $emailUser->createToken('token')->plainTextToken;
                return response()->json([
                    'status' => true,
                    'message' => 'Success!!!',
                    'data' => array(
                        'user_id' => $emailUser->id,
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                    )
                ]);
            }
        }

        // Check if user exists with uid and if already exists then just login.
        $uidUser = User::where($type_field, $request->uid)->first();
        if ($uidUser) {
            $token = $uidUser->createToken('token')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Success!!!',
                'data' => array(
                    'user_id' => $uidUser->id,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                )
            ]);
        }

        // If user doesn't exist then register user to system:
        $save = new User();

        $save->first_name = $request->name;
        $save->{$type_field} = $request->uid;
        if (!empty(($request->email))) {
            $save->email = $request->email;
        }

        $result = $save->save();
        if ($result) {
            $token = $save->createToken('token')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Success!!!',
                'data' => array(
                    'user_id' => $save->id,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                )
            ]);
        }

        return response()->json(['status' => false, 'message' => 'Something Went Wrong', 'data' => []]);
    }
}
