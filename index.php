<?php
include 'conexion.php';
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>BifeConJuguito - Votar</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family:Arial, sans-serif;background:#f5f7fb;color:#222;padding:20px}
    .container{max-width:900px;margin:0 auto;background:#fff;padding:20px;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,0.08)}
    .combo{border:1px solid #e6ecf2;padding:12px;margin-bottom:10px;border-radius:6px;display:flex;justify-content:space-between;align-items:center}
    .combo h3{margin:0}
    button{padding:8px 12px;border-radius:6px;border:none;background:#007bff;color:#fff;cursor:pointer}
    button:disabled{opacity:.6;cursor:not-allowed}
  </style>
</head>
<body>
  <div class="container">
    <h1>Votá tu combo favorito — BifeConJuguito</h1>
    <p>Seleccioná uno de los combos y presioná <strong>Votar</strong>.</p>

    <form id="voteForm" method="post" action="guardar.php">
      <input type="hidden" name="opcion" id="opcion" value="">

      <?php
      // Obtener combos desde DB
      $query = "SELECT id, name, description FROM combos ORDER BY id";
      $res = $conexion->query($query);
      if ($res && $res->rowCount() > 0):
        while ($row = $res->fetch(PDO::FETCH_ASSOC)):
      ?>
        <div class="combo">
          <div>
            <h3><?php echo htmlspecialchars($row['id'] . '. ' . $row['name']); ?></h3>
            <div><?php echo htmlspecialchars($row['description']); ?></div>
          </div>
          <div>
            <button type="button" onclick="selectCombo(<?php echo $row['id']; ?>, '<?php echo addslashes($row['name']); ?>')">Seleccionar</button>
          </div>
        </div>
      <?php
        endwhile;
      else:
      ?>
        <p>No hay combos disponibles.</p>
      <?php endif; ?>

      <div style="margin-top:12px;">
        <button id="voteBtn" type="submit" disabled>Votar</button>
        <a href="ver_resultados.php" style="margin-left:12px">Ver resultados</a>
      </div>
    </form>
  </div>

  <script>
    function selectCombo(id, name){
      document.getElementById('opcion').value = id;
      const btn = document.getElementById('voteBtn');
      btn.disabled = false;
      btn.textContent = 'Votar por: ' + name;
    }

    document.getElementById('voteForm').addEventListener('submit', function(e){
      if(!document.getElementById('opcion').value){
        e.preventDefault();
        alert('Seleccioná un combo antes de votar');
      } else {
        // opcional: confirmación
        if(!confirm('¿Confirmás tu voto?')) e.preventDefault();
      }
    });
  </script>
</body>
</html>