![image](https://github.com/user-attachments/assets/7318223f-a857-4187-9e35-23dfe114048f)# TP9DPBO2025C1
Saya Alifa Salsabila dengan NIM 2308138 mengerjakan soal Tugas Praktikum 1 dalam mata kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

# Deskripsi Program
Aplikasi ini adalah sistem manajemen data mahasiswa sederhana yang dibangun menggunakan arsitektur MVP (Model-View-Presenter). Pengguna dapat menambahkan, mengedit, melihat, dan menghapus data mahasiswa.
Setiap data mahasiswa terdiri dari:
-  NIM
-  Nama
-  Tempat Lahir
-  Tanggal Lahir
-  Jenis Kelamin
-  Email
-  Telepon

## 1. Model
Model bertanggung jawab atas interaksi dengan database dan representasi data objek.

### DB.class.php
Membuka koneksi database, mengeksekusi query SQL, dan menutup koneksi.

### Mahasiswa.class.php
Representasi dari objek Mahasiswa (dengan atribut seperti nim, nama, dll).

### TabelMahasiswa.class.php
Menyediakan method untuk query SELECT, INSERT, UPDATE, dan DELETE ke tabel mahasiswa.

## View
View adalah template HTML yang menampilkan informasi kepada pengguna.
Template HTML biasanya menggunakan penanda seperti DATA_TABEL.
### Template.class.php
Bertugas memuat file tampilan, menggantikan penanda template dengan nilai sebenarnya dari data, lalu menampilkannya.

## Presenter
Presenter menghubungkan model dan view. Ia mengambil data dari model, memprosesnya jika perlu, lalu meneruskan ke view.
- Akan memanggil method seperti getMahasiswa(), addMahasiswa(), dst. dari TabelMahasiswa.
- Akan menggunakan Template untuk menggantikan konten HTML dengan data yang diambil dari model.

# Alur Program

## Pengguna mengakses index.php
index.php menjadi pusat dari semua aksi dan akan memuat file TampilMahasiswa.php yang ada di folder view/

## Proses Tambah Data Mahasiswa

### 1. Pengguna mengisi form tambah.
### 2. Data dikirim via POST dengan tombol name="tambah".
### 3. Di index.php, data akan diambil dan diproses oleh:
![image](https://github.com/user-attachments/assets/6f4f1d0b-0610-4227-8b22-e7a0dd20b664)
### 4. TampilMahasiswa menerima data dan meneruskannya ke presenter ProsesMahasiswa
### 5. Presenter ProsesMahasiswa memproses data
### 6. Method addMahasiswa() dari model TabelMahasiswa menyimpan data ke database
- Di sinilah query INSERT ke tabel mahasiswa dilakukan.

##  Proses Edit Data Mahasiswa
### 1. Pengguna klik tombol Edit
- Tombol mengirim index mahasiswa (bukan id sebenarnya di database) lewat parameter GET.
### 2. Di index.php, pengecekan isset($_GET['edit']) dijalankan
![image](https://github.com/user-attachments/assets/143d8b91-b207-40ee-9d28-b2f853d54b39)
### 3. Fungsi editData($id) di TampilMahasiswa akan:
- Mengakses presenter ProsesMahasiswa
- Mengambil data mahasiswa berdasarkan index (termasuk mengambil id yang sebenarnya)
- Menampilkan form edit (dari template)
### 4. Setelah form edit dikirim via POST (name="update"), index.php akan memproses:
![image](https://github.com/user-attachments/assets/bd3c0a99-a0e3-417e-bc9c-8c393ea9f37a)
### 5. Lalu menjalankan fungsi updateData($id, $data) di TampilMahasiswa
### 6. Di ProsesMahasiswa, data di-update ke database dengan memanggil fungsi updateMahasiswa($id, $data) di model/TabelMahasiswa.class.php
### 7. Model TabelMahasiswa menjalankan query UPDATE

## Proses Hapus (Delete) Data Mahasiswa
### 1. Pengguna klik tombol Hapus
- Mengirim index (bukan id yang sebenarnya di database) mahasiswa lewat parameter GET.
### 2. Di index.php, bagian ini akan aktif:
![image](https://github.com/user-attachments/assets/453ea78e-f062-45cf-8c30-b7d80303a71f)
### 3. Menjalankan fungsi deleteData($id) di TampilMahasiswa (view)
### 4. Presenter ProsesMahasiswa menjalankan proses penghapusan dengan memanggil fungsi deleteMahasiswa($id) di model/TabelMahasiswa.class.php
### 5. Model TabelMahasiswa menjalankan query DELETE
