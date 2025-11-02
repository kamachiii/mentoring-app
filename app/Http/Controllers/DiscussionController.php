<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::latest()->with('user')->paginate(5);

        confirmDelete('Delete', 'Are you sure you want to delete this discussion?');
        return view('layouts.forum', compact('discussions'));
    }

    public function store(Request $request)
    {
        // Authorization check
        $this->authorize('create', Discussion::class);
        
        try {
            $validate = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string|max:10000',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        }

        $validate['user_id'] = Auth::user()->id;
        // Sanitize content to prevent XSS
        $validate['title'] = strip_tags($validate['title']);
        $validate['content'] = strip_tags($validate['content']);
        
        $createDiscussion = Discussion::create($validate);
        if (!$createDiscussion) {
            Alert::error('Error', 'Failed to create discussion.');
            return redirect()->back();
        }

        Alert::success('Success', 'Discussion created successfully.');
        return redirect()->route('forum.index');
    }

    public function update(Request $request, $id)
    {
        try {
            $discussion = Discussion::findOrFail($id);
            
            // Authorization check
            $this->authorize('update', $discussion);
            
            $validate = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string|max:10000',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            Alert::error('Error', 'You are not authorized to update this discussion.');
            return redirect()->back();
        }

        // Sanitize content to prevent XSS
        $validate['title'] = strip_tags($validate['title']);
        $validate['content'] = strip_tags($validate['content']);
        
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
            
            // Authorization check
            $this->authorize('delete', $discussion);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Alert::error('Error', 'Discussion not found.');
            return redirect()->back();
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            Alert::error('Error', 'You are not authorized to delete this discussion.');
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
