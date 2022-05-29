<?php

class MinisterioDeporte
{
    private $anioTorneo;
    private $colTorneos;

    public function __construct($anio, $coleccionTorneos)
    {
        $this->anioTorneo = $anio;
        $this->colTorneos = $coleccionTorneos;
    }
    

    public function getAnioTorneo(){
        return $this->anioTorneo;
    }

    public function setAnioTorneo($anioTorneo){
        $this->anioTorneo = $anioTorneo;
    }

    public function getColTorneos(){
        return $this->colTorneos;
    }

    public function setColTorneos($colTorneos){
        $this->colTorneos = $colTorneos;
    }

    public function mostrarCol(){
        $info = "";
        foreach($this->getColTorneos() as $key){
            $info .= "$key";
        }
        return $info;
    }

    public function __toString()
    {
        $torneos = $this->mostrarCol();
        $info = "Año del torneo: {$this->getAnioTorneo()}\n".
        "Coleccion de torneos: $torneos \n";
    }
}