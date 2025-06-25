<?php

namespace App\Http\Controllers;

use App\Models\Mentoring;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use App\Models\User;

class ScheduleController extends Controller
{
   public function index(Request $request)
    {
        // Ambil semua data jadwal mentoring
        // $data = Mentoring::latest()->get();
        // return view('layouts.schedule.index', compact('data'));
        $query = Mentoring::query();

    if ($request->filled('tanggal')) {
        $query->whereDate('tanggal', $request->tanggal);
    }

    if ($request->filled('status')) {
        $today = Carbon::today();

        if ($request->status === 'upcoming') {
            $query->whereDate('tanggal', '>=', $today);
        } elseif ($request->status === 'past') {
            $query->whereDate('tanggal', '<', $today);
        }
    }

    $data = $query->orderBy('tanggal')->get();

    return view('layouts.schedule.index', compact('data'));
    }

    public function show($id)
    {
        $schedule = Mentoring::findOrFail($id);
        return view('layouts.schedule.show', compact('schedule'));
    }
}
