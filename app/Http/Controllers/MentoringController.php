<?php

namespace App\Http\Controllers;

use App\Models\Mentoring;
use Illuminate\Http\Request;

class MentoringController extends Controller
{
    public function index()
    {
        $data = Mentoring::latest()->get();
        return view('layouts.mentoring.index', compact('data'));
    }

    public function create()
    {
        return view('layouts.mentoring.create');
    }

    public function edit($id)
    {
        // $distributor = Distributor::findOrFail($id);
        // return view('distributor.edit', compact('distributor'));
        $mentoring = Mentoring::findOrFail($id);
        return view('layouts.mentoring.edit', compact('mentoring'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tema_mentoring'  => 'required|string|max:255',
            'tanggal'         => 'required|date',
            'tempat'          => 'required|string|max:255',
            'waktu_mulai'     => 'required',
            'waktu_selesai'   => 'required',
            'nama_mentor'     => 'required|string|max:255',
            'nomor'           => 'required|string|max:20',
            'deskripsi'       => 'nullable|string',
        ]);

        $mentoring = Mentoring::create($validated);

        return redirect()->route('mentoring.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        $mentoring = Mentoring::findOrFail($id);
        return view('layouts.jadwaluser.show', compact('mentoring'));
    }

    public function update(Request $request, $id)
    {
        $mentoring = Mentoring::findOrFail($id);

        $validated = $request->validate([
            'tema_mentoring'  => 'required|string|max:255',
            'tanggal'         => 'required|date',
            'tempat'          => 'required|string|max:255',
            'waktu_mulai'     => 'required',
            'waktu_selesai'   => 'required',
            'nama_mentor'     => 'required|string|max:255',
            'nomor'           => 'required|string|max:20',
            'deskripsi'       => 'nullable|string',
        ]);

        $mentoring->update($validated);

        return view('layouts.mentoring.show', compact('mentoring'))->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mentoring = Mentoring::findOrFail($id);
        $mentoring->delete();
        return redirect()->route('mentoring.index')->with('success', 'Data berhasil dihapus!');

        // return response()->json([
        //     'message' => 'Data mentoring berhasil dihapus',
        // ]);
    }
}
