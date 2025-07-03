<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::latest()->with('user')->paginate(10); 
        return view('layouts.forum', ['discussions' => $discussions]);
    }

    public function store(Request $request)
    {
        // Logic to store discussion topic
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        // Validate and save the topic to the database
        Discussion::create([
            'user_id' => Auth::user()->id,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('forum.index')->with('success', 'Diskusi berhasil dibuat.');
    }

    public function show($id)
    {
        // Logic to show a specific discussion topic
        return view('layouts.forum', ['discussionId' => $id]);
    }
}
