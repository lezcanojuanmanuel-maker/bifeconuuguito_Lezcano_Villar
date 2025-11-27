<?php
$host = "sql100.infinityfree.com";   // HOST CORRECTO
$dbname = "if0_40534268_bifeconjuguito";         // <-- PONÉ AQUÍ EL NOMBRE EXACTO DE TU BD
$user = "if0_40534268";                // <-- TU USUARIO MYSQL EXACTO
$pass = "Lapapa10112008";             // <-- LA CONTRASEÑA QUE DEFINISTE

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Error conexión BD: " . $e->getMessage());
}
?>
