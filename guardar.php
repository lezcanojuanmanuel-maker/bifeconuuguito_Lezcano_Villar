<?php
// guardar.php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$combo_id = isset($_POST['opcion']) ? intval($_POST['opcion']) : 0;

if ($combo_id <= 0) {
    echo "Selección inválida. Volver a <a href='index.php'>votar</a>.";
    exit;
}

// 1) Verificar que el combo exista
$check = $conexion->prepare("SELECT id FROM combos WHERE id = :id");
$check->bindParam(':id', $combo_id, PDO::PARAM_INT);
$check->execute();

if ($check->rowCount() === 0) {
    echo "Combo no válido. Volver a <a href='index.php'>votar</a>.";
    exit;
}

// 2) Insertar el voto
$insert = $conexion->prepare("INSERT INTO votos (combo_id) VALUES (:combo)");
$insert->bindParam(':combo', $combo_id, PDO::PARAM_INT);
$insert->execute();

// 3) Actualizar contador en combos
$update = $conexion->prepare("UPDATE combos SET cant_votos = cant_votos + 1 WHERE id = :id");
$update->bindParam(':id', $combo_id, PDO::PARAM_INT);
$update->execute();

// 4) Redirigir al usuario
header('Location: ver_resultados.php?msg=' . urlencode('Gracias por votar!'));
exit;
?>
