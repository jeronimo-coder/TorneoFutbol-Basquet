<?php
include_once('torneo.php');

class Provincial extends Torneo
{
    private $nombreProvincia;
    public function __construct($id, $colPartidos, $importe, $localidad, $provincia)
    {
        parent::__construct($id, $colPartidos, $importe, $localidad);
        $this->nombreProvincia = $provincia;
    }

    public function getNombreProvincia(){
        return $this->nombreProvincia;
    }

    public function setNombreProvincia($nombreProvincia){
        $this->nombreProvincia = $nombreProvincia;
    }

    public function __toString()
    {
        $info = parent::__toString();
        $info .= "\nProvincia de: {$this->getNombreProvincia()}\n";
        return $info;
    }
}