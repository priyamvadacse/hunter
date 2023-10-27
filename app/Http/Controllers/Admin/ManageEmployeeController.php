<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Module_list;
use App\Models\Admin\Module_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManageEmployeeController extends Controller
{
    public function AddEmployee(Request $request)
    {
        return view('admin.manage_employee.employee');
    }

  

  public function storeEmployee(Request $request){
      $rules = [
        "name" => 'required',
        "email" => 'required|email|max:128|unique:users',
        "role" => 'required',
        "password" => 'required|min:8'
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
          return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
          exit;
      }
      
      $employee = new Admin();
      $employee->name = $request->name;
      $employee->email = $request->email;
      $employee->password = Hash::make($request->password);
      $employee->role = $request->role;
      $result = $employee->save();
      
     $modules = Module_list::all();
     foreach($modules as $module){
        $user_permission = new Module_permission();
        $user_permission -> admin_id = $employee->id;
        $user_permission->module_name = $module->module_name;
        $user_permission->permission = '0';
        $user_permission->save();
     }


 
      if ($result) {
          return response()->json(array('status' => true, 'msg' => "Successfully Added", 'location' => route('admin.ajax_employee')));
        //   return redirect()->route('admin.ajax_employee');
        // return redirect()->route('admin.ajax_employee');

      } else {
          return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
      }
  }



public function EmployeeListAjax(Request $request)
{
    $admins = Admin::orderBy('id','DESC')->paginate(10);
    return view('admin.manage_employee.show_employee',compact('admins'));   
}

public function showPermission($id)
{
    $permissions = Module_permission::where('admin_id',$id)->get();
    return view('admin.manage_employee.permission',compact('permissions','id')); 
}

public function updatePermission(Request $request)
{
    // dd($request->all());
    // try {
        $modules = Module_list::pluck('module_name')->toArray();
        foreach($modules as $index => $module){
            $admin_permission = Module_permission::where(['admin_id' => $request->id, 'module_name' => $module])->first();
            $module = str_replace(" ","_",$module);
            $admin_permission->permission = $request->has($module) ? '1' : '0';
            // if($index == 2)
            //             dd($module, $admin_permission,$request);
            $admin_permission->update();
        }
        return response()->json(array('status' => true, 'msg' => "Successfully Updated", 'location' => route('admin.ajax_employee')));

        // return redirect()->route('admin.ajax_employee')->with('success', 'Permissions updated successfully');
    // } catch (\Exception $ex) {
    //     dd($ex);
    // }

}

}
