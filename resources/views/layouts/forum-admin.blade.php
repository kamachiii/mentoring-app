<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forum Diskusi</title>
  <!-- AdminLTE & Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.2/dist/css/adminlte.min.css">
</head>
<body class="layout-fixed sidebar-mini">
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper p-4">
      <div class="container">
        <h3 class="mb-4">Forum Diskusi</h3>

        <!-- Form Diskusi -->
        <form id="form-diskusi">
          <div class="mb-3">
            <label for="topik" class="form-label">Topik Diskusi</label>
            <input type="text" class="form-control" id="Topik" required>
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
                    <th>#</th>
                    <th>Topik Diskusi</th>
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

      </div>
    </div>
  </div>

  <!-- Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('form-diskusi');
      const topikInput = document.getElementById('topik');
      const laporanTable = document.getElementById('tabel-laporan');
      let no = 1;

      form.addEventListener('submit', function (e) {
        e.preventDefault();

        const topik = topikInput.value.trim();
        const waktu = new Date().toLocaleString();
        const nama = "Anda"; // Ganti nanti dengan nama login jika perlu

        if (topik) {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${no++}</td>
            <td>${topik}</td>
            <td>${waktu}</td>
          `;
          laporanTable.prepend(row);

          judulInput.value = '';
        }
      });
    });
  </script>

     <!-- Form Mentor -->
        <form id="form-diskusi">
           <form action="proses.php" method="post" class="p-3">
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

      </div>
    </div>
  </div>

  <!-- Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('form-diskusi');
      const topikInput = document.getElementById('topik');
      const laporanTable = document.getElementById('tabel-laporan');
      let no = 1;

      form.addEventListener('submit', function (e) {
        e.preventDefault();

        const topik = topikInput.value.trim();
        const waktu = new Date().toLocaleString();
        const nama = "Anda"; // Ganti nanti dengan nama login jika perlu

        if (topik) {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${no++}</td>
            <td>${topik}</td>
            <td>${waktu}</td>
          `;
          laporanTable.prepend(row);

          judulInput.value = '';
        }
      });
    });
  </script>


 <!-- Form User -->
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

      </div>
    </div>
  </div>

  <!-- Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('form-diskusi');
      const topikInput = document.getElementById('topik');
      const laporanTable = document.getElementById('tabel-laporan');
      let no = 1;

      form.addEventListener('submit', function (e) {
        e.preventDefault();

        const topik = topikInput.value.trim();
        const waktu = new Date().toLocaleString();
        const nama = "Anda"; // Ganti nanti dengan nama login jika perlu

        if (topik) {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${no++}</td>
            <td>${topik}</td>
            <td>${waktu}</td>
          `;
          laporanTable.prepend(row);

          judulInput.value = '';
        }
      });
    });
  </script>

  <!-- AdminLTE & Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.2/dist/js/adminlte.min.js"></script>
</body>
</html>


