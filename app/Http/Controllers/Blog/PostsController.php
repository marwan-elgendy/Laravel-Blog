<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\post;

use App\category;

use App\tag;

class PostsController extends Controller
{
    public function show(post $post){
        return view('blog.show')->with('post',$post);
    }

    public function category(category $category){

        
        return view('blog.category')
        ->with('category',$category)
        ->with('posts',$category->posts()->searched()->simplePaginate(2))
        ->with('categories',category::all())
        ->with('tags',tag::all());
    }

    public function tag(tag $tag){

        
        return view('blog.tag')
        ->with('tag',$tag)
        ->with('posts',$tag->posts()->searched()->simplePaginate(2))
        ->with('categories',category::all())
        ->with('tags',tag::all());
    }
}
