<?php

class Basquet extends Partido{
    private $infracciones;

    public function __construct($id, $fecha, $cantPuntosE1, $cantPuntosE2, $equipo1, $equipo2, $infracciones)
    {
        parent::__construct($id, $fecha, $cantPuntosE1, $cantPuntosE2, $equipo1, $equipo2);
        $this->infracciones = $infracciones;
    }  

    public function getInfracciones(){
        return $this->infracciones;
    }

    public function setInfracciones($infracciones){
        $this->infracciones = $infracciones;
    }

    public function coeficientePartido()
    {
        $coef = parent::coeficientePartido();
        $coefBasquet = $coef[2] - 0.75 * $this->getInfracciones();
        return $coefBasquet;
    }
}