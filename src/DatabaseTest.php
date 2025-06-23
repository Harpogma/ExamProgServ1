<?php 

class DatabaseTest {
    const DATABASE_FILE = '../projectmanager.db';
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("sqlite:" . self::DATABASE_FILE);

        $sql = "CREATE TABLE IF NOT EXISTS projects (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            description TEXT,
            status TEXT NOT NULL,
            priority TEXT NOT NULL,
            category TEXT
        )";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function getPdo() {
        return $this->pdo;
    }
    
}
