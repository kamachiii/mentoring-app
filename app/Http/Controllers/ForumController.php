<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ForumController extends Controller
{
    public function index()
    {
        $discussions = Discussion::latest()->with('user')->paginate(5);

        confirmDelete('Delete', 'Are you sure you want to delete this discussion?');
        return view('layouts.forum.index', compact('discussions'));
    }

    public function show($id)
    {
        try {
            $discussion = Discussion::with('user')->findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Alert::error('Error', 'Discussion not found.');
            return redirect()->route('forum.index');
        }

        return view('layouts.forum.show', compact('discussion'));
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        }

        $validate['user_id'] = Auth::user()->id;
        $createDiscussion = Discussion::create($validate);
        if (!$createDiscussion) {
            Alert::error('Error', 'Failed to create discussion.');
            return redirect()->back();
        }

        Alert::success('Success', 'Discussion created successfully.');
        return redirect()->route('forum.index');
    }

    public function storeComment(Request $request)
    {
        try {
            $validate = $request->validate([
                'discussion_id' => 'required|exists:discussions,id',
                'content' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        }

        $validate['user_id'] = Auth::user()->id;
        $discussion = Discussion::findOrFail($validate['discussion_id']);
        $createComment = $discussion->comments()->create($validate);
        if (!$createComment) {
            Alert::error('Error', 'Failed to add comment.');
            return redirect()->back();
        }

        Alert::success('Success', 'Comment added successfully.');
        return redirect()->route('forum.show', ['forum' => $discussion->id]);
    }

    public function update(Request $request, $id)
    {
        try {
            $discussion = Discussion::findOrFail($id);
            $validate = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        }

        $updateDiscussion = $discussion->update($validate);
        if (!$updateDiscussion) {
            Alert::error('Error', 'Failed to update discussion.');
            return redirect()->back();
        }

        Alert::success('Success', 'Discussion updated successfully.');
        return redirect()->route('forum.index');
    }

    public function destroy($id)
    {
        try {
            $discussion = Discussion::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Alert::error('Error', 'Discussion not found.');
            return redirect()->back();
        }

        if (!$discussion->delete()) {
            Alert::error('Error', 'Failed to delete discussion.');
            return redirect()->back();
        }
        Alert::success('Success', 'Discussion deleted successfully.');
        return redirect()->route('forum.index');
    }
}
