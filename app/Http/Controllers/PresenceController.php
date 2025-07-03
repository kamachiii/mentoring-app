<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Presence;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    
    public function index(Request $request)
    {
        
        $currentMentor = Auth::user();

        
        if (!$currentMentor || !$currentMentor->isMentor()) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses sebagai mentor untuk halaman presensi.');
        }

        $currentMentorId = $currentMentor->id;
        $mentorName = $currentMentor->name;

        $showResults = false;
        $presensiDateDisplay = now()->translatedFormat('d F Y'); 

        
        $scheduleToday = Schedule::firstOrCreate(
            [
                'user_id' => $currentMentorId,
                'date' => now()->toDateString(), 
            ],
            [
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',  
                'topic' => 'Sesi Mentoring Harian ' . now()->translatedFormat('d F Y'),
                'description' => 'Jadwal otomatis untuk presensi harian.',
            ]
        );

        if ($request->isMethod('post')) {
            $presensiData = $request->input('ket');

            
            Presence::where('schedule_id', $scheduleToday->id)
                    ->whereDate('created_at', now()->toDateString())
                    ->delete();

            if ($presensiData) {
                foreach ($presensiData as $studentId => $status) {
                    if (!empty($status)) { 
                        $student = User::where('id', $studentId)->where('role', 'user')->first();
                        if ($student) {
                            Presence::create([
                                'user_id' => $studentId,
                                'schedule_id' => $scheduleToday->id,
                                'status' => $status,
                                'created_at' => now(), // Catat tanggal presensi
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
            $showResults = true; 
        }

        
        $allStudents = User::where('role', 'user')->get();

        
        $existingPresences = [];
        if ($scheduleToday) { 
             $existingPresences = Presence::where('schedule_id', $scheduleToday->id)
                                    ->whereDate('created_at', now()->toDateString())
                                    ->pluck('status', 'user_id')
                                    ->toArray();
        }


        return view('presensi', compact('mentorName', 'allStudents', 'showResults', 'presensiDateDisplay', 'existingPresences', 'currentMentorId'));
    }
}