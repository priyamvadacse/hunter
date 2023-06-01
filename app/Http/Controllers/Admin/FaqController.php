<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Admin\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function faqPage()
    {
        return view('admin.faq.faq');
    }

    public function saveFaq(Request $request)
    {
        $rules = [

            'question' => 'required',
            'answer' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return response()->json(array('status' => false, 'msg' => $validate->errors()->first()));
        }

        $get = new Faq();

        $get->question = $request->question;
        $get->answer = $request->answer;
        $get->save();

        if ($get) {

            return response()->json(array('status' => true, 'msg' => 'Success fully Added', 'location' => route('admin.showfaq')));
        } else {

            return response()->json(array('status' => false, 'msg' => 'something went wrong , please try again'));
        }
    }

    public function showFaq()
    {
        // echo "hello";
        // exit;
        $getdata = Faq::all();
        // echo"<pre>",print_r($getdata);
        // exit;

        return view('admin.faq.show_question_answer', compact('getdata'));
    }
    public function EditPage($id)
    {
        $edit = Faq::where('id', $id)->first();

        return view('admin.faq.faq_edit', compact('edit'));
    }

    public function faqUpdate(Request $request)
    {
        $rules = [

            'question' => 'required',
            'answer' => 'required',
        ];
        $custom = [
            'question.required' => 'Question Field Empty',
            'answer.required' => 'Answer Field Empty'
        ];

        $validate = Validator::make($request->all(), $rules, $custom);

        if ($validate->fails()) {
            return response()->json(array('status' => false, 'msg' => $validate->errors()->first()));
        }

        $get = Faq::find($request->id);
        // echo"<pre>",print_r($get);
        // exit;

        $get->question = $request->question;
        $get->answer = $request->answer;
        $get->update();



        if ($get) {

            return response()->json(array('status' => true, 'msg' => "Successfully Updated", 'location' => route('admin.showfaq')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }

    public function delateFaq($id)
    {
        $delete = Faq::where('id', $id)->first();

        $delete->delete();

        return back()->with('success', 'product updated Successfully');
    }


    public function change_status(Request $request)
    {
        $where = array('id' => $request->id);
        $data = array(
            'status' => $request->status,
        );

        $update = Faq::where($where)->update($data);

        if ($update) {
            return response()->json(array('status' => true, 'msg' => "Successfully Updated !"));
            exit;
        } else {
            return response()->json(array('status' => false, 'msg' => "Error Occured, please try again"));
            exit;
        }
    }


    // method use for about us page
    public function aboutUsPage()
    {
        $getdata = AboutUs::first();
        return view('admin.about_us.about_us', compact('getdata'));
    }

    // method use for about us update
    public function about_usUpdate(Request $request)
    {
        $rules = [

            'title' => 'required',
            'about_us' => 'required',
        ];
        $custom = [
            'title.required' => 'Title Field Empty',
            'about_us.required' => 'Content Field Empty'
        ];

        $validate = Validator::make($request->all(), $rules, $custom);

        if ($validate->fails()) {
            return response()->json(array('status' => false, 'msg' => $validate->errors()->first()));
        }

        $getAboutUs = AboutUs::first();
        if (isset($getAboutUs)) {
            $getAboutUs->title = $request->title;
            $getAboutUs->content = $request->about_us;
            $update =  $getAboutUs->update();
            if ($update) {
                return response()->json(array('status' => true, 'msg' => "Successfully Updated !", 'location'=>route('admin.about_us')));
                exit;
            } else {
                return response()->json(array('status' => false, 'msg' => "Error Occured, please try again"));
                exit;
            }
        } else {
            $newStore = new AboutUs();
            $newStore->title = $request->title;
            $newStore->content = $request->about_us;
            $save =  $newStore->save();
            if ($save) {
                return response()->json(array('status' => true, 'msg' => "Successfully Save !", 'location'=>route('admin.about_us')));
                exit;
            } else {
                return response()->json(array('status' => false, 'msg' => "Error Occured, please try again"));
                exit;
            }
        }
    }
}
