<?php
class producto
{

    public $nombre;
    public $precio;

    public function __construct($nombre, $precio)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }
}