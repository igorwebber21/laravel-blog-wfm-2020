<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'DESC')->paginate(4);
        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::query()->with('category')->where(['slug' => $slug])->firstOrFail();
        $post->views += 1;
        $post->update();
        return view('posts.show', compact('post'));
    }

}
