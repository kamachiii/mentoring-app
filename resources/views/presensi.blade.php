<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Presensi Mentoring</title>
    <base href="{{ url('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
        name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
        name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
        crossorigin="anonymous"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
        crossorigin="anonymous"
    />
    {{-- Pastikan path ke adminlte.css benar di proyek Laravel My --}}
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
        crossorigin="anonymous"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
        crossorigin="anonymous"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body {
            height: 100%; /* Memastikan html dan body mengambil tinggi penuh */
            margin: 0;
            padding: 0;
            /* Terapkan gradien langsung ke html dan body */
            background-image: linear-gradient(to bottom right, #93c5fd, #ffffff, #fdba74); /* Warna gradien kamu */
            background-attachment: fixed; /* Penting agar gradien tidak scroll dengan konten */
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Agar body selalu setinggi viewport */
        }
        .app-wrapper {
            flex-grow: 1; /* app-wrapper akan mengisi sisa ruang vertikal */
            display: flex; /* Mempertahankan layout flex My untuk sidebar dan main */
            flex-direction: row; /* Sesuai layout My (sidebar dan main content berdampingan) */
            /* [PERBAIKAN]: Beri ruang di bagian bawah untuk footer */
            padding-bottom: 60px; /* Sesuaikan nilai ini jika tinggi footer berbeda */
            box-sizing: border-box; /* Pastikan padding tidak menambah ukuran */
        }
        main {
            flex-grow: 1; 
        }
        /* Style untuk footer */
        .app-footer {
            background-color: #f8f9fa; /* Warna latar belakang umum untuk footer */
            padding: 15px;
            text-align: center;
            width: 100%;
            border-top: 1px solid #dee2e6;
            box-sizing: border-box;
            flex-shrink: 0; /* Mencegah footer menyusut */
            /* [PERBAIKAN]: Posisikan footer secara fixed di bagian bawah viewport */
            position: fixed;
            bottom: 0;
            left: 0;
            /* z-index: 1000; Pastikan footer di atas elemen lain */
        }
        .app-footer .float-right {
            display: block !important;
            float: none !important;
            text-align: center;
            margin-bottom: 5px;
        }
        aside {
            position: fixed;
            z-index: 99;
        }
        /* Tambahkan CSS ini ke dalam tag <style> */
        .table-scroll-container {
        max-height: 55vh; /* Atur tinggi maksimal. Sesuaikan angkanya sesuai kebutuhan */
        overflow-y: auto; /* Tampilkan scrollbar vertikal jika konten tabel lebih tinggi */
        border-radius: 0.75rem; /* Optional: Agar sudutnya sama dengan tabel */
        border: 1px solid #e5e7eb; /* Optional: Memberi bingkai tipis */
        }

        /* Sedikit trik agar header tabel (thead) ikut menempel di atas saat di-scroll */
        .table-scroll-container thead th {
        position: -webkit-sticky; /* Kompatibilitas Safari */
        position: sticky;
        top: 0;
        z-index: 10;
        background-color: #f9fafb; /* Sesuaikan dengan warna header tabel Anda */
        }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg">
    <div class="app-wrapper grid grid-flow-col gap-5">
        <div class="row-span-3">
            <aside class="app-sidebar bg-blue-600 shadow text-white h-screen" data-bs-theme="dark">
                <div class="sidebar-brand bg-white px-4 py-4 flex items-center gap-3">
                    <a href="{{ url('/') }}" class="brand-link flex items-center gap-3 px-4 py-4">
                        <img src="{{ asset('sttnf-logo.png') }}" alt="AdminLTE Logo" class="w-11 h-11 opacity-75 shadow rounded" />
                        <span class="brand-text font-bold text-black">Mentoring NF</span>
                    </a>
                </div>
                <div class="sidebar-wrapper px-2 py-4">
                    <nav class="mt-2">
                        <ul class="nav sidebar-menu flex flex-col gap-1" role="menu">
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="nav-link active bg-white/20 hover:bg-white/30 px-4 py-2 rounded flex items-center gap-2">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="font-medium">Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/materi') }}" class="nav-link hover:bg-white/20 px-4 py-2 rounded flex items-center gap-2">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="font-medium">Materi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/jadwal') }}" class="nav-link hover:bg-white/20 px-4 py-2 rounded flex items-center gap-2">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="font-medium">Jadwal</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/forum') }}" class="nav-link hover:bg-white/20 px-4 py-2 rounded flex items-center gap-2">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="font-medium">Forum</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/presensi') }}" class="nav-link hover:bg-white/20 px-4 py-2 rounded flex items-center gap-2">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p class="font-medium">Presensi</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
        </div>
        <div class="col-span-2">
            <main class="content-wrapper">
                <div class="content-header bg-orange-500 p-8 text-white text-center font-bold text-3xl rounded-t-3xl shadow">
                    Presensi Mentoring - {{ $mentorName }}
                </div>
                <div class="bg-white shadow-2xl border border-gray-200">
                    <div class="p-8 overflow-x-auto">
    
                        @if ($showResults)
                            {{-- Tampilan Hasil Presensi (SETELAH FORM DISUBMIT) --}}
                            <h3 class="text-xl font-bold mb-4">Hasil Presensi Tanggal: {{ $presensiDateDisplay }}</h3>
                            <div class="table-scroll-container">
                            <table class="min-w-full text-center border border-gray-300 rounded-xl overflow-hidden">
                                <thead class="bg-gray-100 text-gray-800">
                                    <tr>
                                        <th class="border px-2 py-3 text-sm w-16">No</th>
                                        <th class="border px-4 py-3 text-sm w-auto">Nama Siswa</th>
                                        <th class="border px-2 py-3 text-sm font-semibold w-36">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700">
                                    @forelse ($allStudents as $student) {{-- Menggunakan $allStudents --}}
                                        @php
                                            // Ambil status presensi siswa ini untuk hari ini dari existingPresences
                                            $status = $existingPresences[$student->id] ?? 'belum_absen'; // Ambil dari existingPresences
    
                                            $color_class = '';
                                            $displayText = '';
    
                                            switch ($status) {
                                                case 'present': $color_class = 'bg-green-500'; $displayText = 'Hadir'; break;
                                                case 'absent':  $color_class = 'bg-red-500';   $displayText = 'Alfa'; break;
                                                case 'sick':    $color_class = 'bg-yellow-500'; $displayText = 'Sakit'; break;
                                                case 'permit':  $color_class = 'bg-blue-500';  $displayText = 'Izin'; break;
                                                default:        $color_class = 'bg-gray-500';   $displayText = 'Belum Ab.'; break;
                                            }
                                        @endphp
                                        <tr class="hover:bg-gray-50">
                                            <td class="border px-2 py-2 w-16">{{ $loop->iteration }}</td>
                                            <td class="border px-4 py-2 text-left">{{ $student->name }}</td>
                                            <td class="border px-2 py-2 w-36">
                                                <span class="{{ $color_class }} text-white px-3 py-1 rounded-full text-xs font-semibold">{{ $displayText }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="border px-4 py-2 text-center text-gray-500 font-semibold">
                                            Tidak ada data presensi yang ditemukan untuk tanggal ini. Klik "Isi Presensi Baru" untuk memulai.
                                        </td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                            </div>
                            <div class="text-right mt-8">
                                <a href="{{ url('/presensi') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl shadow inline-block">Isi Presensi Baru</a>
                            </div>
    
                        @else
                            {{-- Tampilan Form Presensi (DEFAULT) --}}
                            <h3 class="text-xl font-bold mb-4">Form Presensi Tanggal: {{ now()->translatedFormat('d F Y') }}</h3>
                            <form action="{{ url('/presensi') }}" method="POST" id="presensiForm">
                                @csrf {{-- Penting untuk keamanan Laravel --}}
                                <div class="table-scroll-container">
                                <table class="min-w-full text-center border border-gray-300 rounded-xl overflow-hidden">
                                    <thead class="bg-gray-100 text-gray-800">
                                        <tr>
                                            <th class="border px-2 py-3 text-sm w-16">No</th>
                                            <th class="border px-4 py-3 text-sm w-auto">Nama Siswa</th>
                                            <th class="border px-2 py-3 text-sm font-semibold w-36">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-700">
                                        @forelse ($allStudents as $student) {{-- Menggunakan $allStudents --}}
                                            @php
                                                $currentKeterangan = $existingPresences[$student->id] ?? '';
                                            @endphp
                                            <tr class="hover:bg-gray-50">
                                                <td class="border px-2 py-2 w-16">{{ $loop->iteration }}</td>
                                                <td class="border px-4 py-2 text-left">{{ $student->name }}</td>
                                                <td class="border px-2 py-2 w-36">
                                                    <select name="ket[{{ $student->id }}]" onchange="updateSelectColor(this)" class="status-select text-sm font-semibold rounded border p-2 shadow-sm w-full">
                                                        <option value="" {{ $currentKeterangan == '' ? 'selected' : '' }}>-- Pilih --</option>
                                                        <option value="present" {{ $currentKeterangan == 'present' ? 'selected' : '' }}>Hadir</option>
                                                        <option value="absent" {{ $currentKeterangan == 'absent' ? 'selected' : '' }}>Alfa</option>
                                                        <option value="permit" {{ $currentKeterangan == 'permit' ? 'selected' : '' }}>Izin</option>
                                                        <option value="sick" {{ $currentKeterangan == 'sick' ? 'selected' : '' }}>Sakit</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3" class="border px-4 py-2 text-center text-red-500 font-semibold">
                                                Tidak ada siswa yang ditemukan. Pastikan ada siswa dengan role 'user' di database Anda.
                                            </td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                </div>
                                <div class="text-right mt-8">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl shadow">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
    
                <script>
                    function updateSelectColor(select) {
                        const colorMap = {
                            present: 'bg-green-500', // Hadir
                            absent: 'bg-red-500',   // Alfa
                            permit: 'bg-blue-500',  // Izin
                            sick: 'bg-yellow-500'   // Sakit
                        };
    
                        select.classList.remove('bg-green-500', 'bg-red-500', 'bg-blue-500', 'bg-yellow-500');
                        const selected = select.value;
                        if (colorMap[selected]) {
                            select.classList.add(colorMap[selected]);
                        }
                    }
    
                    document.addEventListener('DOMContentLoaded', function () {
                        document.querySelectorAll('.status-select').forEach(select => {
                            updateSelectColor(select);
                        });
                    });
                </script>
            </main>
        </div>
    </div>
    <footer class="app-footer text-black h-15">
        <div class="float-right d-none d-sm-inline">Anything you want</div>
            <strong>
                Copyright &copy; 2014-2024&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
            All rights reserved.
    </footer>
    <script
        src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"
    ></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
        integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ="
        crossorigin="anonymous"
    ></script>
    <script>
        const connectedSortables = document.querySelectorAll('.connectedSortable');
        connectedSortables.forEach((connectedSortable) => {
            let sortable = new Sortable(connectedSortable, {
                group: 'shared',
                handle: '.card-header',
            });
        });

        const cardHeaders = document.querySelectorAll('.connectedSortables .card-header');
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = 'move';
        });
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
        crossorigin="anonymous"
    ></script>
    <script>

        const sales_chart_options = {
            series: [
                {
                    name: 'Digital Goods',
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    name: 'Electronics',
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
            ],
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                type: 'datetime',
                categories: [
                    '2023-01-01',
                    '2023-02-01',
                    '2023-03-01',
                    '2023-04-01',
                    '2023-05-01',
                    '2023-06-01',
                    '2023-07-01',
                ],
            },
            tooltip: {
                x: {
                    format: 'MMMM dd',
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector('#revenue-chart'),
            sales_chart_options,
        );
        sales_chart.render();
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
        integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
        integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
        crossorigin="anonymous"
    ></script>
    <script>
        const visitorsData = {
            US: 398, // USA
            SA: 400, // Saudi Arabia
            CA: 1000, // Canada
            DE: 500, // Germany
            FR: 760, // France
            CN: 300, // China
            AU: 700, // Australia
            BR: 600, // Brazil
            IN: 800, // India
            GB: 320, // Great Britain
            RU: 3000, // Russia
        };

        const map = new jsVectorMap({
            selector: '#world-map',
            map: 'world',
        });

        // Sparkline charts
        const option_sparkline1 = {
            series: [
                {
                    data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
                },
            ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
        sparkline1.render();

        const option_sparkline2 = {
            series: [
                {
                    data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
                },
            ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
        sparkline2.render();

        const option_sparkline3 = {
            series: [
                {
                    data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
                },
            ],
            chart: {
                type: 'area',
                height: 50,
                sparkline: {
                    enabled: true,
                },
            },
            stroke: {
                curve: 'straight',
            },
            fill: {
                opacity: 0.3,
            },
            yaxis: {
                min: 0,
            },
            colors: ['#DCE6EC'],
        };

        const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
        sparkline3.render();
    </script>
    </body>
</html>