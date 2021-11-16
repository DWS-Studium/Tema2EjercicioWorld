<!--
    Crear una página que muestre el nombre y la población de todos los países.
    Crear una página que dada una letra muestre todos los países cuyo nombre comience por dicha letra:
-->
<?php
$servidor = 'localhost';
$usuario = 'root';
$clave = 'root';
$baseDeDatos = 'world';

date_default_timezone_set('Europe/Madrid');

$conexion = new mysqli($servidor, $usuario, $clave, $baseDeDatos);
if (mysqli_connect_error()) {
    die('Error de Conexion (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}
echo '**1**<br/>';
$sql_select = "SELECT Name, Population FROM country ORDER BY Name";
$paises = $conexion->query($sql_select);

if ($paises->num_rows > 0) {
    while ($pais = $paises->fetch_assoc()) {
        echo $pais['Name'] . ': ' . number_format($pais['Population'], 0, ',', '.') . '<br/>';
    }
}

echo '<br/><br/>**2**<br/>';
if (isset($_GET['inicial'])) {
    $letraInicial = filter_input(INPUT_GET, 'inicial', FILTER_SANITIZE_STRING);
    $sql_select = "SELECT Name FROM country WHERE Name LIKE '" . $letraInicial . "%' ORDER BY Name";
    $paises = $conexion->query($sql_select);

    if ($paises->num_rows > 0) {
        while ($pais = $paises->fetch_assoc()) {
            echo $pais['Name'] . '<br/>';
        }
    }
}

$conexion->close();
?>