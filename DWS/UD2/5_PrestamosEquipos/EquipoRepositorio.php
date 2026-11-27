<?php
declare(strict_types=1);

class EquipoRepositorio
{
    public function __construct(private PDO $pdo) {}

    public function listarEquipos(): array
    {
        $equipos = $this->pdo->query(
            'SELECT id, nombre, unidades FROM equipo ORDER BY nombre'
        )->fetchAll();
        $prestamos = $this->pdo->query(
            'SELECT equipo_id FROM prestamo WHERE devuelto = 0'
        )->fetchAll();

        $resultado = [];
        foreach ($equipos as $equipo) {
            $abiertos = 0;
            foreach ($prestamos as $prestamo) {
                if ((int)$prestamo['equipo_id'] === (int)$equipo['id']) {
                    $abiertos++;
                }
            }
            $equipo['disponibles'] = (int)$equipo['unidades'] - $abiertos;
            $resultado[] = $equipo;
        }
        return $resultado;
    }

    public function listarPrestamos(): array
    {
        $sql = 'SELECT p.id, e.nombre AS equipo, p.persona, p.devuelto
                FROM prestamo p INNER JOIN equipo e ON p.equipo_id = e.id
                ORDER BY p.id DESC';
        return $this->pdo->query($sql)->fetchAll();
    }

    public function prestar(int $equipoId, string $persona): void
    {
        $persona = trim($persona);
        if ($equipoId < 1 || strlen($persona) < 2 || strlen($persona) > 80) {
            throw new InvalidArgumentException('Comprueba el equipo y el nombre.');
        }
        $buscar = $this->pdo->prepare('SELECT id, unidades FROM equipo WHERE id = ?');
        $buscar->execute([$equipoId]);
        $equipo = $buscar->fetch();
        if ($equipo === false) {
            throw new InvalidArgumentException('El equipo no existe.');
        }

        $buscarPrestamos = $this->pdo->prepare(
            'SELECT id FROM prestamo WHERE equipo_id = ? AND devuelto = 0'
        );
        $buscarPrestamos->execute([$equipoId]);
        $abiertos = $buscarPrestamos->fetchAll();
        if (count($abiertos) >= (int)$equipo['unidades']) {
            throw new RuntimeException('No quedan unidades disponibles.');
        }

        $stmt = $this->pdo->prepare(
            'INSERT INTO prestamo (equipo_id, persona, devuelto) VALUES (?, ?, 0)'
        );
        $stmt->execute([$equipoId, $persona]);
    }

    public function devolver(int $prestamoId): bool
    {
        if ($prestamoId < 1) {
            throw new InvalidArgumentException('ID de préstamo incorrecto.');
        }
        $buscar = $this->pdo->prepare(
            'SELECT id, devuelto FROM prestamo WHERE id = ?'
        );
        $buscar->execute([$prestamoId]);
        $prestamo = $buscar->fetch();
        if ($prestamo === false || (int)$prestamo['devuelto'] === 1) {
            return false;
        }
        $stmt = $this->pdo->prepare(
            'UPDATE prestamo SET devuelto = 1 WHERE id = ? AND devuelto = 0'
        );
        $stmt->execute([$prestamoId]);
        return true;
    }
}