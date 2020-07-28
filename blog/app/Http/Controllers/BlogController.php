<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $array = DB::table('blogs')
            ->select('blogs.*')
            ->where('blogs.users_id', $id)
            ->orderByDesc('blogs.created_at')
            ->paginate(5);
        return view('personPage', compact('array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->users_id = $id;
        $blog->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {

        $array = DB::table('blogs')
            ->join('users', 'users.id', '=', 'blogs.users_id')
            ->select('blogs.*', 'users.id', 'users.name', 'users.images')
            ->where('blogs.id', $blog->id)
            ->get();

        return view('detailPost', compact('array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('updateBlogs', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $blog->title = $data['title'];
        $blog->content = $data['content'];
        $blog->save();
        // $request->session()->flash('key', 'Cập nhật thành công');

        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->back();
    }

    public function search()
    {
        $key = Request('input');
        $listPosts = DB::table('blogs')
            ->join('users', 'users.id', '=', 'blogs.users_id')
            ->select('blogs.*',  'users.name', 'users.email', 'users.images')
            ->where('blogs.title', 'like', '%' . $key . '%')
            ->orWhere('blogs.content', 'like', '%' . $key . '%')
            ->orderByDesc('blogs.created_at')
            ->paginate(15);
        
        return view('searchPage', compact(['listPosts', 'key']));
    }
}
