<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mapa de Calor de Extorsiones</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <!-- Leaflet Heat -->
  <script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>

  <style>
    #map {
      height: 600px;
      width: 100%;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .leaflet-control.legend-control {
      background: #fff;
      padding: 10px 12px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,.15);
      font: 14px/1.2 system-ui, Arial, sans-serif;
      color: #222;
      pointer-events: none;
    }

    .legend-title {
      font-weight: 600;
      margin-bottom: 6px;
    }

    .legend-bar {
      height: 12px;
      width: 220px;
      border-radius: 6px;
      background: linear-gradient(to right, blue 0%, #7FFF00 65%, red 100%);
      border: 1px solid rgba(0,0,0,.12);
    }

    .legend-labels {
      display: flex;
      justify-content: space-between;
      font-size: 12px;
      color: #444;
      margin-top: 4px;
    }
  </style>
</head>
<body class="bg-light p-5">

<?php
$titulo = "Mapa de Calor";
$basePath = '../';
$cssPrincipal = 'styles.css';
ob_start();
?>

<!-- Título -->
<section class="py-5 text-center">
  <h1 class="titulo-fcnm">Análisis Geográfico</h1>
  <p class="descripcion-fcnm">Visualiza la intensidad de casos de extorsión en Guayaquil usando un mapa de calor.</p>
</section>

<!-- Filtro de Año -->
<section class="py-2">
  <div class="container text-center">
    <label for="anioSelect" class="form-label fw-bold">Selecciona el año:</label>
    <select id="anioSelect" class="form-select filtro-select mx-auto">
      <option value="todos">Todos los años</option>
      <option value="2021">2021</option>
      <option value="2022">2022</option>
      <option value="2023">2023</option>
      <option value="2024">2024</option>
    </select>
  </div>
</section>

<!-- Mapa -->
<section class="py-2">
  <div class="container">
    <div id="map"></div>
  </div>
</section>

<script>
let map, heatLayer, jsonData;

function crearMapa() {
  map = L.map('map').setView([-2.1700, -79.9200], 12);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  // Leyenda
  const legend = L.control({ position: 'bottomleft' });
  legend.onAdd = function () {
    const div = L.DomUtil.create('div', 'leaflet-control legend-control');
    div.innerHTML = `
      <div class="legend-title">Intensidad de casos</div>
      <div class="legend-bar"></div>
      <div class="legend-labels">
        <span>Baja</span><span>Media</span><span>Alta</span>
      </div>
    `;
    return div;
  };
  legend.addTo(map);
}

function actualizarMapa(anio) {
  if (!jsonData) return;

  let datos = [];

  if (anio === "todos") {
    // Unir todos los años
    for (const key in jsonData) {
      datos = datos.concat(jsonData[key]);
    }
  } else {
    datos = jsonData[anio] || [];
  }

  const heatData = datos.map(p => [p.y, p.x, p.value]);

  if (heatLayer) {
    heatLayer.setLatLngs(heatData);
  } else {
    heatLayer = L.heatLayer(heatData, {
      radius: 25,
      blur: 15,
      maxZoom: 17,
      gradient: {
        0.4: 'blue',
        0.65: '#7FFF00',
        1: 'red'
      }
    }).addTo(map);
  }
}

// Inicializar
fetch('../json/mapa/heatmap_years.json')
  .then(res => res.json())
  .then(data => {
    jsonData = data;
    crearMapa();
    actualizarMapa("todos");
  })
  .catch(err => {
    console.error("Error al cargar el JSON:", err);
    document.getElementById("map").innerHTML = "<p>Error al cargar el mapa de calor.</p>";
  });

// Filtro
document.getElementById("anioSelect").addEventListener("change", function () {
  const anio = this.value;
  actualizarMapa(anio);
});
</script>

<?php
$contenido = ob_get_clean();
include '../comp/layout.php';
?>

</body>
</html>
