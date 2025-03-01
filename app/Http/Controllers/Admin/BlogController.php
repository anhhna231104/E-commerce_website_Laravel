<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBlogRequest;
use App\Http\Requests\EditBlogRequest;
use App\Models\Admin\Blog;
use App\Models\Admin\Country;
use Auth;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     */

    public function index()
    {
        $data = Blog::all();
        return view('admin.blog.blog', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        return view('admin.blog.add.add-blog');
    }

    public function create(AddBlogRequest $request)
    {
        $file = $request->image;
        $data = $request->all();

        if (!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
        }

        var_dump($data);
        if (Blog::create($data)) {
            $file->move('upload/blog', $file->getClientOriginalName());
            return redirect()->back()->with('success', _('Create blog successfully'));
        } else {
            return redirect()->back()->withErrors('Create blog failed.');
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
        $data = Blog::where('id', $id)->get()->first();
        return view('admin.blog.edit.edit-blog', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditBlogRequest $request, string $id)
    {
        $blog = Blog::findOrFail($id);


        $data = $request->all();
        $file = $request->image;

        if (!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
        }


        if ($blog->update($data)) {
            if (!empty($file)) {
                $file->move('upload/blog', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', _('Edit blog successfully.'));
        } else {
            return redirect()->back()->withErrors('Edit blog failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Blog::destroy($id)) {
            return redirect()->back()->with('success', _('Delete blog successfully.'));
        } else {
            return redirect()->back()->withErrors('Delete blog failed.');
        }
    }
}
