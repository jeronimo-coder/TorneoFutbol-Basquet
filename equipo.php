<?php

class Equipo{
    private $nombre;
    private $nombreCapitan;
    private $cantJugadores;
    private $categoria;

    public function __construct($nombre, $nombreCapitan, $cantJugadores, $categoria)
    {
        $this->nombre = $nombre;
        $this->nombreCapitan = $nombreCapitan;
        $this->cantJugadores = $cantJugadores;
        $this->categoria = $categoria;
    }
    

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getNombreCapitan(){
        return $this->nombreCapitan;
    }

    public function setNombreCapitan($nombreCapitan){
        $this->nombreCapitan = $nombreCapitan;
    }

    public function getCantJugadores(){
        return $this->cantJugadores;
    }

    public function setCantJugadores($cantJugadores){
        $this->cantJugadores = $cantJugadores;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    public function __toString()
    {
        $info = "Nombre: {$this->getNombre()}\n".
        "Capitan: {$this->getNombreCapitan()}\n".
        "Cantidad de jugadores: {$this->getCantJugadores()}\n".
        "Categoria: {$this->getCategoria()}\n";
        return $info;
    }
}