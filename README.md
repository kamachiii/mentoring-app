## Kelompok

- Adit
- Ariq
- Eka
- Lalu
- Muhammad Kamil
- Zaid

## Requirements

- PHP >= 8.4
- Composer
- MySQL/MariaDB (atau database lain yang didukung)
- Node.js & npm (untuk frontend, opsional)
- Git

## Cara Menjalankan Project Laravel 12

1. **Clone repository**
    ```bash
    git clone https://github.com/kamachiii/mentoring-app
    cd mentoring-app
    ```

2. **Install dependencies**
    ```bash
    composer install
    ```

3. **Copy file environment**
    ```bash
    cp .env.example .env
    ```

4. **Generate application key**
    ```bash
    php artisan key:generate
    ```

5. **Atur konfigurasi database**
    Edit file `.env` dan sesuaikan bagian berikut(optional)
    ```
    DB_DATABASE=nama_database
    DB_USERNAME=username_database
    DB_PASSWORD=password_database
    ```

6. **Jalankan migrasi database**
    ```bash
    php artisan migrate
    ```

7. **Jalankan server lokal**
    ```bash
    php artisan serve
    ```

8. **(Opsional) Install dependencies frontend**
    ```bash
    npm install
    npm run dev
    ```

Akses aplikasi di [http://localhost:8000](http://localhost:8000)
