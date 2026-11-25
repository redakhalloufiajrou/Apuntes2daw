<?php
declare(strict_types=1);

class EquipoRepositorio
{
    public function __construct(private PDO $pdo) {}

    public function listarEquipos(): array
    {
        // Completa el listado y calcula las unidades disponibles.
        return [];
    }

    public function listarPrestamos(): array
    {
        // Completa la consulta con INNER JOIN.
        return [];
    }

    public function prestar(int $equipoId, string $persona): void
    {
        // Comprueba equipo, disponibilidad y registra el préstamo.
    }

    public function devolver(int $prestamoId): bool
    {
        // Cambia el estado solamente si el préstamo sigue abierto.
        return false;
    }
}
