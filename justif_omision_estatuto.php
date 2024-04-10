<?php
// No mostrar los errores de PHP
error_reporting(1);

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
  <html lang="mx">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Justificación Omisión para Estatuto</title>
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
<!--      <iframe id="ifmcontentstoprint" style="height: 500px; width: 100%;"></iframe>-->

    <p>
    <h3><b>Por favor ingresa los datos solicitados:</b></h3>
    </p>

    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" autocomplete="off" id="form-justif-omision-cct">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        window.onload = function() {
            window.jsPDF = window.jspdf.jsPDF
            var doc = new jsPDF('p', 'mm', 'letter')
            // const data1 = {
            //     a_partir:null,
            //     adscripcion:"CAMELOT",
            //     asunto:null,
            //     categoria:"COORD PROYECTO E1",
            //     cve_ads:"09NC014000",
            //     desc_horario:"9.00  A 17.00",
            //     fecha_de_alta:"2024-04-10",
            //     fecha_de_incidencia:"0000-00-00",
            //     folio:"500013",
            //     horario:"Entrada",
            //     id:"60",
            //     jefe_inmediato:"Ada Lovelace",
            //     matricula:"123456789",
            //     micro:"M021",
            //     motivo:"",
            //     nombre:"SALANDER LISBETH ",
            //     ocurrir:null,
            //     responsable_personal:"",
            //     tipo_documento:"JUSTIFICACION POR OMISION DE REGISTRO",
            //     turno:"MATUTINO",
            // }
            // imprimirArchivo(data1)
            const form = document.getElementById('form-justif-omision-cct')
            form.addEventListener('submit', function(e) {
                e.preventDefault()
                const formData = new FormData(form)
                axios.post('guardar_Justif_Omision_Estatuto.php', formData)
                    .then(response => {
                        imprimirArchivo(response.data)
                    })
                    .catch(error => {
                        console.error(error)
                    })
                return false
            })
            function imprimirArchivo(data){
                //reset doc
                doc = new jsPDF('p', 'mm', 'letter')
                console.log(data)
                doc.rect(10, 10, 196, 115)
                const img = new Image()
                img.src = 'img/logo.jpg'
                doc.addImage(img, 'JPEG', 17, 12, 17, 17)
                title('JUSTIFICACIÓN POR OMISIÓN DE REGISTRO PARA ESTATUTO DE TRABAJADORES DE CONFIANZA “A”', 160, 17)

                text('DIRECCIÓN DE ADMINISTRACIÓN', 40, 15)
                text('OODA', 67, 20)
                underlineBold('NIVEL CENTRAL', 80, 20)
                text('UNIDAD DE SERVICIO', 40, 25)
                underlineBold('DIRECCIÓN JURÍDICA', 80, 25)

                // /////////////////////// primera parte

                textCenter('Folio', 140, 30)
                text('CC_'+data.folio, 150, 30)
                // // linea
                // doc.line(10, 45, 206, 45)
                ///////////////// segunda parte
                text('México, ', 12, 40)
                underline('Ciudad de México', 35, 40)
                text('a', 80, 40)
                const dia = new Date().getDate()
                underline(dia+'', 95, 40)
                text('de', 115, 40)
                const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
                const mes = meses[new Date().getMonth()]
                underline(mes+'', 125, 40)
                text('de', 155, 40)
                const anio = new Date().getFullYear()
                underline(anio+'', 170, 40)
                ////////////////////////tercera parte
                textCenterMinus('Lugar y fecha', 100, 45)
                ////////////////////////cuarta parte
                text(' C. ', 20, 60)
                underline(data.nombre+'', 50, 60)
                text('Turno', 140, 60)
                underline(data.turno+'', 160, 60)
                ////////////////////////quinta parte
                text('Categoria', 12, 65)
                underline(data.categoria+'', 50, 65)
                text('Matricula', 140, 65)
                underline(data.matricula+'', 160, 65)
                ////////////////////////sexta parte
                text('Adscripción', 12, 70)
                underline(data.adscripcion, 50, 70)
                text('Horario', 140, 70)
                underline(data.horario+'', 160, 70)
                ////////////////////////septima parte
                // doc.line(10, 75, 206, 75)
                text('Los trabajadores registrarán personalmente su hora de entrada y salida en apego al Artículo 8, Fracción VI del Estatuto de Trabajadores de Confianza “A”, se justifica la omisión de registro', 12, 80)
                // underline(data.a_partir+'', 50, 80)
                const x = data.horario === 'Entrada' ? '(X)' : '( )'
                const y = data.horario === 'Salida' ? '(X)' : '( )'
                text(x+'Entrada '+y+' Salida correspondiente al día: '+data.fecha_de_incidencia, 118, 87)
                // underline(data.ocurrir+'', 140, 80)
                ////////////////////////octava parte
                text('Motivo de la omisión:', 12, 90)
                // underline(data.motivo+'', 50, 85)
                ////////////////////////novena parte
                doc.line(50, 92, 200, 92)
                doc.line(10, 95, 206, 95)

                textCenter('Solicita', 50, 100)
                textCenter('Certifica', 110, 100)
                textCenter('Autoriza', 170, 100)
                doc.line(30, 115, 70, 115)
                doc.line(90, 115, 130, 115)
                doc.line(150, 115, 190, 115)
                textCenter('Trabajadora/trabajador', 50, 120)
                textCenter('Jefe del servicio', 110, 120)
                textCenter('Jefe de la Dependencia', 170, 120)
                ////////////////////////decima parte
                // textMinusWithAuto('Nota: Para considerarse el pase como oficial o médico, este deberá contar con el correspondiente sello o documento anexo comprobatorio, que certifique la presencia del trabajador en la dependencia oficial de destino.', 12, 128)
                // texto debajo de la linea de cuadrado
                text('Clave: 1A74-009-084', 170, 133)
                //descargar
                doc.save('justificacion_omision_estatuto.pdf')
                // document.getElementById('ifmcontentstoprint').src = doc.output('datauristring')
            }

            function title(text,x,y) {
                doc.setFontSize(10)
                doc.setFont('helvetica', 'bold')
                doc.text(x, y, text,{maxWidth: 80, align: 'center'})
            }
            function subtitle(text,x,y) {
                doc.setFontSize(10)
                doc.setFont('helvetica', 'bold')
                doc.text(x, y, text)
            }
            function text(text,x,y) {
                doc.setFontSize(10)
                doc.setFont('helvetica', 'normal')
                doc.text(x, y, text, {maxWidth: 190})
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
            function textMinusWithAuto(text,x,y) {
                doc.setFontSize(7)
                doc.setFont('helvetica', 'normal')
                doc.text(x, y, text, {maxWidth: 190})
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
