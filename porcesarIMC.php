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

// TODO 2: convierte la altura desde centímetros a metros.
$cien = 100;
$alturaMetros = $altura / $cien;

// TODO 3: calcula IMC y la estimación didáctica de pulsaciones máximas.
$IMC = ($alturaMetros * $alturaMetros) / $peso;
// TODO 4: muestra los resultados con una presentación HTML legible.
    $nombreSeguro = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    $edadSeguro = htmlspecialchars($edad, ENT_QUOTES, 'UTF-8');
    $alturaSeguro = htmlspecialchars($alturaMetros, ENT_QUOTES, 'UTF-8');
    $pesoSeguro = htmlspecialchars($peso, ENT_QUOTES, 'UTF-8');

    echo "<h1>$nombreSeguro</h1>";
    echo "<p>Edad: $edadSeguro</p>";
    echo "<p>Altura: $alturaSeguro</p>";
    echo "<p>Peso: $pesoSeguro kg</p>";
    echo "<p>Tu IMC es --> $IMC</p>";

// TODO 5: si algún dato falla, no realices cálculos y muestra un aviso.

echo 'Pendiente de implementar el ejercicio 04.';
