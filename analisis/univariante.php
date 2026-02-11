<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Análisis Univariante</title>
  <link rel="stylesheet" href="../css/styles.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Highcharts -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/highcharts-more.js"></script>
</head>

<body>

<?php
$titulo = "Análisis Univariante";
$basePath = '../';
$cssPrincipal = 'styles.css';

ob_start();
?>


<!-- Sección: Introducción -->
<section class="py-5 text-center">
    <h1 class="titulo-fcnm">Análisis Univariante</h1>
    <p class="descripcion-fcnm">Visualiza la distribución de tasas por distrito entre 2021 y 2024.</p>
</section>

<!-- Sección: Filtro -->
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

<!-- Sección: Visualización -->
<section class="section-data py-2">
  <div class="container-fluid px-5">
    <div class="row g-4">
      <!-- Gráfico -->
      <div class="col-lg-7">
        <div class="card p-4 shadow-sm h-100">
          <div id="graficoUnivariante" style="height: 500px;"></div>
        </div>
      </div>

      <!-- Tabla -->
      <div class="col-lg-5">
        <div class="card p-4 shadow-sm h-100">
          <h4 class="text-center fw-bold titulo-tabla">Tabla de Tasas</h4>
          <div class="table-responsive">
            <table id="tablaTasas" class="table table-bordered text-center align-middle">
              <thead class="table-header">
                <tr>
                  <th>Distrito</th>
                  <th>Tasa</th>
                  <th>Proporción (%)</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Sección: Frecuencias por Subcircuito -->
<section class="py-5 text-center">
    <p class="descripcion-fcnm">Frecuencia de Extorsiones por Subcircuito.</p>
</section>

<section class="py-2">
  <div class="container text-center">
    <label for="districtSelector" class="form-label fw-bold">Selecciona un Distrito:</label>
      <select id="districtSelector" class="form-select filtro-select mx-auto">
      </select>
  </div>
</section>

<section class="py-2">
    <div id="frecuenciaChart" style="height: 700px;"></div>
  </div>
</section>


<script>
  const anioSelect = document.getElementById("anioSelect");

  function cargarDatos(anio) {
    const carpeta = anio === "todos" ? "todos" : anio;
    const graficoPath = `../json/tasas/${carpeta}/tasas_por_distrito_${carpeta}_grafico.json`;
    const tablaPath = `../json/tasas/${carpeta}/tasas_por_distrito_${carpeta}.json`;

    // Gráfico
    fetch(graficoPath)
      .then(res => res.json())
      .then(data => {
        Highcharts.chart("graficoUnivariante", {
          chart: { type: "bubble", backgroundColor: "transparent" },
          title: { text: null },
          xAxis: {
            categories: data.categorias,
            title: { text: "Distrito" },
            labels: { rotation: -45 }
          },
          yAxis: {
            min: 0,
            title: { text: "Tasa por 100.000" }
          },
          tooltip: {
            pointFormat: 'Tasa: <b>{point.y:.2f}</b>'
          },
          series: [{
            name: "Tasa",
            data: data.categorias.map((cat, i) => ({
              x: i,
              y: data.tasas[i],
              z: data.tasas[i] / 10
            })),
            colorByPoint: true
          }],
          credits: { enabled: false }
        });
      });

    // Tabla
    fetch(tablaPath)
      .then(res => res.json())
      .then(tabla => {
        const tbody = document.querySelector("#tablaTasas tbody");
        tbody.innerHTML = "";
        const totalTasas = tabla.reduce((acc, row) => acc + row.tasa, 0);

        tabla.forEach(row => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
            <td>${row.Distrito}</td>
            <td>${row.tasa.toFixed(2)}</td>
            <td>${((row.tasa / totalTasas) * 100).toFixed(2)}%</td>
          `;
          tbody.appendChild(tr);
        });
      });
  }

  anioSelect.addEventListener("change", () => {
    cargarDatos(anioSelect.value);
  });

  window.addEventListener("DOMContentLoaded", () => {
    cargarDatos(anioSelect.value);
  });
</script>

<script>
  let frecuenciaData = {};

  // Colores por distrito (puedes personalizar estos)
  const districtColors = {
    "MODELO": "#4CC9F0",
    "PASCUALES": "#277DA1",
    "NUEVA PROSPERINA": "#B5179E",
    "SUR": "#F3722C",
    "FLORIDA": "#8ECAE6",
    "PORTETE": "#90BE6D",
    "9 DE OCTUBRE": "#FFB703",
    "ESTEROS": "#E76F51",
    "CEIBOS": "#43AA8B",
    "PROGRESO": "#F8961E"
  };

  fetch('../json/tasas/frecuencias.json')
    .then(res => res.json())
    .then(data => {
      frecuenciaData = data;
      cargarDistritos(data);
      dibujarGrafico(Object.keys(data)[0]); // Muestra el primero por defecto
    });

  function cargarDistritos(data) {
    const selector = document.getElementById('districtSelector');
    selector.innerHTML = ""; // Limpiar por si acaso

    Object.keys(data).forEach(distrito => {
      const option = document.createElement("option");
      option.value = distrito;
      option.textContent = distrito;
      selector.appendChild(option);
    });

    selector.addEventListener("change", function () {
      dibujarGrafico(this.value);
    });
  }

  function dibujarGrafico(distrito) {
    const datos = frecuenciaData[distrito];
    if (!datos) return;

    Highcharts.chart('frecuenciaChart', {
      chart: {
        type: 'column',
        polar: true,
        inverted: true
      },
      title: {
        text: distrito
      },
      pane: {
        size: '85%',
        innerSize: '20%',
        endAngle: 270
      },
      xAxis: {
        categories: datos.categories,
        tickInterval: 1,
        lineWidth: 0,
        gridLineWidth: 0,
        labels: {
          rotation: -45,
          align: 'right',
          style: { fontSize: '11px' }
        }
      },
      yAxis: {
        min: 0,
        title: { text: null },
        gridLineWidth: 0
      },
      tooltip: {
        outside: true,
        headerFormat: '<span style="font-size:10px">{point.key}</span><br/>',
        pointFormat: '<span style="color:{series.color}">●</span> Frecuencia: <b>{point.y}</b><br/>'
      },
      plotOptions: {
        column: {
          stacking: null,
          pointPadding: 0,
          groupPadding: 0,
          pointPlacement: 'between',
          pointWidth: 10,
          borderRadius: '50%'
        }
      },
      series: [{
        name: distrito,
        data: datos.data,
        color: districtColors[distrito] || '#888'
      }]
    });
  }
</script>


<?php
$contenido = ob_get_clean();
include '../comp/layout.php';
?>

</body>
</html>
