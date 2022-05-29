<?php

class Torneo
{
    private $colPartidos;
    private $importePremio;
    private $nombreLocalidad;

    public function __construct($colPartidos, $importe, $localidad)
    {
        $this->colPartidos = $colPartidos;
        $this->importePremio = $importe;
        $this->nombreLocalidad = $localidad;
    }

    public function getColPartidos()
    {
        return $this->colPartidos;
    }

    public function setColPartidos($colPartidos)
    {
        $this->colPartidos = $colPartidos;
    }

    public function getImportePremio()
    {
        return $this->importePremio;
    }

    public function setImportePremio($importePremio)
    {
        $this->importePremio = $importePremio;
    }

    public function getNombreLocalidad()
    {
        return $this->nombreLocalidad;
    }

    public function setNombreLocalidad($nombreLocalidad)
    {
        $this->nombreLocalidad = $nombreLocalidad;
    }

    public function infoPartidos()
    {
        $info = "";
        foreach ($this->getColPartidos() as $value) {
            $info .= "$value";
        }
        return $info;
    }

    public function __toString()
    {
        $partidos = $this->infoPartidos();
        $info = "Partidos: $partidos \n" .
            "Premio: {$this->getImportePremio()}\n" .
            "Se jugó en: {$this->getNombreLocalidad()}";
        return $info;
    }


    public function ingresarPartido($objEquipo1, $objEquipo2, $fecha, $tipo)
    {
        $objPartido = null;
        if (
            $objEquipo1->getCantJugadores() == $objEquipo2->getCantJugadores() &&
            $objEquipo1->getCategoria()->getIdCategoria() == $objEquipo2->getCategoria()->getIdCategoria()
        ) {
            if ($tipo == "futbol") {
                $objPartido = new Futbol(count($this->getColPartidos()) + 1, $fecha, 0, 0, $objEquipo1, $objEquipo2);
                $array = $this->getColPartidos();
                $array[] = $objPartido;
                $this->setColPartidos($array);
            } elseif ($tipo == "basquet") {
                $objPartido = new Basquet(count($this->getColPartidos()) + 1, $fecha, 0, 0, $objEquipo1, $objEquipo2, 0);
                $array = $this->getColPartidos();
                $array[] = $objPartido;
                $this->setColPartidos($array);
            }
            return $objPartido;
        }
    }

    public function darGanadores($deporte)
    {
        $ganadores = [];
        foreach ($this->getColPartidos() as $partido) {
            if (is_a($partido, $deporte)) {
                $ganadores[] = $partido->darGanador();
            }
        }
        return $ganadores;
    }

    public function calcularPremioPartido($objPartido)
    {
        $infoPremio["equipoGanador"] = $objPartido->darGanador();
        $infoPremio["premio"] = $objPartido->coeficientePartido() * $this->getImportePremio();
        return $infoPremio;
    }

    public function obtenerEquipoGanadorTorneo()
    {
        $ganadorTorneo = [];
        $ganadoresPartidos = [];
        $coleccionPartidosTorneo = $this->getColPartidos();
        $n = count($coleccionPartidosTorneo);
        for ($i = 0; $i < $n; $i++) {
            $goles = 0;
            $ganadorPartido = $coleccionPartidosTorneo[$i]->darGanador();
            $goles = $ganadorPartido["goles"];
            $clave = array_search($ganadorPartido, $ganadoresPartidos);
            if ($clave != false) {
                $golXPartido = $ganadorPartido["goles"];
                $goles += $golXPartido;
                $ganado = $ganadorPartido["ganados"];
                $ganado += 1;
                $ganadoresPartidos[$clave] = ["equipo" => $ganadorPartido["equipo"], "goles" => $goles, "ganados" => $ganado];
            } else {
                $ganadoresPartidos[$i] = ["equipo" => $ganadorPartido["equipo"], "goles" => $goles, "ganados" => 1];
            }
        }
        $d = count($ganadoresPartidos);
        $ganados = 1;
        $gol = 0;
        for($i = 0; $i < $d; $i++){   
            $ganadosXequipo = $ganadoresPartidos[$i]["ganados"];
            $golesXequipo = $ganadoresPartidos[$i]["goles"];
            if($ganadosXequipo > $ganados && $golesXequipo > $gol){
                $ganados = $ganadosXequipo;
                $gol = $golesXequipo;
                $ganadorTorneo = $ganadoresPartidos[$i];
            }
        }
        return $ganadorTorneo;
    }
}
