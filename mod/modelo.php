<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modelo de Extorsiones</title>
  <link rel="stylesheet" href="../css/styles.css">


  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

  <style>
    #mapSubcircuito {
      height: 400px;
    }
  </style>
</head>
<body class="bg-light p-5">

<?php
$titulo = "Análisis Univariante";
$basePath = '../';
$cssPrincipal = 'styles.css';

ob_start();
?>

<section class="py-5 text-center">
    <h1 class="titulo-fcnm">Modelo de Extorsiones por Subcircuito</h1>
    <p class="descripcion-fcnm">Consulta el riesgo estimado por subcircuito, accede a probabilidades de variables clave y visualiza la ubicación geográfica.</p>
</section>

<!-- Buscador -->
<section class="py-2">
  <div class="container text-center">
    <label for="subcircuito" class="form-label fw-bold">Escribe el Subcircuito:</label>
    <input type="text" id="subcircuito" class="form-control" placeholder="Ej. 9 DE OCTUBRE 2">
    <button id="buscar" class="btn btn-primary mt-3">Buscar</button>
  </div>
</section>

 <!-- Resultado -->
<section class="container py-2">
  <div id="resumen" class="mt-5 d-none">
    <div class="bg-white p-4 rounded shadow-sm">
      <h4 class="mb-3 text-primary">Información del Subcircuito</h4>
      <p id="info-basica" class="bg-light p-3 border rounded"></p>

      <h4 class="mt-4 text-primary">Tabla de Probabilidades</h4>
      <div id="tabla" class="table-responsive"></div>

      <h4 class="mt-4 text-primary">Ubicación en el Mapa</h4>
      <div id="mapSubcircuito" style="height: 400px; border-radius: 10px; overflow: hidden;"></div>
    </div>
  </div>
</section>


<script>
let mapSubcircuito = null;
let marcador = null;
let dataModelo = [];

// Cargar datos
fetch("../json/mapa/modelo.json")
  .then(res => res.json())
  .then(data => {
    dataModelo = data;
  })
  .catch(err => {
    console.error("Error al cargar modelo.json:", err);
    alert("Error al cargar los datos del modelo.");
  });

// Buscar y mostrar
document.getElementById("buscar").addEventListener("click", () => {
  const input = document.getElementById("subcircuito").value.trim().toLowerCase();

  const resultado = dataModelo.find(item =>
    item.SubCircuito.toLowerCase() === input
  );

  const resumen = document.getElementById("resumen");
  const info = document.getElementById("info-basica");
  const tablaDiv = document.getElementById("tabla");

  if (!resultado) {
    alert("Subcircuito no encontrado.");
    resumen.classList.add("d-none");
    return;
  }

  resumen.classList.remove("d-none");

  // Mostrar información básica
  info.innerHTML = `
    <strong>Distrito:</strong> ${resultado.Distrito} <br>
    <strong>Circuito:</strong> ${resultado.Circuito} <br>
    <strong>Subcircuito:</strong> ${resultado.SubCircuito} <br>
    <strong>Coordenadas:</strong> Lat: ${resultado.Latitud}, Long: ${resultado.Longitud}
  `;

  // Construir tabla de probabilidades
  const variables = Object.keys(resultado).filter(k =>
    !["Distrito", "Circuito", "SubCircuito", "Latitud", "Longitud"].includes(k)
  );

  let tablaHTML = "<table class='table table-bordered table-striped'><thead><tr>";
  variables.forEach(v => tablaHTML += `<th>${v}</th>`);
  tablaHTML += "</tr></thead><tbody><tr>";
  variables.forEach(v => {
    const val = resultado[v];
    tablaHTML += `<td>${typeof val === "number" ? (val * 100).toFixed(1) + "%" : val}</td>`;
  });
  tablaHTML += "</tr></tbody></table>";
  tablaDiv.innerHTML = tablaHTML;

  // Mostrar mapa
  const coords = [resultado.Latitud, resultado.Longitud];

  if (!mapSubcircuito) {
    mapSubcircuito = L.map('mapSubcircuito').setView(coords, 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapSubcircuito);
  } else {
    mapSubcircuito.setView(coords, 14);
  }

  if (marcador) {
    mapSubcircuito.removeLayer(marcador);
  }

  marcador = L.marker(coords)
    .addTo(mapSubcircuito)
    .bindPopup(`<strong>${resultado.SubCircuito}</strong><br>Lat: ${coords[0]}, Long: ${coords[1]}`)
    .openPopup();
});
</script>

<?php
$contenido = ob_get_clean();
include '../comp/layout.php';
?>

</body>
</html>
