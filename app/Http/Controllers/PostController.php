<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Posts.index',[
            'posts'=>Post::withTrashed()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->only(["title","content"]);
        $post=Post::create($data);
        $request->session()->flash('status','post was created');
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrfail($id);
        return view('posts.edit',[
            'post'=>$post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePost $request,$id)
    {
        $posts=Post::findorFail($id);
        $this->authorize('update',$posts);
        $posts->product_name=$request->input('title');
        $posts->product_price=$request->input('content');
        $posts->save();
        $request->session()->flash('status','product was updated!!!');
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $post=Post::findOrFail($id);
        $post->delete();
        $request->session()->flash('status','post was deleted!!!');
        return redirect('/posts');
    }


    public function restore($id)
    {
        $post=Post::onlyTrashed()->where('id', $id);
     $post->restore();
        return redirect()->route('posts.index');
    }
}
