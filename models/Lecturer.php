<?php
// models/Lecturer.php

class Lecturer
{
    private $conn;
    private $table_name = "lecturers";

    // Properti
    public $id;
    public $name;
    public $nidn;
    public $phone;
    public $join_date;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // --- METODE CRUD ---

    // 1. READ (Membaca semua data)
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
        return $result;
    }

    // 2. CREATE (Menyimpan data baru)
    public function create($data)
    {
        // Ambil data dari form
        $name = $data['name'];
        $nidn = $data['nidn'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];

        $query = "INSERT INTO " . $this->table_name . " (name, nidn, phone, join_date) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // 'ssss' berarti semua parameter adalah string
        $stmt->bind_param('ssss', $name, $nidn, $phone, $join_date);

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
        
        // 'i' berarti parameter adalah integer
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 4. UPDATE (Mengubah data)
    public function update($id, $data)
    {
        // Ambil data dari form
        $name = $data['name'];
        $nidn = $data['nidn'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];

        $query = "UPDATE " . $this->table_name . " SET name = ?, nidn = ?, phone = ?, join_date = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // 'ssssi' berarti 4 string, 1 integer
        $stmt->bind_param('ssssi', $name, $nidn, $phone, $join_date, $id);

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

        // 'i' berarti parameter adalah integer
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>