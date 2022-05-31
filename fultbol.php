<?php

include_once('partido.php');

class Futbol extends Partido{

    public function __construct($id, $fecha, $cantGoles1, $cantGoles2, $equipo1, $equipo2)
    {
        parent::__construct($id, $fecha, $cantGoles1, $cantGoles2, $equipo1, $equipo2);
    }

    public function coeficientePartido()
    {
        $coef = parent::coeficientePartido();
        $coefFutbol = $coef[2] + $coef[2] * $this->getObjEquipo1()->getCategoria()->getCoefCategoria()
                               + $coef[2] * $this->getObjEquipo2()->getCategoria()->getCoefCategoria();
        return $coefFutbol;
    }
}