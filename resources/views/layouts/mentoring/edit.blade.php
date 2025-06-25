@extends('app')
@section('title', 'Edit Jadwal Mentoring')
@section('content')

<a href="{{ route('mentoring.index') }}" class="btn btn-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
</a>

<div class="card">
    <div class="card-header">
        <strong>Edit Jadwal Mentoring</strong>
    </div>
    <div class="card-body">
        <form action="{{ route('mentoring.update', $mentoring->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="tema_mentoring">Tema Mentoring</label>
                <input type="text" name="tema_mentoring" id="tema_mentoring" class="form-control" value="{{ $mentoring->tema_mentoring }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $mentoring->tanggal }}" required>
            </div>

            <div class="mb-3">
                <label for="tempat">Tempat</label>
                <input type="text" name="tempat" id="tempat" class="form-control" value="{{ $mentoring->tempat }}" required>
            </div>

            <div class="mb-3">
                <label for="waktu_mulai">Waktu Mulai</label>
                <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" value="{{ $mentoring->waktu_mulai }}" required>
            </div>

            <div class="mb-3">
                <label for="waktu_selesai">Waktu Selesai</label>
                <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" value="{{ $mentoring->waktu_selesai }}" required>
            </div>

            <div class="mb-3">
                <label for="nama_mentor">Nama Mentor</label>
                <input type="text" name="nama_mentor" id="nama_mentor" class="form-control" value="{{ $mentoring->nama_mentor }}" required>
            </div>

            <div class="mb-3">
                <label for="nomor">Nomor HP</label>
                <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input type="text" name="nomor" id="nomor" class="form-control" value="{{ ltrim($mentoring->nomor, '+62') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ $mentoring->deskripsi }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Perbarui</button>
        </form>
    </div>
</div>

@endsection
