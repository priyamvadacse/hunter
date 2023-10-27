<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function send_sms($mobile, $otp)
    {
        $user = User::where('phone', $mobile)->first();
        $name = !empty($user->first_name) ? $user->first_name : 'User';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://alerts.cbis.in/SMSApi/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "userid=jmdburo&password=MD@buro1&mobile=$mobile&msg=Hello $name, Your OTP code for verification is $otp. Please use this code within 10 minutes. If you did not request this code, please ignore this message. - JMD Marriage Bureau (Hunttr)&senderid=JMDMAB&msgType=text&dltEntityId=1701168698870006287&dltTemplateId=1707168743667283932&duplicatecheck=true&output=json&sendMethod=quick",
            CURLOPT_HTTPHEADER => array(
                "apikey: 8cd60cff5b320dac913ecf7e056c6f20f96b8ccc",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        // dd($response);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function registerWithPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_no' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }

        $user = User::where('phone', $request->mobile_no)->first();

        if (empty($user)) {
            $newCreate = User::create([
                'phone' => $request->mobile_no,
                'f_token' => $request->f_token,
            ]);

            if ($newCreate->phone == '9999999999') {
                $userOtp = new UserOtp();
                $save = ([
                    'user_id' => $newCreate->id,
                    'phone' => $newCreate->phone,
                    // 'otp' => rand(123456, 999999),
                    'otp' => 123456,

                ]);
                $result = $userOtp->fill($save)->save();
                $sms = json_decode($this->send_sms($newCreate->phone, $save['otp']));
                if ($sms->status == 'error') {
                    return response()->json(['status' => false, 'message' => 'OTP not sent. Please try again!']);
                }
                if ($result) {
                  return response()->json(['status' => true, 'message' => 'New Otp Generated successfully', 'data' => $save]);
                } else {
                    return response()->json(['status' => false, 'message' => 'Something Went Wrong!!', 'data', '']);
                }
            } else {

                if ($newCreate) {

                    $userOtp = new UserOtp();
                    $save = ([
                        'user_id' => $newCreate->id,
                        'phone' => $newCreate->phone,
                        'otp' => rand(123456, 999999),
                        // 'otp' => 123456,

                    ]);
                    $result = $userOtp->fill($save)->save();
                    $sms = json_decode($this->send_sms($newCreate->phone, $save['otp']));
                    if ($sms->status == 'error') {
                        return response()->json(['status' => false, 'message' => 'OTP not sent. Please try again!']);
                    }
                    if ($result) {
                    return response()->json(['status' => true, 'message' => 'New Otp Generated successfully', 'data' => $save]);
                    } else {
                        return response()->json(['status' => false, 'message' => 'Something Went Wrong!!', 'data', '']);
                    }
                }
            }
        } else {

            $find = UserOtp::where('user_id', $user->id)->first();

            if ($user->phone == '9999999999') {
                $fill = [
                    'user_id' => $user->id,
                    'phone' =>  $user->phone,
                    // 'otp' => rand(123456, 999999),
                    'otp' => 123456,

                ];

                $update = $find->update($fill);
                $sms = json_decode($this->send_sms($user->phone, $fill['otp']));
                if ($sms->status == 'error') {
                    return response()->json(['status' => false, 'message' => 'OTP not sent. Please try again!']);
                }
                if ($update) {
                    return response()->json(['status' => true, 'message' => 'Otp Generated successfully', 'data' => $fill]);
                } else {
                    return response()->json(['status' => true, 'message' => 'Something Went Wrong!!', 'data' => ""]);
                }
            } else {

                $fill = [
                    'user_id' => $user->id,
                    'phone' =>  $user->phone,
                    'otp' => rand(123456, 999999),
                    // 'otp' => 123456,

                ];

                $update = $find->update($fill);
                $sms = json_decode($this->send_sms($user->phone, $fill['otp']));
                if ($sms->status == 'error') {
                    return response()->json(['status' => false, 'message' => 'OTP not sent. Please try again!']);
                }
                if ($update) {
                    return response()->json(['status' => true, 'message' => 'Otp Generated successfully', 'data' => $fill]);
                } else {
                    return response()->json(['status' => true, 'message' => 'Something Went Wrong!!', 'data' => ""]);
                }
            }
        }
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
            return response()->json(['status' => false, 'message' => 'Your OTP is not correct', 'data' => '']);
        }
        // else if($userOtp && $now->isAfter($userOtp->expire_at)){
        //     return response()->json (['status'=>false, 'message' =>'Your OTP has been expired']);
        // }

        $user = User::whereId($request->user_id)->first();

        
        if ($user) {
            
            if ($request->otp == $userOtp->otp) {
                // dd($user);
                $datam = [
                    'screen' => "newlead",
                    'params' => [
                        'refresh' => true
                    ]
                ];
                $this->sendNotification($user->id, 'Register', 'Congratulations,Successfully Login', 'user', $datam);

                $success['api_token'] =  $user->createToken('MyApp')->plainTextToken;
                
                if ($user->mobile_verified !== 'Yes') {
                    $user->mobile_verified = 'Yes';
                    $user->mobile_otp = $request->otp;
                }
                
                if ($user->last_login_at === NULL) {
                    $user->last_login_at = now();
                    $user->save();
                    return response()->json(['status' => true, 'message' => 'Account Verified Successfully',  'data' => ['user_id' => $request->user_id, 'token' => $success, 'full_name' => $user->first_name]]);
                } else {
                    $user->last_login_at = now();
                    $user->save();
                    return response()->json(['status' => true, 'message' => 'login Successfully', 'data' => ['token' => $success, 'user_id' => $request->user_id, 'full_name' => $user->first_name]]);
                }
            } else {

                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Auth::login($user);
            // return response()->json(['status'=>true , 'message'=> 'Account Verified Successfully', ]);
        }
        

        return response()->json(['status' => false, 'message' => 'Your OTP is not correct', 'data' => '']);
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
        if ($user) {

            $find = UserOtp::where('user_id', $user->id)->first();

            $fill = [
                'phone' =>  $user->phone,
                'otp' => rand(123456, 999999),
                // 'otp' => 123456,
            ];
            $update = $find->update($fill);
            $sms = json_decode($this->send_sms($user->phone, $fill['otp']));
            if ($sms->status == 'error') {
                return response()->json(['status' => false, 'message' => 'OTP not sent. Please try again!']);
            }
            if ($update) {
                return response()->json(['status' => true, 'message' => 'Otp Generated successfully', 'data' => $fill]);
            } else {
                return response()->json(['status' => true, 'message' => 'Something Went Wrong!!', 'data' => ""]);
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
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Login type: facebook|google',
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
                        'exist' => 'true',
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
                    'exist' => 'just_login',
                )
            ]);
        }

        // If user doesn't exist then register user to system:
        $save = new User();

        $save->first_name = $request->name;
        $save->{$type_field} = $request->uid;
        $save->login_type =  $type;
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
                    'exist' => 'New Register'
                )
            ]);
        }

        return response()->json(['status' => false, 'message' => 'Something Went Wrong', 'data' => []]);
    }


    // method use for send otp on email for verification
    public function sendOtpEmail(Request $request)
    {

        $rules = [
            'email' => 'required|email'
        ];

        $custom = [
            'email.required' => "Email is required",
            'email.email' => "The Email must be a valid email address."
        ];

        $validator = Validator::make($request->all(), $rules, $custom);

        if ($validator->fails()) {
            return response()->json(array('status' => false, 'message' => $validator->errors()));
        }

        $userLogin = Auth::user();
        if (!empty($userLogin->email)) {
            if ($userLogin->email == $request->email) {
                $existingUser = User::where('email', $request->email)->first();

                if ($existingUser) {
                    // User found
                    $updateUser = $existingUser;

                    if ($updateUser->email_verified == 'Yes') {
                        return response()->json(array(
                            'status' => false,
                            'message' => 'Email is already verified.'
                        ));
                    }

                    $otp = rand(111111, 999999);
                    // $otp = 123456;
                    $updateUser->email_otp = $otp;
                    $updateUser->update();                    

                    $msg = '<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                    <div style="margin:50px auto;width:70%;padding:20px 0">
                      
                      <p style="font-size:1.1em">Hello ' . $updateUser->first_name . ',</p>
                      <p>Thank you for choosing Hunttr. Please use this verification code within 10 minutes . if you did not request this code, please ignore this message.  </p>
                      <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">' . $otp . '</h2>
                      <p style="font-size:0.9em;">Regards,<br />JMD Marrage Bureau(hunttr)</p>
                     
                    </div>
                  </div>';

                    $subject = "Email Verification Code";
                    
                    $this->sendMail($request->email, $msg, $subject);
                
                    return response()->json(array(
                        'status' => true,
                        'message' => 'OTP has been sent to your email. Please check your email.',
                        'data' => [
                            'otp' => $otp,
                            'mobile_otp' => '',
                            'email' => $updateUser->email,
                            'mobile' => $updateUser->phone,
                            'mobile_verified' => $updateUser->mobile_verified,
                            'email_verified' => $updateUser->email_verified,
                        ],
                    ));
                } else {
                    // User not found
                    // $newUser = new User();


                }
            } else {
                return response()->json(array(
                    'status' => false,
                    'message' => 'This email is already taken by another user.'
                ));
            }
        } else {
            $existingUser = User::where('id', $userLogin->id)->first();
            $otp = rand(111111, 999999);
            // $otp = 123456;
            $existingUser->email_otp = $otp;
            $existingUser->email = $request->email;
            // $existingUser->email_verified = ;
            $existingUser->save();

            // Generate and send OTP to the email
            $msg = '<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                    <div style="margin:50px auto;width:70%;padding:20px 0">
                      
                      <p style="font-size:1.1em">Hello ' . $existingUser->first_name . ',</p>
                      <p>Thank you for choosing Hunttr. Please use this verification code within 10 minutes . if you did not request this code, please ignore this message.  </p>
                      <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">' . $otp . '</h2>
                      <p style="font-size:0.9em;">Regards,<br />JMD Marrage Bureau(hunttr)</p>
                     
                    </div>
                </div>';

            $subject = "Email Verification Code";

            $this->sendMail($request->email, $msg, $subject);

            return response()->json(array(
                'status' => true,
                'message' => 'OTP has been sent to your email. Please check your email.',
                'data' => [
                    'email' => $existingUser->email,
                    'email_otp' => $otp,
                    'mobile' => '',
                    'mobile_verified' => $existingUser->mobile_verified,
                    'email_verified' => $existingUser->email_verified,
                ],
            ));
        }
    }

    // method use for verified email 
    public function emailVerified(Request $request)
    {
        $rules = [
            'email' => "required",
            'otp' => "required|numeric"
        ];

        $customs = [
            'email.required' => "Email is required",
            'otp.required' => "OTP is required",
            'otp.numeric' => "OTP has to be numeric value"
        ];

        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
            return response()->json(array('status' => false, 'message' => $validator->errors()));
        } else {

            $udata = User::where(['email' => $request->email])->first();

            if ($udata) {

                if ($udata['email_verified'] === "Yes") {
                    return response()->json(array('status' => false, 'message' => "Email already verified"));
                }

                if ($udata['email_otp'] == $request->otp) {
                    $udata['email_verified'] = "Yes";

                    $udata->update();

                    return response()->json(array(
                        'status' => true,
                        'message' => "Success",
                        'data' => [
                            'user_id' => $udata->id,
                            'email' => $udata->email,
                            'otp' => '',
                            'motp' => '',
                            'mobile' =>  $udata->phone,
                            'mobile_verified' => $udata->mobile_verified,
                            'email_verified' => $udata->email_verified,
                        ],
                    ));
                } else {

                    return response()->json(array('status' => false, 'message' => "OTP is incorrect"));
                }
            } else {
                return response()->json(array('status' => false, 'message' => "Email ID is incorrect"));
            }
        }
    }


    //method use for mobile number on send otp verified
    public function mobileOtpSend(Request $request)
    {
        $rules = [
            'mobile' => 'required|numeric'
        ];

        $custom = [
            'mobile.required' => "Mobile Number is required",
            'mobile.mumeric' => "Mobile Number has to be numeric value"
        ];

        $validator = Validator::make($request->all(), $rules, $custom);
        if ($validator->fails()) {
            return response()->json(array('status' => false, 'message'  => $validator->errors()));
            //   return response()->json(array('msg' => $validator->getMessageBag()->toArray()));
        }


        $input =  $request->all();
        $userLogin = Auth::user();
        if ($userLogin->phone == $request->mobile) {

            if (User::where('phone', '=', $request->mobile)->count() > 0) {
                // user found
                $updateUser = User::where('phone', '=', $request->mobile)->firstOrFail();

                // $otp = rand(111111, 999999);
                $otp = 123456;
                $updateUser->mobile_otp = $otp;

                $updateUser->update();
                // $subject = "OTP Verification";

                // $phnumber = $updateUser->phone_code.$updateUser->mobile;


                // $this->sendOtpSms($updateUser->name,$phnumber, $otp);

                return response()->json(array(
                    'status' => true,
                    'message' => 'OTP has been send to your mobile number. Please Check SMS.',
                    'data' => array(
                        'otp' => '',
                        'mobile_otp' => $otp,
                        'email' => $updateUser->email,
                        'mobile' => $updateUser->phone,
                        'mobile_verified' => $updateUser->mobile_verified,
                        'email_verified' => $updateUser->email_verified,
                    )
                ));
            } else {
                // user not found
                return response()->json(array('status' => false, 'message' => 'No Account Found With This Email.'));
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Mobile Number is already taken by another user.']);
        }
    }


    // method use for user mobile verification with otp
    public function userMobileVerification(Request $request)
    {
        $rules = [
            'mobile' => "required|numeric",
            'otp' => "required|numeric"
        ];

        $customs = [
            'mobile.required' => "Mobile Number is required",
            'otp.required' => "OTP is required",
            'mobile.numeric' => "Mobile Number has to be numeric value",
            'otp.numeric' => "OTP has to be numeric value",
        ];

        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
            return response()->json(array('status' => false, 'message' => $validator->errors()));
        } else {

            $udata = User::where(['phone' => $request->mobile])->first();

            if ($udata) {

                if ($udata['mobile_verified'] === "Yes") {
                    return response()->json(array('status' => false, 'message' => "Mobile Number already verified"));
                }

                if ($udata['mobile_otp'] == $request->otp) {
                    $udata['mobile_verified'] = "Yes";
                    $udata->update();

                    return response()->json(array(
                        'status' => true,
                        'data' => [
                            'user_id' => $udata->id,
                            'email' => $udata->email,
                            'otp' => '',
                            'motp' => '',
                            'mobile' =>  $udata->phone,
                            'mobile_verified' =>  $udata->mobile_verified,
                            'email_verified' => $udata->email_verified,
                        ],
                        'message' => "OTP Verified"
                    ));
                } else {

                    return response()->json(array('status' => false, 'message' => "OTP is incorrect"));
                }
            } else {
                return response()->json(array('status' => false, 'message' => "Mobile Number is incorrect"));
            }
        }
    }


    // method use for image verifiaction
    public function imageVerify(Request $request)
    {

        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'verify_image' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()]);
        }

        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->first();
        if ($user) {

            if ($user['verify_image'] == 'Yes') {
                return response()->json(['status' => false, 'message' => 'Your image already verified']);
            }


            if ($request->file('verify_image') != "") {
                $favicon = uniqid(time()) . '.' . $request->verify_image->extension();
                $request->verify_image->move(public_path('assets/user/assets/img/verify_img'), $favicon);
                $favicon = "/assets/user/assets/img/verify_img" . $favicon;
            } else {
                $favicon = $user->image_verification;
            }

            $user->image_verification = $favicon;
            $user->verify_image = "Yes";
            $user->update();

            return response()->json([
                'status' => true, 'message' => 'image verify Successfully',
                'data' => [
                    'user_id' => $userId,
                    'image_verification' => $user->image_verification,
                    'verify_image' => $user->verify_image
                ]
            ]);
        } else {
            return response()->json(['status' => true, 'message' => 'something went wrong']);
        }
    }
}
