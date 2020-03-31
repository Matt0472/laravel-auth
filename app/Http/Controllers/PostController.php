<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //tutti gli utenti
    public function index()
    {
        $posts = Post::all();

        return view('guest.posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (empty($post)) {
            abort('404');
        }

        return view('guest.posts.show', compact('post'));
    }
}
