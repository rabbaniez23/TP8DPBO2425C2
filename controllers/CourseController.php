<?php
// controllers/CourseController.php

// Path ini benar karena file ini dipanggil oleh /index.php (Router)
require_once 'models/Course.php';
require_once 'models/Lecturer.php'; 
require_once 'config/Database.php';

class CourseController
{
    private $db;
    private $course;
    private $lecturer;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->course = new Course($this->db);
        $this->lecturer = new Lecturer($this->db); 
    }

    // Menampilkan daftar semua mata kuliah
    public function index()
    {
        $courses = $this->course->read();
        
        // Path ini juga benar, relatif dari /index.php
        include 'views/course/index.php';
    }

    // Menampilkan form tambah data
    public function create()
    {
        $lecturers = $this->lecturer->read();
        include 'views/course/create.php';
    }

    // Menyimpan data baru
    public function store()
    {
        if (isset($_POST['submit'])) {
            if ($this->course->create($_POST)) {
                header("Location: index.php?controller=course&action=index");
            } else {
                echo "Error: Could not create course.";
            }
        }
    }

    // Menampilkan form edit data
    public function edit()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $course = $this->course->readById($id);
            $lecturers = $this->lecturer->read();
            
            if ($course) {
                include 'views/course/edit.php';
            } else {
                echo "Course not found.";
            }
        }
    }

    // Mengupdate data
    public function update()
    {
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            if ($this->course->update($id, $_POST)) {
                header("Location: index.php?controller=course&action=index");
            } else {
                echo "Error: Could not update course.";
            }
        }
    }

    // Menghapus data
    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->course->delete($id)) {
                header("Location: index.php?controller=course&action=index");
            } else {
                echo "Error: Could not delete course.";
            }
        }
    }
}
?>