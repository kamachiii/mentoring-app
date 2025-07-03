<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MentoringGroup;
use RealRashid\SweetAlert\Facades\Alert;

class MentoringGroupController extends Controller
{
    public function index()
    {
        $groups = MentoringGroup::latest()->paginate(5);

        confirmDelete('Delete', 'Are you sure you want to delete this mentoring group?');
        return view('layouts.mentoring_group.index', compact('groups'));
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        }

        $createMontoring = MentoringGroup::create($validate);
        if (!$createMontoring) {
            Alert::error('Error', 'Failed to create mentoring group.');
            return redirect()->back();
        }

        Alert::success('Success', 'Mentoring group created successfully.');
        return redirect()->route('mentoring-group.index');
    }

    public function update(Request $request, $id)
    {
        try {
            $group = MentoringGroup::findOrFail($id);
            $validate = $request->validate([
                'name' => 'required|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            Alert::error('Error', implode('<br>', $errors));
            return redirect()->back()->withInput();
        }

        $updateGroup = $group->update($validate);
        if (!$updateGroup) {
            Alert::error('Error', 'Failed to update mentoring group.');
            return redirect()->back();
        }

        Alert::success('Success', 'Mentoring group updated successfully.');
        return redirect()->route('mentoring-group.index');
    }

    public function destroy($id)
    {
        try {
            $group = MentoringGroup::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Alert::error('Error', 'Mentoring group not found.');
            return redirect()->back();
        }

        if (!$group->delete()) {
            Alert::error('Error', 'Failed to delete mentoring group.');
            return redirect()->back();
        }
        Alert::success('Success', 'Mentoring group deleted successfully.');
        return redirect()->route('mentoring-group.index');
    }
}
