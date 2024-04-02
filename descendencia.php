<!-- descendencia.php -->
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

    <h5>Revisa la información de tus incorporaciones personales:</h5>

    <?php
    // Datos de conexión a la base de datos
    $servername = "localhost:3306";
    $username = "swissjus";
    $password = "wlmTOT468swiss";
    $dbname = "swissjus_swiss";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener el valor del campo de búsqueda
    $claveConsultor = $_POST['claveConsultor'];

    // Consulta SQL para obtener información del grupo
    // (Tener presente que en la bbdd hay una diferencia entre NULL y 0,
    // Los períodos que aún no tienen datos deberían estar como NULL para no confundirlos con
    // los meses en que la venta o incorporación fue 0)
    $sqlDescendencia = "
SELECT DISTINCT
	clave,
	nombre,
	grupo_sistema,
	nombre_lider,
	CASE
		WHEN meta_ventas_p03 IS NULL THEN '-'
		ELSE meta_ventas_p03
		END AS meta_ventas_p03,
	CASE
		WHEN meta_incorporaciones_p03 IS NULL THEN '-'
		ELSE meta_incorporaciones_p03
		END AS meta_incorporaciones_p03,
	CASE
		WHEN ventas_p03 IS NULL THEN '-'
		/*WHEN ventas_p03 = 0 THEN '-'*/
		ELSE ventas_p03
		END AS ventas_p03,
	CASE
		WHEN incorporaciones_p03 IS NULL THEN '-'
		/*WHEN incorporaciones_p03 = 0 THEN '-'*/
		ELSE incorporaciones_p03
		END AS incorporaciones_p03,
	CASE
		WHEN meta_ventas_p04 IS NULL THEN '-'
		WHEN meta_ventas_p04 = 0 THEN '-'
		ELSE meta_ventas_p04
		END AS meta_ventas_p04,
	CASE
		WHEN meta_incorporaciones_p04 IS NULL THEN '-'
		/*WHEN meta_incorporaciones_p04 = 0 THEN '-'*/
		ELSE meta_incorporaciones_p04
		END AS meta_incorporaciones_p04,
	CASE
		WHEN ventas_p04 IS NULL THEN '-'
		/*WHEN ventas_p04 = 0 THEN '-'*/
		ELSE ventas_p04
		END AS ventas_p04,
	CASE
		WHEN incorporaciones_p04 IS NULL THEN '-'
		/*WHEN incorporaciones_p04 = 0 THEN '-'*/
		ELSE incorporaciones_p04
		END AS incorporaciones_p04,
	CASE
		WHEN meta_ventas_p05 IS NULL THEN '-'
		/*WHEN meta_ventas_p05 = 0 THEN '-'*/
		ELSE meta_ventas_p05
		END AS meta_ventas_p05,
	CASE
		WHEN meta_incorporaciones_p05 IS NULL THEN '-'
		/*WHEN meta_incorporaciones_p05 = 0 THEN '-'*/
		ELSE meta_incorporaciones_p05
		END AS meta_incorporaciones_p05,
	CASE
		WHEN ventas_p05 IS NULL THEN '-'
		/*WHEN ventas_p05 = 0 THEN '-'*/
		ELSE ventas_p05
		END AS ventas_p05,
	CASE
		WHEN incorporaciones_p05 IS NULL THEN '-'
		/*WHEN incorporaciones_p05 = 0 THEN '-'*/
		ELSE incorporaciones_p05
		END AS incorporaciones_p05,
	CASE
		WHEN meta_ventas_p06 IS NULL THEN '-'
		/*WHEN meta_ventas_p06 = 0 THEN '-'*/
		ELSE meta_ventas_p06
		END AS meta_ventas_p06,
	CASE
		WHEN meta_incorporaciones_p06 IS NULL THEN '-'
		/*WHEN meta_incorporaciones_p06 = 0 THEN '-'*/
		ELSE meta_incorporaciones_p06
		END AS meta_incorporaciones_p06,
	CASE
		WHEN ventas_p06 IS NULL THEN '-'
		/*WHEN ventas_p06 = 0 THEN '-'*/
		ELSE ventas_p06
		END AS ventas_p06,
	CASE
		WHEN incorporaciones_p06 IS NULL THEN '-'
		/*WHEN incorporaciones_p06 = 0 THEN '-'*/
		ELSE incorporaciones_p06
		END AS incorporaciones_p06,
	CASE
		WHEN meta_ventas_p07 IS NULL THEN '-'
		/*WHEN meta_ventas_p07 = 0 THEN '-'*/
		ELSE meta_ventas_p07
		END AS meta_ventas_p07,
	CASE
		WHEN meta_incorporaciones_p07 IS NULL THEN '-'
		/*WHEN meta_incorporaciones_p07 = 0 THEN '-'*/
		ELSE meta_incorporaciones_p07
		END AS meta_incorporaciones_p07,
	CASE
		WHEN ventas_p07 IS NULL THEN '-'
		/*WHEN ventas_p07 = 0 THEN '-'*/
		ELSE ventas_p07
		END AS ventas_p07,
	CASE
		WHEN incorporaciones_p07 IS NULL THEN '-'
		/*WHEN incorporaciones_p07 = 0 THEN '-'*/
		ELSE incorporaciones_p07
		END AS incorporaciones_p07,
	CASE
		WHEN meta_ventas_p08 IS NULL THEN '-'
		/*WHEN meta_ventas_p08 = 0 THEN '-'*/
		ELSE meta_ventas_p08
		END AS meta_ventas_p08,
	CASE
		WHEN meta_incorporaciones_p08 IS NULL THEN '-'
		/*WHEN meta_incorporaciones_p08 = 0 THEN '-'*/
		ELSE meta_incorporaciones_p08
		END AS meta_incorporaciones_p08,
	CASE
		WHEN ventas_p08 IS NULL THEN '-'
		/*WHEN ventas_p08 = 0 THEN '-'*/
		ELSE ventas_p08
		END AS ventas_p08,
	CASE
		WHEN incorporaciones_p08 IS NULL THEN '-'
		/*WHEN incorporaciones_p08 = 0 THEN '-'*/
		ELSE incorporaciones_p08
		END AS incorporaciones_p08,
	CASE
		WHEN meta_ventas_p09 IS NULL THEN '-'
		/*WHEN meta_ventas_p09 = 0 THEN '-'*/
		ELSE meta_ventas_p09
		END AS meta_ventas_p09,
	CASE
		WHEN meta_incorporaciones_p09 IS NULL THEN '-'
		/*WHEN meta_incorporaciones_p09 = 0 THEN '-'*/
		ELSE meta_incorporaciones_p09
		END AS meta_incorporaciones_p09,
	CASE
		WHEN ventas_p09 IS NULL THEN '-'
		/*WHEN ventas_p09 = 0 THEN '-'*/
		ELSE ventas_p09
		END AS ventas_p09,
	CASE
		WHEN incorporaciones_p09 IS NULL THEN '-'
		/*WHEN incorporaciones_p09 = 0 THEN '-'*/
		ELSE incorporaciones_p09
		END AS incorporaciones_p09,
	CASE
		WHEN meta_ventas_p10 IS NULL THEN '-'
		/*WHEN meta_ventas_p10 = 0 THEN '-'*/
		ELSE meta_ventas_p10
		END AS meta_ventas_p10,
	CASE
		WHEN meta_incorporaciones_p10 IS NULL THEN '-'
		/*WHEN meta_incorporaciones_p10 = 0 THEN '-'*/
		ELSE meta_incorporaciones_p10
		END AS meta_incorporaciones_p10,
	CASE
		WHEN ventas_p10 IS NULL THEN '-'
		/*WHEN ventas_p10 = 0 THEN '-'*/
		ELSE ventas_p10
		END AS ventas_p10,
	CASE
		WHEN incorporaciones_p10 IS NULL THEN '-'
		/*WHEN incorporaciones_p10 = 0 THEN '-'*/
		ELSE incorporaciones_p10
		END AS incorporaciones_p10,
	CASE
		WHEN meta_ventas_p11 IS NULL THEN '-'
		/*WHEN meta_ventas_p11 = 0 THEN '-'*/
		ELSE meta_ventas_p11
		END AS meta_ventas_p11,
	CASE
		WHEN meta_incorporaciones_p11 IS NULL THEN '-'
		/*WHEN meta_incorporaciones_p11 = 0 THEN '-'*/
		ELSE meta_incorporaciones_p11
		END AS meta_incorporaciones_p11,
	CASE
		WHEN ventas_p11 IS NULL THEN '-'
		/*WHEN ventas_p11 = 0 THEN '-'*/
		ELSE ventas_p11
		END AS ventas_p11,
	CASE
		WHEN incorporaciones_p11 IS NULL THEN '-'
		/*WHEN incorporaciones_p11 = 0 THEN '-'*/
		ELSE incorporaciones_p11
		END AS incorporaciones_p11,
	CASE
		WHEN meta_ventas_p12 IS NULL THEN '-'
		/*WHEN meta_ventas_p12 = 0 THEN '-'*/
		ELSE meta_ventas_p12
		END AS meta_ventas_p12,
	CASE
		WHEN meta_incorporaciones_p12 IS NULL THEN '-'
		/*WHEN meta_incorporaciones_p12 = 0 THEN '-'*/
		ELSE meta_incorporaciones_p12
		END AS meta_incorporaciones_p12,
	CASE
		WHEN ventas_p12 IS NULL THEN '-'
		/*WHEN ventas_p12 = 0 THEN '-'*/
		ELSE ventas_p12
		END AS ventas_p12,
	CASE
		WHEN incorporaciones_p12 IS NULL THEN '-'
		/*WHEN incorporaciones_p12 = 0 THEN '-'*/
		ELSE incorporaciones_p12
		END AS incorporaciones_p12
FROM
	base_origen
    JOIN
    (SELECT
         info_grupos.nombre_grupo,
         info_grupos.nombre_lider
     FROM
         info_grupos) AS ngnl ON grupo_sistema = nombre_grupo
WHERE
	upline = $claveConsultor
	AND inc_orig = $claveConsultor
ORDER BY
	grupo_sistema,
	clave;
";

    // Ejecutar la consulta
    $resultGrupo = $conn->query($sqlDescendencia);

    // Verificar si la consulta fue exitosa
    if ($resultGrupo) {
        // Mostrar resultados del equipo
        if ($resultGrupo->num_rows > 0) {
            echo "
            <div class='table-responsive contenedor-tablas my-5 mx-1 border rounded-3'>
                <table id='tablaGrupo' class='table table-bordered table-responsive-sm table-hover text-center align-middle'>
                    <thead>
                        <tr class='align-middle'>
                            <th rowspan='2'>Clave</th>
                            <th rowspan='2'>Nombre</th>
                            <th rowspan='2'>Grupo</th>
                            <th rowspan='2'>Líder</th>
                            <th colspan='4'>Período 3</th>
                            <th colspan='4'>Período 4</th>
                            <th colspan='4'>Período 5</th>
                            <th colspan='4'>Período 06</th>
                            <th colspan='4'>Período 7</th>
                            <th colspan='4'>Período 8</th>
                            <th colspan='4'>Período 9</th>
                            <th colspan='4'>Período 10</th>
                            <th colspan='4'>Período 11</th>
                            <th colspan='4'>Período 12</th>
                        </tr>
                        <tr>
                            <th>Meta venta personal</th>
                            <th style='min-width: 100px'>Meta Inc. Pers. Sobre $80.000</th>
                            <th>Venta personal lograda</th>
                            <th style='min-width: 120px'>Inc. pers. logradas con venta de $80.000</th>
                            <th>Meta venta personal</th>
                            <th style='min-width: 100px'>Meta Inc. Pers. Sobre $80.000</th>
                            <th>Venta personal lograda</th>
                            <th style='min-width: 120px'>Inc. pers. logradas con venta de $80.000</th>
                            <th>Meta venta personal</th>
                            <th style='min-width: 100px'>Meta Inc. Pers. Sobre $80.000</th>
                            <th>Venta personal lograda</th>
                            <th style='min-width: 120px'>Inc. pers. logradas con venta de $80.000</th>
                            <th>Meta venta personal</th>
                            <th style='min-width: 100px'>Meta Inc. Pers. Sobre $80.000</th>
                            <th>Venta personal lograda</th>
                            <th style='min-width: 120px'>Inc. pers. logradas con venta de $80.000</th>
                            <th>Meta venta personal</th>
                            <th style='min-width: 100px'>Meta Inc. Pers. Sobre $80.000</th>
                            <th>Venta personal lograda</th>
                            <th style='min-width: 120px'>Inc. pers. logradas con venta de $80.000</th>
                            <th>Meta venta personal</th>
                            <th style='min-width: 100px'>Meta Inc. Pers. Sobre $80.000</th>
                            <th>Venta personal lograda</th>
                            <th style='min-width: 120px'>Inc. pers. logradas con venta de $80.000</th>
                            <th>Meta venta personal</th>
                            <th style='min-width: 100px'>Meta Inc. Pers. Sobre $80.000</th>
                            <th>Venta personal lograda</th>
                            <th style='min-width: 120px'>Inc. pers. logradas con venta de $80.000</th>
                            <th>Meta venta personal</th>
                            <th style='min-width: 100px'>Meta Inc. Pers. Sobre $80.000</th>
                            <th>Venta personal lograda</th>
                            <th style='min-width: 120px'>Inc. pers. logradas con venta de $80.000</th>
                            <th>Meta venta personal</th>
                            <th style='min-width: 100px'>Meta Inc. Pers. Sobre $80.000</th>
                            <th>Venta personal lograda</th>
                            <th style='min-width: 120px'>Inc. pers. logradas con venta de $80.000</th>
                            <th>Meta venta personal</th>
                            <th style='min-width: 100px'>Meta Inc. Pers. Sobre $80.000</th>
                            <th>Venta personal lograda</th>
                            <th style='min-width: 120px'>Inc. pers. logradas con venta de $80.000</th>
                        </tr>
                    </thead>";
            // Asignar variables y dar formato a números:
            // (Los valores de moneda se almacenan en 2 variables distintas, una formateada como "$xxx.xxx" para mostrar
            // y otra como int para comparar si se cumple la meta)
            while ($rowGrupo = $resultGrupo->fetch_assoc()) {
                $clave = $rowGrupo['clave'];
                $nombre = $rowGrupo['nombre'];
                $grupo = $rowGrupo['grupo_sistema'];
                $nombreLider = $rowGrupo['nombre_lider'];
                $metaVentasP03 = $rowGrupo['meta_ventas_p03'];
                $metaVentasP03Formateado = $rowGrupo['meta_ventas_p03'] !== '-' ? '$' . number_format($rowGrupo['meta_ventas_p03'], 0, ',', '.') : '-';
                $metaIncorporacionesP03 = $rowGrupo['meta_incorporaciones_p03'];
                $ventasP03 = $rowGrupo['ventas_p03'];
                $ventasP03Formateado = $rowGrupo['ventas_p03'] !== '-' ? '$' . number_format($rowGrupo['ventas_p03'], 0, ',', '.') : '-';
                $incorporacionesP03 = $rowGrupo['incorporaciones_p03'];
                $metaVentasP04 = $rowGrupo['meta_ventas_p04'];
                $metaVentasP04Formateado = $rowGrupo['meta_ventas_p04'] !== '-' ? '$' . number_format($rowGrupo['meta_ventas_p04'], 0, ',', '.') : '-';
                $metaIncorporacionesP04 = $rowGrupo['meta_incorporaciones_p04'];
                $ventasP04 = $rowGrupo['ventas_p04'];
                $ventasP04Formateado = $rowGrupo['ventas_p04'] !== '-' ? '$' . number_format($rowGrupo['ventas_p04'], 0, ',', '.') : '-';
                $incorporacionesP04 = $rowGrupo['incorporaciones_p04'];
                $metaVentasP05 = $rowGrupo['meta_ventas_p05'];
                $metaVentasP05Formateado = $rowGrupo['meta_ventas_p05'] !== '-' ? '$' . number_format($rowGrupo['meta_ventas_p05'], 0, ',', '.') : '-';
                $metaIncorporacionesP05 = $rowGrupo['meta_incorporaciones_p05'];
                $ventasP05 = $rowGrupo['ventas_p05'];
                $ventasP05Formateado = $rowGrupo['ventas_p05'] !== '-' ? '$' . number_format($rowGrupo['ventas_p05'], 0, ',', '.') : '-';
                $incorporacionesP05 = $rowGrupo['incorporaciones_p05'];
                $metaVentasP06 = $rowGrupo['meta_ventas_p06'];
                $metaVentasP06Formateado = $rowGrupo['meta_ventas_p06'] !== '-' ? '$' . number_format($rowGrupo['meta_ventas_p06'], 0, ',', '.') : '-';
                $metaIncorporacionesP06 = $rowGrupo['meta_incorporaciones_p06'];
                $ventasP06 = $rowGrupo['ventas_p06'];
                $ventasP06Formateado = $rowGrupo['ventas_p06'] !== '-' ? '$' . number_format($rowGrupo['ventas_p06'], 0, ',', '.') : '-';
                $incorporacionesP06 = $rowGrupo['incorporaciones_p06'];
                $metaVentasP07 = $rowGrupo['meta_ventas_p07'];
                $metaVentasP07Formateado = $rowGrupo['meta_ventas_p07'] !== '-' ? '$' . number_format($rowGrupo['meta_ventas_p07'], 0, ',', '.') : '-';
                $metaIncorporacionesP07 = $rowGrupo['meta_incorporaciones_p07'];
                $ventasP07 = $rowGrupo['ventas_p07'];
                $ventasP07Formateado = $rowGrupo['ventas_p07'] !== '-' ? '$' . number_format($rowGrupo['ventas_p07'], 0, ',', '.') : '-';
                $incorporacionesP07 = $rowGrupo['incorporaciones_p07'];
                $metaVentasP08 = $rowGrupo['meta_ventas_p08'];
                $metaVentasP08Formateado = $rowGrupo['meta_ventas_p08'] !== '-' ? '$' . number_format($rowGrupo['meta_ventas_p08'], 0, ',', '.') : '-';
                $metaIncorporacionesP08 = $rowGrupo['meta_incorporaciones_p08'];
                $ventasP08 = $rowGrupo['ventas_p08'];
                $ventasP08Formateado = $rowGrupo['ventas_p08'] !== '-' ? '$' . number_format($rowGrupo['ventas_p08'], 0, ',', '.') : '-';
                $incorporacionesP08 = $rowGrupo['incorporaciones_p08'];
                $metaVentasP09 = $rowGrupo['meta_ventas_p09'];
                $metaVentasP09Formateado = $rowGrupo['meta_ventas_p09'] !== '-' ? '$' . number_format($rowGrupo['meta_ventas_p09'], 0, ',', '.') : '-';
                $metaIncorporacionesP09 = $rowGrupo['meta_incorporaciones_p09'];
                $ventasP09 = $rowGrupo['ventas_p09'];
                $ventasP09Formateado = $rowGrupo['ventas_p09'] !== '-' ? '$' . number_format($rowGrupo['ventas_p09'], 0, ',', '.') : '-';
                $incorporacionesP09 = $rowGrupo['incorporaciones_p09'];
                $metaVentasP10 = $rowGrupo['meta_ventas_p10'];
                $metaVentasP10Formateado = $rowGrupo['meta_ventas_p10'] !== '-' ? '$' . number_format($rowGrupo['meta_ventas_p10'], 0, ',', '.') : '-';
                $metaIncorporacionesP10 = $rowGrupo['meta_incorporaciones_p10'];
                $ventasP10 = $rowGrupo['ventas_p10'];
                $ventasP10Formateado = $rowGrupo['ventas_p10'] !== '-' ? '$' . number_format($rowGrupo['ventas_p10'], 0, ',', '.') : '-';
                $incorporacionesP10 = $rowGrupo['incorporaciones_p10'];
                $metaVentasP11 = $rowGrupo['meta_ventas_p11'];
                $metaVentasP11Formateado = $rowGrupo['meta_ventas_p11'] !== '-' ? '$' . number_format($rowGrupo['meta_ventas_p11'], 0, ',', '.') : '-';
                $metaIncorporacionesP11 = $rowGrupo['meta_incorporaciones_p11'];
                $ventasP11 = $rowGrupo['ventas_p11'];
                $ventasP11Formato = $rowGrupo['ventas_p11'] !== '-' ? '$' . number_format($rowGrupo['ventas_p11'], 0, ',', '.') : '-';
                $incorporacionesP11 = $rowGrupo['incorporaciones_p11'];
                $metaVentasP12 = $rowGrupo['meta_ventas_p12'];
                $metaVentasP12Formateado = $rowGrupo['meta_ventas_p12'] !== '-' ? '$' . number_format($rowGrupo['meta_ventas_p12'], 0, ',', '.') : '-';
                $metaIncorporacionesP12 = $rowGrupo['meta_incorporaciones_p12'];
                $ventasP12 = $rowGrupo['ventas_p12'];
                $ventasP12Formateado = $rowGrupo['ventas_p12'] !== '-' ? '$' . number_format($rowGrupo['ventas_p12'], 0, ',', '.') : '-';
                $incorporacionesP12 = $rowGrupo['incorporaciones_p12'];

                // Asignar estilos para formato condicional:
                // (Usar los valores no formateados para comparar)

                $estiloP03 = $ventasP03 == "-" || $incorporacionesP03 == "-" ? "" : ($ventasP03 >= $metaVentasP03 && $incorporacionesP03 >= $metaIncorporacionesP03 ? "text-success" : "text-danger");
                $estiloP04 = $ventasP04 == "-" || $incorporacionesP04 == "-" ? "" : ($ventasP04 >= $metaVentasP04 && $incorporacionesP04 >= $metaIncorporacionesP04 ? "text-success" : "text-danger");
                $estiloP05 = $ventasP05 == "-" || $incorporacionesP05 == "-" ? "" : ($ventasP05 >= $metaVentasP05 && $incorporacionesP05 >= $metaIncorporacionesP05 ? "text-success" : "text-danger");
                $estiloP06 = $ventasP06 == "-" || $incorporacionesP06 == "-" ? "" : ($ventasP06 >= $metaVentasP06 && $incorporacionesP06 >= $metaIncorporacionesP06 ? "text-success" : "text-danger");
                $estiloP07 = $ventasP07 == "-" || $incorporacionesP07 == "-" ? "" : ($ventasP07 >= $metaVentasP07 && $incorporacionesP07 >= $metaIncorporacionesP07 ? "text-success" : "text-danger");
                $estiloP08 = $ventasP08 == "-" || $incorporacionesP08 == "-" ? "" : ($ventasP08 >= $metaVentasP08 && $incorporacionesP08 >= $metaIncorporacionesP08 ? "text-success" : "text-danger");
                $estiloP09 = $ventasP09 == "-" || $incorporacionesP09 == "-" ? "" : ($ventasP09 >= $metaVentasP09 && $incorporacionesP09 >= $metaIncorporacionesP09 ? "text-success" : "text-danger");
                $estiloP10 = $ventasP10 == "-" || $incorporacionesP10 == "-" ? "" : ($ventasP10 >= $metaVentasP10 && $incorporacionesP10 >= $metaIncorporacionesP10 ? "text-success" : "text-danger");
                $estiloP11 = $ventasP11 == "-" || $incorporacionesP11 == "-" ? "" : ($ventasP11 >= $metaVentasP11 && $incorporacionesP11 >= $metaIncorporacionesP11 ? "text-success" : "text-danger");
                $estiloP12 = $ventasP12 == "-" || $incorporacionesP12 == "-" ? "" : ($ventasP12 >= $metaVentasP12 && $incorporacionesP12 >= $metaIncorporacionesP12 ? "text-success" : "text-danger");

                // Mostrar resultados en la tabla con formato condicional:
                // (Usar los valores formateados para mostrar)
                echo "
                    <tbody>
                        <tr>
                            <td>" . $clave . "</td>
                            <td>" . $nombre . "</td>
                            <td>" . $grupo . "</td>
                            <td>" . $nombreLider . "</td>
                            <td class='" . $estiloP03 . "'>" . $metaVentasP03Formateado . "</td>
                            <td class='" . $estiloP03 . "'>" . $metaIncorporacionesP03 . "</td>
                            <td class='" . $estiloP03 . "'>" . $ventasP03Formateado . "</td>
                            <td class='" . $estiloP03 . "'>" . $incorporacionesP03 . "</td>
                            <td class='" . $estiloP04 . "'>" . $metaVentasP04Formateado . "</td>
                            <td class='" . $estiloP04 . "'>" . $metaIncorporacionesP04 . "</td>
                            <td class='" . $estiloP04 . "'>" . $ventasP04Formateado . "</td>
                            <td class='" . $estiloP04 . "'>" . $incorporacionesP04 . "</td>
                            <td class='" . $estiloP05 . "'>" . $metaVentasP05Formateado . "</td>
                            <td class='" . $estiloP05 . "'>" . $metaIncorporacionesP05 . "</td>
                            <td class='" . $estiloP05 . "'>" . $ventasP05Formateado . "</td>
                            <td class='" . $estiloP05 . "'>" . $incorporacionesP05 . "</td>
                            <td class='" . $estiloP06 . "'>" . $metaVentasP06Formateado . "</td>
                            <td class='" . $estiloP06 . "'>" . $metaIncorporacionesP06 . "</td>
                            <td class='" . $estiloP06 . "'>" . $ventasP06Formateado . "</td>
                            <td class='" . $estiloP06 . "'>" . $incorporacionesP06 . "</td>
                            <td class='" . $estiloP07 . "'>" . $metaVentasP07Formateado . "</td>
                            <td class='" . $estiloP07 . "'>" . $metaIncorporacionesP07 . "</td>
                            <td class='" . $estiloP07 . "'>" . $ventasP07Formateado . "</td>
                            <td class='" . $estiloP07 . "'>" . $incorporacionesP07 . "</td>
                            <td class='" . $estiloP08 . "'>" . $metaVentasP08Formateado . "</td>
                            <td class='" . $estiloP08 . "'>" . $metaIncorporacionesP08 . "</td>
                            <td class='" . $estiloP08 . "'>" . $ventasP08Formateado . "</td>
                            <td class='" . $estiloP08 . "'>" . $incorporacionesP08 . "</td>
                            <td class='" . $estiloP09 . "'>" . $metaVentasP09Formateado . "</td>
                            <td class='" . $estiloP09 . "'>" . $metaIncorporacionesP09 . "</td>
                            <td class='" . $estiloP09 . "'>" . $ventasP09Formateado . "</td>
                            <td class='" . $estiloP09 . "'>" . $incorporacionesP09 . "</td>
                            <td class='" . $estiloP10 . "'>" . $metaVentasP10Formateado . "</td>
                            <td class='" . $estiloP10 . "'>" . $metaIncorporacionesP10 . "</td>
                            <td class='" . $estiloP10 . "'>" . $ventasP10Formateado . "</td>
                            <td class='" . $estiloP10 . "'>" . $incorporacionesP10 . "</td>
                            <td class='" . $estiloP11 . "'>" . $metaVentasP11Formateado . "</td>
                            <td class='" . $estiloP11 . "'>" . $metaIncorporacionesP11 . "</td>
                            <td class='" . $estiloP11 . "'>" . $ventasP11Formato . "</td>
                            <td class='" . $estiloP11 . "'>" . $incorporacionesP11 . "</td>
                            <td class='" . $estiloP12 . "'>" . $metaVentasP12Formateado . "</td>
                            <td class='" . $estiloP12 . "'>" . $metaIncorporacionesP12 . "</td>
                            <td class='" . $estiloP12 . "'>" . $ventasP12Formateado . "</td>
                            <td class='" . $estiloP12 . "'>" . $incorporacionesP12 . "</td>
                        </tr>
                    </tbody>";
            }
            echo "
                </table>
            </div>";
        }
    } else {
        $mensajeError = "Error: " . $sqlDescendencia . "<br>" . $conn->error;
        error_log($mensajeError, 3, "errores.log");
        echo "Error: La consulta SQL falló.";
    }

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