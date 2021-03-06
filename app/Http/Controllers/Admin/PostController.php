<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Tag;
use App\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;
use App\Mail\SendMailUpdatePost;
use Carbon\Carbon;

class PostController extends Controller
{
    private $validateRules;

    public function __construct()
    {

        $this->validateRules = [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'path_image' => 'image'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // questo è per vedere solamente i post dell'utente appena loggato
        // $posts = Post::where('user_id', Auth::id())->get();
        
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $images = Image::all();

        $data = [
            'tags' => $tags,
            'images' => $images
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idUser = Auth::user()->id;
        $request->validate($this->validateRules);

        $data = $request->all();

        $newPost = new Post;
        $path = Storage::disk('public')->put('images', $data['path_image']);
        $newPost->title = $data['title'];
        $newPost->body = $data['body'];
        $newPost->user_id = $idUser;
        $newPost->path_image = $path;
        $newPost->slug = Str::finish(Str::slug($newPost->title), rand(1, 1000000));
    
        $saved = $newPost->save();

        if (!$saved) {
            return redirect()->back();
        }

        $tags = $data['tags'];
        if (!empty($tags)) {
            $newPost->tags()->attach($tags);
        }

        $images = $data['images'];
        if (!empty($images)) {
            $newPost->images()->attach($images);
        }

        Mail::to('mail@mail.it')->send(new SendNewMail($newPost));

        return redirect()->route('admin.posts.show', $newPost->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();
        $images = Image::all();

        $data = [
            'tags' => $tags,
            'post' => $post,
            'images' => $images
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $idUser = Auth::user()->id;
        if (empty($post)) {
            abort(404);
        }

        if ($post->user->id != $idUser) {
            abort(404);
        }
        $request->validate($this->validateRules);
        $data = $request->all();

        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->slug = Str::finish(Str::slug($post->title), rand(1, 1000000));
        $post->updated_at = Carbon::now();
        $updated = $post->update();
        if (!$updated) {
            return redirect()->back();
        }

        $tags = $data['tags'];
        if (!empty($tags)) {
            $post->tags()->sync($tags);
        }

        $images = $data['images'];
        if (!empty($images)) {
            $post->images()->sync($images);
        }

        Mail::to('mail@mail.it')->send(new SendMailUpdatePost($post));

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (empty($post)) {
            abort('404');
        }
        $id = $post->id;
        $post->images()->detach();
        $post->tags()->detach();
        $post->delete();
        $data = [
            'id' => $id,
            'posts' => Post::all()
        ];
        return redirect()->route('admin.posts.index')->with('delete', $post);
    }
}
