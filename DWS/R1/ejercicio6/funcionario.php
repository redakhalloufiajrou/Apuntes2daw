<?php

function validarEntero(string $campo, int $min, int $max): int|false
{
    return filter_var(
        $_POST[$campo] ?? null,
        FILTER_VALIDATE_INT,
        [
            'options' => [
                'min_range' => $min,
                'max_range' => $max
            ]
        ]
    );
}

function validarDecimal(string $campo, float $min, float $max): float|false
{
    $valor = filter_var(
        $_POST[$campo] ?? null,
        FILTER_VALIDATE_FLOAT
    );

    if ($valor !== false && $valor >= $min && $valor <= $max) {
        return $valor;
    }

    return false;
}

/**
 * Valida y limpia una cadena de texto (ej. nombres, apellidos).
 */
function validarTexto(string $campo, int $longitudMin = 1, int $longitudMax = 255): string|false
{
    $valor = trim($_POST[$campo] ?? '');

    if (mb_strlen($valor) >= $longitudMin && mb_strlen($valor) <= $longitudMax) {
        return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
    }

    return false;
}

/**
 * Valida una dirección de correo electrónico.
 */
function validarEmail(string $campo): string|false
{
    $email = filter_var($_POST[$campo] ?? null, FILTER_VALIDATE_EMAIL);
    return $email !== false ? $email : false;
}

/**
 * Valida que el valor enviado esté dentro de una lista de opciones permitidas (útil para selects o radios).
 */
function validarOpcion(string $campo, array $opcionesPermitidas): string|false
{
    $valor = $_POST[$campo] ?? null;

    if (in_array($valor, $opcionesPermitidas, true)) {
        return $valor;
    }

    return false;
}

function imprimirCabecera(string $titulo): void
{
    echo '<!doctype html>';
    echo '<html lang="es">';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>' . htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8') . '</title>';
    echo '</head>';
    echo '<body>';
}

function imprimirPie(): void
{
    echo '</body>';
    echo '</html>';
}

/**
 * Imprime una alerta o mensaje formateado (ideal para errores o éxitos).
 */
function imprimirAlerta(string $mensaje, string $tipo = 'error'): void
{
    $color = ($tipo === 'exito') ? 'green' : 'red';
    echo '<div style="padding: 10px; margin: 10px 0; border: 1px solid ' . $color . '; color: ' . $color . ';">';
    echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8');
    echo '</div>';
}

/**
 * Genera dinámicamente opciones para un elemento <select> manteniendo la selección anterior.
 */
function generarOpcionesSelect(array $opciones, mixed $seleccionado = null): void
{
    foreach ($opciones as $valor => $etiqueta) {
        $selected = ($valor == $seleccionado) ? ' selected' : '';
        echo '<option value="' . htmlspecialchars($valor, ENT_QUOTES, 'UTF-8') . '"' . $selected . '>';
        echo htmlspecialchars($etiqueta, ENT_QUOTES, 'UTF-8');
        echo '</option>';
    }
}

