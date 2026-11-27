<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/TallerRepositorio.php';
function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}   
$talleres = [];
$repo = new TallerRepositorio(conectar());
$talleres = $repo->listarTalleres();

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Talleres</title>
</head>

<body>
    <h1>Talleres</h1>
    <h2>Plazas</h2>
    <table border="1">
        <tr>
            <th>Taller</th>
            <th>Plazas</th>
            <th>Confirmadas</th>
            <th>En Espera</th>
        </tr>
        <?php foreach ($talleres as $taller): ?>
            <tr>
                <td><?= e($taller['titulo']) ?></td>
                <td><?= (int) $taller['plazas'] ?></td>
                <td><?= (int) $taller['confirmadas'] ?></td>
                <td><?= (int) $taller['espera'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>