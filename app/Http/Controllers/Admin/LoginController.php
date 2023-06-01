<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $rules = [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('result' => false, 'msg' => $validator->errors()->first()));
        }



        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return json_encode(['status' => true, 'msg' => "Success, Welcome Back!", 'location' => url('admin/dashboard')]);
            exit;

            

        } else {

            return response()->json(array('status' => false, 'msg' => "Credentials not matched !"));
            exit;
        }
    }

    public function logout()
    {
        $dboy = Auth::guard('admin')->user()->id;
        $input['updated_at'] = date('Y-m-d h:i:s');
        Admin::where('id', $dboy)->update($input);
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
