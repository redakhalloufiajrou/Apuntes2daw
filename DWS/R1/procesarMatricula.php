<?php
require_once __DIR__ . '/horario.php'; // Datos de días, tramos horarios y asignaturas.

// EJERCICIO 05.
// TODO 1: acepta únicamente POST; recupera y valida asignaturas[].
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {http_response_code(405);
    exit('Envía el formulario mediante POST.');
}
$asignaturas = ($_POST['asignaturas'] ?? []);
// TODO 2: para cada asignatura elegida, muestra sus días e intervalos de clase.
foreach ($asignaturas as $asignatura) {
    if (!array_key_exists($asignatura, $horario)) {
        exit("Asignatura no válida: $asignatura");
    }
    echo "<h2>$asignatura</h2>";
    foreach ($horario[$asignatura] as $dia => $intervalos) {
        echo "<p>$dia: " . implode(", ", $intervalos) . "</p>";
    }
}
// TODO 3: suma la duración semanal de TODOS sus intervalos (hay días con dos tramos).
foreach ($asignaturas as $asignatura) {
    $duracionTotal = 0;
    foreach ($horario[$asignatura] as $dia => $intervalos) {
        for ($i = 0; $i < count($intervalos); $i += 2) {
            $inicio = strtotime($intervalos[$i]);
            $fin = strtotime($intervalos[$i + 1]);
            $duracionTotal += ($fin - $inicio) / 60; // Duración en minutos
        }
    }
    echo "<p>Duración semanal de $asignatura: $duracionTotal minutos</p>";
}
// TODO 4 (ampliación): genera una tabla de lunes a viernes y colorea las celdas
//    de los tramos que correspondan a las asignaturas seleccionadas.
// En horario.php están los datos iniciales; la lógica debes escribirla aquí.

    echo 'Pendiente de implementar el ejercicio 05.';
