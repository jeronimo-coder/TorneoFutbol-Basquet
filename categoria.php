<?php

class Categoria{
    private $idCategoria;
    private $descripcion;

    public function __construct($id, $descripcion)
    {
        $this->idCategoria = $id;
        $this->descripcion = $descripcion;
    }


    public function getIdCategoria(){
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria){
        $this->idCategoria = $idCategoria;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function __toString()
    {
        $info = "Id de categoria: {$this->getIdCategoria()}\n".
        "Descripción: {$this->getDescripcion()}\n";
        return $info;
    }
}