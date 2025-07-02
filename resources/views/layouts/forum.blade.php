@extends('app')
@section('title', 'Jadwal Mentoring')
@section('content')
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper p-4">
      <div class="container">
        <h3 class="mb-4">Forum Diskusi</h3>

        <!-- Form Diskusi -->
         @if (auth()->user()->role == 'admin')
        <form id="form-diskusi">
          <div class="mb-3">
            <label for="topik" class="form-label">Topik Diskusi</label>
            <input type="text" class="form-control" id="topik" required>
          </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
        
        <hr>

        <!-- Tabel Laporan -->
        <div class="card mt-4">
          <div class="card-header bg-primary text-white">
            Laporan Aktivitas Diskusi (Admin Only)
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>User</th>
                    <th>Title</th>
                    <th>Content</th>
                  </tr>
                </thead>
                <tbody id="tabel-laporan">
                  <!-- Isi dari JavaScript -->
                  @foreach ($discussions as $item)
                  <tr>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->content }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
          @endif

     <!-- Form Mentor -->
      @if (auth()->user()->role == 'mentor')
        <form id="form-diskusi">          
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="nama">Nama Mentor</label>
      <input type="text" class="form-control" id="nama" name="nama">
    </div>
    <div class="form-group col-md-5">
      <label for="judul">Judul Diskusi</label>
      <input type="text" class="form-control" id="judul" name="judul">
    </div>
    <div class="form-group">
    <label for="isi">Isi Topik Diskusi</label>
    <textarea class="form-control" id="isi" name="isi" rows="5" placeholder="Tulis isi diskusi di sini..."></textarea>
  </div>
  </div>
  <button type="submit" class="btn btn-primary">Kirim</button>
</form>
        <hr>

        <!-- Tabel Laporan -->
        <div class="card mt-4">
          <div class="card-header bg-primary text-white">
            Laporan Aktivitas Diskusi 
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Mentor</th>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Waktu</th>
                  </tr>
                </thead>
                <tbody id="tabel-laporan">
                  <!-- Isi dari JavaScript -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @endif 

 <!-- Form User -->
  @if (auth()->user()->role == 'user') 
        <form id="form-diskusi">
         <div class="form-group col-md-4">
      <label for="nama">Nama User</label>
      <input type="text" class="form-control" id="nama" name="nama">
    </div>
    <div class="form-group col-md-5">
      <label for="judul">Judul Diskusi</label>
      <input type="text" class="form-control" id="judul" name="judul">
    </div>
    <div class="form-group">
    <label for="isi">Komentar</label>
    <textarea class="form-control" id="isi" name="isi" rows="5" placeholder="Tulis isi diskusi di sini..."></textarea>
  </div>
          <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
     

        <hr>

        <!-- Tabel Laporan -->
        <div class="card mt-4">
          <div class="card-header bg-primary text-white">
            Laporan Aktivitas Diskusi 
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama User</th>
                    <th>Judul</th>
                    <th>Komentar</th>
                    <th>Waktu</th>
                  </tr>
                </thead>
                <tbody id="tabel-laporan">
                  <!-- Isi dari JavaScript -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
           @endif 

      </div>
    </div>
  </div>
 

  <!-- AdminLTE & Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.2/dist/js/adminlte.min.js"></script>

  @endsection


