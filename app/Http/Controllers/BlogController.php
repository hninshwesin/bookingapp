<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();

        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $heading = $request->input('heading');
        $body = $request->input('body');


        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $store_img = $img->store('public/blog');
            Blog::create([
                'heading' => $heading,
                'body' => $body,
                'image' => $store_img
            ]);
        } else {
            Blog::create([
                'heading' => $heading,
                'body' => $body
            ]);
        }

        return redirect()->route('blog.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $heading = $request->input('heading');
        $body = $request->input('body');

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $store_img = $img->store('public/blog');
            if (Storage::exists($blog->image)) {
                Storage::delete($blog->image);
            }
            $blog->update([
                'heading' => $heading,
                'body' => $body,
                'image' => $store_img
            ]);
        } else {
            $blog->update([
                'heading' => $heading,
                'body' => $body
            ]);
        }

        return redirect()->route('blog.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Blog deleted successfully');
    }
}
