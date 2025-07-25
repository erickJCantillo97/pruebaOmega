<?php 

class Conexion {
    private const  HOST = 'localhost';
    private const USER = 'root';
    private const PASS = '';
    private const DB = 'pruebamega';

    public function conectar() {
        $conexion = mysqli_connect(self::HOST, self::USER, self::PASS, self::DB);
        if (!$conexion) {
            die("Conexión fallida: " . mysqli_connect_error());
        }
        return $conexion;
    }
}
?>