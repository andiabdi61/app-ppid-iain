# AGENTS.md

## Filosofi Proyek

Aplikasi ini merupakan Sistem PPID yang sudah hampir selesai dikembangkan.

Fitur utama seperti autentikasi, informasi publik, berita, dan dokumen sudah stabil.

Fokus pengembangan saat ini adalah menambahkan fitur baru dan melakukan penyempurnaan tanpa mengubah arsitektur yang sudah berjalan.

Jangan melakukan refactor besar atau mengubah fitur yang sudah stabil kecuali diminta secara eksplisit.

---

## Standar Coding

Selalu ikuti standar berikut:

- Laravel Best Practices
- PSR-12
- SOLID Principle
- Clean Code
- DRY (Don't Repeat Yourself)

Tulis kode yang mudah dibaca, mudah dipelihara, dan konsisten dengan struktur proyek yang sudah ada.

---

## Standar Laravel

Saat membuat atau mengubah fitur:

Gunakan:

- Form Request untuk validasi
- Resource Controller jika sesuai
- Eloquent ORM
- Route Model Binding jika memungkinkan
- Migration untuk perubahan database

Hindari:

- Raw SQL jika tidak benar-benar diperlukan
- Business Logic di dalam Blade
- Controller yang terlalu besar
- Duplikasi kode

---

## Cara AI Bekerja

Sebelum menulis kode:

1. Analisis terlebih dahulu konteks fitur yang diminta.
2. Gunakan pola dan struktur yang sudah ada di proyek.
3. Jangan mengubah file yang tidak berhubungan.

Jika perubahan memengaruhi banyak file:

- Jelaskan terlebih dahulu file yang akan diubah.
- Jelaskan alasan perubahan.
- Tunggu persetujuan sebelum melakukan perubahan besar.

---

## Output yang Diharapkan

Kode yang dihasilkan harus:

- Mengikuti Laravel Best Practices
- Mengikuti PSR-12
- Mudah dipahami
- Aman
- Mudah dikembangkan kembali
- Konsisten dengan coding style proyek yang sudah ada

## Konsistensi Proyek

Saat menambahkan fitur baru, ikuti pola yang sudah digunakan pada proyek ini.

Jangan memperkenalkan arsitektur atau library baru kecuali diminta secara eksplisit.

Prioritaskan konsistensi dibanding mengubah struktur yang sudah berjalan dengan baik.
