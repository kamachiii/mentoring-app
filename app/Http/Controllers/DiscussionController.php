<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::all(); 
        return view('layouts.forum', ['discussions' => $discussions]);
    }

    public function store(Request $request)
    {
        // Logic to store discussion topic
        // Validate and save the topic to the database

        return redirect()->route('forum.index')->with('success', 'Diskusi berhasil dibuat.');
    }

    public function show($id)
    {
        // Logic to show a specific discussion topic
        return view('layouts.forum', ['discussionId' => $id]);
    }
}
