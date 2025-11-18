<?php
// config/Database.php

class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "tp_mvc25";
    public $conn;

    // Method untuk mendapatkan koneksi database
    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db_name);
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
?>