<?php
declare(strict_types=1);

class TallerRepositorio
{
    public function __construct(private PDO $pdo) {}

    public function listarTalleres(): array
    {
        // Recupera talleres y cuenta los estados en PHP.
        return [];
    }

    public function listarInscripciones(): array
    {
        // Completa la consulta con INNER JOIN.
        return [];
    }

    public function inscribir(int $tallerId, string $nombre, string $email): string
    {
        // Comprueba los datos y devuelve confirmada o espera.
        return '';
    }

    public function cancelar(int $inscripcionId): bool
    {
        // Elimina la inscripción y, si procede, cubre la plaza libre.
        return false;
    }
}
