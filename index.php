<?php
// No mostrar los errores de PHP
error_reporting(1);

session_start();
require 'master/index.php';

function contenido()
{
?>

  <h3>Impresión de Constancia de pase y/o Justificación por omisión de registro</h3>
  <hr class="red">

  <div class="row vertical-buffer">
    <div class="col-md-12">
      <p>
        Por favor ingresa tu matrícula y selecciona el formato correspondiente.
      </p>
    </div>
  </div><!-- Termina div row -->

  <!--fila row -->
  <?php
  $conexion = mysqli_connect("localhost", "root", "", "incidencias"); // CONEXION A LA BD
  ?>

  <!-- INICIO BLOQUE PRINCIPAL  -->

  <div class="row">
    <div class="col-12">
      <form id="form2" name="form2" method="POST" action="index.php">
        <div class="col-12 row">
          <div class="col-11">
            <label for="busca" class="form-label">Buscar</label>
            <input type="text" class="form-control" id="busca" name="busca" placeholder="matricula" required>
          </div>

          <div class="col-1">
            <input type="submit" class="btn btn-success" value="Ver" style="margin-top: 30px;">
          </div>
        </div>
      </form>
      <br>
      <?php
      if (isset($_REQUEST['busca'])) {
        $conexion = mysqli_connect("localhost", "root", "", "incidencias");

        $sql = ("SELECT id_trabajador,micro,matricula, cve_ads, nom_ads, desc_contratacion, ocupante, desc_categoria,desc_horario, desc_contratacion, turno FROM principal
          WHERE matricula = '" . $_POST["busca"] . "'");
        $result = mysqli_query($conexion, $sql);
        $numeroSql = mysqli_num_rows($result);

        if ($numeroSql > 0) {
          // Almacenar todos los resultados en un array

          $resultados = array();
          while ($row = $result->fetch_assoc()) {
            $resultados[] = $row;
          }

          // Obtener datos adicionales de la tabla principal
          $nombre = $resultados[0]['ocupante'];
          $categoria = $resultados[0]['desc_categoria'];
          $matricula = $resultados[0]['matricula'];
          $departamento = $resultados[0]['nom_ads'];
          $micro = $resultados[0]['micro'];
          $cve_ads = $resultados[0]['cve_ads'];
          $turno = $resultados[0]['turno'];
          $desc_horario = $resultados[0]['desc_horario'];

          //echo "Valor de cve_ads: " . $cve_ads; // o var_dump($cve_ads);
          //echo "Valor de turno: " . $turno;
          //var_dump($turno);

          $_SESSION['nombre'] = $nombre;
          $_SESSION['categoria'] = $categoria;    //echo "Valor de cve_ads: " . $cve_ads; // o var_dump($cve_ads);
          $_SESSION['matricula'] = $matricula;
          $_SESSION['departamento'] = $departamento;
          $_SESSION['micro'] = $micro;
          $_SESSION['cve_ads'] = $cve_ads;
          $_SESSION['turno'] = $turno;
          $_SESSION['desc_horario'] = $desc_horario;

          //var_dump($_SESSION['cve_ads'], $_SESSION['categoria'], $_SESSION['matricula']);
      ?>
          <form id="guardar" name="guardar" method="POST" action="guardar_const_pase_cct.php" enctype="multipart/form-data">
            <input type="hidden" name="nombre" value="<?= $nombre ?>">
            <input type="hidden" name="categoria" value="<?= $categoria ?>">
            <input type="hidden" name="matricula" value="<?= $matricula ?>">
            <input type="hidden" name="cve_ads" value="<?= $cve_ads ?>"> <!-- Para guardar clave ads -->
            <input type="hidden" name="turno" value="<?= $turno ?>"> <!-- Para guardar turno -->
            <input type="hidden" name="desc_horario" value="<?= $desc_horario ?>"> <!-- Para guardar Horario -->
       



            <p style="font-weight: bold; color:green;"><i class="mdi mdi-file-document"></i> <?php echo $numeroSql; ?> Resultados encontrados</p>

            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr style="background-color: #00695c; color:#FFFFFF;">
                    <th>id</th>
                    <th>Matricula</th>
                    <th>Adscripcion</th>
                    <th>Nombre</th>
                    <th>Tipo Contratación</th>
                    <th>Formatos</th> <!-- Nueva columna para los enlaces -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($resultados as $resultado) {
                  ?>
                    <tr>
                      <td style='font-size:12px'><?php echo $resultado['id_trabajador'] ?></td>
                      <td style='font-size:12px'>
                        <input type="text" style='font-size:14px' readonly id="matricula" class="form-control" name="matricula" value="<?= $resultado['matricula'] ?>">
                      </td>
                      <td style='font-size:12px'><?php echo $resultado['nom_ads'] ?></td>
                      <td style='font-size:12px'><?php echo $resultado['ocupante'] ?></td>
                      <td style='font-size:12px'><?php echo $resultado['desc_contratacion'] ?></td>
                      <!-- Agrega la línea para incluir cve_ads como campo oculto -->
                      <input type="hidden" name="cve_ads" value="<?= $resultado['cve_ads'] ?>">
                      <input type="hidden" name="turno" value="<?= $resultado['turno'] ?>">
                      <input type="hidden" name="desc_horario" value="<?= $resultado['desc_horario'] ?>">

                      <!-- Nueva columna para los enlaces -->
                      <td>
                        <?php
                        // Verificar el valor de desc_contratacion y mostrar los enlaces correspondientes
                        if ($resultado['desc_contratacion'] == 'CONFIANZA' || $resultado['desc_contratacion'] == 'BASE') {
                          echo '<a href="const_pase_cct.php">Constancia Pase CCT</a><br><br>';
                          echo '<a href="justif_omision_cct.php">Justificación Omisión CCT</a>';
                        } elseif ($resultado['desc_contratacion'] == 'ESTATUTO A') {
                          echo '<a href="const_pase_estatuto.php">Constancia de Pase Estatuto</a><br><br>';
                          echo '<a href="justif_omision_estatuto.php">Justificación Omisión Estatuto </a>';
                        } elseif ($resultado['desc_contratacion'] == 'BASE') {
                          echo '<a href="const_pase_cct.php">Constancia Pase CCT</a><br><br>';
                          echo '<a href="justif_omision_cct.php">Justificación Omisión CCT<</a>';
                        }
                        ?>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </form>
      <?php
        }
      }
      ?>
      <!--          -->
    </div>
  </div>

  <!--Fin de contenido-->
<?php
}
?>