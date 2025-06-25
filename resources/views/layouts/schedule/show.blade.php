@extends('app')
@section('title', 'Detail Jadwal')
@section('content')

<a href="{{ route('schedule.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

<div class="card">
    <div class="card-body">
        <h4 class="mb-3">{{ $schedule->tema_mentoring }}</h4>

        <p><strong>Mentor:</strong> {{ $schedule->nama_mentor }}</p>
        <p><strong>Tanggal:</strong> {{ $schedule->tanggal }}</p>
        <p><strong>Tempat:</strong> {{ $schedule->tempat }}</p>
        <p><strong>Waktu:</strong> {{ $schedule->waktu_mulai }} - {{ $schedule->waktu_selesai }}</p>
        <p><strong>Deskripsi:</strong><br> {{ $schedule->deskripsi }}</p>
    </div>
</div>
@endsection
