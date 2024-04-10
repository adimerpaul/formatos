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
  <title>Constancia Pase Estatuto</title>


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
      margin-top: 50px;
      margin-bottom: 50px;
      padding-top: 20px;
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


      <div class="row border_1 p-3">
        <div class="col-md-1 col-xs-3" style="padding: 3px;">
          <!--<img  id="logoIMSS" src="https://1000marcas.net/wp-content/uploads/2022/01/IMSS-Logo.png" alt="" class="p-3">-->
          <img id="logoIMSS" src="img/logo.jpg" alt="" class="p-3">
        </div>

        <div class="col-md-6 col-xs-6" style="margin-top: 2PX; margin-bottom: 2px; font-size: 1.5rem !important;">
          <div class="col-md-12 col-xs-12 flexbox-container">DIRECCIÓN DE ADMINISTRACIÓN</div>
          <div class="col-md-12 col-xs-12 flexbox-container">
            <label for="">OOAD</label>
            <label name="delegacion" id="delegacion" style=" margin-left: 10PX; border-bottom: #000 solid 2PX;">NIVEL
              CENTRAL</label>
          </div>

          <div class="col-md-12 col-xs-12 flexbox-container">
            <label for="">UNIDAD DE SERVICIO</label>
            <label name="unidad_servicio" id="unidad_servicio" style=" margin-left: 10PX; border-bottom: #000 solid 2PX;">DIRECCIÓN JURÍDICA</label>
          </div>
        </div>

        <div class="col-md-3 col-xs-3 text-center m-3">
          <P>
          <h6>CONSTANCIA DE PASE PARA ESTATUTO DE TRABAJADORES DE CONFIANZA “A”</h6>
          </p>
        </div>
      </div>

      <!-- Para clave de adscripcion -->
      <input type="hidden" name="cve_ads" value="<?= $_SESSION['cve_ads'] ?>">
      <!-- Para Turno -->
      <input type="hidden" name="turno" value="<?= $_SESSION['turno'] ?>">

      <div class="row border_1">
        <div class="col-md-5 col-xs-5 text-center">
          <h6>Por su Horario</h6>
          <div class="radio">
            <label>
              <input type="radio" name="radio-01" value="opcion-01" <?= $datos_incidencia['horario'] === 'Entrada' ? 'checked' : '' ?>> Entrada
            </label>
            <label>
              <input type="radio" name="radio-01" value="opcion-02" <?= $datos_incidencia['horario'] === 'Intermedio' ? 'checked' : '' ?>> Intermedio
            </label>
            <label>
              <input type="radio" name="radio-01" value="opcion-03" <?= $datos_incidencia['horario'] === 'Salida' ? 'checked' : '' ?>> Salida
            </label>
          </div>
        </div>

        <div class="col-md-5 col-xs-5 text-center border_2 border_4">
          <h6>Por el asunto</h6>
          <div class="radio">
            <label>
              <input type="radio" name="radio-02" value="opcion-01" <?= $datos_incidencia['asunto'] === 'Particular' ? 'checked' : '' ?>> Particular
            </label>
            <label>
              <input type="radio" name="radio-02" value="opcion-02" <?= $datos_incidencia['asunto'] === 'Oficial' ? 'checked' : '' ?>> Oficial
            </label>
            <label>
              <input type="radio" name="radio-02" value="opcion-03" <?= $datos_incidencia['asunto'] === 'Médico' ? 'checked' : '' ?>> Médico
            </label>
          </div>
        </div>

        <div class="col-md-2 col-xs-2 text-center">
          <label for="folio">Folio:</label>
          <div>CE_<?= isset($datos_incidencia['folio']) ? $datos_incidencia['folio'] : ''; ?></div>
        </div>
      </div>

      <div class="row top-buffer" style="padding-top: 0px; padding-left: 0px; padding-right: 5px; padding-bottom: 0px;">
        <?php
        date_default_timezone_set('America/Mexico_City');
        $fecha = new DateTime(date('Y-m-d', strtotime($datos_incidencia['fecha_de_incidencia'])));
        $dia = $fecha->format('j');

        // Traducción manual del nombre del mes
        $meses = [
          'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
          'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
        ];
        $mes = $meses[$fecha->format('n') - 1];

        $anio = $fecha->format('Y');
        ?>

        <div class="col-md-12">
          <div class="row">
            <!-- Este es un renglon donde las columnas deben sumar 12-->
            <div class="col-md-1  col-xs-1">México,</div>
            <div class="col-md-4  col-xs-4 subrayado"><span>Ciudad de México</span></div>
            <div class="col-md-1  col-xs-1 text-center">a</div>
            <div class="col-md-1  col-xs-1 subrayado"><label><?= $dia ?></label></div>
            <div class="col-md-1  col-xs-1 text-center">de</div>
            <div class="col-md-2  col-xs-2 subrayado"><label><?= $mes ?></label></div>
            <div class="col-md-1 col-xs-1 text-center">de</div>
            <div class="col-md-1  col-xs-1 subrayado"><label><?= $anio ?></label></div>
            <!-- termina renglon donde las columnas deben sumar 12-->
          </div><!-- Termina div row -->

          <!-- parrafo que da un espacio entre renglones y que puede servir para agregar una leyenda -->
          <div class="row">
            <p class="col-md-12 col-xs-12 text-center mt-3" style="font-size: italic; margin-top: 0.5px;">Lugar y fecha</p>
          </div>
        </div><!-- Termina div row -->

        <!-- Este es un renglon donde las columnas deben sumar 12-->

        <div class="row">
          <div class="col-md-3 col-xs-2">Se hace constar que el (la) C</div>
          <div class="col-md-5 col-xs-5 subrayado"><?= $datos_incidencia['nombre'] ?></div>
          <div class="col-md-2 col-xs-2" style="text-align: right;">Turno</div>
          <div class="col-md-2 col-xs-3 subrayado"><?= $datos_incidencia['turno'] ?></div>
        </div>
        <!-- termina renglon donde las columnas deben sumar 12-->


        <!-- Este es un renglon donde las columnas deben sumar 12-->
        <div class="col-md-2">Con categoria</div>
        <div class="col-md-5 subrayado"><?= $datos_incidencia['categoria'] ?></div>
        <div class="col-md-2">Matricula</div>
        <div class="col-md-3 subrayado"><?= $datos_incidencia['matricula'] ?></div>
        <!-- termina renglon donde las columnas deben sumar 12-->

        <!-- Este es un renglon donde las columnas deben sumar 12-->
        <div class="col-md-5">Permanecerá ausente del Departamento de</div>
        <div class="col-md-7 subrayado"><?= $datos_incidencia['adscripcion'] ?></div>
        <!-- termina renglon donde las columnas deben sumar 12-->


        <!-- Este es un renglon donde las columnas deben sumar 12-->
        <div class="col-md-2">A partir de las</div>
        <div class="col-md-5 subrayado"><?= $datos_incidencia['a_partir'] ?></div>
        <div class="col-md-2">Para ocurrir</div>
        <div class="col-md-3 subrayado"><?= $datos_incidencia['ocurrir'] ?></div>
        <!-- termina renglon donde las columnas deben sumar 12-->

        <!-- Este es un renglon donde las columnas deben sumar 12-->
        <div class="col-md-3">Con objeto de</div>
        <div class="col-md-9 subrayado"><?= $datos_incidencia['motivo'] ?></div>
        <!-- parrafo vacio que da un espacio entre renglones y que puede servir para agregar una leyenda -->
        <p class="col-md-12 leyenda bottom-buffer"></p>
        <div class="col-md-3"></div>
        <div class="col-md-9 subrayado"></div>
        <!-- termina renglon donde las columnas deben sumar 12-->
      </div>

      <hr class="border_1"> <!-- Línea de separación de las firmas -->
      <div class="text-center">
        <div class="col-md-4 col-xs-4">

          <h6>Solicita</h6> <!-- Leyenda -->
          <br><br>
          <h6> <?= $datos_incidencia['nombre'] ?></h6>
          <hr class="border_1"> <!-- Línea de separación -->
          <h6>Trabajadora/Trabajador</h6>
        </div>

        <div class="col-md-4 col-xs-4">

          <h6>Certifica</h6> <!-- Leyenda -->
          <br><br>
          <h6>
            <?= $datos_incidencia['jefe_inmediato'] ?>
          </h6>
          <hr class="border_1"><!-- Línea de separación -->
          <h6>Jefe del Servicio</h6>
        </div>

        <div class="col-md-4 col-xs-4">
          <h6>Autoriza</h6><!-- Leyenda -->
          <br><br>
          <h6>
            <?= $datos_incidencia['responsable_personal'] ?>
          </h6>
          <hr class="border_1"><!-- Línea de separación -->
          <h6>Jefe de la Dependencia</h6>
        </div>
      </div>

      <div class="col-md-12 col-xs-12">
        <small><b>
            <label style="position: relative; bottom:-50px;"> Nota: Para considerarse el pase como oficial o médico,
              este deberá contar con el correspondiente sello o documento anexo comprobatorio, que certifique
              la presencia del trabajador en la dependencia oficial de destino.
            </label>
          </b></small>
        <div class="texto-vertical-2">Clave: 1A74-009-083</div>
      </div>



    </div>

  </main>

</body>

</html>