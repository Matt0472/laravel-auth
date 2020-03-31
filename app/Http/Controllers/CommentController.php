<?php

namespace App\Http\Controllers;

use App\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $validateComments;

    public function __construct()
    {

        $this->validateComments = [
            'title' => 'required|string',
            'body' => 'required|string|max:150',
            'name' => 'required|string|max:80',
            'email' => 'required|email',
            'post_id' => 'required|numeric|exists:posts,id'
        ];
    }

    public function store(Request $request)
    {
        $request->validate($this->validateComments);
        $data = $request->all();

        $comment = new Comment;
        $comment->fill($data);
        $saved = $comment->save();

        if (!$saved) {
            return redirect()->back();
        }

        return redirect()->route('posts.show', $comment->post->slug);
    }
}
