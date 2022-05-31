<?php
include_once('torneo.php');

class Nacional extends Torneo
{
    public function __construct($colPartidos, $importe, $localidad)
    {
        parent::__construct($colPartidos, $importe, $localidad);
    }

    public function __toString()
    {
        $info = parent::__toString();
        return $info;
    }

}