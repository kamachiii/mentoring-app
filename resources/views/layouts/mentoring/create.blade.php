@extends('app')
@section('title', 'Tambah Jadwal Mentoring')
@section('content')

<a href="{{ route('mentoring.index') }}" class="btn btn-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
</a>

<div class="card">
    <div class="card-header">
        <strong>Form Tambah Jadwal Mentoring</strong>
    </div>
    <div class="card-body">
        <form action="{{ route('mentoring.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="tema_mentoring">Tema Mentoring</label>
                <input type="text" name="tema_mentoring" id="tema_mentoring" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tempat">Tempat</label>
                <input type="text" name="tempat" id="tempat" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="waktu_mulai">Waktu Mulai</label>
                <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="waktu_selesai">Waktu Selesai</label>
                <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nama_mentor">Nama Mentor</label>
                <input type="text" name="nama_mentor" id="nama_mentor" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nomor">Nomor HP</label>
                <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input type="number" name="nomor" id="nomor" class="form-control" placeholder="81234567890" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>

@endsection
