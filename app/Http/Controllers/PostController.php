<?php

namespace App\Http\Controllers;

use App\Models\Post; // Pastikan baris model ini ada di atas
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // 1. Ambil data berita dari database
        $posts = Post::latest()->get();

        // 2. Kirim variabel $posts ke file index.blade.php
        return view('index', compact('posts'));
    }
}