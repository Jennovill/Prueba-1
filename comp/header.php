<!-- Header -->
<?php
if (!isset($basePath)) {
  $basePath = '';
}
?>

<header class="main-header">
  <div class="container header-content">

    <div class="logos">
      <a href="https://www.fcnm.espol.edu.ec/es" target="_blank">
        <img src="<?= $basePath ?>img/logo-esp.png" alt="Logo ESPOL">
      </a>
      <a href="https://x.com/ceie_espol" target="_blank">
        <img src="<?= $basePath ?>img/logo-centro.png" alt="Logo Centro">
      </a>
    </div>

    <nav class="main-nav">
      <ul>
        <li><a href="<?= $basePath ?>index.php#inicio">Inicio</a></li>
        <li><a href="<?= $basePath ?>index.php#nosotros">Nosotros</a></li>
        <li><a href="<?= $basePath ?>index.php#extorsiones">Sobre las Extorsiones</a></li>
        <li><a href="<?= $basePath ?>index.php#analisis">2021 - 2024</a></li>
        <li><a href="<?= $basePath ?>index.php#predicciones">Predicciones</a></li>
      </ul>
    </nav>

  </div>
</header>

