<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Resultados — BifeConJuguito</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body{font-family:Arial, sans-serif;background:#f5f7fb;padding:20px}
    .container{max-width:900px;margin:0 auto;background:#fff;padding:20px;border-radius:8px}
  </style>
</head>
<body>
  <div class="container">
    <h1>Resultados de la votación</h1>
    <?php if(isset($_GET['msg'])): ?>
      <p style="color:green;"><?php echo htmlspecialchars($_GET['msg']); ?></p>
    <?php endif; ?>
    <canvas id="chart" width="800" height="300"></canvas>
    <p><a href="index.php">Volver a votar</a></p>
  </div>

  <script>
    async function loadAndDraw(){
      const res = await fetch('api_results.php');
      const rows = await res.json();

      const labels = rows.map(r => r.name);
      const data = rows.map(r => Number(r.cant_votos));

      const ctx = document.getElementById('chart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'Votos',
            data: data
          }]
        },
        options: {
          responsive: true,
          plugins: { legend: { display: false } },
          scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
      });
    }
    loadAndDraw();
  </script>
</body>
</html>