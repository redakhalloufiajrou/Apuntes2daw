<?php
// EJERCICIO 03. Los datos llegan desde radioCheckbox.html por POST.
// TODO 1: comprueba el método de la petición y recoge los campos del formulario.
    $nombre = trim((string) ($_POST['nombre'] ?? ''));
    $apellidos = trim((string) ($_POST['apellidos'] ??''));
    $edad = trim((string) ($_POST['edad'] ??''));
    $peso = filter_var($_POST['peso'] ?? null, FILTER_VALIDATE_INT);
    $sexo = trim((string) ($_POST['sexo'] ?? ''));
    $estadoCivil = trim((string) ($_POST['estadoCivil'] ?? ''));
    $aficiones = ($_POST['aficiones'] ?? []);
// TODO 2: valida los datos obligatorios y que las opciones recibidas estén permitidas.
    if ($nombre === '') {
        exit('Introduce un nombre');
    } elseif ($apellidos === '') {
        exit('Introduce un apellido');
    } elseif ($peso === '') {
        exit('Introduce tu peso');
    }else { 
        print_r('Datos creados');
    }
// TODO 3: muestra nombre y apellidos en un <h1> y el resto de campos en párrafos.
    $nombreSeguro = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    $apellidosSeguro = htmlspecialchars($apellidos, ENT_QUOTES, 'UTF-8');
    $edadSeguro = htmlspecialchars($edad, ENT_QUOTES, 'UTF-8');
    $pesoSeguro = htmlspecialchars($peso, ENT_QUOTES, 'UTF-8');
    $sexoSeguro = htmlspecialchars($sexo, ENT_QUOTES, 'UTF-8');
    $estadoCivilSeguro = htmlspecialchars($estadoCivil, ENT_QUOTES, 'UTF-8');

    echo "<h1>$nombreSeguro $apellidosSeguro</h1>";
    echo "<p>Edad: $edadSeguro</p>";
    echo "<p>Peso: $pesoSeguro kg.</p>";
    echo "<p>Sexo: $sexoSeguro</p>";
    echo "<p>Estado Civil: $estadoCivilSeguro</p>";

// TODO 4: recorre las aficiones y muéstralas en una lista <ul>.


// TODO 5: contempla el caso de no haber seleccionado ninguna afición.
// Nota: al imprimir texto enviado por el usuario, escápalo para HTML.

echo 'Pendiente de implementar el ejercicio 03.';