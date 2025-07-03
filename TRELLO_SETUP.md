# Setup Integrasi Trello

## Langkah-langkah Setup

### 1. Dapatkan API Key dan Token Trello

1. Buka [Trello App Key](https://trello.com/app-key)
2. Login dengan akun Trello Anda
3. Salin **API Key** yang muncul
4. Klik link **Token** untuk mendapatkan token akses
5. Salin **Token** yang muncul

### 2. Tambahkan Konfigurasi ke File .env

Tambahkan baris berikut ke file `.env` Anda:

```env
# Trello Configuration
TRELLO_API_KEY=your_trello_api_key_here
TRELLO_TOKEN=your_trello_token_here
```

Ganti `your_trello_api_key_here` dan `your_trello_token_here` dengan nilai yang sudah Anda dapatkan dari langkah 1.

### 3. Jalankan Migration

```bash
php artisan migrate
```

### 4. Cara Penggunaan

1. Buka halaman **Pengembangan** di proyek Anda
2. Klik tombol **"Integrasikan dengan Trello"**
3. Sistem akan otomatis:
   - Membuat board baru di Trello dengan nama proyek
   - Membuat list: To Do, In Progress, Quality Assurance, Done
   - Membuat card untuk setiap development task
   - Menambahkan checklist dari data checkdev
   - Mengundang anggota tim ke board Trello
4. Setelah berhasil, tombol akan berubah menjadi **"Lihat di Trello"**
5. Klik tombol tersebut untuk membuka board Trello di tab baru

### 5. Fitur yang Tersedia

- **One-way integration**: Data dari sistem ke Trello
- **Automatic board creation**: Board dibuat otomatis dengan list default
- **Card creation**: Setiap development task menjadi card di Trello
- **Checklist integration**: Checklist dari sistem menjadi checklist di card Trello
- **Team member invitation**: Anggota tim otomatis diundang ke board Trello
- **Status mapping**: Status di sistem dipetakan ke list Trello

### 6. Troubleshooting

Jika terjadi error, periksa:
1. API Key dan Token Trello sudah benar
2. Koneksi internet stabil
3. Log error di `storage/logs/laravel.log`

### 7. Keamanan

- Jangan share API Key dan Token Trello
- Gunakan environment variable untuk menyimpan kredensial
- Token Trello memberikan akses penuh ke akun Trello Anda 
