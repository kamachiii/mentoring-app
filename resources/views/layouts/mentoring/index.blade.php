@extends('app')
@section('title', 'Jadwal Mentoring')
@section('content')

<a href="{{ route('mentoring.create') }}" class="btn btn-primary mb-3">
    <i class="bi bi-plus-lg"></i> Tambah Jadwal Mentoring
</a>

<table class="table table mt-4">
    <thead>
        <tr>
            <th>No</th>
            <th>Tema Mentoring</th>
            <th>Nama Mentor</th>
            <th>Tanggal</th>
            <th>Tempat</th>
            <th>Waktu</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->tema_mentoring }}</td>
                <td>{{ $item->nama_mentor }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->tempat }}</td>
                <td>{{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</td>
                <td>
                    <a href="{{ route('mentoring.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('mentoring.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
