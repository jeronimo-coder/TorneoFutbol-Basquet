<?php

class Partido{
    private $idPartido;
    private $fecha;
    private $cantGolesE1;
    private $cantGolesE2;
    private $objEquipo1;
    private $objEquipo2;

    public function __construct($idPartido, $fecha, $cantGoles1, $cantGoles2, $objEquipo1, $objEquipo2)
    {
        $this->idPartido = $idPartido;
        $this->fecha = $fecha;
        $this->cantGolesE1 = $cantGoles1;
        $this->cantGolesE2 = $cantGoles2;
        $this->objEquipo1 = $objEquipo1;
        $this->objEquipo2 = $objEquipo2;
    }
    

    public function getIdPartido(){
        return $this->idPartido;
    }

    public function setIdPartido($idPartido){
        $this->idPartido = $idPartido;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getCantGolesE1(){
        return $this->cantGolesE1;
    }

    public function setCantGolesE1($cantGolesE1){
        $this->cantGolesE1 = $cantGolesE1;
    }

    public function getCantGolesE2(){
        return $this->cantGolesE2;
    }

    public function setCantGolesE2($cantGolesE2){
        $this->cantGolesE2 = $cantGolesE2;
    }

    public function getObjEquipo1(){
        return $this->objEquipo1;
    }

    public function setObjEquipo1($objEquipo1){
        $this->objEquipo1 = $objEquipo1;
    }

    public function getObjEquipo2(){
        return $this->objEquipo2;
    }

    public function setObjEquipo2($objEquipo2){
        $this->objEquipo2 = $objEquipo2;
    }

    public function __toString()
    {
        $info = "Id partido: {$this->getIdPartido()}\n".
        "Fecha: {$this->getFecha()}\n".
        "Goles del equipo 1: {$this->getCantGolesE1()}\n".
        "Goles del equipo 2: {$this->getCantGolesE2()}\n".
        "Equipo 1: {$this->getObjEquipo1()}\n".
        "Equipo 2: {$this->getObjEquipo2()}\n";
        return $info;
    }

    public function coeficientePartido(){
        $arrayCoef = []; 
        $coef1 = 0.5 * $this->getCantGolesE1() * $this->getObjEquipo1()->getCantJugadores();
        $coef2 = 0.5 * $this->getCantGolesE2() * $this->getObjEquipo2()->getCantJugadores();
        $coefTotal = $coef1 + $coef2;
        $arrayCoef = [$coef1,$coef2, $coefTotal];
        return $arrayCoef;
    }

    public function darGanador(){
        $ganador = null;
        if($this->getCantGolesE1() > $this->getCantGolesE2()){
            $ganador["equipo"] = $this->getObjEquipo1();
            $ganador["goles"] = $this->getCantGolesE1();
        }elseif($this->getCantGolesE2() > $this->getCantGolesE1()){
            $ganador["equipo"] = $this->getObjEquipo2();
            $ganador["goles"] = $this->getCantGolesE2();
        }
        return $ganador;
    }

}