<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\post;

use App\category;

use App\tag;

use App\Http\Requests\Posts\CreatePostsRequest;

use App\Http\Requests\Posts\UpdatePostsRequest;

use Illuminate\Support\Facades\Storage;

class postsController extends Controller
{


    public function __construct()
    {
        $this->middleware('VerifyCategoriesCount')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',category::all())->with('tags',tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        
        $image = $request->image->store('posts');

        $post = new post();
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->content = $request['content'];
        $post->image = $image;
        $post->published_at = $request['published_at'];
        $post->category_id = $request['category'];
        $post->user_id = auth()->user()->id;
        $post->save();

        if($request['tags']){
            $post->tags()->attach($request['tags']);
        }

        session()->flash('success','Post Created Successfully');

        return redirect(route('posts.index'));
        
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
    public function edit(post $post)
    {
        
        return view('posts.create')->with('post', $post)->with('categories',category::all())->with('tags',tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request,post $post)
    {

        if($request->hasFile('image')){
            $image = $request->image->store('posts');
            Storage::delete($post->image);
            $post->image = $image;
        }
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->content = $request['content'];
        $post->published_at = $request['published_at'];

        $post->save();
        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        session()->flash('success','Post Updated Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::withTrashed()->where('id',$id)->firstOrFail();
        if ($post->trashed()) {
            Storage::delete($post->image);
            $post->forceDelete();
        }
        else{
            $post->delete();
        }
        session()->flash('success' , 'Post Deleted Successfully');
        return redirect(route('posts.index'));
    }
    /**
     * Display trashed posts
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed(){
        $trashed = post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashed);
    }

    /**
     * Restore trashed posts
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id){
        $post = post::withTrashed()->where('id',$id)->firstOrFail();
         $post->restore();
         session()->flash('success' , 'Post Restored Successfully');
        return redirect()->back();
    }
}

