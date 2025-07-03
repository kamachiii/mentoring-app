<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::latest()->paginate(5);
        $users = User::where('role', 'mentor')->get();

        confirmDelete('Delete','Are you sure you want to delete this schedule?');
        return view('layouts.schedule.index', compact('schedules', 'users'));
    }


    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'mentor_id'          => 'required|exists:users,id',
                'mentoring_group_id' => 'exists:mentoring_groups,id',
                'date'               => 'required|date',
                'location'           => 'required|string|max:255',
                'start_time'         => 'required',
                'end_time'           => 'required',
                'topic'              => 'required|string|max:255',
                'description'        => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        }

        $createSchedule = Schedule::create($validate);
        if (!$createSchedule) {
            Alert::error('Error', 'Failed to create schedule.');
            return redirect()->back();
        }

        Alert::success('Success', 'Schedule created successfully.');
        return redirect()->route('schedule.index');
    }

    public function update(Request $request, $id)
    {
        try {
            $schedule = Schedule::findOrFail($id);
            $validate = $request->validate([
                'mentor_id'          => 'required|exists:users,id',
                'mentoring_group_id' => 'exists:mentoring_groups,id',
                'date'               => 'required|date',
                'location'           => 'required|string|max:255',
                'start_time'         => 'required',
                'end_time'           => 'required',
                'topic'              => 'required|string|max:255',
                'description'        => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        }

        $updateSchedule = $schedule->update($validate);
        if(!$updateSchedule) {
            Alert::error('Error', 'Failed to update schedule.');
            return redirect()->back();
        }

        Alert::success('Success', 'Schedule updated successfully.');
        return redirect()->route('schedule.index');
    }

    public function destroy($id)
    {
        try {
            $schedule = Schedule::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Alert::error('Error', 'Schedule not found.');
            return redirect()->back();
        }

        if (!$schedule->delete()) {
            Alert::error('Error', 'Failed to delete schedule.');
            return redirect()->back();
        }
        Alert::success('Success', 'Schedule deleted successfully.');
        return redirect()->route('schedule.index');
    }
}
