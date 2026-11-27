
<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/EquipoRepositorio.php';

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$error = '';
$equipos = [];
$prestamos = [];
$repo = null;
try {
    $repo = new EquipoRepositorio(conectar());
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'] ?? '';
        if ($accion === 'prestar') {
            $id = filter_var($_POST['equipo_id'] ?? null, FILTER_VALIDATE_INT);
            $persona = $_POST['persona'] ?? null;
            if ($id === false || $id === null || !is_string($persona)) {
                throw new InvalidArgumentException('Selecciona un equipo y escribe tu nombre.');
            }
            $repo->prestar($id, $persona);
        } elseif ($accion === 'devolver') {
            $id = filter_var($_POST['prestamo_id'] ?? null, FILTER_VALIDATE_INT);
            if ($id === false || $id === null) {
                throw new InvalidArgumentException('ID de préstamo incorrecto.');
            }
            if (!$repo->devolver($id)) {
                throw new RuntimeException('El préstamo no existe o ya está devuelto.');
            }
        } else {
            throw new InvalidArgumentException('Acción desconocida.');
        }
        header('Location: index.php');
        exit;
    }
} catch (PDOException $ex) {
    error_log($ex->getMessage());
    $error = 'No se ha podido completar la operación con la base de datos.';
} catch (Exception $ex) {
    $error = $ex->getMessage();
}
if ($repo !== null) {
    try {
        $equipos = $repo->listarEquipos();
        $prestamos = $repo->listarPrestamos();
    } catch (PDOException $ex) {
        error_log($ex->getMessage());
        $error = 'No se han podido consultar los préstamos.';
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Préstamos de equipos</title>
</head>

<body>
    <h1>Préstamos de equipos</h1>
    <?php if ($error !== ''): ?>
        <p><?= e($error) ?></p><?php endif; ?>
    <h2>Equipos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Equipo</th>
            <th>Unidades</th>
            <th>Disponibles</th>
        </tr>
        <?php foreach ($equipos as $equipo): ?>
            <tr>
                <td><?= (int) $equipo['id'] ?></td>
                <td><?= e($equipo['nombre']) ?></td>
                <td><?= (int) $equipo['unidades'] ?></td>
                <td><?= (int) $equipo['disponibles'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h2>Nuevo préstamo</h2>
    <form method="post">
        <input type="hidden" name="accion" value="prestar">
        <label>Equipo <select name="equipo_id" required>
                <?php foreach ($equipos as $equipo): ?>
                    <option value="<?= (int) $equipo['id'] ?>"><?= e($equipo['nombre']) ?></option>
                <?php endforeach; ?>
            </select></label>
        <label>Persona <input name="persona" minlength="2" maxlength="80" required></label>
        <button type="submit">Prestar</button>
    </form>
    <h2>Préstamos</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Equipo</th>
            <th>Persona</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($prestamos as $prestamo): ?>
            <tr>
                <td><?= (int) $prestamo['id'] ?></td>
                <td><?= e($prestamo['equipo']) ?></td>
                <td><?= e($prestamo['persona']) ?></td>
                <td><?= (int) $prestamo['devuelto'] === 1 ? 'Devuelto' : 'Abierto' ?></td>
                <td><?php if ((int) $prestamo['devuelto'] === 0): ?>
                        <form method="post"><input type="hidden" name="accion" value="devolver">
                            <button type="submit" name="prestamo_id" value="<?= (int) $prestamo['id'] ?>">Devolver</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>