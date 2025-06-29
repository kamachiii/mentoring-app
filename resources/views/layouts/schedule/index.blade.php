@extends('app')
@section('title', 'Jadwal Show')
@section('content')

{{-- FORM FILTER --}}
<form method="GET" action="{{ route('schedule.index') }}" class="row mb-4">
    <div class="col-md-4">
        <label for="tanggal">Filter Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
    </div>
    <div class="col-md-4">
        <label for="status">Status</label>
        <select name="status" class="form-control">
            <option value="">-- Semua --</option>
            <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Yang Akan Berlangsung</option>
            <option value="past" {{ request('status') == 'past' ? 'selected' : '' }}>Yang Sudah Berlangsung</option>
        </select>
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <button class="btn btn-primary me-2">Filter</button>
        <a href="{{ route('schedule.index') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>
{{-- END FORM FILTER --}}

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Tema Mentoring</th>
            <th>Nama Mentoring</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->tema_mentoring }}</td>
                <td>{{ $item->nama_mentor }}</td>
                <td>
                    <a href="{{ route('schedule.show', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
                </td>
            </tr>
             @empty
            <tr>
                <td colspan="4" class="text-center text-muted">Maaf, jadwal yang Anda telusuri tidak ada.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
