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
  $desc_horario = isset($_SESSION['desc_horario']) ? $_SESSION['desc_horario'] : '';
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
    <title>Justificación Omisión por Omisión de Registro</title>
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


    <p>
    <h3><b>Por favor ingresa los datos solicitados:</b></h3>
    </p>

    <form class="form-horizontal" method="POST" action="guardar_justif_omision_cct.php " enctype="multipart/form-data" autocomplete="off">
      <form>



        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="justif_omision_cct" name="justif_omision_cct" value="JUSTIFICACION POR OMISION DE REGISTRO" required>
          <label class="form-check-label" for="justif_omision_cct">Justificación por omisión de registro</label>
        </div>

        <label for="micro">Micro:</label>
        <input type="text" name="micro" value="<?= $micro ?>" readonly class="texto-rojo">

        <label for="cve_ads">Clave de Adscripción:</label>
        <input type="text" name="cve_ads" value="<?= $cve_ads ?>" readonly class="texto-rojo">

        <label for="turno">Turno:</label>
        <input type="text" name="turno" value="<?= $turno ?>" readonly class="texto-rojo">

        <label for="desc_horario">Desc_Horario:</label>
        <input type="text" name="desc_horario" value="<?= $desc_horario ?>" readonly class="texto-rojo">


        <!--------------UNO----------------->
        <label for="horario">Justificacion de la omisión de registro:</label>
        <select name="horario">
          <option value="Entrada">Entrada</option>
          <option value="Salida">Salida</option>
        </select>

        <!--------------DOS----------------->
        <label for="folio">Folio:</label>
        <input type="text" name="folio" value="<?= $nuevo_folio; ?>" readonly>

        <!--------------TRES----------------->
        <label for="fecha_de_alta">Fecha de registro:</label>
        <input type="text" name="fecha_de_alta" placeholder="Fecha de registro" value="<?= date('Y-m-d'); ?>" readonly class="texto-rojo">

        <!--------------CUATRO----------------->
        <label for="nombre">Nombre del Trabajador:</label>
        <input type="text" name="nombre" value="<?= $nombre ?>" readonly class="texto-rojo">

        <!--------------CINCO----------------->
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" value="<?= $categoria ?>" readonly class="texto-rojo">

        <!---------------SEIS---------------->
        <label for="matricula">Matrícula:</label>
        <input type="text" name="matricula" value="<?= $matricula ?>" readonly class="texto-rojo">

        <!--------------SIETE----------------->
        <label for="departamento">Adscripcion:</label>
        <input type="text" name="departamento" value="<?= $departamento ?>" readonly class="texto-rojo">



        <!--------------PLUS----------------->
        <label for="fecha_incidencia">Correspondiente al día:</label>
        <input type="date" name="fecha_incidencia">

        <!--------------PLUS----------------->
        <label for="motivo">Motivo de la omisión:</label>
        <input type="text" name="motivo">
        
        <!--------------DOCE----------------->
        <label for="jefe_inmediato">Jefe de Servicio:</label>
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
        <label for="responsable">Jefe de la Dependencia:</label>
        <input type="text" name="responsable">

        <button type="submit">Enviar</button>
      </form>
    </form>


  </body>

  </html>


<?php
}
?>