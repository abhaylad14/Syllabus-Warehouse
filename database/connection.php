<?php
class connection {

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "syllabus_warehouse";
    private $conn;

    public function connect() {
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function disconnect() {
        $conn = null;
    }

}

?>