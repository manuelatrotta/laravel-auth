<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::all();

      return view('admin.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $tags= Tag::all();
      return view('admin.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string|max:1000',
    ]);

      $data = $request->all();

      $post = new Post;
      $post->fill($data);
      $post->user_id = Auth::id();
      $post->slug = Str::finish(Str::slug($post->title),rand(1, 1000000));
      $post->save();

      $tags = $data['tags'];
        if(!empty($tags)) {
            $post->tags()->attach($tags);
        }

      return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return view('admin.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      return view('admin.edit', compact('post'));
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
      $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string|max:1000',
    ]);

      $data = $request->all();

      $post->fill($data);
      $post->user_id = Auth::id();
      $post->slug = Str::finish(Str::slug($post->title),rand(1, 1000000));
      $post->update($data);

      return redirect()->route('admin.posts.index');
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
      $post->tags()->detach();
      $post->comments()->delete();
      $post->delete();
      return redirect()->route('admin.posts.index');
    }
}
