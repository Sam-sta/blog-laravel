<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
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
        $category = Category::where('id', $request->category_id)->first();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category = $category->name;
        $post->save();
        $data = [
            'message' => 'Post created succesfully',
            'category' => $post
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $category = Category::find($request->category_id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category = $category->name;
        $post->save();
        $data = [
            'message' => 'Post created succesfully',
            'category' => $post
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        $data = [
            'message' => 'Post deleted succesfully',
            'category' => $post
        ];
        return response()->json($data);
    }

    public function showByCategory(string $category)
    {
        $posts = Post::where('category', $category)->get();

        return response()->json($posts);
    }
}
