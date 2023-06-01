<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Route;


class AdminProfileController extends Controller
{

   public function adminProfilePage()
   {
    // dd(url(Auth::guard('admin')->user()->image));
    return view('admin.profile.admin_profilepage');
   }

   public function changePassword()
   {
    return view('admin.profile.change_password');
   }

    public function index()
    {
        return view('admin.profile.index');
    }

    public function profile_submit(Request $request)
    {
        // echo "Hello";
        // exit;

        // dd($request->all());

        $image = Admin::find($request->id);


        if ($request->file('file') != "") {

            $favicon = uniqid(time()) . '.' . $request->file->extension();
            $request->file->move(public_path('assets/admin/assets/img/'), $favicon);
            $favicon = "/public/assets/admin/assets/img/" . $favicon;


            $image->image =  $favicon;
            $image->name = $request->input('name');
            $image->email = $request->input('email');

            $image->update();
        } else {




            // $image->image =  $favicon;
            $image->name = $request->input('name');
            $image->email = $request->input('email');

            $image->update();
        }
        if ($image) {

            return response()->json(array('status' => true, 'msg' => "Successfully Updated", 'location' => route('admin.profilepage')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }


    public function password_reset(Request $request)
    {

        $rules = [
            'current_password' => ['required', 'string', 'min:6'],
            'n_password' => ['required', 'string', 'min:6', 'same:c_password'],
        ];
        $msg =  Validator::make($request->all(), $rules);
        if ($msg->fails()) {
            return response()->json(['status' => false, 'msg' => $msg->errors()->first()]);
        }


        $getdata = Admin::where('id', Auth::guard('admin')->user()->id)->first();

        if (!(Hash::check($request->current_password, $getdata->password))) {

            return response()->json(array('status' => false, 'msg' => 'old password is not match'));
        } else {

            $getdata->password = Hash::make($request->n_password);
            $getdata->save();
            // return redirect()->route('admin.profile');
            if ($getdata) {

                return response()->json(array('status' => true, 'msg' => "Password Updated Successfully", 'location' => route('admin.profilepage')));
            } else {
                return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
            }
        }
    }
}
