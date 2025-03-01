<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AddCommentRequest;
use App\Models\Admin\Blog;
use App\Models\Frontend\Comment;
use App\Models\Frontend\Rate;
use Illuminate\Http\Request;
use Auth;

class BlogDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $data = Blog::where('id', $id)->get()->first();
        $commentData = Comment::where('id_blog', $id)->get();

        //rate
        $rateData = Rate::where('id_blog', $id)->get();

        $sum = 0;
        $count = 0;

        foreach ($rateData as $value) {
            $sum = $sum + (int) $value['rate'];
            $count++;
        }
        if ($count == 0) {
            $avgRate = 0;
        } else {
            $avgRate = round($sum / $count);
        }


        //end rate

        return view('frontend.blog.detail-ajax', compact('commentData', 'data', 'avgRate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function rateBlog(Request $request)
    {
        // dd($request->all());
        $data = $request->all();

        $rate = Rate::create([
            'rate' => $data['rate'],
            'id_blog' => $data['id_blog'],
            'id_user' => $data['id_user']
        ]);

        if ($rate) {
            //ajax
            return response()->json(['data' => $rate]);


        } else {
            //ajax
            return response()->json(['error' => 'Add comment failed']);
        }

    }

    public function createCmt(AddCommentRequest $request)
    {
        // dd($request->all());
        $data = $request->all();

        $cmt = Comment::create([
            'cmt' => $data['cmt'],
            'username' => $data['username'],
            'id_user' => $data['id_user'],
            'id_blog' => $data['id_blog'],
            'user_avatar' => $data['user_avatar'],
            'level' => $data['level'],
        ]);

        if ($cmt) {
            //js
            // return redirect()->back()->with('success', 'Add comment successfully.');

            //ajax
            return response()->json(['res' => $cmt]);


        } else {
            //js
            // return redirect()->back()->withErrors('Add comment failed.');

            //ajax
            return response()->json(['error' => 'Add comment failed']);

        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
