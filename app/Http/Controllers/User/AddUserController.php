<?php

namespace App\Http\Controllers\User;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;



class AddUserController extends Controller
{
    public function index()
    {

        return view('users.add_users');
    }

    public function userList()
    {
        // $users = User::get();
        return view('users.user_list');
    }


    public function userListAjax(Request $request)
    {
        // $start_date = "";
        // $end_date = "";

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

        // $total = User::orWhere('first_name', 'like', '%' . $search . '%')
        //     ->orWhere('created_at', 'like', '%' . $search . '%');
        
        $category = User::orWhere('first_name', 'like', '%' . $search . '%');
            
        $total = $category->count();
        $start_date = $request->filled('from_date') ? date('Y-m-d', strtotime($request->input('from_date'))) : NULL;
        $end_date = $request->filled('end_date') ? date('Y-m-d', strtotime($request->input('end_date'))) : NULL;

        //  if (isset($_GET['from_date']) && isset($_GET['end_date']) && !is_null($_GET['from_date']) && !is_null($_GET['end_date'])) {
        if (!is_null($start_date) && !is_null($end_date)){
            // echo "Hello";
            // exit;
            // $start_date = date('Y-m-d', strtotime($_GET['from_date']));
            // $end_date = date('Y-m-d', strtotime($_GET['end_date']));

            $category = $category->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date);
            $total = $category->count();
            
        }
        
        $category = $category->offset($ofset)->limit($limit)
        ->orderBy($nameOrder, $orderType)->get();
        $i = 1 + $ofset;
        $data = [];

        foreach ($category as $cate) {
            $url = route('admin.user.edit', ['id' => $cate->id]);
            $status = '<button class="statusVerifiedClick btn ' . ($cate->status == 'ACTIVE' ? "btn-success btn-sm" : "btn-danger btn-sm") . '  " data-status="' . ($cate->status == 'ACTIVE'  ? 'INACTIVE' : 'ACTIVE') . '" data-id="' . $cate->id . '">' . ($cate->status == 'ACTIVE' ? "ACTIVE" : "INACTIVE") . '</button>
                       ';
            $data[] = array(
                $i++,
                $cate->first_name,
                $cate->last_name,
                '<img class="img-fluid" src="' . asset($cate->pic1) . '" width="70px;">',
                $cate->email,
                $cate->phone,
                $cate->gender == 'male' ? 'M' : 'F',
                $cate->interested_in == 'male'   ? 'M' : 'F',
                $status,
                '<a  href=' . $url . ' class="editCategory btn btn-info btn-sm "  data-id="' . $cate->id . '"><i class="zmdi zmdi-edit"></i></a> 
                    <a href="#" class="btn btn-danger btn-sm delete_user" data-id="' . $cate->id . '"><i class="zmdi zmdi-delete"></i></a>',
                $cate->created_at->format('y-m-d'),

            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        echo json_encode($records);
    }

    // Active User List

    public function ActiveUserList()
    {
        return view('users.active_users');
    }

    public function ActiveUserListAjax(Request $request)
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

        $total = User::orWhere('first_name', 'like', '%' . $search . '%')->where('status', 'ACTIVE')->count();
        $category = User::orWhere('first_name', 'like', '%' . $search . '%')
            ->offset($ofset)->limit($limit)
            ->orderBy($nameOrder, $orderType)
            ->where('status', 'ACTIVE')
            ->get();

        $i = 1 + $ofset;
        $data = [];

        foreach ($category as $cate) {

            $url = route('admin.user.edit', ['id' => $cate->id]);
            $status = '<button class="statusVerifiedClick btn ' . ($cate->status == 'ACTIVE' ? "btn-success btn-sm" : "btn-danger btn-sm") . '  " data-status="' . ($cate->status == 'ACTIVE'  ? 'INACTIVE' : 'ACTIVE') . '" data-id="' . $cate->id . '">' . ($cate->status == 'ACTIVE' ? "ACTIVE" : "INACTIVE") . '</button>
                       ';
            $data[] = array(
                $i++,
                $cate->first_name,
                $cate->last_name,
                '<img class="img-fluid" src="'  . asset($cate->pic1) . '" width="70px;">',
                $cate->email,
                $cate->phone,
                $cate->gender,
                $cate->interested_in,
                $status,

                '<a  href=' . $url . ' class="editCategory btn btn-info btn-sm "  data-id="' . $cate->id . '"><i class="zmdi zmdi-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-sm delete_user" data-id="' . $cate->id . '"><i class="zmdi zmdi-delete"></i></a>',

            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        echo json_encode($records);
    }


    // Inactive Users List
    public function InactiveUserList()
    {
        return view('users.inactive_users');
    }

    public function InactiveUserListAjax(Request $request)
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

        $total = User::orWhere('first_name', 'like', '%' . $search . '%')->where('status', 'INACTIVE')->count();
        $category = User::orWhere('first_name', 'like', '%' . $search . '%')
            ->offset($ofset)->limit($limit)
            ->orderBy($nameOrder, $orderType)
            ->where('status', 'INACTIVE')
            ->get();
        $i = 1 + $ofset;
        $data = [];

        foreach ($category as $cate) {
            $url = route('admin.user.edit', ['id' => $cate->id]);
            $status = '<button class="statusVerifiedClick btn ' . ($cate->status == 'ACTIVE' ? "btn-success btn-sm" : "btn-danger btn-sm") . '  " data-status="' . ($cate->status == 'ACTIVE'  ? 'INACTIVE' : 'ACTIVE') . '" data-id="' . $cate->id . '">' . ($cate->status == 'ACTIVE' ? "ACTIVE" : "INACTIVE") . '</button>
                       ';
            $data[] = array(
                $i++,
                $cate->first_name,
                $cate->last_name,
                '<img class="img-fluid" src="' . url($cate->pic1) . '" width="70px;">',
                $cate->email,
                $cate->phone,
                $cate->gender,
                $cate->interested_in,

                $status,
                '<a  href=' . $url . ' class="editCategory btn btn-info btn-sm "  data-id="' . $cate->id . '"><i class="zmdi zmdi-edit"></i></a>
                    <a href="#" class="btn btn-danger btn-sm delete_user" data-id="' . $cate->id . '"><i class="zmdi zmdi-delete"></i></a>',

            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        // dd($records);
        echo json_encode($records);
    }


    // Verified Users List
    public function VerifiedUserList()
    {
        return view('users.verified_users');
    }

    public function VerifiedUserListAjax(Request $request)
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

        $total = User::orWhere('first_name', 'like', '%' . $search . '%')->where('verification', '1')->count();
        $category = User::orWhere('first_name', 'like', '%' . $search . '%')
            ->offset($ofset)->limit($limit)
            ->orderBy($nameOrder, $orderType)
            ->where('verification', '1')
            ->get();
        $i = 1 + $ofset;
        $data = [];

        foreach ($category as $cate) {

            $url = route('admin.user.edit', ['id' => $cate->id]);
            $status = '<button class="statusVerifiedClick btn ' . ($cate->status == 'ACTIVE' ? "btn-success btn-sm" : "btn-danger btn-sm") . '  " data-status="' . ($cate->status == 'ACTIVE'  ? 'INACTIVE' : 'ACTIVE') . '" data-id="' . $cate->id . '">' . ($cate->status == 'ACTIVE' ? "ACTIVE" : "INACTIVE") . '</button>
                       ';
            $data[] = array(
                $i++,
                $cate->first_name,

                $cate->last_name,
                '<img class="img-fluid" src="' . url($cate->pic1) . '" width="70px;">',
                $cate->email,
                $cate->phone,
                $cate->gender,
                $cate->interested_in,

                $status,

                '<a  href=' . $url . ' class="editCategory btn btn-info btn-sm "  data-id="' . $cate->id . '"><i class="zmdi zmdi-edit"></i></a> |
                    <a href="#" class="btn btn-danger btn-sm delete_user" data-id="' . $cate->id . '"><i class="zmdi zmdi-delete"></i></a>',

            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        echo json_encode($records);
    }
    public function addUser(Request $request)
    {

        // dd($request->all());

        $rules = [
            'first_name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'pic1' => 'required',
            "email" => "required|email|max:128|unique:users",
            "phone" => "required|max:11|min:9|unique:users",
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }
        // $data = $request->validated();
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;


        if ($request->file('pic1') != "") {
            $favicon = uniqid(time()) . '.' . $request->pic1->extension();
            $request->pic1->move(public_path('assets/user/assets/img/'), $favicon);
            $favicon = "/assets/user/assets/img/" . $favicon;
        }
        // dd($favicon);
        $user->pic1  = $favicon;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->interested_in = $request->interested_in;
        $user->status = $request->status;
        $user->relationship_type = $request->relationship_type;
        $user->verification = '1';
        $user->save();
        // return redirect()->back()->with('status','User Added Successfully');

        if ($user) {
            return response()->json(array('status' => true, 'msg' => "Successfully Added", 'location' => url('admin/user-list')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->delete();
            return response()->json(array('status' => true, 'msg' => "Successfully Deleted"));
            exit;
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }

    public function editUser($id)
    {

        $user = User::find($id);



        return view('users.edit_user', compact('user'));
    }


    public function update(Request $request)
    {

        // dd($request->id);
        // // echo $request->id;
        // // exit;

        $rules = [
            'first_name' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'pic1' => 'required',
            "email" => 'required|email|max:128|unique:users,email,' . $request->id,
            "phone" => 'required|max:11|min:9|unique:users,phone,' . $request->id,
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }
        // $data = $request->validated();
        $user = User::find($request->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;


        if ($request->file('pic1') != "") {
            $favicon = uniqid(time()) . '.' . $request->pic1->extension();
            $request->pic1->move(public_path('assets/user/assets/img/'), $favicon);
            $favicon = "/assets/user/assets/img/" . $favicon;
        }
        // dd($favicon);
        $user->pic1  = $favicon;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->interested_in = $request->interested_in;
        $user->status = $request->status;
        $user->relationship_type = $request->relationship_type;
        $user->update();
        // return redirect()->back()->with('status','User Added Successfully');

        if ($user) {

            return response()->json(array('status' => true, 'msg' => "Successfully Updated", 'location' => url('admin/user-list')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }



    public function userStatus(Request $request)
    {
        $where = array('id' => $request->id);
        $data = array(
            'status' => $request->status,
        );

        $update = User::where($where)->update($data);

        if ($update) {
            return response()->json(array('status' => true, 'msg' => "Successfully Updated !"));
            exit;
        } else {
            return response()->json(array('status' => false, 'msg' => "Error Occured, please try again"));
            exit;
        }
    }

    public function csv(Request $request)
    {

        if ($request->file('file_csv') != null) {
            // $file = $request->file("file_csv");
            $file = fopen($request->file('file_csv'), "r");

            $importData_arr = array();
            $i = 0;

            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);


                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file);



            foreach ($importData_arr as $key => $d) {
                $dataCsv = new User();
                $dataCsv->first_name                 = $d[0];
                $dataCsv->last_name                 = $d[1];
                $dataCsv->email           = $d[2];
                $dataCsv->phone     = $d[3];
                $dataCsv->dob        = date('Y-m-d', strtotime($d[4]));
                $dataCsv->gender      = $d[5];
                $dataCsv->status           = $d[6];
                $dataCsv->interested_in           = $d[7];
                $dataCsv->verification           = $d[8];
                $dataCsv->relationship_type           = $d[9];



                $result = $dataCsv->save();
            }


            if ($result) {
                return response()->json(array('status' => true, 'msg' => "Wow, CSV File Data Successfully Import!", 'location' => route('admin.user.list')));
                exit;
            } else {
                return response()->json(array('status' => false, 'msg' => "Something went wrong, Please try again !"));
                exit;
            }
        }
    }

    public function csvExport(Request $request)
    {
        $fileName = 'users.csv';
        $tasks    =  User::all();

        $headers = array(

            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename = $fileName",
            "Pragma"   => "no-cache",
            "Cache-Control"  => "must-revalidata, post-check=0, pre-check=0",
            "Expires"  => "0"


        );

        $columns = array('first_name', 'last_name', 'email', '	pic1', 'phone', 'dob', 'gender', 'interested_in', 'status', 'verification', 'relationship_type');

        $callback = function () use ($tasks, $columns) {

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as  $task) {
                $row['first_name']  = $task->first_name;
                $row['last_name']  = $task->last_name;
                $row['email']  = $task->email;
                $row['pic1']  = $task->pic1;
                $row['phone']  = $task->phone;
                $row['dob']  = $task->dob;
                $row['gender']  = $task->gender;
                $row['status']  = $task->status;
                $row['interested_in']  = $task->interested_in;
                $row['verification']  = $task->verification;
                $row['relationship_type']  = $task->relationship_type;

                fputcsv($file, array($row['first_name'], $row['last_name'], $row['email'], $row['pic1'], $row['phone'], $row['dob'], $row['gender'], $row['interested_in'], $row['status'], $row['verification'], $row['relationship_type']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function paidUsaerlist()
    {
        return view('users.paid_user');
    }
    public function unPaidusaerList()
    {
        return view('users.unpaid_user');
    }
}
