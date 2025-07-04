<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Presence;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PresenceController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'user') {
            $presences = Presence::with(['user', 'schedule'])
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(10);
        } else {
            $presences = Presence::with(['user', 'schedule'])->latest()->paginate(10);
        }
        $users = User::where('role', 'user')->get();
        $schedules = Schedule::latest()->get();

        confirmDelete('Delete', 'Are you sure you want to delete this presence record?');
        return view('layouts.presence.index', compact('presences', 'users', 'schedules'));
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'user_id' => 'required|exists:users,id',
                'schedule_id' => 'required|exists:schedules,id',
                'status' => 'required|in:present,absent,late,sick',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        }

        $createPresence = Presence::create($validate);
        if (!$createPresence) {
            Alert::error('Error', 'Failed to create presence record.');
            return redirect()->back();
        }

        Alert::success('Success', 'Presence record created successfully.');
        return redirect()->route('presence.index');
    }

    public function update(Request $request, $id)
    {
        try {
            $presence = Presence::findOrFail($id);
            $validate = $request->validate([
                'user_id' => 'required|exists:users,id',
                'schedule_id' => 'required|exists:schedules,id',
                'status' => 'required|in:present,absent,sick,permit',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        }

        $updatePresence = $presence->update($validate);
        if (!$updatePresence) {
            Alert::error('Error', 'Failed to update presence record.');
            return redirect()->back();
        }

        Alert::success('Success', 'Presence record updated successfully.');
        return redirect()->route('presence.index');
    }

    public function destroy($id)
    {
        try {
            $presence = Presence::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Alert::error('Error', 'Presence record not found.');
            return redirect()->back();
        }

        if (!$presence->delete()) {
            Alert::error('Error', 'Failed to delete presence record.');
            return redirect()->back();
        }
        Alert::success('Success', 'Presence record deleted successfully.');
        return redirect()->route('presence.index');
    }
}
