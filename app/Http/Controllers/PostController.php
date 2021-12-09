<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = Post::with('categories')->get();
        // dd($data);

        return view('post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::pluck('name', 'id');

        return view('post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $path = $request->file('image')->store('images/post');
        if(!$path) {
            return redirect()->back()->with("ERROR", __("Failed to upload image"));
        }
        $user = Auth::user()->id;
        $post = Post::create([
            'user_id' => $user,
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'image' => $path
        ]);
        if(empty($post)) {
            return redirect()->back()->withInput();
        }
        return redirect()->route('posts.index')->with("SUCCESS", __("Post has been created successfully"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    public function complete(Post $post) {

        $post->forceFill([
            'is_complete' => true
        ]);
        if($post->update()){
            return redirect()->route('posts.index')->with("SUCCESS", __('Post has been completed successfully'));
        }
        return redirect()->back()->with("ERROR", __('Failed to updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data['posts'] = $post;

        return view('post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        if($request->hasFile('image')) {
            if($post->image) {
                Storage::delete($post->image);
            }
            $path = $request->file('image')->store('images/post');
        }
        if($post->update([
            $post->name = $request->get('name'),
            $post->image = $path
        ])) {
            return redirect()->route('posts.index')->with('SUCCESS', __('Post has been updated successfully'));
        }
        return redirect()->back()->withInput()->with('ERROR', __('Failed to update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->image);
        if($post->delete()) {
            return redirect()->back()->with('SUCCESS', __('Post has been deleted successfully'));
        }
        return redirect()->back()->with('ERROR', __('Failed to delete todo'));
    }
}