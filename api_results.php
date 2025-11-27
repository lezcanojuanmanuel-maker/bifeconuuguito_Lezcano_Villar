<?php
include("conexion.php");

// Habilitar errores en desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');

$sql = "
    SELECT 
        c.id,
        c.name,
        (SELECT COUNT(*) FROM votos v WHERE v.combo_id = c.id) AS cant_votos
    FROM combos c
    ORDER BY c.id
";

$stmt = $conexion->query($sql);

$rows = [];
if ($stmt) {
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $r;
    }
}

echo json_encode($rows);
