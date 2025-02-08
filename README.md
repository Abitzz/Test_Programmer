# Test_Programmer
Project ini saya buat untuk memenuhi persyaratan rekrutmen junior programmer di PT FastPrint Indonesia cabang Surabaya.

## Deskripsi Singkat terkait Project
Project ini merupakan web berbasis CodeIgniter3 yang dibuat untuk mengelola data produk dalam sistem manajemen produk. dalam web ini, pengguna dapat menambahkan, mengubah, atau menghapus data produk.

## Fitur
- Mengambil data dari API yang disediakan dan memasukkannya ke dalam database
- Menampilkan data dari database dalam bentuk tabel untuk dikelola.
- Menambah, mengedit, dan menghapus produk dengan sejumlah validasi input.
- Memfilter data produk berdasarkan status tersedia untuk dijual.

## Persiapan
- Text Editor (VS code atau yang lain)
- Web Browser (chrome, firefox, opera, atau yang lain)
- Web Server : XAMPP
- CodeIgniter3 : https://codeigniter.com/userguide3/installation/downloads.html

## Langkah Langkah
- Copy folder test_programmer dan taruh ke dalam folder xampp di C:\xampp\htdocs
- buka XAMPP control panel, nyalakan Apache dan MYSQL sebagai web server serta database yang digunakan
  
![image](https://github.com/user-attachments/assets/02dfb41a-d809-4227-97ab-a7e1a259eae4)

- masuk ke phpmyadmin dan jalankan perintah yang ada di dalam file 'untuk database.txt' untuk membuat database yang diperlukan

![image](https://github.com/user-attachments/assets/c99cabfb-fab4-452e-a1dd-f52c3791f14c)

- setelah itu, ambil data dari API dengan masuk ke link http://localhost/test_programmer/produk/ambil_data_api pada browser. akan muncul respon seperti di gambar jika berhasil mengambil data

![image](https://github.com/user-attachments/assets/9ea8c241-31b5-4287-8750-38f4a4b85126)

- setelah data telah dimasukkan ke dalam database, masukkan link http://localhost/test_programmer/produk/ .project web telah dapat digunakan. ini adalah tampilan halaman utama.

![image](https://github.com/user-attachments/assets/94cc78f3-b369-460c-b73a-ad63f290a870)

##

