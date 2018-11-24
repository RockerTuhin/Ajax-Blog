<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Yajra\Datatables\Datatables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'title' => $request->form_title,
            'author' => $request->form_author,
            'details' => $request->form_details,
        ];
        return Post::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request['form_title'];
        $post->author = $request['form_author'];
        $post->details = $request['form_details'];
        $post->update();
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
    }

    public function all_post()
    {
        $all_post = Post::all();
        return Datatables::of($all_post)
            ->addColumn('action',function($all_post)
                {
                    return '<a onclick="showData('.$all_post->id.')" class="btn btn-sm btn-success">Show</a>'.' '. 
                            '<a onclick="editForm('.$all_post->id.')" class="btn btn-sm btn-info">Edit</a>'.' '. 
                            '<a onclick="deleteData('.$all_post->id.')" class="btn btn-sm btn-danger">Delete</a>';
                })->make(true);
    }
  
}
