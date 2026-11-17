<?php
declare(strict_types=1);

class EquipoRepositorio
{
    public function __construct(private PDO $pdo) {}

    public function listar(): array
    {
        return $this->pdo
            ->query('SELECT id, nombre, unidades FROM equipo ORDER BY id DESC')
            ->fetchAll();
    }


    public function crear(string $nombre, int $unidades): void
    {
        $nombre = strtolower(trim($nombre));
        
        $sql = 'INSERT INTO equipo(nombre, unidades) VALUES (?, ?)';
        $sentencia = $this->pdo->prepare($sql);
        $sentencia->execute([$nombre, $unidades]);

    }

    public function actualizarUnidades(int $id, int $unidades): void
    {
        if ($id < 1) {
            throw new InvalidArgumentException('ID no válido.');
        }
        
        if ($unidades < 0) {
            throw new InvalidArgumentException('Las unidades no pueden ser negativas.');
        }

        $sentencia = $this->pdo->prepare('UPDATE equipo SET unidades = ? WHERE id = ?');
        $sentencia->execute([$unidades, $id]);
    }

    public function eliminar(int $id): void
    {
        // Comprueba el equipo y elimínalo.
        if ($id < 1) {
            throw new InvalidArgumentException('Id no válido.');
        }
        $sentencia = $this->pdo->prepare('DELETE FROM equipo WHERE id = ?');
        $sentencia->execute([$id]);
    }

}
