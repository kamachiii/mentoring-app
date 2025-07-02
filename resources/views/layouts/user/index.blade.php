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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn"
                            data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}"
                            data-email="{{ $user->email }}"
                            data-bs-toggle="modal" data-bs-target="#editUserModal">
                            Edit
                        </button>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus user ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
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
                  <label for="name" class="form-label">Nama</label>
                  <input type="text" class="form-control" name="name" required>
              </div>
              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" required>
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" required>
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
                  <label for="edit_name" class="form-label">Nama</label>
                  <input type="text" class="form-control" name="name" id="edit_name" required>
              </div>
              <div class="mb-3">
                  <label for="edit_email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="edit_email" required>
              </div>
              <div class="mb-3">
                  <label for="edit_password" class="form-label">Password (isi jika ingin ganti)</label>
                  <input type="password" class="form-control" name="password" id="edit_password">
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editUserModal = document.getElementById('editUserModal');
        var editUserForm = document.getElementById('editUserForm');
        var editName = document.getElementById('edit_name');
        var editEmail = document.getElementById('edit_email');
        var editPassword = document.getElementById('edit_password');

        document.querySelectorAll('.edit-btn').forEach(function(button) {
            button.addEventListener('click', function () {
                var id = this.getAttribute('data-id');
                var name = this.getAttribute('data-name');
                var email = this.getAttribute('data-email');
                editUserForm.action = '/user/' + id;
                editName.value = name;
                editEmail.value = email;
                editPassword.value = '';
            });
        });
    });
</script>
@endpush

@endsection
