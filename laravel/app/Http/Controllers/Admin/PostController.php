<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $validationForm = [
        'title' => 'required|min:3|max:255',
        'post_content' => 'required|min:10',
        'post_image' => 'required|min:3|',
    ];



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::where('user_id', Auth::id())->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $post = new Post();
        return view('admin.posts.create', compact('post'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate($this->validationForm);


        $data = $request->all();
        $data['user_id'] = Auth::id();

        $data['post_date'] = new DateTime();
        
        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'Il post ' . $data["title"] . " è stato creato con successo");

        $post = new Post();
        $post->title = $data['title'];
        $post->post_content = $data['post_content'];
        $post->post_image = $data['post_image'];


        $post->save();
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        return view('admin.posts.show ', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
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
        //
        $validated = $request->validate($this->validationForm);


        $data = $request->all();
        $post = Post::findOrFail($id);

        $post->title = $data['title'];
        $post->post_content = $data['post_content'];
        $post->post_image = $data['post_image'];

        $post->save();
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', 'Il post ' . $post->title . ' è stato eliminato con successo');
    }
}
