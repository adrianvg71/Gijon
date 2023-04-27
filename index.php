<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
  Visitar La Laboral
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Visitas La Laboral</h1>

<?php

function recoge($var, $m = "")
{
    $tmp = is_array($m) ? [] : "";
    if (isset($_REQUEST[$var])) {
        if (!is_array($_REQUEST[$var]) && !is_array($m)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$var]));
        } elseif (is_array($_REQUEST[$var]) && is_array($m)) {
            $tmp = $_REQUEST[$var];
            array_walk_recursive($tmp, function (&$valor) {
                $valor = trim(htmlspecialchars($valor));
            });
        }
    }
    return $tmp;
}

$nombre = recoge("nombre");
$apellidos = recoge("apellidos");
$email = recoge("correo");
$guiada = recoge("guiada");
$fecha = recoge("fecha");
$texto = recoge("texto");

$nombreOk = false;
$apellidosOk = false;
$emailOk = false;
$guiadaOk = false;
$fechaOk = false;
$zonasOk = false;

if(empty($nombre)) {
  print "<p>El nombre no puede estar vacio</p>\n";
} else {
  $nombreOk = true;
}

if(empty($apellidos)) {
  print "<p>El apellido no puede estar vacio</p>\n";
} else {
  $apellidosOk = true;
}

if(empty($email)) {
  print "<p>El correo no puede estar vacio</p>\n";
} else {
  $emailOk = true;
}

if(empty($guiada)) {
  print "<p>Por favor seleccione el tipo de visita</p>\n";
} else {
  $guiadaOk = true;
}

if(empty($fecha)) {
  print "<p>Por favor seleccione una fecha</p>\n";
} elseif ($fecha < date("Y-m-d")) {
  print "<p>La fecha de visita no puede ser anterior ni igual a hoy</p>\n";
} else {
  $fechaOk = true;
}

if(empty($_REQUEST['zonas'])) {
  print"<p>Seleccione al menos una zona para la visita</p>\n";
} else {
  $zonasOk = true;
}

if($nombreOk && $apellidosOk && $emailOk && $guiadaOk && $fechaOk && $zonasOk) {
  print "<p>Buenas $nombre"." $apellidos</p>\n";
  print "<p>Se te enviara un correo con todos los datos de la reserva al correo: $email</p>\n";
  print "<p>El tipo de visita que has elegido es: $guiada</p>\n";
  print "<p>La visita se efectuara en la fecha: $fecha</p>\n";
  print "<p>En tu visita veras las zonas: </p>\n";
  foreach($_REQUEST['zonas'] as $zona) {
    print "<p>$zona</p>\n";
  }
  if(!empty($texto)) {
    print "<p>Como comentario extra has escrito: $texto</p>\n";
  }
}

?>

  <p><a href="universidad-laboral.html">Volver a la pagina.</a></p>

</body>
</html>
