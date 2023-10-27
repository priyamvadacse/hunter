<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Termcondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermconditionController extends Controller
{
    public function termCondition()

    {
        $getdata = Termcondition::first();

        return view('admin.term_condition.term_condition', compact('getdata'));
    }

    public function saveTermcondition(Request $request)
    {

        $rules = [

            'termcondition' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }

        $get = Termcondition::find($request->id);
        if(isset($get)){

            $get->termcondition = $request->termcondition;        
            $get->update();
        }else{
            $get =new Termcondition();
            $get->termcondition = $request->termcondition;        
            $get->save();
        }
    

        if ($get) {
            return response()->json(array('status' => true, 'msg' => 'Successfuly Updated', 'location' => route('admin.termcondition')));
        } else {
            return response()->json(array('status' => true, 'msg' => 'Something went wrong , please try again'));
        }
    }
}
