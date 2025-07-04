@extends('app')
@section('title', 'Managemen Kehadiran')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title"><i class="fas fa-list me-2"></i>Daftar Kehadiran</h3>
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'mentor')
                    <div class="ms-auto">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="fas fa-plus me-1"></i> Tambah Data
                        </button>
                    </div>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="attendanceTable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 10px;">#</th>
                                    <th>Nama</th>
                                    <th>Agenda</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($presences as $presence)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>{{ $presence->user->name }}</td>
                                        <td>{{ $presence->schedule->topic }}</td>
                                        <td>{{ $presence->created_at->format('d F Y') }}</td>
                                        <td class="text-center" data-label="Status">
                                            <span class="badge bg-{{ $presence->status == 'present' ? 'success' : ($presence->status == 'absent' ? 'danger' : ($presence->status == 'permit' ? 'warning' : 'secondary')) }}">
                                                {{ $presence->status == 'present' ? 'Hadir' : ($presence->status == 'absent' ? 'Tidak Hadir' : ($presence->status == 'permit' ? 'Izin' : 'Sakit')) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-sm btn-detail" title="Detail" data-bs-toggle="modal" data-bs-target="#detailModal{{ $presence->id }}">Lihat</button>
                                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'mentor')
                                            <button class="btn btn-warning btn-sm btn-edit" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal{{ $presence->id }}">Edit</button>
                                            <a href="{{ route('presence.destroy', $presence->id) }}" class="btn btn-danger btn-sm" data-confirm-delete>
                                                Hapus
                                            </a>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Data -->
                                <div class="modal fade" id="editModal{{ $presence->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Data Absensi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editForm" action="{{ route('presence.update', $presence->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" id="editRowIndex">
                                                    <div class="mb-3">
                                                        <label for="editUser" class="form-label">Nama</label>
                                                        <select name="user_id" class="form-select" id="addUser" required>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}" {{ $presence->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editSchedule" class="form-label">Jadwal</label>
                                                        <select name="schedule_id" class="form-select" id="addSchedule" required>
                                                            @foreach ($schedules as $schedule)
                                                                <option value="{{ $schedule->id }}" {{ $presence->schedule_id == $schedule->id ? 'selected' : '' }}>{{ $schedule->topic }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="editStatus" class="form-label">Status</label>
                                                        <select class="form-select" id="editStatus" name="status" required>
                                                            <option value="present" {{ $presence->status == 'present' ? 'selected' : '' }}>Hadir</option>
                                                            <option value="absent" {{ $presence->status == 'absent' ? 'selected' : '' }}>Tidak Hadir</option>
                                                            <option value="permit" {{ $presence->status == 'permit' ? 'selected' : '' }}>Izin</option>
                                                            <option value="sick" {{ $presence->status == 'sick' ? 'selected' : '' }}>Sakit</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" form="editForm" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal Detail Data -->
                                <div class="modal fade" id="detailModal{{ $presence->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel">Detail Data Absensi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <dl class="row">
                                                    <dt class="col-sm-4">User</dt>
                                                    <dd class="col-sm-8">{{ $presence->user->name }}</dd>

                                                    <dt class="col-sm-4">ID Jadwal</dt>
                                                    <dd class="col-sm-8">{{ $presence->schedule->topic }}</dd>

                                                    <dt class="col-sm-4">Status</dt>
                                                    <dd class="col-sm-8">{{ $presence->status }}</dd>
                                                </dl>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Data -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('presence.store') }}" method="POST" id="addForm">
                    @csrf
                    <div class="mb-3">
                        <label for="addUser" class="form-label">User</label>
                        <select name="user_id" class="form-select" id="addUser" required>
                            <option value="" selected disabled>-- Pilih User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addSchedule" class="form-label">Jadwal</label>
                        <select name="schedule_id" class="form-select" id="addSchedule" required>
                            <option value="" selected disabled>-- Pilih Jadwal --</option>
                            @foreach ($schedules as $schedule)
                                <option value="{{ $schedule->id }}">{{ $schedule->topic }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addStatus" class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="" selected disabled>-- Pilih Status --</option>
                            <option value="present">Hadir</option>
                            <option value="absent">Tidak Hadir</option>
                            <option value="permit">Izin</option>
                            <option value="sick">Sakit</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="addForm" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
