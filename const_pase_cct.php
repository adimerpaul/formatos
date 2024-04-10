<?php
// No mostrar los errores de PHP
error_reporting(0);

// Iniciar o reanudar la sesión
session_start();

// Incluir el archivo de conexión a la base de datos
include('conexion.php');

// Requerir otros archivos necesarios
require 'master/index.php';



function contenido()
{
// Incluir el archivo de conexión a la base de datos
include('conexion.php');

  $nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
  $categoria = isset($_SESSION['categoria']) ? $_SESSION['categoria'] : '';
  $matricula = isset($_SESSION['matricula']) ? $_SESSION['matricula'] : '';

  $departamento = isset($_SESSION['departamento']) ? $_SESSION['departamento'] : '';
  $micro = isset($_SESSION['micro']) ? $_SESSION['micro'] : '';
  $cve_ads = isset($_SESSION['cve_ads']) ? $_SESSION['cve_ads'] : '';
  $turno = isset($_SESSION['turno']) ? $_SESSION['turno'] : '';

  //var_dump($cve_ads, $categoria, $matricula);
  // Consulta el rango de folios para la cve_ads actual
  $sql_rango_folios = "SELECT inicio, fin FROM cat_folios WHERE clave_adsc = '$cve_ads'";
  $resultado_rango_folios = mysqli_query($conexion, $sql_rango_folios);

  if (!$resultado_rango_folios) {
    die("Error al obtener el rango de folios: " . mysqli_error($conexion));
  }

  $rango_folios = mysqli_fetch_assoc($resultado_rango_folios);

  // Obtener el último folio utilizado para la cve_ads actual en la tabla datos_incidencia
  $sql_ultimo_folio = "SELECT MAX(folio) AS ultimo_folio FROM datos_incidencia WHERE cve_ads = '$cve_ads'";
  $resultado_ultimo_folio = mysqli_query($conexion, $sql_ultimo_folio);
  $fila_ultimo_folio = mysqli_fetch_assoc($resultado_ultimo_folio);
  $ultimo_folio = $fila_ultimo_folio['ultimo_folio'];

  // Verificar si el último folio está dentro del rango permitido
  if ($ultimo_folio !== null && $ultimo_folio < $rango_folios['fin']) {
    // Incrementar el último folio en 1 para obtener el nuevo folio
    $nuevo_folio = $ultimo_folio + 1;
  } else {
    // Volver al inicio del rango como nuevo folio
    $nuevo_folio = $rango_folios['inicio'];
  }

  // Mostrar el nuevo folio en el campo de entrada
  echo '<input type="text" name="folio" value="' . $nuevo_folio . '" readonly>';


?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Constancia de pase CCT</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex-wrap;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }

      form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 800px;
      }

      label {
        display: block;
        margin-bottom: 8px;

      }

      input,
      select {
        width: 100%;
        padding: 8px;
        margin-bottom: 12px;
        box-sizing: border-box;
      }

      input[type="radio"] {
        margin-right: 5px;
      }

      button {
        background-color: #4caf50;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
      }

      button:hover {
        background-color: #45a049;
      }

      .texto-rojo {
        color: red;
      }
    </style>
  </head>

  <body>
<!--  <iframe id="ifmcontentstoprint" style="height: 500px; width: 100%;"></iframe>-->

    <p>
    <h3><b>Por favor ingresa los datos solicitados:</b></h3>
    </p>

    <form class="form-horizontal" method="POST" target="_blank" action="guardar_const_pase_cct.php " enctype="multipart/form-data" autocomplete="off">
      <form>



        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="constancia_pase" name="constancia_pase" value="CONSTANCIA DE PASE" required>
          <label class="form-check-label" for="constancia_pase">Constancia de Pase</label>
        </div>

        <label for="micro">Micro:</label>
        <input type="text" name="micro" value="<?= $micro ?>" readonly class="texto-rojo">

        <label for="cve_ads">Clave de Adscripción:</label>
        <input type="text" name="cve_ads" value="<?= $cve_ads ?>" readonly class="texto-rojo">

        <label for="turno">Turno:</label>
        <input type="text" name="turno" value="<?= $turno ?>" readonly class="texto-rojo">


        <!--------------UNO----------------->
        <label for="horario">Horario:</label>
        <select name="horario">
          <option value="Entrada">Entrada</option>
          <option value="Intermedio">Intermedio</option>
          <option value="Salida">Salida</option>
        </select>

        <!--------------DOS----------------->
        <label for="asunto">Por el Asunto:</label>
        <select name="asunto">
          <option value="Particular">Particular</option>
          <option value="Oficial">Oficial</option>
          <option value="Medico">Médico</option>
        </select>

        <!--------------TRES----------------->
        <label for="folio">Folio:</label>
        <input type="text" name="folio" value="<?= $nuevo_folio; ?>" readonly>

        <!--------------CUATRO----------------->
        <label for="fecha_de_alta">Fecha de registro:</label>
        <input type="text" name="fecha_de_alta" placeholder="Fecha de registro" value="<?= date('Y-m-d'); ?>" readonly class="texto-rojo">

        <!--------------CINCO----------------->
        <label for="nombre">Nombre del Trabajador:</label>
        <input type="text" name="nombre" value="<?= $nombre ?>" readonly class="texto-rojo">



        <!--------------SEIS----------------->
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" value="<?= $categoria ?>" readonly class="texto-rojo">

        <!---------------SIETE---------------->
        <label for="matricula">Matrícula:</label>
        <input type="text" name="matricula" value="<?= $matricula ?>" readonly class="texto-rojo">

        <!--------------OCHO----------------->
        <label for="departamento">Departamento:</label>
        <input type="text" name="departamento" value="<?= $departamento ?>" readonly class="texto-rojo">


        <!---------------NUEVE---------------->
        <label for="a_partir_de">a partir de las:</label>
        <input type="text" name="a_partir_de">

        <!---------------DIEZ---------------->
        <label for="ocurrir">para ocurrir
          :</label>
        <input type="text" name="ocurrir">

        <!--------------ONCE----------------->
        <label for="con_objeto_de">Con Objeto de:</label>
        <input type="text" name="con_objeto_de">

        <!--------------PLUS----------------->
        <label for="fecha_incidencia">Dia a justificar:</label>
        <input type="date" name="fecha_incidencia">

        <!--------------DOCE----------------->
        <label for="jefe_inmediato">Jefe inmediato:</label>
        <select name="jefe_inmediato">
          <?php
          // Establecer la conexión a la base de datos
          include('conexion.php');

          // Consulta para obtener los datos de la tabla personal_valida
          $sql_select_jefes = "SELECT id_ads, nombre_completo FROM personal_valida ORDER BY nombre_completo ASC";
          $resultado_select_jefes = mysqli_query($conexion, $sql_select_jefes);

          if ($resultado_select_jefes) {
            // Iterar sobre los resultados y generar las opciones del select
            while ($row = mysqli_fetch_assoc($resultado_select_jefes)) {
              $id_ads = $row['id_ads'];
              $nombre_completo = $row['nombre_completo'];
              echo "<option value=\"$nombre_completo\">$nombre_completo</option>";
            }

            // Liberar el resultado
            mysqli_free_result($resultado_select_jefes);
          } else {
            // Manejar el error si la consulta falla
            echo "Error al obtener datos de jefes: " . mysqli_error($conexion);
          }

          // Cerrar la conexión a la base de datos
          mysqli_close($conexion);
          ?>
        </select>


        <!--------------TRECE----------------->
        <label for="responsable">Responsable de los servicios de Personal:</label>
        <input type="text" name="responsable">

        <button type="submit">Enviar</button>
      </form>
    </form>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
window.onload = function() {
  window.jsPDF = window.jspdf.jsPDF
  const doc = new jsPDF('p', 'mm', 'letter')
  doc.rect(10, 10, 196, 130)
  const img = new Image()
  img.src = 'img/logo.jpg'
  doc.addImage(img, 'JPEG', 17, 12, 17, 17)
  title('CONSTANCIA DE PASE', 150, 20)

  text('DIRECCIÓN DE ADMINISTRACIÓN', 40, 15)
  text('OODA', 67, 20)
  underlineBold('NIVEL CENTRAL', 80, 20)
  text('UNIDAD DE SERVICIO', 40, 25)
  underlineBold('DIRECCIÓN JURÍDICA', 80, 25)

    /////////////////////// primera parte
  doc.line(10, 30, 206, 30)
    textCenter('Por su Horario', 55, 35)
    //linea vertical despues de hoaraio
    doc.line(95, 30, 95, 45)

    doc.ellipse(20, 40, 5, 3)
    text('Entrada', 26, 41)
    doc.ellipse(45, 40, 5, 3)
    text('Intermedio', 51, 41)
    doc.ellipse(75, 40, 5, 3)
    text('Salida', 81, 41)

    textCenter('Por el Asunto', 130, 35)
    doc.line(175, 30, 175, 45)
    //3 circulos debajo de hoario con nombre de entrada intermedio salida

    doc.ellipse(105, 40, 5, 3)
    text('Particular', 111, 41)
    doc.ellipse(132, 40, 5, 3)
    text('Oficial', 139, 41)
    doc.ellipse(155, 40, 5, 3)
    text('Médico', 161, 41)

    textCenter('Folio', 190, 35)
    textCenter('CC_', 190, 40)
    // linea
    doc.line(10, 45, 206, 45)
    ///////////////// segunda parte
    text('México, ', 12, 50)
    underline('Ciudad de México', 35, 50)
    text('a', 80, 50)
    underline('12', 95, 50)
    text('de', 115, 50)
    underline('Agosto', 125, 50)
    text('de', 155, 50)
    underline('2021', 170, 50)
    ////////////////////////tercera parte
    textCenterMinus('Lugar y fecha', 100, 55)
    ////////////////////////cuarta parte
    text('Se hace constar que el (la) C', 12, 60)
    underline('COIN ALMA', 60, 60)
    text('Turno', 140, 60)
    underline('Matutino', 160, 60)
    ////////////////////////quinta parte
    text('Con categoría de', 12, 65)
    underline('Técnico en Informática', 50, 65)
    text('Matricula', 140, 65)
    underline('123456', 160, 65)
    ////////////////////////sexta parte
    text('Permanecerá ausente del departamento de', 12, 70)
    underline('DIRECCIÓN DE ADMINISTRACIÓN', 100, 70)
    ////////////////////////septima parte
    //linea
    doc.line(10, 75, 206, 75)
    text('A partir de las', 12, 80)
    underline('8:00', 50, 80)
    text('Para ocurrir', 100, 80)
    underline('A las 12:00', 140, 80)
    ////////////////////////octava parte
    text('Con objeto de', 12, 85)
    underline('Realizar trámites', 50, 85)
    ////////////////////////novena parte
    // linea
    doc.line(10, 90, 206, 90)

    //descargar
    doc.save('constancia_pase.pdf')
  document.getElementById('ifmcontentstoprint').src = doc.output('datauristring')

  function title(text,x,y) {
      doc.setFontSize(12)
      doc.setFont('helvetica', 'bold')
      doc.text(x, y, text)
  }
  function subtitle(text,x,y) {
      doc.setFontSize(10)
      doc.setFont('helvetica', 'bold')
      doc.text(x, y, text)
  }
  function text(text,x,y) {
      doc.setFontSize(10)
      doc.setFont('helvetica', 'normal')
      doc.text(x, y, text)
  }
  function textCenter(text,x,y) {
      doc.setFontSize(10)
      doc.setFont('helvetica', 'normal')
      doc.text(x, y, text, null, null, 'center')
  }
  function textCenterMinus(text,x,y) {
      doc.setFontSize(7)
      doc.setFont('helvetica', 'normal')
      doc.text(x, y, text, null, null, 'center')
  }
  function underline(text,x,y) {
      doc.setFontSize(10)
      doc.setFont('helvetica', 'normal')
      const levelCentralText = text
      const levelCentralX = x
      const levelCentralY = y
      doc.text(levelCentralX, levelCentralY, levelCentralText)
      const textWidth = doc.getTextWidth(levelCentralText)
      doc.setLineWidth(0.2)
      doc.line(levelCentralX, levelCentralY + 1, levelCentralX + textWidth, levelCentralY + 1)
  }
  function underlineBold(text,x,y) {
      doc.setFontSize(10)
      doc.setFont('helvetica', 'bold')
      const levelCentralText = text
      const levelCentralX = x
      const levelCentralY = y
      doc.text(levelCentralX, levelCentralY, levelCentralText)
      const textWidth = doc.getTextWidth(levelCentralText)
      doc.setLineWidth(0.2)
      doc.line(levelCentralX, levelCentralY + 1, levelCentralX + textWidth, levelCentralY + 1)
  }
}
</script>

  </body>

  </html>






<?php
}
?>
