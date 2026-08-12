# Project Gaskeun - Dokumentasi Sistem

Project Gaskeun adalah sebuah sistem informasi berbasis web yang dirancang untuk memonitor, mengelola, dan mendistribusikan LPG dari tingkat agen hingga ke tingkat pangkalan dan masyarakat yang berhak (Rumah Tangga Sasaran). Sistem ini memungkinkan pemangku kepentingan untuk mengontrol pergerakan stok, verifikasi data, hingga menerima keluhan dari masyarakat secara transparan.

---

## 1. Aktor dan Fungsinya

Sistem ini menggunakan fitur multi-role (berbasis `spatie/laravel-permission`) dengan beberapa tingkatan aktor (pengguna). Berikut adalah masing-masing aktor beserta kemampuannya di dalam sistem:

### 1. Super Admin
**Fungsi Utama:** Mengontrol keseluruhan sistem secara teknis dan memastikan data pengguna serta hak akses sesuai.
**Bisa Melakukan:**
- **Manajemen Pengguna:** Menambah, mengubah, menghapus user, serta melakukan *reset password* untuk user lain.
- **Manajemen Role & Permission:** Mengatur hak akses setiap role dan memberikan *permission* khusus kepada role tertentu.
- **Log Aktivitas:** Melihat log aktivitas (*activity log*) seluruh pengguna di dalam sistem untuk audit.

### 2. Disperindag (Dinas Perindustrian dan Perdagangan)
**Fungsi Utama:** Mengelola data master masyarakat yang menjadi sasaran distribusi serta menangani laporan/keluhan masyarakat.
**Bisa Melakukan:**
- **Manajemen Master Data:** Mengelola (CRUD) data wilayah (Kecamatan, Desa), data kependudukan (KK, Penduduk), serta data spesifik seperti Nelayan, Petani, dan UMKM.
- **Manajemen RTS (Rumah Tangga Sasaran):** Mengontrol dan mendata kelompok masyarakat yang berhak menerima subsidi/LPG.
- **Manajemen Keluhan:** Melihat, meninjau, dan memverifikasi (update status) keluhan yang dikirimkan oleh publik.

### 3. Agen LPG
**Fungsi Utama:** Menyalurkan LPG dari agen ke pangkalan-pangkalan yang telah ditentukan.
**Bisa Melakukan:**
- **Manajemen Profil:** Memperbarui data profil agen itu sendiri.
- **Transaksi Pengiriman:** Membuat data pengiriman LPG baru ke pangkalan, dan melihat status pengirimannya.
- **Import Pengiriman:** Mengimpor data pengiriman sekaligus menggunakan file eksternal (seperti Excel).

### 4. Pangkalan LPG
**Fungsi Utama:** Menyalurkan (mendistribusikan) LPG dari pangkalan kepada masyarakat (RTS).
**Bisa Melakukan:**
- **Penerimaan LPG:** Melihat jadwal/data pengiriman dari Agen, melakukan konfirmasi penerimaan, atau mengajukan koreksi jika ada ketidaksesuaian data LPG yang diterima.
- **Penyaluran LPG:** Membuat dan mencatat transaksi penyaluran LPG kepada masyarakat.
- **Cek Stok:** Memantau sisa stok LPG yang ada di pangkalannya.

### 5. Pimpinan Daerah
**Fungsi Utama:** Melakukan pemantauan dan pengawasan di tingkat eksekutif.
**Bisa Melakukan:**
- **Dashboard Pemantauan:** Melihat rekapitulasi data distribusi, ketersediaan stok, dan peta keluhan secara makro untuk pengambilan kebijakan (Executive Dashboard).

### 6. Hiswana Migas
**Fungsi Utama:** Memantau tata niaga dan pergerakan distribusi LPG dari sisi himpunan pengusaha.
**Bisa Melakukan:**
- **Dashboard Pemantauan:** Melihat data rekap distribusi yang dikhususkan untuk Hiswana Migas guna memastikan kelancaran rantai pasok LPG.

### 7. Publik (Masyarakat / NIK)
**Fungsi Utama:** Sebagai pihak penerima (end-user) yang dapat memantau distribusi serta menyampaikan kendala di lapangan.
**Bisa Melakukan:**
- Mengakses halaman utama (Beranda) secara bebas.
- **(Setelah Login)** Membuat dan mengirimkan pengaduan / keluhan (misalnya terkait kelangkaan LPG).
- **(Setelah Login)** Melihat informasi spasial berupa Peta dan Heatmap persebaran/stok LPG.

---

## 2. Teknologi yang Digunakan

Sistem "Gaskeun" dibangun menggunakan teknologi web modern, perpaduan antara framework backend yang andal dan frontend yang responsif, yakni:

### A. Backend & Framework Utama
- **PHP 8.2+**: Bahasa pemrograman utama yang digunakan di sisi server.
- **Laravel Framework (v12.0)**: Digunakan sebagai framework backend (arsitektur MVC - Model View Controller) untuk merancang struktur routing, controller, ORM (Eloquent) dan keamanan sistem.
- **Laravel Spatie Permission**: Digunakan untuk mengelola RBAC (*Role-Based Access Control*), sehingga setiap halaman dan aksi dapat dilindungi berdasarkan tingkatan role pengguna secara dinamis.
- **Laravel Spatie Activity Log**: Merekam setiap log aktivitas (tambah, edit, hapus data) guna keperluan rekam jejak (audit trail).
- **Maatwebsite Excel**: Digunakan untuk fitur ekspor dan impor data menggunakan file Excel (seperti impor pengiriman oleh Agen).

### B. Frontend & UI
- **Blade Templating Engine**: Mesin rendering tampilan (view) bawaan dari Laravel.
- **Tailwind CSS (v4.0)**: Framework CSS *utility-first* yang digunakan untuk merancang antarmuka (UI) yang modern, cepat, dan responsif.
- **Vite**: Sebagai *build tool* (bundler) yang cepat untuk mengkompilasi file CSS (Tailwind) dan JavaScript.
- **Axios**: Library HTTP client berbasis Promise yang biasa digunakan untuk melakukan request AJAX ke backend (API) secara asinkron (misalnya pemanggilan data Peta/Heatmap atau request interaktif lainnya).

### C. Database & Struktur
- **MySQL / Relational DB**: Disokong melalui mekanisme *migration* dari Laravel untuk membangun skema tabel relasional (User, Role, Pengiriman, Penyaluran, Master RTS).
