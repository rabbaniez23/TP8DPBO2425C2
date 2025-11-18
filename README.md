# 🚀 Project Praktikum MVC - TP DPBO 2024

Project ini merupakan implementasi dari Tugas Praktikum 8 DPBO. Tujuan utamanya adalah melakukan refaktor kode PHP prosedural (kode lama) menjadi arsitektur **MVC (Model-View-Controller)**, menambahkan tabel baru dengan relasi, dan membuat fungsionalitas CRUD lengkap untuk tabel tersebut.

---


## 📁 Struktur Repo

struktur folder project ini diorganisir sebagai berikut:

```text
/TP8DPBOB02425C.../
├── config/
│   └── Database.php           (Class untuk koneksi database)
├── controllers/
│   ├── LecturerController.php   (Logika untuk fitur Dosen)
│   └── CourseController.php     (Logika untuk fitur Mata Kuliah)
├── models/
│   ├── Lecturer.php           (Kueri SQL untuk tabel lecturers)
│   └── Course.php             (Kueri SQL untuk tabel courses)
├── views/
│   ├── layouts/
│   │   ├── header.php         (Tampilan HTML bagian atas & navbar)
│   │   └── footer.php         (Tampilan HTML bagian bawah & script)
│   ├── lecturer/
│   │   ├── index.php          (Tampilan tabel Dosen)
│   │   ├── create.php         (Tampilan form tambah Dosen)
│   │   └── edit.php           (Tampilan form edit Dosen)
│   └── course/
│       ├── index.php          (Tampilan tabel Mata Kuliah)
│       ├── create.php         (Tampilan form tambah Mata Kuliah)
│       └── edit.php           (Tampilan form edit Mata Kuliah)
├── dokumentasi/
│   └── (Berisi screenshot/screen record hasil proyek)
├── tp_mvc_database.sql      (File SQL untuk setup database)
├── index.php                (Router Utama/Front Controller)
├── ReadMe.md                (Dokumentasi ini)
└── (Aset seperti bootstrap.min.css, dll.)---
```

## 🏛️ Penjelasan Arsitektur: Dari Prosedural ke MVC

Perubahan terbesar pada proyek ini adalah adopsi pola desain **Model-View-Controller (MVC)**.

### Kenapa Pindah ke MVC?

* **Kode Lama (Prosedural):** Kode lama mencampurkan logika PHP, kueri SQL, dan tampilan HTML ke dalam satu file (contoh: `create.php`, `edit.php`, `index.php`). Ini membuatnya sulit untuk dikelola dan dikembangkan.
* **Kode Baru (MVC):** Arsitektur MVC memisahkan kode berdasarkan tugasnya:
    * **Model:** 🧠 Mengurus semua logika dan interaksi dengan database (semua kueri SQL).
    * **View:** 🎨 Mengurus semua tampilan dan presentasi (semua kode HTML).
    * **Controller:** 🚦 Bertindak sebagai perantara yang menerima input, memanggil Model untuk mengambil data, dan mengirim data itu ke View untuk ditampilkan.

### ❓ Ke Mana File-File Lama Menghilang?

File-file lama **tidak hilang**, tetapi logikanya **dipindahkan dan dipecah** ke dalam file-file baru sesuai struktur MVC.

| File Lama (Prosedural) | Menjadi Apa di Arsitektur MVC? |
| :--- | :--- |
| `connection.php` | Menjadi class `Database` di **`config/Database.php`**. |
| `index.php` (lama) | **Dipecah menjadi 3 bagian:**<br>1. Logika SQL -> `models/Lecturer.php` (method `read()`)<br>2. Logika PHP -> `controllers/LecturerController.php` (method `index()`)<br>3. Tampilan HTML -> `views/lecturer/index.php` |
| `create.php` (lama) | **Dipecah menjadi 3 bagian:**<br>1. Logika SQL -> `models/Lecturer.php` (method `create()`)<br>2. Logika PHP -> `controllers/LecturerController.php` (method `create()` & `store()`)<br>3. Tampilan HTML -> `views/lecturer/create.php` |
| `edit.php` (lama) | **Dipecah menjadi 3 bagian:**<br>1. Logika SQL -> `models/Lecturer.php` (method `readById()` & `update()`)<br>2. Logika PHP -> `controllers/LecturerController.php` (method `edit()` & `update()`)<br>3. Tampilan HTML -> `views/lecturer/edit.php` |
| `delete.php` (lama) | **Dipecah menjadi 2 bagian (tidak ada HTML):**<br>1. Logika SQL -> `models/Lecturer.php` (method `delete()`)<br>2. Logika PHP -> `controllers/LecturerController.php` (method `delete()`) |
| `index.php` (baru) | File `index.php` di *root* sekarang bertindak sebagai **Router** (Front Controller) yang mengatur semua lalu lintas permintaan. |

---

## 🔄 Penjelasan Alur Program (MVC Flow)

Sekarang, semua permintaan publik masuk melalui satu file: **`index.php` (Router)**.

Sebagai contoh, mari kita lacak alur untuk **menghapus data dosen**:

1.  **View** (`views/lecturer/index.php`):<br>
    Pengguna mengklik tombol "Delete". Link-nya bukan lagi `delete.php?id=1`, melainkan:
    `index.php?controller=lecturer&action=delete&id=1`

2.  **Router** (`index.php` utama):<br>
    File ini menerima permintaan dan membacanya:
    * `controller=lecturer` -> "Oke, saya harus memanggil `LecturerController`."
    * `action=delete` -> "Oke, saya harus menjalankan fungsi/method `delete()` di dalam controller itu."

3.  **Controller** (`controllers/LecturerController.php`):<br>
    Method `delete()` dijalankan. Ia mengambil `id=1` dari URL. Ia *tidak* menjalankan SQL, tapi ia memanggil **Model**:
    `$this->lecturer->delete(1);`

4.  **Model** (`models/Lecturer.php`):<br>
    Method `delete(1)` di Model-lah yang bertugas menjalankan kueri SQL:
    `DELETE FROM lecturers WHERE id = 1`

5.  **Controller** (Kembali):<br>
    Setelah Model selesai menghapus data, Controller mengambil alih lagi dan mengarahkan pengguna kembali ke halaman utama:
    `header("Location: index.php?controller=lecturer&action=index");`

Alur yang sama persis berlaku untuk fitur **Courses** (Mata Kuliah) yang baru ditambahkan.

---

## 🗃️ Desain Database

Database yang digunakan adalah `tp_mvc25`.

### Tabel `lecturers`
```sql
CREATE TABLE lecturers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    nidn VARCHAR(50) NOT NULL,
    phone VARCHAR(20),
    join_date DATE
);
```
### Tabel `Courses` (tabel baru)
```sql
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL,
    sks INT NOT NULL,
    lecturer_id INT,
    FOREIGN KEY (lecturer_id) 
        REFERENCES lecturers(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);
```

