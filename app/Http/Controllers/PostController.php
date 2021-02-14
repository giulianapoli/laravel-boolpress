<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\Tag;
use App\Category;
use App\PostInformation;
use App\Http\Requests\PostValidator;


class PostController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth', ['except' => [
    //         'index', 'show'
    //     ]]);
    // }

    // public function guest() {
    //     $message = 'Welcome!';

    //     return view('test', compact('message'));
    // }

    // public function logged() {
    //     $user = Auth::user();
    //     $message = 'Welcome, '.$user->name;

    //     return view('test', compact('message'));
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('post', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tags = Tag::all();

        $categories = Category::all();

        if (Auth::check()) {
            $user = Auth::user();
            return view('create', compact(['categories', 'tags', 'user']));
          } else {
            return redirect()->route('posts.index');
          }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostValidator $request)
    {
        $validated = $request->validated();

        // dd($validated);

        $newpost = Post::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'category_id' => $validated['categories'],
        ]);
        
        

        $newPostInformation = PostInformation::create([
            'post_id' => $newpost->id,
            'description' => $validated['description'],
            'slug' => 'I am a Slug!'        
        ]);


        $newpost->postToTag()->attach($validated['tags']);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        

        return view('watch_post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $post = Post::find($id);

        // $tags = Tag::all();

        // $category = Category::all();

        if (Auth::check()) {
            return view("edit",compact("post"));
        } else {
            return redirect()->back();
        }
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $data = $request->all();

        $post->update($data);

        $post->postToPostInformation->update($data);
        

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Questa funzione vuole un form nella vista

        $post = Post::find($id);

        $post->postToPostInformation->delete();

        foreach ($post->postToTag as $tag) {
            $post->postToTag()->detach($tag->id);
        }

        $post->delete();

        return redirect()->back();
    }
}
