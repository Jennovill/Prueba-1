<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Análisis Temporal</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Highcharts -->
  <script src="https://code.highcharts.com/highcharts.js"></script>

  <!-- Estilos propios -->
  <link rel="stylesheet" href="../css/styles.css">
</head>

<body class="bg-light">

<?php
$titulo = "Análisis Temporal";
$basePath = '../';
$cssPrincipal = 'styles.css';

ob_start();
?>

<!-- Sección 1: Título de la página -->
<section class="py-5 text-center">
    <h1 class="titulo-fcnm mb-2">Análisis Temporal</h1>
    <p class="descripcion-fcnm">Explora la distribución de los casos según distintas dimensiones temporales.</p>
</section>

<!-- Sección 2: Filtros -->
<section class="py-2">
  <div class="container-fluid">
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-4">
      <div class="filtro-box w-100 w-md-25">
        <label for="filtroTemporal" class="form-label fw-bold">Filtro temporal:</label>
        <select id="filtroTemporal" class="form-select">
          <option value="mensuales">Mes</option>
          <option value="dia_semana">Día de la semana</option>
          <option value="rango_horario">Hora del día</option>
        </select>
      </div>
      <div class="filtro-box w-100 w-md-25">
        <label for="anioSelect" class="form-label fw-bold">Año:</label>
        <select id="anioSelect" class="form-select">
          <option value="todos">Todos los años</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
          <option value="2023">2023</option>
          <option value="2024">2024</option>
        </select>
      </div>
    </div>
  </div>
</section>


<!-- Sección 3: Gráfico -->
<section class="grafico-section bg-light py-2">
  <div class="container-fluid">
    <div id="graficoTemporal" style="height: 400px;"></div>
  </div>
</section>





<script>
function actualizarGrafico() {
  const filtro = document.getElementById("filtroTemporal").value;
  const anio = document.getElementById("anioSelect").value;

  const ruta = `../json/temporal/datos_${filtro}.json`;

  fetch(ruta)
    .then(res => res.json())
    .then(data => {
      const anios = ["2021", "2022", "2023", "2024"];

      data.forEach(d => {
        anios.forEach(a => {
          if (!d[a]) d[a] = 0;
        });
      });

      if (filtro === "mensuales") {
        data.forEach(d => {
          if (d.mes > 7) d["2024"] = null;
        });
      }

      let categorias = [];
      if (filtro === "mensuales") {
        categorias = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
      } else if (filtro === "dia_semana") {
        categorias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
      } else if (filtro === "rango_horario") {
        categorias = ['00-03', '03-06', '06-09', '09-12', '12-15', '15-18', '18-21', '21-24'];
      }

      const series = anio === "todos"
        ? anios.map(a => ({
            name: a,
            data: data.map(d => d[a])
          }))
        : [{
            name: anio,
            data: data.map(d => d[anio])
          }];

      Highcharts.chart("graficoTemporal", {
        chart: { type: "line" },
        title: {
          text: `Distribución de Casos por ${filtro.replace('_', ' ')} - Año: ${anio}`,
          style: { fontWeight: "bold", fontSize: "20px", color: "#29004d" }
        },
        xAxis: {
          categories: categorias.slice(0, data.length),
          title: { text: "Categorías" },
          labels: { rotation: -45 }
        },
        yAxis: {
          min: 0,
          title: { text: "Número de Casos" }
        },
        tooltip: {
          pointFormat: 'Casos: <b>{point.y}</b>'
        },
        series: series
      });
    })
    .catch(error => {
      console.error("Error al cargar el gráfico:", error);
      document.getElementById("graficoTemporal").innerHTML = "<p>Error al cargar el gráfico.</p>";
    });
}

document.getElementById("filtroTemporal").addEventListener("change", actualizarGrafico);
document.getElementById("anioSelect").addEventListener("change", actualizarGrafico);
window.addEventListener("DOMContentLoaded", actualizarGrafico);
</script>

<?php
$contenido = ob_get_clean();
include '../comp/layout.php';
?>

</body>
</html>

