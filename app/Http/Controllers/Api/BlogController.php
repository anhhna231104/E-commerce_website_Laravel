<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Rate_Blog;
use App\Http\Requests\admin\BlogRequest;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as Image;
use App\Http\Requests\api\CommentRequest;
use App\Http\Requests\api\RateBlogRequest;
use Validator;
// use Auth;
use App\Models\Comment;

class BlogController extends Controller
{
    // public $successStatus = 200;
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function list()
    {
        // echo 111;

        // return response()->json([
        //     'result'=> 111
        // ]);
        $getBlogData = Blog::all();

        // // dd($getBlogListComment);
        // // co dc 1 arr: 

        // // frontend: reactjs
        // // return view("xxx", compact('getBlogListComment'))

        // // ajax
        return response()->json([
            'blog' => $getBlogData
        ]);

    }

    public function detail(string $id)
    {
        $blogDetailData = Blog::where('id', $id)->get();

        return response()->json([
            'blog-detail' => $blogDetailData
        ]);
    }

    public function comment(CommentRequest $request, string $id)
    {
        $data = $request->all();
        if ($id) {
            $getListCmt = \App\Models\Frontend\Comment::create([
                'id_user' => Auth::user()->id,
                'user_avatar' => Auth::user()->avatar,
                'id_blog' => $id,
                'cmt' => $data['cmt'],
                'username' => Auth::user()->name,
                'level' => 0
            ]);
            if ($getListCmt) {
                return response()->json([
                    'data' => $getListCmt
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'error' => 'error'
                ]);
            }
        } else {
            return response()->json([
                'error' => 'ID not found'
            ]);
        }
    }



}
