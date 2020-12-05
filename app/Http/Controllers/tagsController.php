<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tag;
use App\Http\Requests\tags\CreatetagRequest;
use App\Http\Requests\tags\UpdatetagRequest;

class tagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index')->with('tags',tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatetagRequest $request)
    {

        $tag = new tag();
        $tag->name = $request['name'];
        $tag->save();
        session()->flash('success','tag created successfully');
        
        return redirect(route('tags.index'));
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
    public function edit(tag $tag)
    {
        return view('tags.create')->with('tag',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetagRequest $request,tag $tag)
    {
        $tag->name = $request['name'];
        $tag->save();
        session()->flash('success','tag updated successfully');
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(tag $tag)
    {
        if($tag->posts->count() > 0){
            session()->flash('error','Tag cannot be deleted , beacuseit is associated to some posts');
            return redirect()->back();
        }
 
        $tag->delete();
         session()->flash('success','tag deleted successfully');
         return redirect(route('tags.index'));
    }
}
