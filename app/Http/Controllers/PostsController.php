<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use GuzzleHttp\Client;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();
        $result = null; // Initialize the result variable
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
    
            // Simulate an SSTI vulnerability using eval
            try {
                $result = eval('return ' . $search . ';');
            } catch (\Throwable $e) {
                
            }
        }
        
        if ($request->has('only-local')) {
            $client = new Client();
            $url = $request->input('only-local');
            return redirect()->away($url);
        }
    
        $posts = $query->get();
    
        return view('posts.index', compact('posts', 'result'));
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
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')
                        ->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return redirect()->route('posts.index')
                        ->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')
                        ->with('success', 'Post deleted successfully.');
    }
}
