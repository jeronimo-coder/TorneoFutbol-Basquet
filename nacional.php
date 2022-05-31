<?php
include_once('torneo.php');

class Nacional extends Torneo
{
    public function __construct($id, $colPartidos, $importe, $localidad)
    {
        parent::__construct($id, $colPartidos, $importe, $localidad);
    }

    public function __toString()
    {
        $info = parent::__toString();
        return $info;
    }

    public function obtenerPremioTorneo()
    {
        $arrayPremio = parent::obtenerPremioTorneo();
        $premioFinal = $arrayPremio[0] + ($arrayPremio[0] * 0.1) * $arrayPremio[1]["ganados"];
        return $premioFinal; 
    }
}