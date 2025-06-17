<?php 
const DATABASE_FILE = './xxx.db';

$pdo = new PDO("sqlite:" . DATABASE_FILE);

$sql = "CREATE TABLE IF NOT EXISTS xxx (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    species TEXT NOT NULL,
    nickname TEXT,
    sex TEXT NOT NULL,
    age INTEGER NOT NULL,
    color TEXT,
    personalities TEXT,
    size FLOAT,
    notes TEXT
);";

$pdo->exec($sql);