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

date_default_timezone_set('America/Mexico_City');
$fecha = new DateTime(date('Y-m-d', strtotime($datos_incidencia['fecha_de_incidencia'])));
$dia = $fecha->format('j');
// Traducción manual del nombre del mes
$meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
$mes = $meses[$fecha->format('n') - 1];
$anio = $fecha->format('Y');

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>


<!DOCTYPE html>
<html lang="mx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Constancia Pase CCT</title>


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
    body{
      padding: 0px;
      margin: 0px;
      border: 0px;
    }
    #contenedorFormato_1 {
      /*margin-top: 10px;*/
      /*margin-bottom: 30px;*/
      /*padding-top: 5px;*/
      border: solid #000 2px !important;
    }

    #logoIMSS {
      width: 100px;
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
      border-bottom: solid black 1px;
      margin-left: 5px;
    }

    .border_1 {
      border-bottom: solid black 2px;
    }

    .border_2 {
      border-left: solid black 2px;
    }

    .border_3 {
      border-top: solid black 2px;
    }

    .border_4 {
      border-right: solid black 2px;
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

    /*  !* Aquí reglas CSS específicas para imprimir *!*/

      * {
        font-size: 10pt;
      }

      .noImprimir {
        display: none;
      }

    /*  #logoIMSS {*/
    /*    width: 10cm;*/
    /*    margin: 5pt;*/
    /*  }*/

    /*  h4 {*/
    /*    font-size: 8pt;*/
    /*  }*/

    /*  .main-footer,*/
    /*  header {*/
    /*    visibility: hidden;*/
    /*  }*/

    /*  #contenedorFormato_1 {*/
    /*    margin-top: 0cm !important;*/
    /*    margin-bottom: 0cm !important;*/
    /*    top: 0cm !important;*/

    /*  }*/

    /*  #logoIMSS {*/
    /*    width: 30px;*/
    /*    !* Ajusta el tamaño del logo en la impresión*!*/
    /*    !* height: auto; mantener la proporción original *!*/
    /*  }*/

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

    /*  terminan estilos de impresión   */
    /*div {*/
    /*  padding-top: 5px;*/
    /*  padding-left: 20px;*/
    /*}*/

    p {
      margin: 0;
      /* Eliminar el margen predeterminado del párrafo */
    }

    .subrayado {
      border-bottom: #000 solid 2pt;
      text-align: center;
      height: 20px;
    }

    .leyenda {
      font-size: 10pt;
      text-align: left;
    }


    /*#logoIMSS {*/
    /*  width: 1000px;*/
    /*  !* Ajusta el tamaño del logo *!*/
    /*  !* height: auto; mantener la proporción original *!*/
    /*}*/
    .center{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .mt-1{
        margin-top: 5px;
    }
    .mb-1{
        margin-bottom: 5px;
    }
    .m-1{
        margin: 5px;
    }
    .mb-1{
        margin-bottom: 5px;
    }
    .bold{
        font-weight: bold;
    }
    .ml-2{
        margin-left: 10px;
    }
    .underlined{
        text-decoration: underline;
    }
  </style>

</head>

<body>
  <!-- Contenido -->
  <main class="page">
    <div id="contenedorFormato_1" class="container">
      <div class="row border_1">
        <div class="col-md-1 col-xs-1 mt-1">
            <img src="img/logo.jpg" width="70px" >
        </div>
        <div class="col-md-7 col-xs-7">
            <div class="row" style="line-height: 1;">
                <div class="col-md-12 col-xs-12" > <span>DIRECCIÓN DE ADMINISTRACIÓN</span></div>
                <div class="col-md-12 col-xs-12">
                    <span>OOAD</span>
                    <span class="bold ml-2 underlined">NIVEL CENTRAL</span>
                </div>
                <div class="col-md-12 col-xs-12">
                    <span for="">UNIDAD DE SERVICIO</span>
                    <span class="bold ml-2 underlined">DIRECCIÓN JURÍDICA</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xs-4 text-center m-3">
          <P>
          <h6>CONSTANCIA DE PASE</h6>
          </p>
        </div>

      </div>

      <!-- Para clave de adscripcion -->
      <input type="hidden" name="cve_ads" value="<?= $_SESSION['cve_ads'] ?>">

      <!-- Para Turno -->
      <input type="hidden" name="turno" value="<?= $_SESSION['turno'] ?>">

      <div class="row border_1">
        <div class="col-md-5 col-xs-5 text-center">
          <span class="bold">Por su Horario</span>
          <div>
            <span>
              <input type="radio" name="radio-01" value="opcion-01" <?= $datos_incidencia['horario'] === 'Entrada' ? 'checked' : '' ?>> Entrada
            </span>
            <span>
              <input type="radio" name="radio-01" value="opcion-02" <?= $datos_incidencia['horario'] === 'Intermedio' ? 'checked' : '' ?>> Intermedio
            </span>
            <span>
              <input type="radio" name="radio-01" value="opcion-03" <?= $datos_incidencia['horario'] === 'Salida' ? 'checked' : '' ?>> Salida
            </span>
          </div>
        </div>

        <div class="col-md-5 col-xs-5 text-center border_2 border_4">
          <span class="bold">Por el asunto</span>
          <div>
            <span>
              <input type="radio" name="radio-02" value="opcion-01" <?= $datos_incidencia['asunto'] === 'Particular' ? 'checked' : '' ?>> Particular
            </span>
            <span>
              <input type="radio" name="radio-02" value="opcion-02" <?= $datos_incidencia['asunto'] === 'Oficial' ? 'checked' : '' ?>> Oficial
            </span>
            <span>
              <input type="radio" name="radio-02" value="opcion-03" <?= $datos_incidencia['asunto'] === 'Medico' ? 'checked' : '' ?>> Médico
            </span>
          </div>
        </div>

        <div class="col-md-2 col-xs-2 text-center">
          <span class="bold">Folio:</span>
          <div>CC_<?= isset($datos_incidencia['folio']) ? $datos_incidencia['folio'] : ''; ?></div>
        </div>


      </div>



      <div class="row" style="">
        <div class="col-md-12">
          <div class="row">
            <!-- Este es un renglon donde las columnas deben sumar 12-->
            <div class="col-md-1 col-xs-1">México,</div>
            <div class="col-md-4 col-xs-4 subrayado"><span>Ciudad de México</span></div>
            <div class="col-md-1 col-xs-1 text-center">a</div>
            <div class="col-md-1 col-xs-1 subrayado"><label><?= $dia ?></label></div>
            <div class="col-md-1 col-xs-1  text-center">de</div>
            <div class="col-md-2 col-xs-2 subrayado"><label><?= $mes ?></label></div>
            <div class="col-md-1 col-xs-1  text-center">de</div>
            <div class="col-md-1 col-xs-1 subrayado"><label><?= $anio ?></label></div>
            <!-- termina renglon donde las columnas deben sumar 12-->
          </div><!-- Termina div row -->

          <!-- parrafo que da un espacio entre renglones y que puede servir para agregar una leyenda -->
          <div class="col-md-12 text-center" style="font-size: 10px;border 10px solid red">Lugar y fecha</div>
            <div class="col-md-12 col-xs-12">
                <div class="row">
                    <!-- Este es un renglon donde las columnas deben sumar 12-->
                    <div class="col-md-3 col-xs-3">Se hace constar que el (la) C</div>
                    <div class="col-md-5 col-xs-5 subrayado"><?= $datos_incidencia['nombre'] ?></div>

                    <div class="col-md-2 col-xs-2" style="text-align: right;">Turno</div>
                    <div class="col-md-2 col-xs-2 subrayado"><?= $datos_incidencia['turno'] ?></div>
                    <!-- termina renglon donde las columnas deben sumar 12-->
                </div><!-- Termina div row -->
            </div>

          <div class="row">
            <!-- Este es un renglon donde las columnas deben sumar 12-->
            <div class="col-md-2 col-xs-2">Con categoria</div>
            <div class="col-md-5 col-xs-5 subrayado"><?= $datos_incidencia['categoria'] ?></div>
            <div class="col-md-2 col-xs-2" style="text-align: right;">Matricula</div>
            <div class="col-md-3 col-xs-3 subrayado"><?= $datos_incidencia['matricula'] ?></div>
            <!-- termina renglon donde las columnas deben sumar 12-->
          </div><!-- Termina div row -->

          <div class="row">
            <!-- Este es un renglon donde las columnas deben sumar 12-->
            <div class="col-md-5 col-xs-6 subrayado">Permanecerá ausente del Departamento de</div>
            <div class="col-md-7 col-xs-6 subrayado"><?= $datos_incidencia['adscripcion'] ?></div>
            <!-- termina renglon donde las columnas deben sumar 12-->
          </div><!-- Termina div row -->
<!--          <div class="row">-->
<!--            <div class="col-md-12 col-xs-12 subrayado"></div>-->
<!--          </div>-->

          <div class="row">
            <!-- Este es un renglon donde las columnas deben sumar 12-->
            <div class="col-md-2 col-xs-2">A partir de las</div>
            <div class="col-md-5 col-xs-5 subrayado"> <?= $datos_incidencia['a_partir'] ?></div>
            <div class="col-md-2 col-xs-2">Para ocurrir</div>
            <div class="col-md-3 col-xs-3 subrayado"> <?= $datos_incidencia['ocurrir'] ?></div>
            <!-- termina renglon donde las columnas deben sumar 12-->
        </div><!-- Termina div row -->
          <div class="col-md-12">

          </div>
          <div class=" row">
              <!-- Este es un renglon donde las columnas deben sumar 12-->
              <div class="col-md-3">Con objeto de</div>
              <div class="col-md-9 subrayado"><?= $datos_incidencia['motivo'] ?></div>
              <!-- parrafo vacio que da un espacio entre renglones y que puede servir para agregar una leyenda -->
            </div><!-- Termina div row -->

            <div class="row">
              <div class="col-md-12 col-xs-12 leyenda"></div>
            </div><!-- Termina div row -->

            <div class="row">
              <div class="col-md-12 col-xs-12 subrayado"></div>
              <!-- termina renglon donde las columnas deben sumar 12-->
            </div><!-- Termina div row -->
          </div><!-- Termina div col -->
        </div>


        <div class="row text-center">
          <div class="col-md-4 col-xs-4">
            <div class="bold">Solicita</div>
            <br>
            <br>
            <div class="subrayado">
              <?= $datos_incidencia['nombre'] ?>
            </div>
            <div class="bold">Trabajadora/Trabajador</div>
          </div>
            <div class="col-md-4 col-xs-4">
                <div class="bold">Certifica</div>
                <br>
                <br>
                <div class="subrayado">
                    <?= $datos_incidencia['jefe_inmediato'] ?>
                </div>
                <div class="bold">Jefe del Servicio</div>
            </div>
            <div class="col-md-4 col-xs-4">
                <div class="bold">Autoriza</div>
                <br>
                <br>
                <div class="subrayado">
                    <?= $datos_incidencia['responsable_personal'] ?>
                </div>
                <div class="bold">Jefe de la Dependencia</div>
            </div>
            <div class="col-md-12 col-xs-12">
                <small><b>
                        <div style="position: relative;text-align: left;font-size: 7px">Nota: Para considerarse el pase como oficial o
                            médico, este deberá contar con el correspondiente sello o documento anexo comprobatorio, que
                            certifique la presencia del trabajador en la dependencia oficial de destino.</div>
                    </b></small>
                <div class="texto-vertical-2"> Clave: 1A74-009-038</div>
            </div>
        </div>
      </div>
  </main>

</body>
<script>
  window.print();
  setTimeout(function() {
    // window.close();
  }, 1000);
          </script>
</html>
