<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera los valores del formulario
    $constanciaPase = isset($_POST['constancia_pase']) ? $_POST['constancia_pase'] : '';
    $micro = isset($_POST['micro']) ? $_POST['micro'] : '';
    $horario = isset($_POST['horario']) ? $_POST['horario'] : '';
    $asunto = isset($_POST['asunto']) ? $_POST['asunto'] : '';
    $folio = isset($_POST['folio']) ? $_POST['folio'] : '';
    $fechaRegistro = isset($_POST['fecha_de_alta']) ? $_POST['fecha_de_alta'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
    $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : '';
    $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : '';
    $aPartirDe = isset($_POST['a_partir_de']) ? $_POST['a_partir_de'] : '';
    $ocurrir = isset($_POST['ocurrir']) ? $_POST['ocurrir'] : '';
    $conObjetoDe = isset($_POST['con_objeto_de']) ? $_POST['con_objeto_de'] : '';
    $fechaIncidencia = isset($_POST['fecha_incidencia']) ? $_POST['fecha_incidencia'] : '';
    $jefeInmediato = isset($_POST['jefe_inmediato']) ? $_POST['jefe_inmediato'] : '';
    $responsable = isset($_POST['responsable']) ? $_POST['responsable'] : '';
    $turno = isset($_POST['turno']) ? $_POST['turno'] : '';
    // Recupera el valor de cve_ads para control de folio
    $cve_ads = isset($_POST['cve_ads']) ? $_POST['cve_ads'] : '';

    // Realiza la conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "incidencias");

    // Verifica la conexión
    if (!$conexion) {
        die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
    }

    // Preparar la consulta de inserción
    $sql_insert = "INSERT INTO datos_incidencia (tipo_documento, micro, horario, asunto, folio, fecha_de_alta, nombre, categoria, matricula, adscripcion, a_partir, ocurrir, motivo, fecha_de_incidencia, jefe_inmediato, responsable_personal,turno, cve_ads) 
                                            VALUES ('$constanciaPase', '$micro', '$horario', '$asunto', '$folio', '$fechaRegistro', '$nombre', '$categoria', '$matricula', '$departamento', '$aPartirDe', '$ocurrir', '$conObjetoDe', '$fechaIncidencia', '$jefeInmediato', '$responsable','$turno', '$cve_ads')";

    // Ejecutar la consulta de inserción
    $resultado_insert = mysqli_query($conexion, $sql_insert);

    // Verificar si la consulta se ejecutó con éxito
    if (!$resultado_insert) {
        die("Error al insertar datos: " . mysqli_error($conexion));
    } else {
        // Obtener el ID del registro recién insertado
        $id_registro = mysqli_insert_id($conexion);

        // Redireccionar al formulario de impresión con el ID del registro recién insertado
        header("Location: form_constancia_pase_cct.php?id_registro=" . $id_registro);
        exit;
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>
