<?php
$basePath = $basePath ?? '';
$titulo = $titulo ?? 'Observatorio de Extorsiones';
$cssPrincipal = $cssPrincipal ?? 'principal.css'; // Permite cambiar el CSS desde cada página
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= $titulo ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- CSS -->
  <link rel="stylesheet" href="<?= $basePath ?>css/<?= $cssPrincipal ?>">
  <link rel="stylesheet" href="<?= $basePath ?>css/styles.css">

  <!-- Librerías opcionales -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/highcharts-more.js"></script>
  <script src="https://code.highcharts.com/modules/bubble.js"></script>
</head>
<body>

  <?php include(__DIR__ . '/header.php'); ?>

  <main class="main-content">
    <?= $contenido ?? '' ?>
  </main>

  <?php include(__DIR__ . '/footer.php'); ?>

</body>
</html>


