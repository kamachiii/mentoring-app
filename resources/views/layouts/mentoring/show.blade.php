@extends('app')
@section('title', 'Detail Jadwal Mentoring')
@section('content')

<a href="{{ route('mentoring.index') }}" class="btn btn-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
</a>

<div class="card">
    <div class="card-header">
        <strong>Detail Jadwal Mentoring</strong>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Tema Mentoring</th>
                <td>{{ $mentoring->tema_mentoring }}</td>
            </tr>
            <tr>
                <th>Nama Mentor</th>
                <td>{{ $mentoring->nama_mentor }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $mentoring->tanggal }}</td>
            </tr>
            <tr>
                <th>Tempat</th>
                <td>{{ $mentoring->tempat }}</td>
            </tr>
            <tr>
                <th>Waktu</th>
                <td>{{ $mentoring->waktu_mulai }} - {{ $mentoring->waktu_selesai }}</td>
            </tr>
            <tr>
                <th>Nomor HP</th>
                <td>+62{{ $mentoring->nomor }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $mentoring->deskripsi ?? '-' }}</td>
            </tr>
        </table>
    </div>
</div>

@endsection
