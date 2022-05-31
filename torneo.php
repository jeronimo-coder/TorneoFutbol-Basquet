<?php

class Torneo
{
    private $idTorneo;
    private $colPartidos;
    private $importePremio;
    private $nombreLocalidad;

    public function __construct($id, $colPartidos, $importe, $localidad)
    {
        $this->idTorneo = $id;
        $this->colPartidos = $colPartidos;
        $this->importePremio = $importe;
        $this->nombreLocalidad = $localidad;
    }

    public function getIdTorneo(){
        return $this->idTorneo;
    }

    public function setIdTorneo($idTorneo){
        $this->idTorneo = $idTorneo;
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
        $info ="Id torneo: {$this->getIdTorneo()}\n" . 
            "Partidos: $partidos \n" .
            "Premio: {$this->getImportePremio()}\n" .
            "Se jugó en: {$this->getNombreLocalidad()}";
        return $info;
    }

    /** Ingresamos un nuevo partido, creando la instancia correspondiente con valores de goles en 0
     * @param object $objEquipo1
     * @param object $objEquipo2
     * @param string $fecha
     * @param string $tipo
     * @return object
     */

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

    /** Luego de crear una instancia de partidos, modificamos los valores en los resultados
     * @param int $id //SE BUSCA EL PARTIDO POR ID
     * @param int $cantGolesE1
     * @param int $cantGolesE2
     * @return bool
     */

    public function ingresarResultadoPartido($id, $cantGolesE1, $cantGolesE2)
    {
        $cambios = false;
        $colPartidos = $this->getColPartidos();
        $n = count($colPartidos);
        for ($i = 0; $i < $n; $i++) {
            if ($colPartidos[$i]->getIdPartido() == $id) {
                $colPartidos[$i]->setCantGolesE1($cantGolesE1);
                $colPartidos[$i]->setCantGolesE2($cantGolesE2);
                $cambios = true;
                break;
            }
        }
        return $cambios;
    }

    /** Agrupamos en un array a todos lo ganadores de los partidos disputados
     * @param string
     * @return array
     */

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

    /** calculamos el valor del premio por partido que recibe cada equipo ganador
     * @param object $objPartido
     * @return array
     */
    public function calcularPremioPartido($objPartido)
    {
        $infoPremio["equipoGanador"] = $objPartido->darGanador();
        $infoPremio["premio"] = $objPartido->coeficientePartido() * $this->getImportePremio();
        return $infoPremio;
    }

    /** Obtendremos al ganador del torneo */

    public function obtenerEquipoGanadorTorneo()
    {
        $ganadorTorneo = [];
        $ganadoresPartidos = null;
        $coleccionPartidosTorneo = $this->getColPartidos();
        $n = count($coleccionPartidosTorneo);
        for ($i = 0; $i < $n; $i++) {
            $ganadorPartido = $coleccionPartidosTorneo[$i]->darGanador();
            $goles = $ganadorPartido["goles"];
            if ($ganadoresPartidos == null) {
                $ganadoresPartidos[] = ["equipo" => $ganadorPartido["equipo"], "goles" => $goles, "ganados" => 1];
            } elseif ($ganadoresPartidos != null) {
                $d = count($ganadoresPartidos);
                $esta = false;
                for ($e = 0; $e < $d; $e++) {
                    if ($ganadorPartido["equipo"] == $ganadoresPartidos[$e]["equipo"]) {
                        $golesNuevos = $ganadorPartido["goles"];
                        $golesHechosHastaAhora = $ganadoresPartidos[$e]["goles"];
                        $sumaDeGoles = $golesNuevos + $golesHechosHastaAhora;
                        $ganadosHastaAhora = $ganadoresPartidos[$e]["ganados"];
                        $nuevoGanado = 1;
                        $nuevoGanado += $ganadosHastaAhora;
                        $ganadoresPartidos[$e] = ["equipo" => $ganadorPartido["equipo"], "goles" => $sumaDeGoles, "ganados" => $nuevoGanado];
                        $esta = true;
                    }
                }
                if ($esta == false) {
                    $ganadoresPartidos[] = ["equipo" => $ganadorPartido["equipo"], "goles" => $goles, "ganados" => 1];
                }
            }
        }
        $d = count($ganadoresPartidos);
        $ganados = 1;
        $gol = 0;
        for ($i = 0; $i < $d; $i++) {
            $ganadosXequipo = $ganadoresPartidos[$i]["ganados"];
            $golesXequipo = $ganadoresPartidos[$i]["goles"];
            if ($ganadosXequipo > $ganados && $golesXequipo > $gol) {
                $ganados = $ganadosXequipo;
                $gol = $golesXequipo;
                $ganadorTorneo = $ganadoresPartidos[$i];
            }
        }
        return $ganadorTorneo;
    }

    /** Se calcula el premio del torneo */

    public function obtenerPremioTorneo(){
        $premio = $this->getImportePremio();
        $ganadorTorneo = $this->obtenerEquipoGanadorTorneo();
        $arrayPremio = [$premio, $ganadorTorneo];
        return $arrayPremio;
    }
  
}
