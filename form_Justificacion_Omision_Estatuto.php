<?php
// Establecer la conexión a la base de datos
include('conexion.php');

// Obtener el ID del registro desde la URL
$id_registro = isset($_GET['id_registro']) ? $_GET['id_registro'] : 0;

// Obtener datos del registro utilizando el ID
$sql_select = "SELECT * FROM datos_incidencia WHERE id = $id_registro";
$resultado_select = mysqli_query($conexion, $sql_select);


if (!$resultado_select) {
  die("Error al obtener datos: " . mysqli_error($conexion));
}

// Obtener los datos
$datos_incidencia = mysqli_fetch_assoc($resultado_select);
// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>



<!DOCTYPE html>
<html lang="mx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Justificacion Omision Estatuto</title>


  <!-- CSS -->
  <link href="https://framework-gb.cdn.gob.mx/gm/v4/image/favicon.ico" rel="shortcut icon">
  <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">

  <!-- Respond.js soporte de media queries para Internet Explorer 8 -->
  <!-- ie8.js EventTarget para cada nodo en Internet Explorer 8 -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/ie8/0.2.2/ie8.js"></script>
    <![endif]-->
  <style>
    #contenedorFormato_1 {
      margin-top: 10px;
      margin-bottom: 30px;
      padding-top: 5px;
      border: solid #000 2px !important;
    }

    #logoIMSS {
      width: 120px;
    }

    .flexbox-container {
      display: flex;
      flex-wrap: nowrap;
      justify-content: center;
      align-items: center;
      align-content: center;
    }

    .flexbox-container input,
    .inputFormulario {
      width: 100%;
      border: none;
      border-bottom: solid black 1PX;
      margin-left: 5PX;
    }

    .border_1 {
      border-bottom: solid black 2PX;
    }

    /* Estilos para colocar las líneas de "Matrícula", "Horario" y "Turno" a la izquierda */
    .col-md-2,
    .col-md-3 {
      text-align: left;
    }

    /* Estilos para alinear la línea de "C." a la derecha */
    .col-md-5 {
      text-align: left;
    }

    .border_2 {
      border-left: solid black 2PX;
    }

    .border_3 {
      border-top: solid black 2PX;
    }

    .border_4 {
      border-right: solid black 2PX;
    }

    .texto-vertical-1 {
      writing-mode: vertical-lr;
    }

    .texto-vertical-2 {
      position: absolute;
      bottom: -50px;
      /* Ajusta  para separar el texto de la nota */
      right: 0;
      white-space: nowrap;
      transform: rotate(360deg);
      /* Para rotar el texto/  writing-mode: vertical-lr;/  transform: rotate(180deg); verticalmente */
      transform-origin: right bottom;
      /* Establece el punto de rotación */

    }

    .texto-vertical-3 {
      width: 20px;
      word-wrap: break-word;
      text-align: center;
      line-height: 20px;
    }



    @media print {

      /* Aquí reglas CSS específicas para imprimir */

      * {
        font-size: 6pt;
      }

      #logoIMSS {
        width: 10cm;
        margin: 5pt;
      }

      h4 {
        font-size: 8pt;
      }

      .main-footer,
      header {
        visibility: hidden;
      }

      #contenedorFormato_1 {
        margin-top: 0cm !important;
        margin-bottom: 0cm !important;
        top: 0cm !important;

      }

      .page {
        /* size: letter;
          Tamaño de papel: carta */
        margin: 0.5cm;
        top: 0cm !important;
        /* Márgenes de la página */
        /*top: 0cm !important;*/
      }

      @page {
        margin: 0.2cm;
        margin-top: -0.8cm;
        padding-top: 20cm;
        margin-left: 0.1cm;
        margin-right: 0.1cm;
      }
    }

    div {
      padding-top: 5px;
      padding-left: 20px;
    }

    p {
      margin: 0;
      /* Eliminar el margen predeterminado del párrafo */
    }

    .subrayado {
      border-bottom: #000 solid 2pt;
      text-align: center;
      min-height: 30px;
    }

    .leyenda {
      font-size: 10pt;
      text-align: left;
    }

    #logoIMSS {
      width: 70px;
      /* Ajusta el tamaño del logo */
      /* height: auto; mantener la proporción original */
    }
  </style>



</head>

<body>

  <!-- Contenido -->
  <main class="page">
    <div id="contenedorFormato_1" class="container">

      <div >
        <div class="col-md-1 col-xs-2" style="padding: 2px;">
          <!--<img  id="logoIMSS" src="https://1000marcas.net/wp-content/uploads/2022/01/IMSS-Logo.png" alt="" class="p-3">-->
          <img id="logoIMSS" src="img/logo.jpg" alt="" class="p-3">
        </div>

        <div class="col-md-6 col-xs-6" style="margin-top: 1PX; margin-bottom: 2px; font-size: 1.5rem !important;">
          <div class="col-md-12 col-xs-12 flexbox-container">DIRECCIÓN DE ADMINISTRACIÓN</div>
          <div class="col-md-12 col-xs-12 flexbox-container">
            <label for="">OOAD</label>
            <label name="delegacion" id="delegacion" style=" margin-left: 10PX; border-bottom: #000 solid 2PX;">NIVEL CENTRAL</label>
          </div>
          <br>

          <div class="col-md-12 col-xs-12 flexbox-container">
            <label for="">DEPENDENCIA</label>
            <label name="unidad_servicio" id="unidad_servicio" style=" margin-left: 10PX; border-bottom: #000 solid 2PX;">DIRECCIÓN JURÍDICA</label>
          </div>
        </div>

        <div class="col-md-5 col-xs-3 text-center m-3">
          <P>
          <h6 style="text-align: center;">JUSTIFICACIÓN POR OMISIÓN DE REGISTRO <br> PARA ESTATUTO DE TRABAJADORES <br> DE CONFIANZA “A”</h6>
          </p>
          <div class="text-center">
            <label for="folio">Folio</label>
            <div style="display: inline-block;" class="subrayado">JE_<?= isset($datos_incidencia['folio']) ? $datos_incidencia['folio'] : ''; ?></div>
          </div>
        </div>
      </div>
      
      <!-- Para clave de adscripcion -->
      <input type="hidden" name="cve_ads" value="<?= $_SESSION['cve_ads'] ?>">

      <!-- Para Turno -->
      <input type="hidden" name="turno" value="<?= $_SESSION['turno'] ?>">

      <div class="row" style="padding-top: 0px; padding-left: 0px; padding-right: 5px; padding-bottom: 0px;">
        <div class="col-md-12">
          <?php
          date_default_timezone_set('America/Mexico_City');
          $fecha = new DateTime(date('Y-m-d', strtotime($datos_incidencia['fecha_de_alta'])));
          $dia = $fecha->format('j');

          // Traducción manual del nombre del mes
          $meses = [
            'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
          ];
          $mes = $meses[$fecha->format('n') - 1];

          $anio = $fecha->format('Y');
          ?>
          <!-- Este es un renglon donde las columnas deben sumar 12-->
          <div class="col-md-1">México,</div>
          <div class="col-md-4 subrayado"><span>Ciudad de México</span></div>
          <div class="col-md-1 text-center">a</div>
          <div class="col-md-1 subrayado"><label><?= $dia ?></label></div>
          <div class="col-md-1  text-center">de</div>
          <div class="col-md-2 subrayado"><label><?= $mes ?></label></div>
          <div class="col-md-1  text-center">de</div>
          <div class="col-md-1 subrayado"><label><?= $anio ?></label></div>
          <!-- termina renglon donde las columnas deben sumar 12-->

          <!-- parrafo que da un espacio entre renglones y que puede servir para agregar una leyenda -->
          <p class="col-md-12 bottom-buffer text-center" style="font-size: italic; margin-top: 0px;">(Lugar y fecha)</p>

          <!-- Este es un renglon donde las columnas deben sumar 12-->

          <div class="col-md-2">C.</div>
          <div class="col-md-5 subrayado"><?= $datos_incidencia['nombre'] ?></div>
          <div class="col-md-2">Turno</div>
          <div class="col-md-3 subrayado"><?= $datos_incidencia['turno'] ?></div>
          <!-- termina renglon donde las columnas deben sumar 12-->

          <!-- Este es un renglon donde las columnas deben sumar 12-->
          <div class="col-md-2">Categoria</div>
          <div class="col-md-5 subrayado"><?= $datos_incidencia['categoria'] ?></div>
          <div class="col-md-2">Matricula</div>
          <div class="col-md-3 subrayado"><?= $datos_incidencia['matricula'] ?></div>
          <!-- termina renglon donde las columnas deben sumar 12-->

          <!-- Este es un renglon donde las columnas deben sumar 12-->
          <div class="col-md-2">Adscripción</div>
          <div class="col-md-5 subrayado"><?= $datos_incidencia['adscripcion'] ?></div>
          <div class="col-md-2">Horario</div>
          <div class="col-md-3 subrayado"><?= $datos_incidencia['horario'] ?></div>
          <!-- termina renglon donde las columnas deben sumar 12-->


          <div>Los trabajadores registrarán personalmente su hora de entrada y salida en apego al Artículo 8, Fracción VI del Estatuto de Trabajadores de Confianza “A”, se justifica la omisión de registro
            <div class="radio" style="display: inline-block;">
              <label>
                <input type="radio" name="radio-01" value="opcion-01" <?= $datos_incidencia['horario'] === 'Entrada' ? 'checked' : '' ?>> Entrada
              </label>
              <label>
                <input type="radio" name="radio-01" value="opcion-02" <?= $datos_incidencia['horario'] === 'Salida' ? 'checked' : '' ?>> Salida
              </label>
            </div>
            <label style="display: inline-block;">correspondiente al día:</label>
            <div style="display: inline-block;"><?= date('d-m-Y', strtotime($datos_incidencia['fecha_de_incidencia'])) ?></div>
          </div>



          <!-- Este es un renglon donde las columnas deben sumar 12-->
          <div class="col-md-5"> Motivo de la omisión:</div>
          <div class="col-md-7 subrayado"><?= $datos_incidencia['motivo'] ?></div>
          <!-- termina renglon donde las columnas deben sumar 12-->
        </div>

        <div class="row">
            <div class="col-md-11 col-xs-12 subrayado"></div>
            <!-- termina renglon donde las columnas deben sumar 12-->
          </div><!-- Termina div row -->

      </div>

      <div class="text-center">
          <div class="col-md-4 col-xs-4">
            <h6>Solicita</h6>
            <br>
            <hr class="border_1">
            <div>
              <?= $datos_incidencia['nombre'] ?>
            </div>
            <h6>Trabajadora/Trabajador</h6>
          </div>
          <div class="col-md-4 col-xs-4">
            <h6>Certifica</h6>
            <br>
            <hr class="border_1">
            <div>
              <?= $datos_incidencia['jefe_inmediato'] ?>
            </div>
            <h6>Jefe de Servicio</h6>
          </div>
          <div class="col-md-4 col-xs-4">
            <h6>Autoriza</h6>
            <br>
            <hr class="border_1">
            <div>
              <?= $datos_incidencia['responsable_personal'] ?>
            </div>
            <h6>Jefe de la Dependencia</h6>
          </div>
        </div>

        <div class="col-md-12 col-xs-12">
          <div class="col-md-12 col-xs-3">
            <div class="texto-vertical-2">Clave: 1A74-009-084</div>
          </div>
        </div>

    </div>

  </main>



</body>

</html>