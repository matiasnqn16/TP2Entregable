<?php
class Pasajero{
    private $nombre;
    private $apellido;
    private $nroDoc;
    private $nroTel;

    public function __construct($nombre,$apellido,$nroDoc,$nroTel){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nroDoc = $nroDoc;
        $this->nroTel = $nroTel;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getNroDoc(){
        return $this->nroDoc;
    }
    public function getNroTel(){
        return $this->nroTel;
    }
    public function setNombre($new){
        $this->nombre = $new;
    }
    public function setApellido($new){
        $this->apellido = $new;
    }
    public function setNroDoc($new){
        $this->nroDoc = $new;
    }
    public function setNroTel($new){
        $this->nroTel = $new;
    }

    public function __toString(){
        return "Nombre: ".$this->getNombre()."\n". 
        "Apellido: ".$this->getApellido()."\n". 
        "Num. Documento: ".$this->getNroDoc()."\n". 
        "Telefono: ".$this->getNroTel()."\n";
    }
}