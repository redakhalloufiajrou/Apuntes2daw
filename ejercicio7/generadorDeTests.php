<?php
require_once __DIR__ . '/repositorioPreguntas.php';

// EJERCICIO 07 - PARTE A: GENERACIÓN.
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Envía el formulario mediante POST.');
}

function mostrar($texto): string
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

$asignaturas = trim((string) ($_POST['asignatura'] ?? ''));

$numeroDePreguntas = filter_var($_POST['cantidad'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 5]]);

// TODO 2: elige al azar preguntas distintas del repositorio de esa asignatura.
$preguntas = $_POST['repositorioPreguntas'] ?? [];
$preguntasAleatorias = (array) array_rand($repositorioPreguntas[$asignaturas], $numeroDePreguntas);

echo '<!doctype html>';
echo '<html lang="es">';
echo '<head>';
echo '<meta charset="utf-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
echo '<title>Examen teorico</title>';
echo '</head>';
echo '<body>';

echo '<form action="comprobarTest.php" method="POST">';

if ($asignaturas === 'matematicas') {
    echo '<h1>Preguntas Matematicas</h1>';
} elseif ($asignaturas === 'historia') {
    echo '<h1>Preguntas de Historia</h1>';
} else {
    echo '<h1>Preguntas de Ciencias</h1>';
}

$numero = 0;

foreach ($preguntasAleatorias as $pregunta) {
    $numero++;

    $valor = $repositorioPreguntas[$asignaturas][$pregunta];

    echo '<ol>';
    echo $numero . ' - ' . mostrar($pregunta);


    foreach ($valor as $respuestas => $textoRespuesta) {
        echo '<br>';
        echo '<input type="radio" name="pregunta' . $numero . '" value=""' . htmlspecialchars((string) $respuestas) . '">'
            . htmlspecialchars((string) $textoRespuesta)
            . '</input>';
    }

    echo '</ol>';
}

echo '<input type="hidden" name="asignaturas" value="' .
    htmlspecialchars($asignaturas) . '">';

echo '<button type="submit">Comprobar test</button>';
echo '</form>';

echo '</body>';
echo '</html>';




