# Security Policy

## 🔒 Kebijakan Keamanan

Dokumen ini menjelaskan kebijakan keamanan untuk aplikasi Mentoring App dan bagaimana melaporkan kerentanan keamanan.

## ✅ Versi yang Didukung

| Versi | Status Keamanan |
|-------|----------------|
| 2.0.x | ✅ Didukung     |
| 1.0.x | ❌ Tidak Didukung |

## 🛡️ Fitur Keamanan yang Diimplementasikan

### 1. Proteksi SQL Injection

**Status: ✅ AMAN**

- Menggunakan Laravel Eloquent ORM untuk semua query database
- Parameter binding otomatis mencegah SQL injection
- Tidak ada raw SQL query yang tidak aman
- Validasi input pada semua endpoint

**Contoh Implementasi:**
```php
// ✅ AMAN - Menggunakan Eloquent
User::where('email', $email)->first();

// ❌ TIDAK AMAN - Raw query (TIDAK DIGUNAKAN)
// DB::select("SELECT * FROM users WHERE email = '$email'");
```

### 2. Proteksi XSS (Cross-Site Scripting)

**Status: ✅ AMAN**

- Output escaping otomatis dengan Blade `{{ }}`
- Sanitasi input dengan `strip_tags()` dan `htmlspecialchars()`
- Content Security Policy (CSP) headers
- Validasi maksimal panjang input

**Contoh Implementasi:**
```php
// Controller - Input Sanitization
$validate['content'] = strip_tags($validate['content']);

// View - Output Escaping
{{ $discussion->content }} // Aman
{!! $discussion->content !!} // Tidak digunakan
```

### 3. Proteksi CSRF (Cross-Site Request Forgery)

**Status: ✅ AMAN**

- CSRF token pada semua form
- Validasi token otomatis oleh middleware
- Regenerasi token setelah logout
- Session regeneration setelah login

**Contoh Implementasi:**
```blade
<form method="POST" action="{{ route('forum.store') }}">
    @csrf
    <!-- Form fields -->
</form>
```

### 4. Authorization & Access Control

**Status: ✅ AMAN**

- Policy-based authorization
- Role-based access control (RBAC)
- User hanya bisa edit/delete konten sendiri
- Admin memiliki akses penuh

**Contoh Implementasi:**
```php
// Policy
public function update(User $user, Discussion $discussion): bool
{
    return $user->id === $discussion->user_id || $user->role === 'admin';
}

// Controller
$this->authorize('update', $discussion);
```

### 5. Rate Limiting

**Status: ✅ AMAN**

- Login endpoint: 5 percobaan per menit
- Mencegah brute force attacks
- Throttling otomatis oleh Laravel

### 6. Security Headers

**Status: ✅ AMAN**

Headers yang diimplementasikan:
- `X-Content-Type-Options: nosniff`
- `X-Frame-Options: SAMEORIGIN`
- `X-XSS-Protection: 1; mode=block`
- `Referrer-Policy: strict-origin-when-cross-origin`
- `Content-Security-Policy`
- `Permissions-Policy`

### 7. Session Security

**Status: ✅ AMAN**

- Session regeneration setelah login
- Session invalidation setelah logout
- CSRF token regeneration
- Secure session configuration

### 8. Input Validation

**Status: ✅ AMAN**

- Validasi semua input user
- Maksimal panjang input
- Tipe data validation
- Email sanitization

## 🔍 Cara Melaporkan Kerentanan Keamanan

Jika Anda menemukan kerentanan keamanan, mohon **JANGAN** membuat issue publik. Sebagai gantinya:

1. **Email**: Kirim detail kerentanan ke [security@example.com](mailto:security@example.com)
2. **Subject**: Gunakan format "Security Vulnerability: [Deskripsi Singkat]"
3. **Detail yang Diperlukan**:
   - Deskripsi kerentanan
   - Langkah-langkah untuk mereproduksi
   - Dampak potensial
   - Saran perbaikan (jika ada)

## ⚠️ Apa yang TIDAK Kami Anggap sebagai Kerentanan

- Absence of security headers pada halaman publik yang tidak sensitif
- Lack of DNSSEC/CAA records
- Lack of rate limiting pada endpoint publik yang tidak sensitif
- Self-XSS
- Clickjacking pada halaman publik
- Missing cookie flags pada cookie non-sensitif
- Logout CSRF
- Presence of application/framework version information

## ✅ Testing Keamanan

### Manual Testing

1. **SQL Injection Test**
   ```
   Input: ' OR '1'='1
   Expected: Gagal login / Error validation
   ```

2. **XSS Test**
   ```
   Input: <script>alert('XSS')</script>
   Expected: Script tidak dieksekusi, muncul sebagai text
   ```

3. **CSRF Test**
   ```
   Action: Submit form tanpa CSRF token
   Expected: 419 Page Expired error
   ```

4. **Authorization Test**
   ```
   Action: User A coba edit diskusi User B
   Expected: Error unauthorized / redirect
   ```

### Automated Security Scanning

Anda bisa menggunakan tools berikut untuk scanning otomatis:

```bash
# OWASP ZAP
docker run -t owasp/zap2docker-stable zap-baseline.py -t http://localhost:8000

# PHP Security Checker
composer require --dev enlightn/security-checker
php artisan security:check

# Laravel Security
composer require --dev roave/security-advisories:dev-latest
```

## 🔐 Konfigurasi Keamanan untuk Production

### 1. Environment Configuration

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=[your-32-character-random-string]

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict

# HTTPS
FORCE_HTTPS=true
```

### 2. Web Server Configuration

**Nginx:**
```nginx
# Enable HTTPS
ssl_protocols TLSv1.2 TLSv1.3;
ssl_prefer_server_ciphers on;

# Security Headers (backup jika middleware gagal)
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-Content-Type-Options "nosniff" always;
add_header X-XSS-Protection "1; mode=block" always;
```

**Apache:**
```apache
# .htaccess
Header always set X-Frame-Options "SAMEORIGIN"
Header always set X-Content-Type-Options "nosniff"
Header always set X-XSS-Protection "1; mode=block"
```

### 3. Database Security

```env
# Use strong passwords
DB_PASSWORD=[strong-random-password]

# Use separate database user with limited privileges
GRANT SELECT, INSERT, UPDATE, DELETE ON mentoring_app.* TO 'app_user'@'localhost';
```

### 4. File Permissions

```bash
# Set proper permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Protect sensitive files
chmod 600 .env
```

## 📋 Security Checklist

Sebelum deploy ke production:

- [ ] `APP_DEBUG=false` di `.env`
- [ ] `APP_ENV=production` di `.env`
- [ ] APP_KEY telah di-generate
- [ ] Database credentials aman
- [ ] HTTPS enabled
- [ ] Session cookies secure
- [ ] File permissions di-set dengan benar
- [ ] Error reporting disabled
- [ ] Security headers di-enable
- [ ] Rate limiting di-enable
- [ ] Backup database regular
- [ ] Update dependencies secara berkala

## 🔄 Update dan Patch

Kami akan:
- Merilis security patch sesegera mungkin setelah kerentanan dikonfirmasi
- Memberikan notifikasi melalui GitHub releases
- Menjelaskan detail kerentanan setelah patch dirilis

## 📚 Resources

- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Laravel Security Best Practices](https://laravel.com/docs/security)
- [PHP Security Guide](https://phpsecurity.readthedocs.io/)

## 📞 Contact

Untuk pertanyaan keamanan:
- Email: security@example.com
- GitHub: @kamachiii

---

**Terakhir Diupdate**: 2024-11-02
**Versi**: 2.0.0
