<?php

class Provincial extends Torneo
{
    private $nombreProvincia;
    public function __construct($colPartidos, $importe, $localidad, $provincia)
    {
        parent::__construct($colPartidos, $importe, $localidad);
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
        $info .= "Provincia de: {$this->getNombreProvincia()}\n";
        return $info;
    }
}