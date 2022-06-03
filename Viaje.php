<?php
class Viaje{
    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $objPasajeros;
    private $objResponsable;

    public function __construct($codigoViaje,$destino,$cantMaxPasajeros,$objPasajeros,$objResponsable){
        $this->codigoViaje = $codigoViaje;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        $this->objPasajeros = $objPasajeros;
        $this->objResponsable = $objResponsable;
    }

    public function getCodigoViaje(){
        return $this->codigoViaje;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }
    public function getObjPasajeros(){
        return $this->objPasajeros;
    }
    public function getObjResponsableV(){
        return $this->objResponsable;
    }

    public function setCodigoViaje($codigoViajeN){
        $this->codigoViaje = $codigoViajeN;
    }
    public function setDestino($destinoN){
        $this->destino = $destinoN;
    }
    public function setCantMaxPasajeros($cantMaxPasajerosN){
        $this->cantMaxPasajeros = $cantMaxPasajerosN;
    }
    public function setObjPasajeros($objPasajerosN){
        $this->objPasajeros = $objPasajerosN;
    }
    public function setObjResponsableV($objResponsableN){
        $this->objResponsable = $objResponsableN;
    }

    /* funcion que cambia destino */
    /* @param string $nuevoDestino */
    /* @return void */
    public function cambiarDestino($nuevoDestino){
        $this->setDestino($nuevoDestino);
    }
    /* funcion que cambia codigo del viaje */
    /* @param int $nuevoCodigo */
    /* @return void */
    public function cambiarCodigoViaje($nuevoCodigo){
        $this->setCodigoViaje($nuevoCodigo);
    }
    /* funcion que cambia la cantidad maxima de pasajeros dependiendo de los pasajeros inscriptos */
    /* @param int $nuevaCantidad */
    /* @return boolean */
    public function cambiarMaxDePasajeros($nuevaCantidad){
        $banderin = false;
        if($nuevaCantidad > count($this->getObjPasajeros())-1){
            $this->setCantMaxPasajeros($nuevaCantidad);
            $banderin = true;
        }else
        return $banderin;
    }
    /* funcion que agrega pasajeros hasta que supere la capacidad maxima */
    /* @param array $arrayNuevosPasajeros */
    /* @return boolean */
    public function agregarPasajero($arrayNuevosPasajeros){
        $banderin = false;
        if (count($this->getObjPasajeros()) < $this->getCantMaxPasajeros()){
            $screenshotDatosPasajeros = $this->getObjPasajeros();
            array_push($screenshotDatosPasajeros,$arrayNuevosPasajeros);
            $this->setObjPasajeros($screenshotDatosPasajeros);
            $banderin = true;
        }else
        return $banderin;
    }
    /* funcion que quita pasajero segun su posicion dentro del array asociativo */
    /* @param int $posicionPasajero */
    /* @return boolean */
    public function quitarPasajero($posicionPasajero){
        $banderin = false;
        if ($posicionPasajero < count($this->getObjPasajeros())+1){
            $screenshotDatosPasajeros = $this->getObjPasajeros();
            unset($screenshotDatosPasajeros[($posicionPasajero-1)]);
            $this->setObjPasajeros(array_values($screenshotDatosPasajeros));
            $banderin = true;
        }else
        return $banderin;
    }
    /* funcion para listar pasajeros en una variable iterando desde un recorrido de un array */
    /* @return string */
    public function listarPasajeros(){
        $texto = "pos -  Nombre y Apellido   -   Dni     -  Nro Tel\n";
        foreach($this->getObjPasajeros() as $val => $dat){
            $texto .= "| ".($val+1)." "." -  ".$dat->getNombre()." ".$dat->getApellido()." - ".$dat->getNroDoc()." - ".$dat->getNroTel()."\n";
        }
        return $texto;
    }

    /* funcion que verifica que el dni no se repita de la lista de pasajeros */
    /* @param int $dniPasajero */
    /* @return boolean */
    public function existePasajero($dniPasajero){
        $i = 0;
        $existe = false;
        $listaDeDni = [];
        foreach($this->getObjPasajeros() as $val => $dat){
            $listaDeDni[$val] = ($dat->getNroDoc());
        }
        do{
            if(count($listaDeDni) == 0){ // condicion para tapar el warning por no tener pasajeros
            }else{
            if($listaDeDni[$i] == $dniPasajero){
                $existe = true;
            }
            $i++;}
        }while ($i < count($listaDeDni));
        
        return $existe;
    }
    /* funcion que reemplaza el lugar del objeto por otro nuevo */
    /* @param int $posicionPasajero $dni $nroTel */
    /* @param string $nombre $apellido */
    /* @return void */
    public function modificandoPasajero($posicionPasajero,$nombre,$apellido,$dni,$nroTel){
        $screenshotDatosPasajeros = $this->getObjPasajeros();
        $screenshotDatosPasajeros[$posicionPasajero - 1] = new Pasajero($nombre,$apellido,$dni,$nroTel);
        $this->setObjPasajeros($screenshotDatosPasajeros);
    }

    /* funcion para cargar responsable de viaje */
    /* @param int $nroEmpleado $nroLicencia */
    /* @param string $nombre $apellido */
    /* @return void */
    public function cargarResponsable($nroEmpleado,$nroLicencia,$nombre,$apellido){
        $this->setObjResponsableV(new ResponsableV($nroEmpleado,$nroLicencia,$nombre,$apellido));
    }
    
    public function __toString(){
        return "\nviaje n° ".$this->getCodigoViaje()."\n"."Responsable:".$this->getObjResponsableV(). 
        "Con destino a: ".$this->getDestino()."\n". 
        "Cant. Max. de pasajeros ".$this->getCantMaxPasajeros()."\n". 
        "Cantidad de pasajeros: ".count($this->getObjPasajeros())."\n". 
        "Pasajeros:\n ".$this->listarPasajeros()."\n\n";
    }
}
?>