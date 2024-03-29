<!-- buscar.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="https://www.just.cl/assets/imagenes/favicon.ico">
    <link rel="manifest" href="https://www.swissjustchile.cl/herramientas/origen/manifest.json">
    <link rel="apple-touch-icon" href="https://www.swissjustchile.cl/herramientas/origen/img/origen_apple_icon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Helvetica">
    <!-- Enlace a la hoja de estilo de Bootstrap (CSS) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Enlace a la hoja de estilo local -->
    <link rel="stylesheet" href="estilo.css">
    <!-- Enlaces a los scripts de Bootstrap (JavaScript) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
    <title>Camino al origen | Just</title>
</head>

<body>
<!-- Encabezado -->
<header>
    <div class="d-flex justify-content-center">
        <a href="https://www.just.cl/">
            <img src="img/logo_camino_al_origen.png" alt="Camino al origen">
        </a>
    </div>
</header>


<!-- Contenido -->
<main>
    <?php
    // Datos de conexión a la base de datos
    $servername = "localhost:3306";
    $username = "xxxx";
    $password = "xxxx";
    $dbname = "swissjus_swiss";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener el valor del campo de búsqueda
    $claveConsultor = $_POST['campoBusqueda'];

    // Verificar que el campo no esté vacío
    if (empty($claveConsultor)) {
        echo "Error: Clave del consultor no proporcionada.";
        echo "<br><br><br><a href='index.html'>Volver a buscar</a>";
        echo "<br><br><a href='https://www.swissjustchile.cl/herramientas/'>Volver a Herramientas</a>";
        echo "<br><br><a href='https://viaja.swissjust.com/'>Revisar las bases completas</a>";
        exit;
    }

    // Validar que sea un número entero
    if (!is_numeric($claveConsultor) || floor($claveConsultor) != $claveConsultor) {
        echo "Error: Debes ingresar solo números.";
        echo "<br><br><br><a href='index.html'>Volver a buscar</a>";
        echo "<br><br><a href='https://www.swissjustchile.cl/herramientas/'>Volver a Herramientas</a>";
        echo "<br><br><a href='https://viaja.swissjust.com/'>Revisar las bases completas</a>";
        exit;
    }

    // Consulta SQL
    $sql = "
    SELECT
        clave,
        nombre,
        es_lider,
        upline,
        inc_orig,
        ejecutivo,
        grupo_sistema,
        grupo_origen,
        base_ventas,
        base_incorporaciones,
        meta_ventas_p03,
        meta_incorporaciones_p03,
        ventas_p03,
        incorporaciones_p03,
        meta_ventas_p04,
        meta_incorporaciones_p04,
        ventas_p04,
        incorporaciones_p04,
        meta_ventas_p05,
        meta_incorporaciones_p05,
        ventas_p05,
        incorporaciones_p05,
        meta_ventas_p06,
        meta_incorporaciones_p06,
        ventas_p06,
        incorporaciones_p06,
        meta_ventas_p07,
        meta_incorporaciones_p07,
        ventas_p07,
        incorporaciones_p07,
        meta_ventas_p08,
        meta_incorporaciones_p08,
        ventas_p08,
        incorporaciones_p08,
        meta_ventas_p09,
        meta_incorporaciones_p09,
        ventas_p09,
        incorporaciones_p09,
        meta_ventas_p10,
        meta_incorporaciones_p10,
        ventas_p10,
        incorporaciones_p10,
        meta_ventas_p11,
        meta_incorporaciones_p11,
        ventas_p11,
        incorporaciones_p11,
        meta_ventas_p12,
        meta_incorporaciones_p12,
        ventas_p12,
        incorporaciones_p12,
        CASE
		WHEN clave IN (SELECT DISTINCT
						   CASE
							   WHEN upline = inc_orig THEN upline
							   ELSE 0 END AS tiene_descendencia
					   FROM
						   base_origen
					   WHERE
							 upline = inc_orig
						 AND upline <> 1) THEN 1
		ELSE 0 END AS tiene_descendencia
    FROM
        base_origen
    WHERE 
        clave = $claveConsultor";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si la consulta fue exitosa
    if ($result) {
        // Mostrar los resultados
        if ($result->num_rows > 0) {
            // Guardar los resultados en variables
            while ($row = $result->fetch_assoc()) {
                $clave = $row["clave"];
                if ($clave > 165343) {
                    echo "
                    <div class='d-flex justify-content-center m-5'>
                        <h5>Clave de consultor que no participa del desafío Camino al Origen.
                        <br>
                        Únicamente consultores y líderes vigentes al cierre del periodo 2 participan.</h5>
                    </div>";
                    ?>
                    <!-- Botones de navegación -->
                    <div class="d-flex flex-column align-items-center m-5">
                        <div class="btn-group-sm" role="group" aria-label="Botones de navegación">
                            <button type="button" onclick="window.location.href='index.html'" class="btn m-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-search"
                                     viewBox="0 0 16 16" style="margin-right: 8px">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                                Volver a Buscar
                            </button>
                            <button type="button"
                                    onclick="window.location.href='https://www.swissjustchile.cl/herramientas/'"
                                    class="btn m-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-wrench"
                                     viewBox="0 0 16 16" style="margin-right: 8px">
                                    <path d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364zm13.37 9.019.528.026.287.445.445.287.026.529L15 13l-.242.471-.026.529-.445.287-.287.445-.529.026L13 15l-.471-.242-.529-.026-.287-.445-.445-.287-.026-.529L11 13l.242-.471.026-.529.445-.287.287-.445.529-.026L13 11z"/>
                                </svg>
                                Volver a Herramientas
                            </button>
                            <button type="button" onclick="window.location.href='https://viaja.swissjust.com/'"
                                    class="btn m-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-file-text" viewBox="0 0 16 16" style="margin-right: 8px">
                                    <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/>
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
                                </svg>
                                Revisa las bases completas
                            </button>
                        </div>
                    </div>
                    <?php
                    exit;
                }
                $nombre = $row["nombre"];
                $esLider = $row["es_lider"];
                $upline = $row["upline"];
                $inc_orig = $row["inc_orig"];
                $ejecutivo = $row["ejecutivo"];
                $grupo_sistema = $row["grupo_sistema"];
                $grupo_origen = $row["grupo_origen"];
                $base_ventas = $row["base_ventas"];
                $baseIncorporaciones = $row["base_incorporaciones"];
                $metaVentasP03 = $row["meta_ventas_p03"];
                $metaIncorporacionesP03 = $row["meta_incorporaciones_p03"];
                $ventasP03 = $row["ventas_p03"];
                $incorporacionesP03 = $row["incorporaciones_p03"];
                $metaVentasP04 = $row["meta_ventas_p04"];
                $metaIncorporacionesP04 = $row["meta_incorporaciones_p04"];
                $ventasP04 = $row["ventas_p04"];
                $incorporacionesP04 = $row["incorporaciones_p04"];
                $metaVentasP05 = $row["meta_ventas_p05"];
                $metaIncorporacionesP05 = $row["meta_incorporaciones_p05"];
                $ventasP05 = $row["ventas_p05"];
                $incorporacionesP05 = $row["incorporaciones_p05"];
                $metaVentasP06 = $row["meta_ventas_p06"];
                $metaIncorporacionesP06 = $row["meta_incorporaciones_p06"];
                $ventasP06 = $row["ventas_p06"];
                $incorporacionesP06 = $row["incorporaciones_p06"];
                $metaVentasP07 = $row["meta_ventas_p07"];
                $metaIncorporacionesP07 = $row["meta_incorporaciones_p07"];
                $ventasP07 = $row["ventas_p07"];
                $incorporacionesP07 = $row["incorporaciones_p07"];
                $metaVentasP08 = $row["meta_ventas_p08"];
                $metaIncorporacionesP08 = $row["meta_incorporaciones_p08"];
                $ventasP08 = $row["ventas_p08"];
                $incorporacionesP08 = $row["incorporaciones_p08"];
                $metaVentasP09 = $row["meta_ventas_p09"];
                $metaIncorporacionesP09 = $row["meta_incorporaciones_p09"];
                $ventasP09 = $row["ventas_p09"];
                $incorporacionesP09 = $row["incorporaciones_p09"];
                $metaVentasP10 = $row["meta_ventas_p10"];
                $metaIncorporacionesP10 = $row["meta_incorporaciones_p10"];
                $ventasP10 = $row["ventas_p10"];
                $incorporacionesP10 = $row["incorporaciones_p10"];
                $metaVentasP11 = $row["meta_ventas_p11"];
                $metaIncorporacionesP11 = $row["meta_incorporaciones_p11"];
                $ventasP11 = $row["ventas_p11"];
                $incorporacionesP11 = $row["incorporaciones_p11"];
                $metaVentasP12 = $row["meta_ventas_p12"];
                $metaIncorporacionesP12 = $row["meta_incorporaciones_p12"];
                $ventasP12 = $row["ventas_p12"];
                $incorporacionesP12 = $row["incorporaciones_p12"];
                $tieneDescendencia = $row["tiene_descendencia"];
            }
        } else {
            // Mostrar mensaje de error si no se encontraron resultados
            echo "
            <div class='d-flex justify-content-center m-5 text-danger'>
                <h5>No se encontró la clave " . $claveConsultor . " en nuestra base de datos, inténtalo nuevamente.</h5>
            </div>";
            ?>
            <!-- Botones de navegación -->
            <div class="d-flex flex-column align-items-center m-5">
                <div class="btn-group-sm" role="group" aria-label="Botones de navegación">
                    <button type="button" onclick="window.location.href='index.html'" class="btn m-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-search"
                             viewBox="0 0 16 16" style="margin-right: 8px">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                        Volver a Buscar
                    </button>
                    <button type="button" onclick="window.location.href='https://www.swissjustchile.cl/herramientas/'"
                            class="btn m-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-wrench"
                             viewBox="0 0 16 16" style="margin-right: 8px">
                            <path d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364zm13.37 9.019.528.026.287.445.445.287.026.529L15 13l-.242.471-.026.529-.445.287-.287.445-.529.026L13 15l-.471-.242-.529-.026-.287-.445-.445-.287-.026-.529L11 13l.242-.471.026-.529.445-.287.287-.445.529-.026L13 11z"/>
                        </svg>
                        Volver a Herramientas
                    </button>
                    <button type="button" onclick="window.location.href='https://viaja.swissjust.com/'" class="btn m-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-file-text" viewBox="0 0 16 16" style="margin-right: 8px">
                            <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/>
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
                        </svg>
                        Revisa las bases completas
                    </button>
                </div>
            </div>
            <?php
            exit;
        }
    } else {
        // Mostrar mensaje de error si la consulta falló
        echo "
        <div class='d-flex justify-content-center m-5 text-danger' >
            <h6>Error al ejecutar la consulta: " . $conn->error . "</h6>
        </div>";
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Función para formatear un valor a moneda
    function formatToCurrency($value)
    {
        if ($value === null) {
            return $value;
        }
        return '$' . number_format($value, 0, ',', '.');
    }

    // Formatear los valores a moneda
    $baseVentasFormatted = formatToCurrency($base_ventas);
    $metaVentasP03Formatted = formatToCurrency($metaVentasP03);
    $ventasP03Formatted = formatToCurrency($ventasP03);
    $metaVentasP04Formatted = formatToCurrency($metaVentasP04);
    $ventasP04Formatted = formatToCurrency($ventasP04);
    $metaVentasP05Formatted = formatToCurrency($metaVentasP05);
    $ventasP05Formatted = formatToCurrency($ventasP05);
    $metaVentasP06Formatted = formatToCurrency($metaVentasP06);
    $ventasP06Formatted = formatToCurrency($ventasP06);
    $metaVentasP07Formatted = formatToCurrency($metaVentasP07);
    $ventasP07Formatted = formatToCurrency($ventasP07);
    $metaVentasP08Formatted = formatToCurrency($metaVentasP08);
    $ventasP08Formatted = formatToCurrency($ventasP08);
    $metaVentasP09Formatted = formatToCurrency($metaVentasP09);
    $ventasP09Formatted = formatToCurrency($ventasP09);
    $metaVentasP10Formatted = formatToCurrency($metaVentasP10);
    $ventasP10Formatted = formatToCurrency($ventasP10);
    $metaVentasP11Formatted = formatToCurrency($metaVentasP11);
    $ventasP11Formatted = formatToCurrency($ventasP11);
    $metaVentasP12Formatted = formatToCurrency($metaVentasP12);
    $ventasP12Formatted = formatToCurrency($ventasP12);

    // Función para reemplazar valores nulos con '-'
    function replaceIfZero(&$value)
    {
        if ($value == null || $value == '') {
            $value = '-';
        }
    }

    // Lista de variables a verificar
    $valoresArray = array(
        &$metaIncorporacionesP03,
        &$incorporacionesP03,
        &$metaIncorporacionesP04,
        &$incorporacionesP04,
        &$metaIncorporacionesP05,
        &$incorporacionesP05,
        &$metaIncorporacionesP06,
        &$incorporacionesP06,
        &$metaIncorporacionesP07,
        &$incorporacionesP07,
        &$metaIncorporacionesP08,
        &$incorporacionesP08,
        &$metaIncorporacionesP09,
        &$incorporacionesP09,
        &$metaIncorporacionesP10,
        &$incorporacionesP10,
        &$metaIncorporacionesP11,
        &$incorporacionesP11,
        &$metaIncorporacionesP12,
        &$incorporacionesP12,
        &$metaVentasP03Formatted,
        &$ventasP03Formatted,
        &$metaVentasP04Formatted,
        &$ventasP04Formatted,
        &$metaVentasP05Formatted,
        &$ventasP05Formatted,
        &$metaVentasP06Formatted,
        &$ventasP06Formatted,
        &$metaVentasP07Formatted,
        &$ventasP07Formatted,
        &$metaVentasP08Formatted,
        &$ventasP08Formatted,
        &$metaVentasP09Formatted,
        &$ventasP09Formatted,
        &$metaVentasP10Formatted,
        &$ventasP10Formatted,
        &$metaVentasP11Formatted,
        &$ventasP11Formatted,
        &$metaVentasP12Formatted,
        &$ventasP12Formatted
    );

    // Aplicar reemplazo de valores nulos
    foreach ($valoresArray as &$valoresFormatted) {
        replaceIfZero($valoresFormatted);
    }


    // Verificar si es líder o consultor/a para definir títulos de tablas
    if ($esLider == 1) {
        // Texto de encabezados para líderes
        $tituloVentaInicial = "Base venta grupal";
        $tituloIncorporacionesInicial = "Base activas grupales";
        $tituloVentaPeriodos = "Venta grupal a lograr";
        $tituloIncorporacionesPeriodos = "Activas grupales a lograr";
        $tituloVentaLograda = "Venta lograda";
        $tituloIncorporacionesLogradas = "Activas logradas";
    } else {
        // Texto de encabezados para consultores/as
        $tituloVentaInicial = "Base venta personal";
        $tituloIncorporacionesInicial = "Base incorporaciones personales";
        $tituloVentaPeriodos = "Venta personal a lograr";
        $tituloIncorporacionesPeriodos = "Incorporaciones personales con venta sobre $80.000";
        $tituloVentaLograda = "Venta lograda";
        $tituloIncorporacionesLogradas = "Incorporaciones logradas";
    }

    // Mostrar los datos en una tabla
    echo "
    <!--Tabla con datos del consultor/a-->
    <div class='contenedor-tablas'>
        <table class='table tabla-redondeada tabla-verde' id='tablaDatos'>
            <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>" . $tituloVentaInicial . "</th>
                <th>" . $tituloIncorporacionesInicial . "</th>
                <th>Entras al programa como</th>
            </tr>
            <tr>
                <td>" . $clave . "</td>
                <td>" . $nombre . "</td>
                <td>" . $baseVentasFormatted . "</td>
                <td>" . $baseIncorporaciones . "</td>
                <td>" . ($esLider == 1 ? 'Líder' : 'Consultor/a') . "</td>
            </tr>
        </table>
    </div>";
    ?>

    <!--    Botón para revisar al grupo o la descendencia personal-->
    <div class="d-flex flex-column align-items-center m-5">
        <?php
        // Definir si es líder para mostrar botón para ver su grupo Origen
        if ($esLider == 1) {
            echo "
                    <form method='POST' action='grupo.php'>
                        <input type='hidden' name='grupoOrigen' value='$grupo_origen'>
                        <button class='btn btn-primary btn-sm' type='submit'>Revisa a tu grupo Origen</button>
                    </form>";
        } else if ($tieneDescendencia == 1) {
            echo "
                <form method='POST' action='descendencia.php'>
                    <input type='hidden' name='claveConsultor' value='$clave'>
                    <button class='btn btn-primary btn-sm' type='submit'>Revisa tus incorporaciones personales</button>
                </form>";
        }
        ?>
    </div>

    <h5>Estos son los pasos que debes lograr en tus próximos períodos:</h5>

    <!--asignar valores a los estilos de cada tarjeta según los resultados-->
    <?php
    $estiloP03 = $ventasP03Formatted == "-" || $incorporacionesP03 == "-" ? "border" : ($ventasP03 >= $metaVentasP03 && $incorporacionesP03 >= $metaIncorporacionesP03 ? "border-success bg-success-subtle" : "border-danger bg-danger-subtle");
    $estiloP04 = $ventasP04Formatted == "-" || $incorporacionesP04 == "-" ? "border" : ($ventasP04 >= $metaVentasP04 && $incorporacionesP04 >= $metaIncorporacionesP04 ? "border-success bg-success-subtle" : "border-danger bg-danger-subtle");
    $estiloP05 = $ventasP05Formatted == "-" || $incorporacionesP05 == "-" ? "border" : ($ventasP05 >= $metaVentasP05 && $incorporacionesP05 >= $metaIncorporacionesP05 ? "border-success bg-success-subtle" : "border-danger bg-danger-subtle");
    $estiloP06 = $ventasP06Formatted == "-" || $incorporacionesP06 == "-" ? "border" : ($ventasP06 >= $metaVentasP06 && $incorporacionesP06 >= $metaIncorporacionesP06 ? "border-success bg-success-subtle" : "border-danger bg-danger-subtle");
    $estiloP07 = $ventasP07Formatted == "-" || $incorporacionesP07 == "-" ? "border" : ($ventasP07 >= $metaVentasP07 && $incorporacionesP07 >= $metaIncorporacionesP07 ? "border-success bg-success-subtle" : "border-danger bg-danger-subtle");
    $estiloP08 = $ventasP08Formatted == "-" || $incorporacionesP08 == "-" ? "border" : ($ventasP08 >= $metaVentasP08 && $incorporacionesP08 >= $metaIncorporacionesP08 ? "border-success bg-success-subtle" : "border-danger bg-danger-subtle");
    $estiloP09 = $ventasP09Formatted == "-" || $incorporacionesP09 == "-" ? "border" : ($ventasP09 >= $metaVentasP09 && $incorporacionesP09 >= $metaIncorporacionesP09 ? "border-success bg-success-subtle" : "border-danger bg-danger-subtle");
    $estiloP10 = $ventasP10Formatted == "-" || $incorporacionesP10 == "-" ? "border" : ($ventasP10 >= $metaVentasP10 && $incorporacionesP10 >= $metaIncorporacionesP10 ? "border-success bg-success-subtle" : "border-danger bg-danger-subtle");
    $estiloP11 = $ventasP11Formatted == "-" || $incorporacionesP11 == "-" ? "border" : ($ventasP11 >= $metaVentasP11 && $incorporacionesP11 >= $metaIncorporacionesP11 ? "border-success bg-success-subtle" : "border-danger bg-danger-subtle");
    $estiloP12 = $ventasP12Formatted == "-" || $incorporacionesP12 == "-" ? "border" : ($ventasP12 >= $metaVentasP12 && $incorporacionesP12 >= $metaIncorporacionesP12 ? "border-success bg-success-subtle" : "border-danger bg-danger-subtle");
    ?>


    <!--Metas y resultados por mes-->
    <?php
    echo "
    <!--Contenedor de las tarjetas-->
    <div class='d-flex justify-content-center flex-wrap m-3'>
        <div class='card my-3 mx-2 text-center bg-light " . $estiloP03 . "' style= 'min-width: fit-content; border-radius: 20px'>
            <div class='card-body'>
                <h5 class='card-title'>Período 3</h5>
                <h6 class='card-subtitle text-body-secondary'>2024</h6>
                <table class='table table-sm table-striped table-hover' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloVentaPeriodos . "</th>
                        <th>" . $tituloVentaLograda . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaVentasP03Formatted . "</td>
                        <td>" . $ventasP03Formatted . "</td>
                    </tbody>
                </table>
                <table class='table table-sm table-striped table-hover rounded-2' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloIncorporacionesPeriodos . "</th>
                        <th>" . $tituloIncorporacionesLogradas . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaIncorporacionesP03 . "</td>
                        <td>" . $incorporacionesP03 . "</td>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='card my-3 mx-2 text-center bg-light " . $estiloP04 . "' style= 'min-width: fit-content; border-radius: 20px'>
            <div class='card-body'>
                <h5 class='card-title'>Período 4</h5>
                <h6 class='card-subtitle text-body-secondary'>2024</h6>
                <table class='table table-sm table-striped table-hover' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloVentaPeriodos . "</th>
                        <th>" . $tituloVentaLograda . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaVentasP04Formatted . "</td>
                        <td>" . $ventasP04Formatted . "</td>
                    </tbody>
                </table>
                <table class='table table-sm table-striped table-hover rounded-2' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloIncorporacionesPeriodos . "</th>
                        <th>" . $tituloIncorporacionesLogradas . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaIncorporacionesP04 . "</td>
                        <td>" . $incorporacionesP04 . "</td>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='card my-3 mx-2 text-center bg-light " . $estiloP05 . "' style= 'min-width: fit-content; border-radius: 20px'>
            <div class='card-body'>
                <h5 class='card-title'>Período 5</h5>
                <h6 class='card-subtitle text-body-secondary'>2024</h6>
                <table class='table table-sm table-striped table-hover' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloVentaPeriodos . "</th>
                        <th>" . $tituloVentaLograda . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaVentasP05Formatted . "</td>
                        <td>" . $ventasP05Formatted . "</td>
                    </tbody>
                </table>
                <table class='table table-sm table-striped table-hover rounded-2' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloIncorporacionesPeriodos . "</th>
                        <th>" . $tituloIncorporacionesLogradas . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaIncorporacionesP05 . "</td>
                        <td>" . $incorporacionesP05 . "</td>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='card my-3 mx-2 text-center bg-light " . $estiloP06 . "' style= 'min-width: fit-content; border-radius: 20px'>
            <div class='card-body'>
                <h5 class='card-title'>Período 6</h5>
                <h6 class='card-subtitle text-body-secondary'>2024</h6>
                <table class='table table-sm table-striped table-hover' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloVentaPeriodos . "</th>
                        <th>" . $tituloVentaLograda . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaVentasP06Formatted . "</td>
                        <td>" . $ventasP06Formatted . "</td>
                    </tbody>
                </table>
                <table class='table table-sm table-striped table-hover rounded-2' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloIncorporacionesPeriodos . "</th>
                        <th>" . $tituloIncorporacionesLogradas . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaIncorporacionesP06 . "</td>
                        <td>" . $incorporacionesP06 . "</td>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='card my-3 mx-2 text-center bg-light " . $estiloP07 . "' style= 'min-width: fit-content; border-radius: 20px'>
            <div class='card-body'>
                <h5 class='card-title'>Período 7</h5>
                <h6 class='card-subtitle text-body-secondary'>2024</h6>
                <table class='table table-sm table-striped table-hover' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloVentaPeriodos . "</th>
                        <th>" . $tituloVentaLograda . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaVentasP07Formatted . "</td>
                        <td>" . $ventasP07Formatted . "</td>
                    </tbody>
                </table>
                <table class='table table-sm table-striped table-hover rounded-2' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloIncorporacionesPeriodos . "</th>
                        <th>" . $tituloIncorporacionesLogradas . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaIncorporacionesP07 . "</td>
                        <td>" . $incorporacionesP07 . "</td>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='card my-3 mx-2 text-center bg-light " . $estiloP08 . "' style= 'min-width: fit-content; border-radius: 20px'>
            <div class='card-body'>
                <h5 class='card-title'>Período 8</h5>
                <h6 class='card-subtitle text-body-secondary'>2024</h6>
                <table class='table table-sm table-striped table-hover' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloVentaPeriodos . "</th>
                        <th>" . $tituloVentaLograda . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaVentasP08Formatted . "</td>
                        <td>" . $ventasP08Formatted . "</td>
                    </tbody>
                </table>
                <table class='table table-sm table-striped table-hover rounded-2' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloIncorporacionesPeriodos . "</th>
                        <th>" . $tituloIncorporacionesLogradas . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaIncorporacionesP08 . "</td>
                        <td>" . $incorporacionesP08 . "</td>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='card my-3 mx-2 text-center bg-light " . $estiloP09 . "' style= 'min-width: fit-content; border-radius: 20px'>
            <div class='card-body'>
                <h5 class='card-title'>Período 9</h5>
                <h6 class='card-subtitle text-body-secondary'>2024</h6>
                <table class='table table-sm table-striped table-hover' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloVentaPeriodos . "</th>
                        <th>" . $tituloVentaLograda . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaVentasP09Formatted . "</td>
                        <td>" . $ventasP09Formatted . "</td>
                    </tbody>
                </table>
                <table class='table table-sm table-striped table-hover rounded-2' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloIncorporacionesPeriodos . "</th>
                        <th>" . $tituloIncorporacionesLogradas . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaIncorporacionesP09 . "</td>
                        <td>" . $incorporacionesP09 . "</td>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='card my-3 mx-2 text-center bg-light " . $estiloP10 . "' style= 'min-width: fit-content; border-radius: 20px'>
            <div class='card-body'>
                <h5 class='card-title'>Período 10</h5>
                <h6 class='card-subtitle text-body-secondary'>2024</h6>
                <table class='table table-sm table-striped table-hover' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloVentaPeriodos . "</th>
                        <th>" . $tituloVentaLograda . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaVentasP10Formatted . "</td>
                        <td>" . $ventasP10Formatted . "</td>
                    </tbody>
                </table>
                <table class='table table-sm table-striped table-hover rounded-2' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloIncorporacionesPeriodos . "</th>
                        <th>" . $tituloIncorporacionesLogradas . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaIncorporacionesP10 . "</td>
                        <td>" . $incorporacionesP10 . "</td>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='card my-3 mx-2 text-center bg-light " . $estiloP11 . "' style= 'min-width: fit-content; border-radius: 20px'>
            <div class='card-body'>
                <h5 class='card-title'>Período 11</h5>
                <h6 class='card-subtitle text-body-secondary'>2024</h6>
                <table class='table table-sm table-striped table-hover' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloVentaPeriodos . "</th>
                        <th>" . $tituloVentaLograda . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaVentasP11Formatted . "</td>
                        <td>" . $ventasP11Formatted . "</td>
                    </tbody>
                </table>
                <table class='table table-sm table-striped table-hover rounded-2' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloIncorporacionesPeriodos . "</th>
                        <th>" . $tituloIncorporacionesLogradas . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaIncorporacionesP11 . "</td>
                        <td>" . $incorporacionesP11 . "</td>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='card my-3 mx-2 text-center bg-light " . $estiloP12 . "' style= 'min-width: fit-content; border-radius: 20px'>
            <div class='card-body'>
                <h5 class='card-title'>Período 12</h5>
                <h6 class='card-subtitle text-body-secondary'>2024</h6>
                <table class='table table-sm table-striped table-hover' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloVentaPeriodos . "</th>
                        <th>" . $tituloVentaLograda . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaVentasP12Formatted . "</td>
                        <td>" . $ventasP12Formatted . "</td>
                    </tbody>
                </table>
                <table class='table table-sm table-striped table-hover rounded-2' style='text-align: center; max-width: 16rem'>
                    <thead>
                        <th>" . $tituloIncorporacionesPeriodos . "</th>
                        <th>" . $tituloIncorporacionesLogradas . "</th>
                    </thead>
                    <tbody>
                        <td>" . $metaIncorporacionesP12 . "</td>
                        <td>" . $incorporacionesP12 . "</td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>";

    // Cerrar la conexión al finalizar
    $conn->close();
    ?>

    <!-- Botones de navegación -->
    <div class="d-flex flex-column align-items-center m-5">
        <div class="btn-group-sm" role="group" aria-label="Botones de navegación">
            <button type="button" onclick="window.location.href='index.html'" class="btn m-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                     viewBox="0 0 16 16" style="margin-right: 8px">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
                Volver a Buscar
            </button>
            <button type="button" onclick="window.location.href='https://www.swissjustchile.cl/herramientas/'"
                    class="btn m-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench"
                     viewBox="0 0 16 16" style="margin-right: 8px">
                    <path d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364zm13.37 9.019.528.026.287.445.445.287.026.529L15 13l-.242.471-.026.529-.445.287-.287.445-.529.026L13 15l-.471-.242-.529-.026-.287-.445-.445-.287-.026-.529L11 13l.242-.471.026-.529.445-.287.287-.445.529-.026L13 11z"/>
                </svg>
                Volver a Herramientas
            </button>
            <button type="button" onclick="window.location.href='https://viaja.swissjust.com/'" class="btn m-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-file-text" viewBox="0 0 16 16" style="margin-right: 8px">
                    <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/>
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
                </svg>
                Revisa las bases completas
            </button>
        </div>
    </div>
</main>


<!-- Pie de página -->
<footer>
    <a href="https://www.swissjustchile.cl/herramientas/">
        <img src="img/logo_footer.svg" alt="Hacer bien nos hace bien">
    </a>
</footer>

</body>
</html>