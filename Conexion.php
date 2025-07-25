<?php

class Conexion
{
    private const  HOST = 'localhost';
    private const USER = 'root';
    private const PASS = '';
    private const DB = 'pruebamega';

    public function conectar()
    {
        $conn = new PDO("mysql:host=localhost", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_create_db = "CREATE DATABASE IF NOT EXISTS " . self::DB;
        $conn->exec($sql_create_db);
        $conn_db = new PDO("mysql:host=localhost;dbname=" . self::DB, self::USER, self::PASS);
        $conn->exec($sql_create_db);
        $conn_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $sql_create_table = "
            CREATE TABLE IF NOT EXISTS persons (
                id INT PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                avatar VARCHAR(255) NOT NULL,
                country VARCHAR(255) NOT NULL,
                createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";
        $conn_db->exec($sql_create_table);

        $conexion = mysqli_connect(self::HOST, self::USER, self::PASS, self::DB);
        if (!$conexion) {
            die("Conexión fallida: " . mysqli_connect_error());
        }
        return $conexion;
    }
}
