<?php
// EJERCICIO 04. Recibe datos desde IMC.html.
// TODO 1: exige POST y comprueba que los cuatro datos existen y son válidos.
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

$nombre = trim((string) ($_POST['nombre'] ?? ''));
$edad = filter_var($_POST['edad'] ?? null, FILTER_VALIDATE_FLOAT);
$altura = filter_var($_POST['altura'] ?? null, FILTER_VALIDATE_FLOAT);
$peso = filter_var($_POST['peso'] ?? null, FILTER_VALIDATE_FLOAT);

if ($nombre === '') {
    exit('Debes indicar el nombre para completar el formulario');
}
if ($edad !== false) {
    if ($edad < 0 || $edad > 130) {
        exit('La edad debe ser un número entre 0 y 130.');
    }
}
else {
    exit('Debes indicar la edad para completar el formulario');
}

if ($altura !== false) {
    if ($altura < 50 || $altura > 300) {
        exit('La altura debe ser un número entre 50 y 300.');
    }
}
else {
    exit('Debes indicar la altura para completar el formulario');
}

if ($peso !== false) {
    if ($peso < 20 || $peso > 500) {
        exit('El peso debe ser un número entre 20 y 500.');
    }
}
else {
    exit('Debes indicar el peso para completar el formulario');
}

// TODO 2: convierte la altura desde centímetros a metros.
$cien = 100;
$alturaMetros = $altura / $cien;

// TODO 3: calcula IMC y la estimación didáctica de pulsaciones máximas.
$IMC = $peso / ($alturaMetros * $alturaMetros);
$pulsacionesMaximas = 220 - $edad;

// TODO 4: muestra los resultados con una presentación HTML legible.
    $nombreSeguro = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    $edadSeguro = htmlspecialchars($edad, ENT_QUOTES, 'UTF-8');
    $alturaSeguro = htmlspecialchars($alturaMetros, ENT_QUOTES, 'UTF-8');
    $pesoSeguro = htmlspecialchars($peso, ENT_QUOTES, 'UTF-8');
    echo "<hr>";
    echo "<h1>$nombreSeguro</h1>";
    echo "<p>Edad: $edadSeguro</p>";
    echo "<p>Altura: $alturaSeguro</p>";
    echo "<p>Peso: $pesoSeguro kg</p>";
    echo "<p>Tu IMC es --> " . number_format($IMC, 2) . "</p>";
    echo "<p>Tu estimación de pulsaciones máximas es --> " . number_format($pulsacionesMaximas, 0) . "</p>";
    echo "<hr>";

