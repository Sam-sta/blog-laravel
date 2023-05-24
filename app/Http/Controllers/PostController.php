<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user_id = $user->getId();
        if($user->hasRole('Publicista')) {
            $posts = Post::where('user_id', '=', $user_id)->get();
        }
        else {
            $posts = Post::all();
        }
        $categories = Category::all();
        return view('posts.index', compact('posts'), compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();
        $user = Auth::user();
        $user_id = $user->getId();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $user_id;
        $post->category = $request->category;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = Storage::putFile('public/images', $file);
            $nuevo_path = str_replace('public/', '', $path);
            $post->image_url = $nuevo_path;
        }
        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function view($post)
    {
        $post = Post::find($post);
        return view('view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($post_id)
    {
        $categories = Category::all();
        return view('posts.edit', ['post_id' => $post_id], compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $post_id)
    {
        $post = Post::find($post_id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category = $request->category;
        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        if ($post->imager_url) {
            Storage::delete('public/'.$post->image_url);
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
