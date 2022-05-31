<?php

include_once('fultbol.php');
include_once('basquet.php');
include_once('nacional.php');
include_once('provincial.php');
include_once('categoria.php');
include_once('equipo.php');
include_once('categoria.php');
include_once('ministerioDeporte.php');

$categoriaMenores = new Categoria(1, "Menores");
$categoriaJuveniles = new Categoria(2, "Juveniles");
$categoriaMayores = new Categoria(3, "Mayores");

$objEquipo1 = new Equipo("Diablos", "Andres Gimenez", 10, $categoriaJuveniles);
$objEquipo2 = new Equipo("Valle", "Julian Ortigoza", 10, $categoriaJuveniles);
$objEquipo3 = new Equipo("Italianos", "Pedro Mendez", 10, $categoriaJuveniles);
$objEquipo4 = new Equipo("Regina", "Flavio Perez", 10, $categoriaJuveniles);

$torneoNacional = new Nacional(2, [], 3000, "Villa Regina");
$torneoNacional->ingresarPartido($objEquipo1, $objEquipo2, "10/04/2022", "futbol");
$torneoNacional->ingresarPartido($objEquipo3, $objEquipo4, "10/04/2022", "futbol");
$torneoNacional->ingresarPartido($objEquipo1, $objEquipo3, "13/04/2022", "futbol");
$torneoNacional->ingresarPartido($objEquipo2, $objEquipo4, "13/04/2022", "futbol");
$torneoNacional->ingresarPartido($objEquipo1, $objEquipo4, "16/04/2022", "futbol");
$torneoNacional->ingresarPartido($objEquipo2, $objEquipo3, "16/04/2022", "futbol");


$torneoNacional->ingresarResultadoPartido(1, 0, 3);
$torneoNacional->ingresarResultadoPartido(2, 3, 4);
$torneoNacional->ingresarResultadoPartido(3, 3, 1);
$torneoNacional->ingresarResultadoPartido(4, 0, 2);
$torneoNacional->ingresarResultadoPartido(5, 1, 0);
$torneoNacional->ingresarResultadoPartido(6, 2, 1);


/* print_r($torneoNacional->obtenerEquipoGanadorTorneo()); */

/* echo $torneoNacional->obtenerPremioTorneo(); */

$arrayAsociativo = ["id" => 1,"importePremio" => 3000, "localidad" => "Villa Regina", "provincia" => "Rio Negro"];

$ministerioDeporte = new MinisterioDeporte(2022, []);

$ministerioDeporte->registrarTorneo([], "provincial", $arrayAsociativo);

echo $ministerioDeporte;

