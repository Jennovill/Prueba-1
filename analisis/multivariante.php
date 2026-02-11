<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Análisis Multivariante</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Highcharts -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/scatter.js"></script>
</head>
<body class="bg-light">

<?php
$titulo = "Análisis Univariante";
$basePath = '../';
$cssPrincipal = 'styles.css';

ob_start();
?>

<!-- Contenedor del análisis multivariante -->
<!-- Sección de título -->
<section class="py-5 text-center">
  <h1 class="titulo-fcnm">Análisis Multivariante</h1>
  <p class="descripcion-fcnm">Visualiza relaciones complejas entre múltiples variables mediante un análisis de componentes múltiples.</p>
</section>

<!-- Sección de gráfico multivariante con leyenda -->
<section class="container-fluid py-2 bg-light">
  <div class="row justify-content-center align-items-start gx-5">
    
    <!-- Gráfico más amplio -->
    <div class="col-lg-9 order-1 order-lg-0">
      <div class="bg-white rounded shadow-sm p-4">
        <div id="grafico" style="height: 600px; width: 100%;"></div>
      </div>
    </div>

    <!-- Leyenda compacta a la derecha -->
    <div class="col-lg-3 mb-4 order-0 order-lg-1">
      <div class="leyenda-box p-3 bg-white rounded shadow-sm">
        <h5 class="fw-bold mb-3">Leyenda</h5>
        <ul class="list-unstyled lh-lg mb-0">
          <li><span style="color: #E41A1C; font-size: 1.2rem;">●</span> Distrito</li>
          <li><span style="color: #377EB8; font-size: 1.2rem;">●</span> Categoría</li>
          <li><span style="color: #4DAF4A; font-size: 1.2rem;">●</span> Peligrosidad</li>
          <li><span style="color: #984EA3; font-size: 1.2rem;">●</span> Amenaza de muerte</li>
        </ul>
      </div>
    </div>

  </div>
</section>

<!-- Sección: Varianza Explicada -->
 <section class="py-2 text-center">
  <p class="descripcion-fcnm">Explora cuánta información aporta cada dimensión del análisis de componentes múltiples mediante la varianza explicada.</p>
</section>

<section class="py-2">
  <div id="graficoVarianza" style="height: 500px;"></div>
</section>

<script>
const datos = [
  { "variable": "9 DE OCTUBRE", "x": 0.1287, "y": -0.2866 },
  { "variable": "CEIBOS", "x": 0.2297, "y": -0.2426 },
  { "variable": "ESTEROS", "x": 0.0287, "y": 0.0077 },
  { "variable": "FLORIDA", "x": -0.0584, "y": 0.034 },
  { "variable": "MODELO", "x": 0.0981, "y": -0.2658 },
  { "variable": "NUEVA PROSPERINA", "x": -0.0438, "y": 0.5401 },
  { "variable": "PASCUALES", "x": 0.0566, "y": -0.0516 },
  { "variable": "PORTETE", "x": -0.1464, "y": -0.2022 },
  { "variable": "PROGRESO", "x": -0.0718, "y": 0.0363 },
  { "variable": "SUR", "x": -0.0913, "y": 0.1119 },
  { "variable": "Amenazas (sin extorsión explícita)", "x": -0.3781, "y": -0.2541 },
  { "variable": "Extorsión Presencial / Directa", "x": 0.446, "y": 0.6851 },
  { "variable": "Extorsión Telefónica / Digital", "x": 0.2285, "y": -0.5807 },
  { "variable": "Extorsión Vehicular", "x": -0.1501, "y": 1.249 },
  { "variable": "Fraude / Estafa", "x": 0.0615, "y": 1.6098 },
  { "variable": "Otros / No clasificados", "x": -0.044, "y": 0.1151 },
  { "variable": "Panfletos Extorsivos", "x": -0.0293, "y": 0.6179 },
  { "variable": "peligrosidad_1", "x": 0.6545, "y": 1.7954 },
  { "variable": "peligrosidad_2", "x": -0.2326, "y": 3.2541 },
  { "variable": "peligrosidad_3", "x": -0.2684, "y": 1.7725 },
  { "variable": "peligrosidad_4", "x": -0.5211, "y": -0.3803 },
  { "variable": "peligrosidad_5", "x": -0.6472, "y": -0.728 },
  { "variable": "peligrosidad_No especificado", "x": 1.9068, "y": -0.1534 },
  { "variable": "amenaza_muerte.NA", "x": 2.0107, "y": -0.2591 },
  { "variable": "amenaza_muerte_0", "x": -0.1532, "y": 1.6763 },
  { "variable": "amenaza_muerte_1", "x": -0.5431, "y": -0.4721 }
];

const colorMap = {
  "9 DE OCTUBRE": "#E41A1C",
  "CEIBOS": "#E41A1C",
  "ESTEROS": "#E41A1C",
  "FLORIDA": "#E41A1C",
  "MODELO": "#E41A1C",
  "NUEVA PROSPERINA": "#E41A1C",
  "PASCUALES": "#E41A1C",
  "PORTETE": "#E41A1C",
  "PROGRESO": "#E41A1C",
  "SUR": "#E41A1C",
  "Amenazas (sin extorsión explícita)": "#377EB8",
  "Extorsión Presencial / Directa": "#377EB8",
  "Extorsión Telefónica / Digital": "#377EB8",
  "Extorsión Vehicular": "#377EB8",
  "Fraude / Estafa": "#377EB8",
  "Otros / No clasificados": "#377EB8",
  "Panfletos Extorsivos": "#377EB8",
  "peligrosidad_1": "#4DAF4A",
  "peligrosidad_2": "#4DAF4A",
  "peligrosidad_3": "#4DAF4A",
  "peligrosidad_4": "#4DAF4A",
  "peligrosidad_5": "#4DAF4A",
  "peligrosidad_No especificado": "#4DAF4A",
  "amenaza_muerte.NA": "#984EA3",
  "amenaza_muerte_0": "#984EA3",
  "amenaza_muerte_1": "#984EA3"
};

const seriesData = datos.map(item => ({
  name: item.variable,
  x: item.x,
  y: item.y,
  color: colorMap[item.variable] || "#000000"
}));

Highcharts.chart('grafico', {
  chart: {
    type: 'scatter',
    zoomType: 'xy'
  },
  title: {
    text: 'Distribución de Variables por Coordenadas'
  },
  xAxis: {
  title: { text: 'Coordenada X' },
  gridLineWidth: 0,
  plotLines: [{
    color: "#000000",
    width: 2,
    value: 0
  }]
},
yAxis: {
  title: { text: 'Coordenada Y' },
  gridLineWidth: 0,
  plotLines: [{
    color: "#000000",
    width: 2,
    value: 0
  }]
}
,
  plotOptions: {
    scatter: {
      marker: {
        radius: 8
      }
    }
  },
  series: [{
    name: 'Variables',
    data: seriesData,
    tooltip: {
      pointFormat: '<b>{point.name}</b><br/>X: {point.x}, Y: {point.y}'
    }
  }]
});
</script>

<script>
Highcharts.chart('graficoVarianza', {
  chart: {
    zoomType: 'xy',
    backgroundColor: 'transparent'
  },
  title: {
    text: 'ACM: Varianza Explicada y Eigenvalues'
  },
  xAxis: {
    categories: [
      'dim 1', 'dim 2', 'dim 3', 'dim 4', 'dim 5', 'dim 6', 'dim 7', 'dim 8', 'dim 9', 'dim 10',
      'dim 11', 'dim 12', 'dim 13', 'dim 14', 'dim 15', 'dim 16', 'dim 17', 'dim 18', 'dim 19', 'dim 20', 'dim 21'
    ],
    title: { text: 'Dimensiones', style: { fontWeight: 'bold' } },
    labels: {
      rotation: -45,
      style: { fontSize: '10px' }
    }
  },
  yAxis: [{
    max: 10,
    title: {
      text: 'Porcentaje de Varianza Explicada',
      style: { fontWeight: 'bold' }
    },
    labels: {
      format: '{value}%',
      style: { fontSize: '10px' }
    }
  }, {
    opposite: true,
    title: {
      text: 'Eigenvalues',
      style: { fontWeight: 'bold' }
    },
    labels: {
      format: '{value}',
      style: { fontSize: '10px' }
    }
  }],
  tooltip: {
    shared: true,
    backgroundColor: '#f9f9f9',
    borderColor: '#ccc',
    style: { color: '#000' }
  },
  plotOptions: {
    column: {
      dataLabels: {
        enabled: true,
        format: '{point.y:.1f}%',
        style: {
          fontSize: '10px',
          fontWeight: 'bold',
          color: '#000'
        }
      },
      borderRadius: 3
    },
    line: {
      marker: {
        radius: 4,
        fillColor: '#1a237e'
      }
    }
  },
  series: [
    {
      name: 'Varianza Explicada',
      type: 'column',
      color: {
        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
        stops: [
          [0, '#9c27b0'],
          [1, '#e91e63']
        ]
      },
      data: [
        7.95, 5.73, 5.34, 5.29, 5.22, 5.08, 5.00, 4.83, 4.84, 4.95,
        4.75, 4.71, 4.55, 4.48, 4.46, 4.44, 4.32, 4.17, 4.17, 3.73, 1.95
      ]
    },
    {
      name: 'Eigenvalues',
      type: 'line',
      yAxis: 1,
      color: '#1a237e',
      data: [
        0.4176, 0.3012, 0.2804, 0.2776, 0.2742, 0.2669, 0.2627, 0.2635, 0.2540, 0.2562,
        0.2493, 0.2472, 0.2387, 0.2365, 0.2343, 0.2330, 0.2283, 0.2198, 0.1961, 0.1023, 0.0650
      ],
      tooltip: {
        valueSuffix: ' Eigenvalue'
      }
    }
  ],
  credits: { enabled: false }
});
</script>


<?php
$contenido = ob_get_clean();
include '../comp/layout.php';
?>


</body>
</html>

