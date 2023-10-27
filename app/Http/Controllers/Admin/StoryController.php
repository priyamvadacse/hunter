<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    //
    public function storyIndex()
    {
        return view('admin.story.story_index');
    }

    public function storyListAjax()
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

        $searchKeyword = $search;

        $storydata = Story::where(function ($query) use ($searchKeyword) {
                $query->where('id', 'LIKE', "%{$searchKeyword}%")
                    ->orWhere('title', 'LIKE', "%{$searchKeyword}%");                   
            });            

        $total = $storydata->count();
        $category = $storydata->offset($ofset)->limit($limit)->orderBy($nameOrder, $orderType)->get();

        $i = 1 + $ofset;
        $data = [];

        foreach ($category as $cate) {
            $url = route('admin.edit_story_page', ['id' => $cate->id]);            
            $status = '<button class="statusVerifiedClick btn ' . ($cate->status == 'ACTIVE' ? "btn-success btn-sm" : "btn-danger btn-sm") . '  " data-status="' . ($cate->status == 'ACTIVE'  ? 'INACTIVE' : 'ACTIVE') . '" data-id="' . $cate->id . '">' . ($cate->status == 'ACTIVE' ? "ACTIVE" : "INACTIVE") . '</button>';
            $data[] = array(
                $i++,
                $cate->title,                            
                '<img class="img-fluid" src="'. url($cate->story_image). '" alt="" width="70px;">',
                $status,
                '<a  href=' . $url . ' class="btn btn-info btn-sm "><i class="zmdi zmdi-edit"></i></a> 
                    <a href="#" class="btn btn-danger btn-sm delete_story" data-id="' . $cate->id . '"><i class="zmdi zmdi-delete"></i></a>',                

            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        echo json_encode($records);
    }

    public function addStoryPage()
    {
        return view('admin.story.add_story');
    }

    public function saveStory(Request $request)
    {
        $rules = [
            'title' => 'required',
            'story_image' => 'required',                      
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }
        // $data = $request->validated();
        $user = new Story();
        $user->title = $request->title;        

        if ($request->file('story_image') != "") {
            $favicon = uniqid(time()) . '.' . $request->story_image->extension();
            $request->story_image->move(public_path('assets/user/assets/img/story_img/'), $favicon);
            $favicon = "/assets/user/assets/img/story_img/" . $favicon;
        }        
        $user->story_image  = $favicon;
        $user->story_description = $request->story_description;
        $user->save();        
        if ($user) {
            return response()->json(array('status' => true, 'msg' => "Successfully Added", 'location' => route('admin.story_index')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }


    public function editStoryPage($id)
    {
        $getStory = Story::where('id', $id)->first();
        return view('admin.story.edit_story', compact('getStory'));
    }

    public function updateStory(Request $request)
    {
        $rules = [
            'edit_title' => 'required',
            // 'story_image_edit' => 'required',
        ];
        $message = [
            'edit_title.required' => 'Title Is required',
            // 'story_image_edit.required' => 'Please choose story Image'
        ];

        $validator = Validator::make($request->all(), $rules , $message );
        if ($validator->fails()) {
            return response()->json(array('status' => false, 'msg' => $validator->errors()->first()));
            exit;
        }

        $story = Story::find($request->id);
        
        $story->title = $request->edit_title;        

        if ($request->file('story_image_edit') != "") {
            $favicon = uniqid(time()) . '.' . $request->story_image_edit->extension();
            $request->story_image_edit->move(public_path('assets/user/assets/img/story_img/'), $favicon);
            $favicon = "/assets/user/assets/img/story_img/" . $favicon;
        }else{
            $favicon = $story->story_image;
        }   

        $story->story_image  = $favicon;
        $story->story_description = $request->story_description_edit;        
        $story->update();       

        if ($story) {

            return response()->json(array('status' => true, 'msg' => "Successfully Updated", 'location' => route('admin.story_index')));
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }
    }

    public function deleteStory(Request $request)
    {
        $story = Story::find($request->id);
        if ($story) {
            $story->delete();
            return response()->json(array('status' => true, 'msg' => "Successfully Deleted"));
            exit;
        } else {
            return response()->json(array('status' => false, 'msg' => "Something went wrong, please try again"));
        }            
    }


    // method use for update status story
    public function updateStatusStory(Request $request)
    {
        
        $where = array('id' => $request->id);
        $data = array(
            'status' => $request->status,
        );

        $update = Story::where($where)->update($data);

        if ($update) {
            return response()->json(array('status' => true, 'msg' => "Successfully Updated !"));
            exit;
        } else {
            return response()->json(array('status' => false, 'msg' => "Error Occured, please try again"));
            exit;
        }
    }
}
