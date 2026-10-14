<?php
require_once __DIR__ . '/componentes.php';

// EJERCICIO 06.

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

function mostrar($texto): string {
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function euros($importe): string {
    return number_format($importe, 2, ',', '.') . ' €';
}

// Recoger los datos del formulario.
$modelo = trim((string) ($_POST['Modelo'] ?? ''));
$motor = trim((string) ($_POST['Motor'] ?? ''));
$color = trim((string) ($_POST['Colores'] ?? ''));
$llantas = trim((string) ($_POST['Llantas'] ?? ''));
$equipamiento = trim((string) ($_POST['Equipamientos'] ?? ''));

// Validar el modelo.
if ($modelo === '' || !array_key_exists($modelo, $componentes['Modelo'])) {
    exit('Debes indicar un modelo válido.');
}

// Validar el motor.
if ($motor === '' || !array_key_exists($motor, $componentes['Motor'])) {
    exit('Debes indicar un motor válido.');
}

// Validar el color.
if ($color === '' || !array_key_exists($color, $componentes['Color'])) {
    exit('Debes indicar un color válido.');
}

// Validar las llantas.
if ($llantas === '' || !array_key_exists($llantas, $componentes['Llantas'])) {
    exit('Debes indicar unas llantas válidas.');
}

// Validar el equipamiento.
if ($equipamiento === '' || !array_key_exists($equipamiento, $componentes['Equipamiento'])) {
    exit('Debes indicar un equipamiento válido.');
}

// Validar la cantidad: debe ser un entero entre 1 y 5.
$cantidad = filter_var(
    $_POST['cantidad'] ?? null,FILTER_VALIDATE_INT,
    ['options' => ['min_range' => 1, 'max_range' => 5]]
);

if ($cantidad === false) {
    exit('La cantidad debe ser un número entero entre 1 y 5.');
}

// Guardar los componentes seleccionados.
$seleccion = [
    'Modelo' => $modelo,
    'Motor' => $motor,
    'Color' => $color,
    'Llantas' => $llantas,
    'Equipamiento' => $equipamiento
];

// Recoger y validar los accesorios.
$accesorios = $_POST['Acessorios'] ?? [];

if (!is_array($accesorios)) {
    exit('La selección de accesorios no es válida.');
}

foreach ($accesorios as $accesorio) {
    if (!is_string($accesorio) || !array_key_exists($accesorio, $componentes['Accesorios'])) {
        exit('Has seleccionado un accesorio no válido.');
    }
}

// Evitar accesorios duplicados.
$accesorios = array_unique($accesorios);

// Validar el código de descuento.
$codigo = strtoupper(trim((string) ($_POST['codigo_descuento'] ?? '')));
$descuentoPorcentaje = $codigosDescuento[$codigo] ?? 0;

// Calcular el precio por unidad.
$precioUnidad = 0;

echo '<!doctype html>';
echo '<html lang="es">';
echo '<head>';
echo '<meta charset="utf-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
echo '<title>Tu coche</title>';
echo '</head>';
echo '<body>';

echo '<h1>Resumen de tu coche personalizado</h1>';
echo '<ul>';

// Mostrar los componentes seleccionados.
foreach ($seleccion as $grupo => $valor) {
    $precio = $componentes[$grupo][$valor];
    $precioUnidad += $precio;

    echo '<li>' . mostrar($grupo) . ': '
        . mostrar($valor) . ' — '
        . euros($precio) . '</li>';
}

// Mostrar los accesorios.
if (empty($accesorios)) {
    echo '<li>Accesorios: ninguno</li>';
} else {
    foreach ($accesorios as $accesorio) {
        $precio = $componentes['Accesorios'][$accesorio];
        $precioUnidad += $precio;

        echo '<li>Accesorio: '
            . mostrar($accesorio) . ' — '
            . euros($precio) . '</li>';
    }
}

echo '</ul>';

// Calcular los importes.
$baseInicial = $precioUnidad * $cantidad;
$rebaja = round($baseInicial * $descuentoPorcentaje / 100, 2);
$baseFinal = $baseInicial - $rebaja;
$iva = round($baseFinal * 0.21, 2);
$totalConIva = $baseFinal + $iva;

// Mostrar el resumen económico.
echo '<p>Cantidad: ' . $cantidad . '</p>';
echo '<p>Precio por unidad sin IVA: '
    . euros($precioUnidad) . '</p>';
echo '<p>Base inicial sin IVA: '
    . euros($baseInicial) . '</p>';

if ($codigo !== '') {
    echo '<p>Código de descuento: '
        . mostrar($codigo)
        . ($descuentoPorcentaje > 0
            ? ' (válido)'
            : ' (no válido)')
        . '</p>';
} else {
    echo '<p>Código de descuento: no aplicado</p>';
}

echo '<p>Descuento aplicado: '. euros($rebaja) . '</p>';

echo '<p>Base tras el descuento: '. euros($baseFinal) . '</p>';

echo '<p>IVA (21 %): '. euros($iva) . '</p>';

echo '<h2>Total con IVA: '. euros($totalConIva) . '</h2>';

echo '</body>';
echo '</html>';