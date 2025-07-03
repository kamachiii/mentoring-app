@extends('app')
@section('title', 'User Dashboard')
@section('content')
<div class="card">
    <div class="card-header row">
        <div class="col-6 align-self-center card-title">
            User Management
        </div>
        <div class="col-6 align-self-center text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Tambah User</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{ Str::ucfirst($user->role) }}
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn"
                            data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}"
                            data-email="{{ $user->email }}"
                            data-role="{{ $user->role }}"
                            data-bs-toggle="modal" data-bs-target="#editUserModal">
                            Edit
                        </button>
                       <a href="{{ route('user.destroy', $user->id) }}"
                            class="btn btn-danger btn-sm"
                            data-confirm-delete="Yakin ingin menghapus user ini?">
                            Hapus
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-center">
                            {!! $users->links('pagination::bootstrap-5') !!}
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addUserModalLabel">Tambah User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label for="name" class="form-label">Nama <span class="text-danger text-sm">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="mb-3">
                  <label for="email" class="form-label">Email <span class="text-danger text-sm">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password <span class="text-danger text-sm">*</span></label>
                  <input type="password" class="form-control" id="password" name="password" required>
              </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role <span class="text-danger text-sm">*</span></label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="" hidden>--Select Role--</option>
                        <option value="admin">Admin</option>
                        <option value="mentor">Mentor</option>
                        <option value="user">User</option>
                    </select>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
    </form>
  </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editUserForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label for="edit_name" class="form-label">Nama <span class="text-danger text-sm">*</span></label>
                  <input type="text" class="form-control" name="name" id="edit_name" required>
              </div>
              <div class="mb-3">
                  <label for="edit_email" class="form-label">Email <span class="text-danger text-sm">*</span></label>
                  <input type="email" class="form-control" name="email" id="edit_email" required>
              </div>
              <div class="mb-3">
                  <label for="edit_password" class="form-label">Password <span class="text-secondary text-sm">(opsional)</span></label>
                  <input type="password" class="form-control" name="password" id="edit_password">
              </div>
              <div class="mb-3">
                    <label for="edit_role" class="form-label">Role <span class="text-danger text-sm">*</span></label>
                    <select class="form-select" id="edit_role" name="role" required>
                        <option value="" hidden>--Select Role--</option>
                        <option value="admin">Admin</option>
                        <option value="mentor">Mentor</option>
                        <option value="user">User</option>
                    </select>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editUserModal = document.getElementById('editUserModal');
        var editUserForm = document.getElementById('editUserForm');
        var editName = document.getElementById('edit_name');
        var editEmail = document.getElementById('edit_email');
        var editPassword = document.getElementById('edit_password');
        var editRole = document.getElementById('edit_role');

        document.querySelectorAll('.edit-btn').forEach(function(button) {
            button.addEventListener('click', function () {
                var id = this.getAttribute('data-id');
                var name = this.getAttribute('data-name');
                var email = this.getAttribute('data-email');
                var role = this.getAttribute('data-role');
                editUserForm.action = '/user/' + id;
                editName.value = name;
                editEmail.value = email;
                editPassword.value = '';
                editRole.value = role;
            });
        });
    });
</script>
@endsection
