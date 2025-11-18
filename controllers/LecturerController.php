<?php
// controllers/LecturerController.php

// Pastikan path-nya seperti ini (tanpa ../)
require_once 'models/Lecturer.php';
require_once 'config/Database.php';

class LecturerController
{
    private $db;
    private $lecturer;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->lecturer = new Lecturer($this->db);
    }

    // Menampilkan daftar semua lecturer
    public function index()
    {
        $lecturers = $this->lecturer->read();
        // Path ini juga benar
        include 'views/lecturer/index.php';
    }

    // Menampilkan form tambah data
    public function create()
    {
        include 'views/lecturer/create.php';
    }

    // Menyimpan data baru
    public function store()
    {
        if (isset($_POST['submit'])) {
            if ($this->lecturer->create($_POST)) {
                header("Location: index.php?controller=lecturer&action=index");
            } else {
                echo "Error: Could not create lecturer.";
            }
        }
    }

    // Menampilkan form edit data
    public function edit()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $lecturer = $this->lecturer->readById($id);
            if ($lecturer) {
                include 'views/lecturer/edit.php';
            } else {
                echo "Lecturer not found.";
            }
        }
    }

    // Mengupdate data
    public function update()
    {
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            if ($this->lecturer->update($id, $_POST)) {
                header("Location: index.php?controller=lecturer&action=index");
            } else {
                echo "Error: Could not update lecturer.";
            }
        }
    }

    // Menghapus data
    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->lecturer->delete($id)) {
                header("Location: index.php?controller=lecturer&action=index");
            } else {
                echo "Error: Could not delete lecturer.";
            }
        }
    }
}
?>