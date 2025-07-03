@extends('app')
@section('title', 'Jadwal Mentoring')
@section('content')
<div class="card">
    <div class="card-header row">
        <div class="col-6 align-self-center card-title">
            <h3 class="card-title">
                <i class="bi bi-calendar-event me-2"></i>Jadwal Mentoring
            </h3>
        </div>
        <div class="col-6 align-self-center text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModal">Tambah Jadwal</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>User</th>
                    <th>Tanggal</th>
                    <th>Topik</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr>
                    <td>{{ ($schedules->currentPage() - 1) * $schedules->perPage() + $loop->iteration }}</td>
                    <td>{{ $schedule->user->name }}</td>
                    <td>{{ $schedule->date }}</td>
                    <td>{{ $schedule->topic }}</td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                    <td class="text-center">
                        <button class="btn btn-info btn-sm view-btn"
                            data-user="{{ $schedule->user->name }}"
                            data-date="{{ $schedule->date }}"
                            data-location="{{ $schedule->location }}"
                            data-start_time="{{ $schedule->start_time }}"
                            data-end_time="{{ $schedule->end_time }}"
                            data-topic="{{ $schedule->topic }}"
                            data-description="{{ $schedule->description }}"
                            data-bs-toggle="modal" data-bs-target="#viewScheduleModal">
                            Lihat
                        </button>
                        <button class="btn btn-warning btn-sm edit-btn"
                            data-id="{{ $schedule->id }}"
                            data-users_id="{{ $schedule->mentor_id }}"
                            data-date="{{ $schedule->date }}"
                            data-location="{{ $schedule->location }}"
                            data-start_time="{{ $schedule->start_time }}"
                            data-end_time="{{ $schedule->end_time }}"
                            data-topic="{{ $schedule->topic }}"
                            data-description="{{ $schedule->description }}"
                            data-bs-toggle="modal" data-bs-target="#editScheduleModal">
                            Edit
                        </button>
                        <a href="{{ route('schedule.destroy', $schedule->id) }}"
                            class="btn btn-danger btn-sm"
                            data-confirm-delete>
                            Hapus
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="9" class="text-center">
                        {!! $schedules->links('pagination::bootstrap-5') !!}
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Modal lihat detail Jadwal -->
<div class="modal fade" id="viewScheduleModal" tabindex="-1" aria-labelledby="viewScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-info text-dark">
                <h5 class="modal-title" id="viewScheduleModalLabel">
                    <i class="bi bi-calendar-event me-2"></i>Detail Jadwal
                </h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <div class="row mb-2">
                    <div class="col-4 fw-semibold text-dark">User</div>
                    <div class="col-8" id="view_user"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 fw-semibold text-dark">Tanggal</div>
                    <div class="col-8" id="view_date"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 fw-semibold text-dark">Lokasi</div>
                    <div class="col-8" id="view_location"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 fw-semibold text-dark">Mulai</div>
                    <div class="col-8" id="view_start_time"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 fw-semibold text-dark">Selesai</div>
                    <div class="col-8" id="view_end_time"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 fw-semibold text-dark">Topik</div>
                    <div class="col-8" id="view_topic"></div>
                </div>
                <div class="row mb-2">
                    <div class="col-4 fw-semibold text-dark">Deskripsi</div>
                    <div class="col-8" id="view_description"></div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Jadwal -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('schedule.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-content shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="addScheduleModalLabel">
                                <i class="bi bi-calendar-plus me-2"></i>Tambah Jadwal
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 py-3">
                            <div class="mb-3">
                                    <label for="users_id" class="form-label fw-semibold">User <span class="text-danger">*</span></label>
                                    <select class="form-select" id="users_id" name="mentor_id" required>
                                            <option value="" hidden>--Pilih User--</option>
                                            @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                    </select>
                            </div>
                            <div class="mb-3">
                                    <label for="date" class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="mb-3">
                                    <label for="location" class="form-label fw-semibold">Lokasi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="location" name="location" required placeholder="Masukkan lokasi">
                            </div>
                            <div class="row">
                                    <div class="col-md-6 mb-3">
                                            <label for="start_time" class="form-label fw-semibold">Mulai <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                            <label for="end_time" class="form-label fw-semibold">Selesai <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" id="end_time" name="end_time" required>
                                    </div>
                            </div>
                            <div class="mb-3">
                                    <label for="topic" class="form-label fw-semibold">Topik <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="topic" name="topic" required placeholder="Masukkan topik">
                            </div>
                            <div class="mb-3">
                                    <label for="description" class="form-label fw-semibold">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" rows="2" placeholder="Opsional"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </div>
        </form>
    </div>
</div>

<!-- Modal Edit Jadwal -->
<div class="modal fade" id="editScheduleModal" tabindex="-1" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editScheduleForm" method="POST" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editScheduleModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>Edit Jadwal
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label for="edit_users_id" class="form-label fw-semibold">User <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit_users_id" name="mentor_id" required>
                            <option value="" hidden>--Pilih User--</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_date" class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="edit_date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_location" class="form-label fw-semibold">Lokasi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_location" name="location" required placeholder="Masukkan lokasi">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_start_time" class="form-label fw-semibold">Mulai <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="edit_start_time" name="start_time" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_end_time" class="form-label fw-semibold">Selesai <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="edit_end_time" name="end_time" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_topic" class="form-label fw-semibold">Topik <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_topic" name="topic" required placeholder="Masukkan topik">
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="2" placeholder="Opsional"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // View Schedule Modal
        var viewScheduleModal = document.getElementById('viewScheduleModal');
        if (viewScheduleModal) {
            viewScheduleModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var user = button.getAttribute('data-user');
                var date = button.getAttribute('data-date');
                var location = button.getAttribute('data-location');
                var startTime = button.getAttribute('data-start_time');
                var endTime = button.getAttribute('data-end_time');
                var topic = button.getAttribute('data-topic');
                var description = button.getAttribute('data-description');

                // Update the modal's content.
                var viewUser = viewScheduleModal.querySelector('#view_user');
                var viewDate = viewScheduleModal.querySelector('#view_date');
                var viewLocation = viewScheduleModal.querySelector('#view_location');
                var viewStartTime = viewScheduleModal.querySelector('#view_start_time');
                var viewEndTime = viewScheduleModal.querySelector('#view_end_time');
                var viewTopic = viewScheduleModal.querySelector('#view_topic');
                var viewDescription = viewScheduleModal.querySelector('#view_description');

                viewUser.textContent = user;
                viewDate.textContent = date;
                viewLocation.textContent = location;
                viewStartTime.textContent = startTime;
                viewEndTime.textContent = endTime;
                viewTopic.textContent = topic;
                viewDescription.textContent = description;
            });
        }

        // Edit Schedule Modal
        var editScheduleForm = document.getElementById('editScheduleForm');
        var editUsersId = document.getElementById('edit_users_id');
        var editDate = document.getElementById('edit_date');
        var editLocation = document.getElementById('edit_location');
        var editStartTime = document.getElementById('edit_start_time');
        var editEndTime = document.getElementById('edit_end_time');
        var editTopic = document.getElementById('edit_topic');
        var editDescription = document.getElementById('edit_description');

        document.querySelectorAll('.edit-btn').forEach(function(button) {
            button.addEventListener('click', function () {
                var id = this.getAttribute('data-id');
                var users_id = this.getAttribute('data-users_id');
                var date = this.getAttribute('data-date');
                var location = this.getAttribute('data-location');
                var start_time = this.getAttribute('data-start_time');
                var end_time = this.getAttribute('data-end_time');
                var topic = this.getAttribute('data-topic');
                var description = this.getAttribute('data-description');
                editScheduleForm.action = '/schedule/' + id;
                editUsersId.value = users_id;
                editDate.value = date;
                editLocation.value = location;
                editStartTime.value = start_time;
                editEndTime.value = end_time;
                editTopic.value = topic;
                editDescription.value = description;
            });
        });
    });
</script>
@endsection
