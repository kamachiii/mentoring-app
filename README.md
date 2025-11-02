# Mentoring App - Aplikasi Manajemen Mentoring

Aplikasi web untuk manajemen mentoring yang aman dan terproteksi dari berbagai celah keamanan seperti SQL Injection, XSS (Cross-Site Scripting), dan CSRF (Cross-Site Request Forgery).

## 👥 Kelompok

- Adit
- Ariq Jamhari
- Eka Vitaloka
- Lalu
- Muhammad Kamil
- Zaid Asy Syuhada

## 🔐 Fitur Keamanan

Aplikasi ini telah diperbaiki dan dilengkapi dengan berbagai fitur keamanan:

### 1. **Proteksi SQL Injection**
- ✅ Menggunakan Laravel Eloquent ORM untuk semua query database
- ✅ Parameter binding otomatis untuk mencegah SQL injection
- ✅ Validasi input pada semua endpoint

### 2. **Proteksi XSS (Cross-Site Scripting)**
- ✅ Output escaping otomatis menggunakan Blade template `{{ }}` 
- ✅ Sanitasi input dengan `strip_tags()` dan `htmlspecialchars()`
- ✅ Content Security Policy (CSP) headers
- ✅ Validasi maksimal panjang input untuk mencegah payload XSS

### 3. **Proteksi CSRF (Cross-Site Request Forgery)**
- ✅ CSRF token pada semua form menggunakan `@csrf`
- ✅ Validasi token otomatis oleh Laravel middleware
- ✅ Regenerasi token setelah logout
- ✅ Session regeneration setelah login untuk mencegah session fixation

### 4. **Keamanan Tambahan**
- ✅ **Authorization Policies**: Memastikan user hanya bisa edit/delete konten mereka sendiri
- ✅ **Rate Limiting**: Maksimal 5 percobaan login per menit
- ✅ **Security Headers**: 
  - X-Content-Type-Options: nosniff
  - X-Frame-Options: SAMEORIGIN
  - X-XSS-Protection: 1; mode=block
  - Referrer-Policy
  - Content-Security-Policy
- ✅ **Input Sanitization**: Semua input user dibersihkan sebelum disimpan
- ✅ **Session Security**: Invalidasi session yang tepat saat logout
- ✅ **File Upload Validation**: Validasi tipe dan ukuran file

## 📋 Requirements

- PHP >= 8.2
- Composer
- MySQL/MariaDB (atau database lain yang didukung Laravel)
- Node.js & npm (untuk frontend, opsional)
- Git

## 🚀 Cara Menjalankan Project

### 1. Clone repository
```bash
git clone https://github.com/kamachiii/mentoring-app
cd mentoring-app
```

### 2. Install dependencies
```bash
composer install
```

### 3. Copy file environment
```bash
cp .env.example .env
```

### 4. Generate application key
```bash
php artisan key:generate
```

### 5. Atur konfigurasi database
Edit file `.env` dan sesuaikan bagian berikut:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mentoring_app
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Jalankan migrasi database
```bash
php artisan migrate
```

### 7. (Opsional) Seed database dengan data awal
```bash
php artisan db:seed
```

### 8. Jalankan server lokal
```bash
php artisan serve
```

### 9. (Opsional) Install dan jalankan frontend assets
```bash
npm install
npm run dev
```

Akses aplikasi di [http://localhost:8000](http://localhost:8000)

## 📚 Struktur Aplikasi

```
mentoring-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Controllers untuk logika bisnis
│   │   └── Middleware/      # Middleware keamanan
│   ├── Models/              # Eloquent models
│   └── Policies/            # Authorization policies
├── config/                  # Konfigurasi aplikasi
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/             # Database seeders
├── resources/
│   └── views/               # Blade templates
└── routes/
    └── web.php              # Definisi routes
```

## 🔒 Detail Implementasi Keamanan

### SQL Injection Prevention

**Sebelum:**
```php
// Vulnerable - menggunakan raw query
DB::select("SELECT * FROM users WHERE email = '$email'");
```

**Setelah:**
```php
// Aman - menggunakan Eloquent ORM
User::where('email', $email)->first();
```

### XSS Prevention

**Sebelum:**
```php
// Vulnerable - unescaped output
{!! $discussion->content !!}
```

**Setelah:**
```php
// Aman - escaped output dan input sanitization
{{ $discussion->content }}

// Controller
$validate['content'] = strip_tags($validate['content']);
```

### CSRF Prevention

**Implementasi:**
```html
<!-- Semua form menyertakan CSRF token -->
<form method="POST" action="{{ route('forum.store') }}">
    @csrf
    <!-- form fields -->
</form>
```

### Authorization

**Implementasi Policy:**
```php
// DiscussionPolicy.php
public function update(User $user, Discussion $discussion): bool
{
    return $user->id === $discussion->user_id || $user->role === 'admin';
}

// ForumController.php
public function update(Request $request, $id)
{
    $discussion = Discussion::findOrFail($id);
    $this->authorize('update', $discussion);
    // ...
}
```

## 🛡️ Best Practices Keamanan

1. **Selalu validasi input**: Gunakan Laravel validation untuk semua input user
2. **Escape output**: Gunakan `{{ }}` di Blade templates, bukan `{!! !!}`
3. **Gunakan ORM**: Hindari raw SQL queries
4. **Implementasi authorization**: Cek permission sebelum melakukan action
5. **Rate limiting**: Batasi request untuk endpoint sensitif
6. **HTTPS**: Gunakan HTTPS di production
7. **Update dependencies**: Jalankan `composer update` secara berkala
8. **Secure session**: Konfigurasi session dengan benar di production

## 🧪 Testing Keamanan

Untuk mengetes keamanan aplikasi:

1. **SQL Injection Test**: Coba input `' OR '1'='1` di form login
2. **XSS Test**: Coba input `<script>alert('XSS')</script>` di forum
3. **CSRF Test**: Coba submit form tanpa CSRF token
4. **Authorization Test**: Coba edit/delete content user lain

Semua test di atas seharusnya **gagal** karena aplikasi sudah terproteksi.

## 📖 Dokumentasi API

### Authentication Endpoints

- `GET /login` - Tampilkan form login
- `POST /login` - Proses login (rate limited: 5 attempts/minute)
- `POST /logout` - Logout user

### Forum Endpoints

- `GET /forum` - List semua diskusi
- `POST /forum` - Create diskusi baru (admin/mentor only)
- `PUT /forum/{id}` - Update diskusi (owner/admin only)
- `DELETE /forum/{id}` - Delete diskusi (owner/admin only)
- `POST /forum/comment` - Add comment ke diskusi

### User Management (Admin only)

- `GET /user` - List semua users
- `POST /user` - Create user baru
- `PUT /user/{id}` - Update user
- `DELETE /user/{id}` - Delete user

## 🤝 Contributing

1. Fork repository ini
2. Buat branch untuk fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📝 Changelog

### Version 2.0.0 (Security Update)
- ✅ Fixed SQL Injection vulnerabilities
- ✅ Fixed XSS vulnerabilities
- ✅ Enhanced CSRF protection
- ✅ Added authorization policies
- ✅ Implemented rate limiting
- ✅ Added security headers
- ✅ Improved input sanitization

### Version 1.0.0
- Initial release

## 📄 License

This project is licensed under the MIT License.

## 📞 Support

Jika menemukan bug atau celah keamanan, silakan laporkan melalui:
- GitHub Issues: [https://github.com/kamachiii/mentoring-app/issues](https://github.com/kamachiii/mentoring-app/issues)
- Email: [security@example.com](mailto:security@example.com)

---

**⚠️ PERHATIAN**: Aplikasi ini telah diperbaiki untuk mengatasi celah keamanan SQL Injection, XSS, dan CSRF. Pastikan untuk selalu mengikuti best practices keamanan saat development.
