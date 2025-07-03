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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMentoringGroupModal">Tambah Jadwal</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Nama Mentoring Group</th>
                <th class="text-center" style="width: 200px">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($groups as $group)
            <tr>
                <td>{{ ($groups->currentPage() - 1) * $groups->perPage() + $loop->iteration }}</td>
                <td>{{ $group->name }}</td>
                <td class="text-center">
                    <button class="btn btn-info btn-sm view-btn"
                        data-name="{{ $group->name }}"
                        data-bs-toggle="modal" data-bs-target="#viewMentoringGroupModal">
                        Lihat
                    </button>
                    <button class="btn btn-warning btn-sm edit-btn"
                        data-id="{{ $group->id }}"
                        data-name="{{ $group->name }}"
                        data-bs-toggle="modal" data-bs-target="#editMentoringGroupModal">
                        Edit
                    </button>
                    <a href="{{ route('mentoring-group.destroy', $group->id) }}"
                        class="btn btn-danger btn-sm delete-btn"
                        data-confirm-delete>
                        Hapus
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="3" class="text-center">
                {!! $groups->links('pagination::bootstrap-5') !!}
                </th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Modal lihat detail Mentoring Group -->
<div class="modal fade" id="viewMentoringGroupModal" tabindex="-1" aria-labelledby="viewMentoringGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-info text-dark">
                <h5 class="modal-title" id="viewMentoringGroupModalLabel">
                    <i class="bi bi-people me-2"></i>Detail Mentoring Group
                </h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <div class="row mb-2">
                    <div class="col-4 fw-semibold text-dark">Nama Group</div>
                    <div class="col-8 text-end" id="view_group_name"></div>
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

<!-- Modal Tambah Mentoring Group -->
<div class="modal fade" id="addMentoringGroupModal" tabindex="-1" aria-labelledby="addMentoringGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('mentoring-group.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addMentoringGroupModalLabel">
                        <i class="bi bi-people me-2"></i>Tambah Mentoring Group
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Group <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required maxlength="255" placeholder="Masukkan nama group">
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

<!-- Modal Edit Mentoring Group -->
<div class="modal fade" id="editMentoringGroupModal" tabindex="-1" aria-labelledby="editMentoringGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editMentoringGroupForm" method="POST" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editMentoringGroupModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>Edit Mentoring Group
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label for="edit_group_name" class="form-label fw-semibold">Nama Group <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_group_name" name="name" required maxlength="255" placeholder="Masukkan nama group">
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
        // View Mentoring Group Modal
        var viewMentoringGroupModal = document.getElementById('viewMentoringGroupModal');
        if (viewMentoringGroupModal) {
            viewMentoringGroupModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var groupName = button.getAttribute('data-name');
                var viewGroupName = viewMentoringGroupModal.querySelector('#view_group_name');
                viewGroupName.textContent = groupName;
            });
        }

        // Edit Mentoring Group Modal
        var editMentoringGroupModal = document.getElementById('editMentoringGroupModal');
        var editMentoringGroupForm = document.getElementById('editMentoringGroupForm');
        var editGroupNameInput = document.getElementById('edit_group_name');

        document.querySelectorAll('.edit-btn').forEach(function(button) {
            button.addEventListener('click', function () {
                var id = this.getAttribute('data-id');
                var name = this.getAttribute('data-name');
                editMentoringGroupForm.action = '/mentoring-group/' + id;
                editGroupNameInput.value = name;
            });
        });
    });
</script>
@endsection
