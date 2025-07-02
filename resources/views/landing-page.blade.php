<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentoring Digital | STT Terpadu kena Nurul Fikri</title>
    <meta name="description" content="Platform digital untuk program mentoring agama di Kampus Nurul Fikri (STT-NF). Penguatan iman dan ilmu melalui teknologi modern." />
    <meta name="author" content="STT Nurul Fikri" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="nav-wrapper">
                <!-- Logo -->
                <div class="logo">
                    <img src="sttnf-logo.png" alt="STT-NF Logo" class="logo-img">
                    <div class="logo-text">
                        <h1>STT-NF</h1>
                        <p>Mentoring Digital</p>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <nav class="nav-desktop">
                    <a href="#home" class="nav-item">Home</a>
                    <a href="#about" class="nav-item">About</a>
                    <a href="#services" class="nav-item">Services</a>
                    <a href="#contact" class="nav-item">Contact</a>
                </nav>

                <!-- Auth Buttons -->
                <div class="auth-buttons">
                    @auth
                    <a href="{{ route('dashboard') }}" class="btn-ghost" style="text-decoration: none;">Dashboard</a>
                    {{-- <button class="btn-primary">Daftar</button> --}}
                    @else
                    <a href="{{ route('login') }}" class="btn-ghost" style="text-decoration: none;">Login</a>
                    {{-- <button class="btn-primary">Daftar</button> --}}
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <nav class="nav-mobile" id="mobileMenu">
                <a href="#home" class="nav-item">Home</a>
                <a href="#about" class="nav-item">About</a>
                <a href="#services" class="nav-item">Services</a>
                <a href="#contact" class="nav-item">Contact</a>
                <div class="mobile-auth">
                    <a href="{{ route('login') }}" class="btn-ghost" style="text-decoration: none;">Login</a>
                    {{-- <button class="btn-primary">Daftar</button> --}}
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-left">
                    <div class="badge">
                        <i class="fas fa-bolt"></i>
                        Platform Digital Terdepan
                    </div>

                    <h1 class="hero-title">
                        Mentoring Digital untuk
                        <span class="text-blue">Penguatan</span>
                        <span class="text-orange">Iman & Ilmu</span>
                    </h1>

                    <p class="hero-description">
                        Bergabunglah dengan program mentoring agama digital di Kampus Nurul Fikri.
                        Wujudkan generasi muslim yang berilmu, beriman, dan berteknologi.
                    </p>

                    <div class="hero-buttons">
                        <button class="btn-primary-large">
                            <i class="fas fa-users"></i>
                            Gabung Sekarang
                            <i class="fas fa-arrow-right"></i>
                        </button>

                        <button class="btn-outline-large">
                            <i class="fas fa-info-circle"></i>
                            Pelajari Lebih Lanjut
                        </button>
                    </div>
                </div>

                <div class="hero-right">
                    <div class="hero-illustration">
                        <div class="main-circle">
                            <div class="circle-content">
                                <i class="fas fa-graduation-cap" style="font-size: 2.5rem;"></i>
                                <h3>Mentoring</h3>
                                <p>Belajar Bersama</p>
                            </div>
                        </div>
                        <div class="floating-icon icon-1">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="floating-icon icon-2">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="hero-stats">
        <div class="stat">
            <div class="stat-number">500+</div>
            <div class="stat-label">Mahasiswa Aktif</div>
        </div>
        <div class="stat">
            <div class="stat-number">20+</div>
            <div class="stat-label">Mentor Berpengalaman</div>
        </div>
        <div class="stat">
            <div class="stat-number">95%</div>
            <div class="stat-label">Tingkat Kepuasan</div>
        </div>
    </div>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="section-header">
                <div class="badge">Tentang Program Mentoring</div>
                <h2 class="section-title">
                    Membangun Generasi
                    <span class="text-blue">Berilmu</span>
                    dan
                    <span class="text-orange">Beriman</span>
                </h2>
                <p class="section-description">
                    Program Mentoring Digital STT Nurul Fikri hadir sebagai inovasi dalam pendidikan agama yang menggabungkan
                    nilai-nilai Islam dengan teknologi modern, menciptakan lingkungan pembelajaran yang komprehensif dan inspiratif.
                </p>
            </div>

            <div class="about-content">
                <div class="about-left">
                    <h3>Visi & Misi Program</h3>

                    <div class="vision-mission">
                        <div class="vm-item">
                            <h4>Visi</h4>
                            <p>Menjadi platform mentoring agama digital terdepan yang menghasilkan generasi muslim
                            yang berilmu, beriman, dan siap menghadapi tantangan masa depan.</p>
                        </div>

                        <div class="vm-item">
                            <h4>Misi</h4>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> Memberikan pendampingan spiritual yang komprehensif</li>
                                <li><i class="fas fa-check-circle"></i> Mengintegrasikan teknologi dalam pembelajaran agama</li>
                                <li><i class="fas fa-check-circle"></i> Membangun komunitas mahasiswa yang islami dan progresif</li>
                                <li><i class="fas fa-check-circle"></i> Mengembangkan karakter kepemimpinan yang berintegritas</li>
                            </ul>
                        </div>
                    </div>

                    <div class="highlight-box">
                        <h4>Mengapa Digitalisasi Mentoring?</h4>
                        <p>Di era digital ini, kami percaya bahwa teknologi dapat menjadi sarana yang efektif untuk
                        menyebarkan ilmu agama dan memperkuat iman. Melalui platform digital, mentoring menjadi
                        lebih accessible, interaktif, dan dapat menjangkau lebih banyak mahasiswa.</p>
                    </div>
                </div>

                <div class="about-right">
                    <div class="values-grid" style="padding-top: 8vh;">
                        <div class="value-card">
                            <div class="value-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h4>Penguatan Iman</h4>
                            <p>Membangun fondasi spiritual yang kuat melalui pemahaman agama yang mendalam dan aplikatif dalam kehidupan sehari-hari.</p>
                        </div>

                        <div class="value-card">
                            <div class="value-icon">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <h4>Inovasi Digital</h4>
                            <p>Mengintegrasikan teknologi modern dalam pembelajaran agama untuk menciptakan pengalaman yang interaktif dan menarik.</p>
                        </div>

                        <div class="value-card">
                            <div class="value-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h4>Pembentukan Karakter</h4>
                            <p>Membentuk mahasiswa yang berakhlak mulia, berintegritas tinggi, dan mampu menjadi teladan di masyarakat.</p>
                        </div>

                        <div class="value-card">
                            <div class="value-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <h4>Keunggulan Akademik</h4>
                            <p>Mengharmonisasikan ilmu pengetahuan dunia dan akhirat untuk menciptakan lulusan yang kompeten dan berkarakter.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="islamic-quote">
                <h3>Fondasi Nilai-Nilai Islami</h3>
                <blockquote>
                    "Dan barangsiapa yang diberi hikmah, ia benar-benar telah diberi kebajikan yang banyak.
                    Dan hanya orang yang berakallah yang dapat mengambil pelajaran (dari firman Allah)."
                </blockquote>
                <cite>QS. Al-Baqarah: 269</cite>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-header">
                <div class="badge">Layanan Digital Kami</div>
                <h2 class="section-title">
                    Fitur
                    <span class="text-blue">Unggulan</span>
                    Platform
                    <span class="text-orange">Mentoring</span>
                </h2>
                <p class="section-description">
                    Dua layanan utama yang dirancang khusus untuk mendukung perjalanan spiritual
                    dan akademik mahasiswa STT Nurul Fikri
                </p>
            </div>

            <div class="services-grid">
                <div class="service-card service-blue">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h3>Absensi Online</h3>
                        <p>Sistem presensi digital yang memudahkan tracking kehadiran mentoring dengan teknologi modern dan user-friendly.</p>
                    </div>

                    <div class="service-body">
                        <h4>Keunggulan Fitur:</h4>
                        <ul>
                            <li><i class="fas fa-check"></i> Real-time attendance tracking</li>
                            <li><i class="fas fa-check"></i> Automated attendance reports</li>
                            <li><i class="fas fa-check"></i> Mobile-friendly interface</li>
                            <li><i class="fas fa-check"></i> Integration with academic system</li>
                        </ul>
                        <button class="btn-service">
                            Pelajari Lebih Lanjut
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <div class="service-card service-orange">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <h3>E-Learning Agama</h3>
                        <p>Modul pembelajaran interaktif berbasis digital dengan konten agama yang komprehensif dan mudah dipahami.</p>
                    </div>

                    <div class="service-body">
                        <h4>Keunggulan Fitur:</h4>
                        <ul>
                            <li><i class="fas fa-check"></i> Interactive learning modules</li>
                            <li><i class="fas fa-check"></i> Multimedia content (video, audio, text)</li>
                            <li><i class="fas fa-check"></i> Progress tracking system</li>
                            <li><i class="fas fa-check"></i> Quiz and assessment tools</li>
                        </ul>
                        <button class="btn-service">
                            Pelajari Lebih Lanjut
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="additional-features">
                <h3>Fitur Pendukung Lainnya</h3>
                <p>Berbagai layanan tambahan yang melengkapi pengalaman mentoring digital Anda</p>

                <div class="features-grid">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Mentoring Berkelompok</h4>
                        <p>Sesi mentoring dalam kelompok kecil untuk diskusi yang lebih intensif</p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4>Jadwal Fleksibel</h4>
                        <p>Pengaturan waktu mentoring yang dapat disesuaikan dengan aktivitas mahasiswa</p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Evaluasi Berkala</h4>
                        <p>Sistem evaluasi dan feedback untuk mengukur progress spiritual dan akademik</p>
                    </div>
                </div>
            </div>

            <div class="islamic-quote-services">
                <div class="quote-icon">
                    <i class="fas fa-quote-left"></i>
                </div>
                <blockquote>"Tuntutlah ilmu sejak dari buaian hingga liang lahat"</blockquote>
                <cite>Hadits Nabi Muhammad SAW</cite>
                <p>Menginspirasi kami untuk terus berinovasi dalam menyediakan platform pembelajaran
                yang menggabungkan teknologi modern dengan nilai-nilai islami yang autentik.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <div class="badge">Hubungi Kami</div>
                <h2 class="section-title">
                    Mari
                    <span class="text-blue">Berinteraksi</span>
                    dan
                    <span class="text-orange">Berkembang Bersama</span>
                </h2>
                <p class="section-description">
                    Kami siap membantu perjalanan spiritual dan akademik Anda. Jangan ragu untuk menghubungi
                    tim mentoring STT Nurul Fikri kapan saja.
                </p>
            </div>

            <div class="contact-content">
                <div class="div">
                    <div class="contact-form">
                        <h3>Kirim Pesan Kepada Kami</h3>
                        <p>Sampaikan pertanyaan, saran, atau permintaan informasi lebih lanjut tentang program mentoring kami.</p>

                        <form id="contactForm">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" placeholder="nama@email.com" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="message">Pesan</label>
                                <textarea id="message" name="message" rows="5" placeholder="Tuliskan pesan atau pertanyaan Anda..." required></textarea>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane"></i>
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                    <br>
                    <div class="social-card">
                        <h3>Ikuti Media Sosial Kami</h3>
                        <p>Dapatkan update terbaru tentang program mentoring, tips spiritual, dan konten inspiratif lainnya.</p>

                        <div class="social-links">
                            <a href="https://facebook.com/stt.nf" target="_blank" class="social-link">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://instagram.com/stt_nf" target="_blank" class="social-link">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://youtube.com/@stt-nf" target="_blank" class="social-link">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="contact-info">
                    <div class="info-card">
                        <h3>Informasi Kontak</h3>

                        <div class="contact-items">
                            <a href="mailto:mentoring@stt-nf.ac.id" class="contact-item">
                                <div class="contact-icon email">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h4>Email</h4>
                                    <p>mentoring@stt-nf.ac.id</p>
                                </div>
                            </a>

                            <a href="https://wa.me/6282112345678" class="contact-item">
                                <div class="contact-icon whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <div>
                                    <h4>WhatsApp</h4>
                                    <p>+62 821-1234-5678</p>
                                </div>
                            </a>

                            <a href="https://maps.google.com" class="contact-item">
                                <div class="contact-icon location">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h4>Alamat</h4>
                                    <p>Kampus STT Nurul Fikri, Depok, Jawa Barat</p>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div class="hours-card">
                        <h3>Jam Operasional</h3>
                        <div class="hours-list">
                            <div class="hour-item">
                                <span>Senin - Jumat</span>
                                <span>08:00 - 16:00 WIB</span>
                            </div>
                            <div class="hour-item">
                                <span>Sabtu</span>
                                <span>08:00 - 12:00 WIB</span>
                            </div>
                            <div class="hour-item">
                                <span>Minggu</span>
                                <span>Tutup</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="logo">
                        <img src="{{ asset('sttnf-logo.png') }}" alt="STT-NF Logo" class="logo-img">
                        <div class="logo-text">
                            <h3>STT Nurul Fikri</h3>
                            <p>Mentoring Digital</p>
                        </div>
                    </div>
                    <p>Platform digital untuk penguatan iman dan ilmu melalui program mentoring agama yang inovatif dan komprehensif.</p>
                </div>

                <div class="footer-links">
                    <h4>Tautan Cepat</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h4>Kontak</h4>
                    <p>mentoring@stt-nf.ac.id</p>
                    <p>+62 821-1234-5678</p>
                    <p>Kampus STT Nurul Fikri<br>Depok, Jawa Barat</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2024 STT Nurul Fikri. Semua hak cipta dilindungi. Dibuat dengan ❤️ untuk kemajuan umat.</p>
            </div>
        </div>
    </footer>

    <!-- Chatbot -->
    <div class="chatbot">
        <button class="chatbot-toggle" id="chatbotToggle">
            <i class="fas fa-comments"></i>
        </button>

        <div class="chatbot-window" id="chatbotWindow">
            <div class="chatbot-header">
                <div class="chatbot-info">
                    <img src="{{ asset('sttnf-logo.png') }}" alt="STT-NF Bot" class="chatbot-avatar">
                    <div>
                        <h4>Asisten Mentoring STT-NF</h4>
                        <p>Online - Siap membantu</p>
                    </div>
                </div>
                <button class="chatbot-close" id="chatbotClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="chatbot-messages" id="chatbotMessages">
                <div class="message bot-message">
                    <div class="message-avatar">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div class="message-content">
                        <p>Assalamu'alaikum! Selamat datang di Program Mentoring Digital STT-NF. Ada yang bisa saya bantu?</p>
                        <span class="message-time">12:00</span>
                    </div>
                </div>
            </div>

            <div class="chatbot-input">
                <input type="text" id="chatbotInputField" placeholder="Ketik pesan Anda...">
                <button id="chatbotSend">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <script src="{{ asset('script.js') }}"></script>
</body>
</html>
