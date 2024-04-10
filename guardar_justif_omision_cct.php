<?php
// Realiza la conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "incidencias");

// Verifica la conexión
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera los valores del formulario
    $justif_omision_cct = isset($_POST['justif_omision_cct']) ? $_POST['justif_omision_cct'] : '';
    $horario = isset($_POST['horario']) ? $_POST['horario'] : '';
    $desc_horario = isset($_POST['desc_horario']) ? $_POST['desc_horario'] : '';
    $folio = isset($_POST['folio']) ? $_POST['folio'] : '';
    $fechaIncidencia = isset($_POST['fecha_incidencia']) ? $_POST['fecha_incidencia'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
    $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : '';
    $cve_ads = isset($_POST['cve_ads']) ? $_POST['cve_ads'] : '';
    $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : '';
    $micro = isset($_POST['micro']) ? $_POST['micro'] : '';
    $motivo = isset($_POST['motivo']) ? $_POST['motivo'] : '';
    $jefeInmediato = isset($_POST['jefe_inmediato']) ? $_POST['jefe_inmediato'] : '';
    $responsable = isset($_POST['responsable']) ? $_POST['responsable'] : '';
    $turno = isset($_POST['turno']) ? $_POST['turno'] : '';
    $fechaRegistro = isset($_POST['fecha_de_alta']) ? $_POST['fecha_de_alta'] : '';

    // Escapar los valores de las cadenas para evitar problemas de SQL Injection
    $justif_omision_cct = mysqli_real_escape_string($conexion, $justif_omision_cct);
    $horario = mysqli_real_escape_string($conexion, $horario);
    $desc_horario = mysqli_real_escape_string($conexion, $desc_horario);
    $folio = mysqli_real_escape_string($conexion, $folio);
    $fechaIncidencia = mysqli_real_escape_string($conexion, $fechaIncidencia);
    $nombre = mysqli_real_escape_string($conexion, $nombre);
    $categoria = mysqli_real_escape_string($conexion, $categoria);
    $matricula = mysqli_real_escape_string($conexion, $matricula);
    $cve_ads = mysqli_real_escape_string($conexion, $cve_ads);
    $departamento = mysqli_real_escape_string($conexion, $departamento);
    $micro = mysqli_real_escape_string($conexion, $micro);
    $motivo = mysqli_real_escape_string($conexion, $motivo);
    $jefeInmediato = mysqli_real_escape_string($conexion, $jefeInmediato);
    $responsable = mysqli_real_escape_string($conexion, $responsable);
    $turno = mysqli_real_escape_string($conexion, $turno);
    $fechaRegistro = mysqli_real_escape_string($conexion, $fechaRegistro);

    // Preparar la consulta de inserción
    $sql_insert = "INSERT INTO datos_incidencia (tipo_documento,horario, desc_horario,folio,fecha_de_incidencia, nombre, categoria, matricula,cve_ads, adscripcion, micro, motivo,jefe_inmediato,  responsable_personal, turno, fecha_de_alta) 
                    VALUES ('$justif_omision_cct','$horario','$desc_horario','$folio','$fechaIncidencia', '$nombre','$categoria','$matricula', '$cve_ads','$departamento', '$micro', '$motivo','$jefeInmediato','$responsable','$turno','$fechaRegistro')";

    // Ejecutar la consulta de inserción
    $resultado_insert = mysqli_query($conexion, $sql_insert);

    // Verificar si la consulta se ejecutó con éxito
    if (!$resultado_insert) {
        die("Error al insertar datos: " . mysqli_error($conexion));
    } else {
        // Obtener el ID del registro recién insertado
        $id_registro = mysqli_insert_id($conexion);

        // Redireccionar al formulario de impresión con el ID del registro recién insertado
        header("Location: form_justificacion_omision_cct.php?id_registro=" . $id_registro);
        exit;
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>