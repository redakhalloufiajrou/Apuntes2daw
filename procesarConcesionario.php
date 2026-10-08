<?php
require_once __DIR__ . '/componentes.php'; // Datos iniciales de opciones, precios y descuentos.

// EJERCICIO 06.


if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

$modelo = trim((string) ($_POST['Modelo'] ?? ''));
$motor = trim((string) ($_POST['Motor'] ?? ''));
$colores = trim((string) ($_POST['Colores'] ?? ''));
$llantas = trim((string) ($_POST['Llantas'] ?? ''));
$equipamientos = trim((string) ($_POST['Equipamientos'] ?? ''));
$cantidad = filter_var($_POST['cantidad'] ?? null, FILTER_VALIDATE_FLOAT);

if ($modelo === '' || !array_key_exists($modelo, $componentes['Modelo'])) {
    exit('Debes indicar el modelo para completar el formulario');
}
if ($motor === '' || !array_key_exists($motor, $componentes['Motor'])) {
    exit('Debes indicar el motor para completar el formulario');
}
if ($colores === '' || !array_key_exists($colores, $componentes['Color'])) {
    exit('Debes indicar el color para completar el formulario');
}
if ($llantas === '' || !array_key_exists($llantas, $componentes['Llantas'])) {
    exit('Debes indicar las llantas para completar el formulario');
}
if ($equipamientos === '' || !array_key_exists($equipamientos, $componentes['Equipamiento'])) {
    exit('Debes indicar los equipamientos para completar el formulario');
}
if ($cantidad !== false) {
    if ($cantidad < 1 || $cantidad > 5) {
        exit('La cantidad debe ser un número entre 1 y 5.');
    }
} else {
    exit('Debes indicar la cantidad para completar el formulario');
}
// TODO 2: recoge los accesorios seleccionados (pueden ser cero) y la cantidad (1–5).










// TODO 3: calcula el precio unitario SIN IVA a partir de los precios proporcionados.
// TODO 4: multiplica por el número de vehículos y aplica el descuento, si es válido.
// TODO 5: calcula un IVA del 21 % sobre la base una vez descontada la rebaja.
// TODO 6: genera un resumen con opciones, importes, descuentos, IVA y total.
// Si el código de descuento no existe, indica que es inválido y no apliques rebaja.

echo 'Pendiente de implementar el ejercicio 06.';
