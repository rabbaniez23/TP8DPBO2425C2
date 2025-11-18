<?php
// models/Course.php

class Course
{
    private $conn;
    private $table_name = "courses";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // 1. READ (Membaca semua data, di-JOIN dengan nama dosen)
    public function read()
    {
        // Kita gunakan LEFT JOIN untuk tetap menampilkan mata kuliah
        // meskipun dosennya sudah dihapus (lecturer_id = NULL)
        $query = "SELECT 
                    c.id, 
                    c.course_name, 
                    c.sks, 
                    c.lecturer_id, 
                    l.name as lecturer_name 
                  FROM 
                    " . $this->table_name . " c 
                    LEFT JOIN lecturers l ON c.lecturer_id = l.id";
        
        $result = $this->conn->query($query);
        return $result;
    }

    // 2. CREATE (Menyimpan data baru)
    public function create($data)
    {
        $course_name = $data['course_name'];
        $sks = $data['sks'];
        $lecturer_id = $data['lecturer_id'];

        // Cek jika lecturer_id kosong, set ke NULL
        if (empty($lecturer_id)) {
            $lecturer_id = null;
        }

        $query = "INSERT INTO " . $this->table_name . " (course_name, sks, lecturer_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        
        // 'sii' = string, integer, integer
        $stmt->bind_param('sii', $course_name, $sks, $lecturer_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 3. READ BY ID (Membaca satu data untuk edit)
    public function readById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 4. UPDATE (Mengubah data)
    public function update($id, $data)
    {
        $course_name = $data['course_name'];
        $sks = $data['sks'];
        $lecturer_id = $data['lecturer_id'];

        // Cek jika lecturer_id kosong, set ke NULL
        if (empty($lecturer_id)) {
            $lecturer_id = null;
        }

        $query = "UPDATE " . $this->table_name . " SET course_name = ?, sks = ?, lecturer_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        // 'siii' = string, integer, integer, integer
        $stmt->bind_param('siii', $course_name, $sks, $lecturer_id, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 5. DELETE (Menghapus data)
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>