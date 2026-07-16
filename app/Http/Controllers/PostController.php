<?php

namespace App\Http\Controllers;

use App\Models\Post; // Pastikan baris model ini ada di atas
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'nullable|string',
            'publisher' => 'nullable|string',
            'image' => 'nullable|url',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category ?? 'Umum',
            'publisher' => $request->publisher ?? 'Redaksi',
            'image' => $request->image,
            'published' => 'yes',
        ]);

        return redirect()->route('posts.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
}