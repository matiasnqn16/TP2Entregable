<?php
class ResponsableV{
    private $nroEmpleado;
    private $nroLicencia;
    private $nombre;
    private $apellido;

    public function __construct($nroEmpleado,$nroLicencia,$nombre,$apellido){
        $this->nroEmpleado = $nroEmpleado;
        $this->nroLicencia = $nroLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function getNroEmpleado(){
        return $this->nroEmpleado;
    }
    public function getNroLicencia(){
        return $this->nroLicencia;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function setNroEmpleado($new){
        $this->nroEmpleado = $new;
    }
    public function setNroLicencia($new){
        $this->nroLicencia = $new;
    }
    public function setNombre($new){
        $this->nombre = $new;
    }
    public function setApellido($new){
        $this->apellido = $new;
    }

    public function __toString(){
        return "\nNombre y Apellido: ".$this->getNombre()." ".$this->getApellido()."\n".
        "N° Empleado: ".$this->getNroEmpleado()." - ".
        "N° Licencia: ".$this->getNroLicencia()."\n";
    }
}