<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Observatorio de Extorsiones</title>
  <link rel="stylesheet" href="css/principal.css">
</head>
<body>

<?php
$titulo = "Observatorio de Extorsiones";
$basePath = '';
$cssPrincipal = 'principal.css';

ob_start();
?>

  <!-- Sección 1: INICIO / PORTADA -->
<section class="hero" id="inicio">
  <div class="hero-wrapper">
    <div class="hero-text">
      <h1>Observatorio de Extorsiones en Guayaquil</h1>
      <p>Una plataforma para visualizar, entender y analizar el fenómeno de las extorsiones en nuestra sociedad. Accede a información verificada, análisis territorial y predicciones geográficas.</p>
      <div class="botones">
        <button class="btn btn-secundario" onclick="mostrarObjetivos()">Objetivos</button>
  <a href="#extorsiones" class="btn">Más información</a>
  
</div>

    </div>
    <div class="hero-image">
      <img src="img/imagen-portada2.png" alt="Ilustración extorsión">
    </div>
  </div>
  <div class="curve-bottom">
    <img src="curve-bottom.svg" alt="Curva decorativa">
  </div>
</section>


<!-- Sección 5: Nosotros -->
<section class="nosotros" id="nosotros">
  <div class="nosotros-container">
    <h2>Nosotros</h2>
    <p class="nosotros-intro">
      Somos estudiantes de la carrera de <strong>Ingeniería en Estadística</strong> de la Escuela Superior Politécnica del Litoral (ESPOL). Este observatorio fue desarrollado como un proyecto académico con el objetivo de analizar y visualizar información sobre extorsiones en Guayaquil - Ecuador.
    </p>

    <div class="equipo">
      <div class="miembro">
        <img src="img/persona1.png" alt="Integrante 1">
        <p>Franklin López</p>
      </div>
      <div class="miembro">
        <img src="img/persona2.png" alt="Integrante 2">
        <p>Jenny Ochoa</p>
      </div>
      <div class="miembro">
        <img src="img/persona3.png" alt="Integrante 3">
        <p>Leonardo Pesantes</p>
      </div>
      <div class="miembro">
        <img src="img/persona4.png" alt="Integrante 4">
        <p>Doménica Rocha</p>
      </div>
    </div>
  </div>
</section>

    <!-- Sección 2: SOBRE LAS EXTORSIONES -->
<section class="extorsiones" id="extorsiones">
  <div class="extorsiones-container">
    <!-- Columna Izquierda: Tipos de extorsión -->
<div class="tipos-extorsion">
  <div class="tipo-box" onclick="abrirModal('virtual')">
    <img src="img/icon-virtual.svg" alt="Extorsión virtual">
    <h3>Extorsión virtual</h3>
  </div>

  <div class="tipo-box" onclick="abrirModal('vacunas')">
    <img src="img/icon-vacunas.png" alt="Vacunas">
    <h3>Vacunas</h3>
  </div>

  <div class="tipo-box" onclick="abrirModal('personal')">
    <img src="img/icon-personal.png" alt="Amenazas con información personal">
    <h3>Amenazas con información personal</h3>
  </div>

  <div class="tipo-box" onclick="abrirModal('carcelaria')">
    <img src="img/icon-carcelaria.svg" alt="Extorsión carcelaria">
    <h3>Extorsión carcelaria</h3>
  </div>
</div>



    <!-- Columna Derecha: Info legal -->
    <div class="info-extorsion">
      <h2>Sobre las extorsiones</h2>
      <p>
        <strong>Art. 185 - COIP:</strong><br>
        La extorsión ocurre cuando una persona, con el fin de obtener un beneficio propio o para un tercero, obliga a otro mediante violencia o intimidación, incluso por medios electrónicos, a realizar u omitir un acto que perjudique su patrimonio o el de otro.
      </p>
      <a href="https://www.defensa.gob.ec/wp-content/uploads/downloads/2021/03/COIP_act_feb-2021.pdf" target="_blank" class="btn-coip">Leer más en el COIP</a>
    </div>
  </div>
</section>

 
<!-- Sección 3: 2021 - 2024 -->
<section class="analisis" id="analisis">
  <h2>Análisis 2021 - 2024</h2>
  <p class="intro-text">
    Selecciona el tipo de análisis para explorar datos específicos sobre la evolución y comportamiento de las extorsiones en el período 2021 - 2024.
  </p>

  <div class="espaciado"></div>

  <div class="analisis-grid">
    
    <a href="analisis/univariante.php" class="analisis-card">
      <div class="circle-img">
        <img src="img/icon-univariante.png" alt="Univariante">
      </div>
      <h3>Análisis Univariante</h3>
      <p class="desc">Observa la distribución de tasas por distrito entre 2021 y 2024.</p>
    </a>

    <a href="analisis/temporal.php" class="analisis-card">
      <div class="circle-img">
        <img src="img/icon-temporal.png" alt="Temporal">
      </div>
      <h3>Análisis Temporal</h3>
      <p class="desc">Explora cómo ha variado la extorsión a lo largo del tiempo en distintos contextos.</p>
    </a>

    <a href="analisis/multivariante.php" class="analisis-card">
      <div class="circle-img">
        <img src="img/icon-multivariante.png" alt="Multivariante">
      </div>
      <h3>Análisis Multivariante</h3>
      <p class="desc">Relaciona múltiples variables para entender patrones complejos de comportamiento.</p>
    </a>

    <a href="analisis/geografico.php" class="analisis-card">
      <div class="circle-img">
        <img src="img/icon-geografico.png" alt="Geográfico">
      </div>
      <h3>Análisis Geográfico</h3>
      <p class="desc">Visualiza la intensidad y frecuencia de casos de extorsión en Guayaquil.</p>
    </a>

  </div>
</section>

<!-- Sección 4: Predicciones -->
<section class="predicciones" id="predicciones">
  <div class="predicciones-container">
    <div class="mapa">
      <img src="img/mapa-guayaquil.jpeg" alt="Mapa de Guayaquil">
    </div>
    <div class="contenido-prediccion">
      <h2>Predicciones Geográficas</h2>
      <p>Conoce la probabilidad de ocurrencia de extorsiones en tu zona, con base en datos históricos y modelos predictivos. ¡Explora los sectores más vulnerables y toma decisiones informadas!</p>
      <a href="mod\modelo.php" class="btn">Ir al análisis de predicción</a>
    </div>
  </div>
</section>

<div id="modal-extorsion" class="modal">
  <div class="modal-contenido">
    <span class="cerrar1" onclick="cerrarModal()">&times;</span>
    <h2 id="modal-titulo"></h2>
    <p id="modal-descripcion"></p>
  </div>
</div>

<script>
  const datosExtorsion = {
    virtual: {
      titulo: 'Extorsión virtual',
      descripcion: 'Llamadas telefónicas o mensajes digitales para exigir dinero, generalmente usando información obtenida en redes sociales.'
    },
    vacunas: {
      titulo: 'Vacunas',
      descripcion: 'Cobros ilegales que bandas criminales imponen a comerciantes, transportistas o vecinos para “protegerlos”.'
    },
    personal: {
      titulo: 'Amenazas con información personal',
      descripcion: 'Uso de redes sociales o filtraciones para amenazar a las víctimas.'
    },
    carcelaria: {
      titulo: 'Extorsión carcelaria',
      descripcion: 'Desde las cárceles se realizan amenazas a personas en libertad para pedir pagos.'
    }
  };

  function abrirModal(tipo) {
    document.getElementById('modal-titulo').textContent = datosExtorsion[tipo].titulo;
    document.getElementById('modal-descripcion').textContent = datosExtorsion[tipo].descripcion;
    document.getElementById('modal-extorsion').style.display = 'block';
  }

  function cerrarModal() {
    document.getElementById('modal-extorsion').style.display = 'none';
  }

  // Cerrar si hacen clic fuera del contenido
  window.onclick = function(event) {
    const modal = document.getElementById('modal-extorsion');
    if (event.target == modal) {
      cerrarModal();
    }
  }
</script>

<div id="modalObjetivos" class="modal-objetivos">
  <div class="modal-contenido">
    <span class="cerrar2" onclick="cerrarObjetivos()">&times;</span>
    
    <h2><strong>OBJETIVO</strong> <span style="color: #4c0075;">GENERAL</span></h2>
    <p class="objetivo-texto">
      Aplicar modelos de aprendizaje estadístico para el pronóstico, la clasificación y la caracterización de patrones espacio-temporales relevantes en los casos de extorsión registrados en la ciudad de Guayaquil, con el fin de generar conocimiento útil para la toma de decisiones en materia de seguridad ciudadana.
    </p>

    <h3 style="background: #4c0075; color: white; padding: 10px;">OBJETIVOS ESPECÍFICOS</h3>
    <ol class="objetivos-lista">
      <li>
        <span class="num">1</span>
        Caracterizar los patrones de extorsión mediante el análisis exploratorio y modelos estadísticos que permitan reconocer relaciones significativas entre variables (temporales, geográficas, sociales, etc.).
      </li>
      <li>
        <span class="num">2</span>
        Aplicar técnicas de pronóstico espacio-temporales para predecir la ocurrencia futura del delito en función de patrones históricos.
      </li>
      <li>
        <span class="num">3</span>
        Evaluar una visualización interactiva sobre el pronóstico, la clasificación y la caracterización de patrones espacio-temporales del delito de extorsión en la ciudad de Guayaquil.
      </li>
    </ol>
  </div>
</div>

<script>
function mostrarObjetivos() {
  document.getElementById("modalObjetivos").style.display = "block";
}

function cerrarObjetivos() {
  document.getElementById("modalObjetivos").style.display = "none";
}

// Cerrar si se hace clic fuera del contenido
window.onclick = function(event) {
  const modal = document.getElementById("modalObjetivos");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


<?php
$contenido = ob_get_clean();
include 'comp/layout.php';
?>

</body>
</html>
