<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Multi-Peran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
      /* Keep minimal custom styles if absolutely necessary, but aim to use AdminLTE classes */
      body {
        font-family: 'Inter', sans-serif;
      }
      .tab-content {
        display: none;
      }
      .tab-content.active {
        display: block;
      }
    </style>
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <h1 class="nav-link text-2xl font-bold text-gray-800">Dashboard</h1>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <span class="nav-link text-gray-600">Halo, Alexander Pierce</span>
          </li>
          <li class="nav-item">
            <img
              src="https://placehold.co/40x40/cccccc/ffffff?text=AP"
              alt="Profil Pengguna"
              class="img-circle elevation-2"
              style="height: 40px; width: 40px;"
            />
          </li>
        </ul>
      </nav>
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
          <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Multi-Peran</span>
        </a>

        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="https://placehold.co/160x160/cccccc/ffffff?text=AP" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">Alexander Pierce</a>
            </div>
          </div>

          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="#" class="nav-link active tab-button" onclick="showTab('user', this)">
                  <i class="nav-icon fas fa-user"></i>
                  <p>User Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link tab-button" onclick="showTab('admin', this)">
                  <i class="nav-icon fas fa-crown"></i>
                  <p>Admin Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link tab-button" onclick="showTab('mentoring', this)">
                  <i class="nav-icon fas fa-handshake"></i>
                  <p>Mentoring Dashboard</p>
                </a>
              </li>
            </ul>
          </nav>
          </div>
        </aside>

      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Dashboard Overview</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="content">
          <div class="container-fluid">
            <div id="user" class="tab-content active row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>1,234</h3>
                    <p>Jumlah Pengguna Aktif</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-chart-line"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-12">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-book-open mr-2"></i>Kursus Terdaftar</h3>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled">
                      <li>Pengembangan Web (80% Selesai)</li>
                      <li>Desain UI/UX (65% Selesai)</li>
                      <li>Manajemen Proyek (40% Selesai)</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-lg-5 col-12">
                <div class="card card-warning card-outline">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-bell mr-2"></i>Notifikasi Terbaru</h3>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled">
                      <li><span class="font-weight-bold">Baru:</span> Materi "CSS Lanjutan" telah ditambahkan.</li>
                      <li><span class="font-weight-bold">Pengingat:</span> Kuis Bab 3 jatuh tempo besok.</li>
                      <li><span class="font-weight-bold">Pesan:</span> Anda memiliki pesan baru dari Mentor Anda.</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-12">
                <div class="card card-success card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Kemajuan Kursus Anda</h3>
                  </div>
                  <div class="card-body">
                    <div class="progress-group">
                      HTML Dasar
                      <span class="float-right"><b>90</b>/100</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 90%"></div>
                      </div>
                    </div>
                    <div class="progress-group">
                      JavaScript Interaktif
                      <span class="float-right"><b>75</b>/100</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 75%"></div>
                      </div>
                    </div>
                    <div class="progress-group">
                      React Fundamental
                      <span class="float-right"><b>50</b>/100</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 50%"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-12">
                <div class="card card-info card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Diskusi Forum Terbaru</h3>
                  </div>
                  <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                      <li class="item">
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title">Bagaimana cara kerja React Hooks?</a>
                          <span class="product-description">Diposting oleh Joko Susilo 2 jam yang lalu</span>
                        </div>
                      </li>
                      <li class="item">
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title">Tips untuk mengoptimalkan kinerja CSS?</a>
                          <span class="product-description">Diposting oleh Maria Ozawa 5 jam yang lalu</span>
                        </div>
                      </li>
                      <li class="item">
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title">Error saat melakukan fetch API di JavaScript</a>
                          <span class="product-description">Diposting oleh Budi Santoso 1 hari yang lalu</span>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div id="admin" class="tab-content row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-purple">
                  <div class="inner">
                    <h3>5,678</h3>
                    <p>Total Pengguna Terdaftar</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-server"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-12">
                <div class="card card-secondary card-outline">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users-cog mr-2"></i>Pengelolaan Pengguna</h3>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled">
                      <li><i class="fas fa-user-plus mr-2"></i>Pengguna Baru: 7 hari terakhir (+25)</li>
                      <li><i class="fas fa-user-times mr-2"></i>Akun Dinonaktifkan: 3</li>
                      <li><i class="fas fa-user-shield mr-2"></i>Administrator Aktif: 5</li>
                    </ul>
                    <button class="btn btn-block btn-outline-primary mt-3">Lihat Semua Pengguna</button>
                  </div>
                </div>
              </div>

              <div class="col-lg-5 col-12">
                <div class="card card-danger card-outline">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-clipboard-list mr-2"></i>Laporan Aktivitas</h3>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled">
                      <li><span class="font-weight-bold">[Admin]</span> X mengedit Materi "Python Dasar".</li>
                      <li><span class="font-weight-bold">[User]</span> Y menyelesaikan Kuis Bab 1.</li>
                      <li><span class="font-weight-bold">[Mentor]</span> Z membuat Sesi Mentoring baru.</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-12">
                <div class="card card-success card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Statistik Pendapatan</h3>
                  </div>
                  <div class="card-body">
                    <p class="text-3xl font-bold text-green-600 mb-2">Rp 125.000.000</p>
                    <p class="text-gray-600 text-sm">Total Pendapatan Bulan Ini</p>
                    <div class="mt-4">
                      <p class="text-gray-700">Penjualan Kursus: 70%</p>
                      <p class="text-gray-700">Langganan Mentoring: 30%</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-12">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Pengelolaan Konten</h3>
                  </div>
                  <div class="card-body">
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Materi "Pengembangan Backend"</b>
                        <div class="float-right">
                          <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <b>Modul "Keamanan Siber"</b>
                        <div class="float-right">
                          <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</button>
                          <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button>
                        </div>
                      </li>
                    </ul>
                    <button class="btn btn-block btn-success mt-3"><i class="fas fa-plus mr-2"></i> Tambah Materi Baru</button>
                  </div>
                </div>
              </div>
            </div>

            <div id="mentoring" class="tab-content row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>18</h3>
                    <p>Total Mentee Aktif</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-4 col-12">
                <div class="card card-dark card-outline">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-calendar-alt mr-2"></i>Jadwal Sesi Mendatang</h3>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled">
                      <li><span class="font-weight-bold">Besok, 10:00 AM:</span> Sesi dengan Budi (Pengembangan Web)</li>
                      <li><span class="font-weight-bold">Lusa, 02:00 PM:</span> Sesi dengan Siti (Desain UI/UX)</li>
                      <li><span class="font-weight-bold">Senin, 09:00 AM:</span> Sesi dengan Amir (Manajemen Proyek)</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-lg-5 col-12">
                <div class="card card-orange card-outline">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-line-chart mr-2"></i>Kemajuan Mentee</h3>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled">
                      <li><span class="font-weight-bold">Rina:</span> Telah menyelesaikan Modul 3.</li>
                      <li><span class="font-weight-bold">Agus:</span> Membutuhkan bantuan dengan Proyek Akhir.</li>
                      <li><span class="font-weight-bold">Dewi:</span> Kemajuan stabil di semua kursus.</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-12">
                <div class="card card-light card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Feedback Mentee Terbaru</h3>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled">
                      <li><p class="text-gray-700">"Mentor sangat membantu dalam menjelaskan konsep yang sulit." - Anna</p></li>
                      <li><p class="text-gray-700">"Sesi mentoring sangat interaktif dan praktis." - Rio</p></li>
                      <li><p class="text-gray-700">"Saya merasa lebih percaya diri setelah sesi ini." - Tania</p></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-12">
                <div class="card card-blue card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Sumber Daya Mentoring</h3>
                  </div>
                  <div class="card-body">
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        Panduan Terbaik Mentoring V2.0 <a href="#" class="float-right">Unduh</a>
                      </li>
                      <li class="list-group-item">
                        Tips Komunikasi Efektif dengan Mentee <a href="#" class="float-right">Baca</a>
                      </li>
                      <li class="list-group-item">
                        Studi Kasus Sukses Mentoring <a href="#" class="float-right">Lihat</a>
                      </li>
                    </ul>
                    <button class="btn btn-block btn-primary mt-3"><i class="fas fa-upload mr-2"></i> Unggah Sumber Daya Baru</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
          Anything you want
        </div>
        <strong>&copy; 2024 Dashboard Multi-Peran.</strong> All rights reserved.
      </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

    <script>
      function showTab(tabId, clickedButton) {
        document.querySelectorAll('.tab-content').forEach((content) => {
          content.classList.remove('active');
        });

        document.querySelectorAll('.tab-button').forEach((button) => {
          button.classList.remove('active'); // Remove AdminLTE 'active' class
        });

        document.getElementById(tabId).classList.add('active');

        if (clickedButton) {
          clickedButton.classList.add('active');
        }
      }

      document.addEventListener('DOMContentLoaded', () => {
        showTab('user', document.querySelector('.tab-button.active')); // Activate 'user' tab and its button
      });
    </script>
  </body>
</html>