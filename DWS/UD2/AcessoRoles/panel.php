<?php
declare(strict_types=1);
session_start();

// Comprobar acceso: si el usuario no está identificado, redirigir al login
if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/incidencias.php';

// Procesar el cambio de estado de una incidencia si se recibe por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_incidencia'])) {
    $idIncidencia = (int) $_POST['id_incidencia'];
    // Función esperada en incidencias.php para actualizar el estado
    marcarIncidenciaRevisada($idIncidencia);
    header('Location: panel.php');
    exit;
}

$nombre = htmlspecialchars((string) $_SESSION['nombre'], ENT_QUOTES, 'UTF-8');
// Recuperar las incidencias desde la librería
$incidencias = obtenerIncidencias(); 
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Panel de incidencias</title>
</head>

<body>
    <h1>Incidencias del centro</h1>
    
    <!-- Saludo personalizado -->
    <p>Hola, <strong><?= $nombre ?></strong></p>

    <!-- Enlace al informe -->
    <p>
        <a href="informe.php">Ver informe completo de incidencias</a>
    </p>

    <h2>Listado de incidencias</h2>
    <?php if (empty($incidencias)): ?>
        <p>No hay incidencias registradas en este momento.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($incidencias as $incidencia): ?>
                    <tr>
                        <td><?= htmlspecialchars((string) ($incidencia['id'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars((string) ($incidencia['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= ($incidencia['revisada'] ?? false) ? 'Revisada' : 'Pendiente' ?></td>
                        <td>
                            <?php if (!($incidencia['revisada'] ?? false)): ?>
                                <form action="panel.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id_incidencia" value="<?= $incidencia['id'] ?>">
                                    <button type="submit">Revisar</button>
                                </form>
                            <?php else: ?>
                                <span>-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Formulario POST de cierre de sesión -->
    <form action="logout.php" method="post" style="margin-top: 20px;">
        <button type="submit">Cerrar sesión</button>
    </form>
</body>

</html>