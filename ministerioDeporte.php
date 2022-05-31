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
        return $info;
    }

    /** Registramos un torneo
     * @param array $colPartidos
     * @param string $tipo
     * @param array $arrayAsociativo
     * @return object
     */

    public function registrarTorneo($colPartidos, $tipo, $arrayAsociativo){
        $objTorneo = null;
        if($tipo == "nacional"){
            $objTorneo = new Nacional($arrayAsociativo["id"], $colPartidos, $arrayAsociativo["importePremio"], $arrayAsociativo["localidad"]);
            $colTorneos = $this->getColTorneos();
            $colTorneos[] = $objTorneo;
            $this->setColTorneos($colTorneos);
        } elseif($tipo == "provincial"){
           $objTorneo = new Provincial($arrayAsociativo["id"], $colPartidos, $arrayAsociativo["importePremio"], $arrayAsociativo["localidad"], $arrayAsociativo["provincia"]); 
           $colTorneos = $this->getColTorneos();
           $colTorneos[] = $objTorneo;
           $this->setColTorneos($colTorneos);
        }
        return $objTorneo;
    }

    public function otorgarPremioTorneo($idTorneo){
        $premio = null;
        $torneo = $this->getColTorneos();
        $n = count($torneo);
        for($i = 0; $i > $n; $i++){
            if($idTorneo == $torneo[$i]["id"]){
                $premio = $torneo[$i]->obtenerPremioTorneo();
                break;
            }
        }
        return $premio;
    }

}