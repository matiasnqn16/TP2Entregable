<?php
include "Viaje.php";
include "ResponsableV.php";
include "Pasajero.php";

$pasajeros = [] ;

/* ------------------ Creando Viaje ----------------------------*/

    echo "           Bienvenido         \n";
    echo "\n Se tomara datos del nuevo viaje\n";
    echo "Ingrese los datos del responsable del viaje\n";
    echo "\nNombre: ";
    $nombre = trim(fgets(STDIN));
    echo "\nApellido: ";
    $apellido = trim(fgets(STDIN));
    echo "\nNumero de Licencia: ";
    $nroLicencia = trim(fgets(STDIN));
    echo "\nNumero de Empleado: ";
    $nroEmpleado = trim(fgets(STDIN));
    $responsable = new ResponsableV($nroEmpleado,$nroLicencia,$nombre,$apellido);
    echo $responsable;
    echo "\nIngrese el destino del viaje: ";
    $destino = trim(fgets(STDIN));
    echo "\nIngrese la cantidad de asientos del transporte: ";
    $cantMaxAsientos = trim(fgets(STDIN));
    echo "\nDefina el codigo del viaje: ";
    $codigoViaje = trim(fgets(STDIN));
    echo "\n\n";
    $miViaje = new Viaje($codigoViaje,$destino,$cantMaxAsientos,$pasajeros,$responsable);
/* ------------------fin creacion viaje ----------------------- */

/* ---------------------------------SECTOR DE FUNCIONES-------------------------------------------------- */

/* funcion que imprime el menu principal */
/* @return int */
function menuPrincipal(){
    echo "------------------Viaje Feliz--------------------\n";
    echo "--------------///Menu principal///---------------\n";
    echo "1 - Visualizar viaje Actual \n";
    echo "2 - Modificar Destino/Responsable \n";
    echo "3 - Modificar Codigo de Viaje \n";
    echo "4 - Quitar/modificar Pasajeros \n";
    echo "5 - agregar nuevo Pasajero \n";
    echo "6 - visualizar Pasajeros \n";
    echo "7 - ver capacidad maxima y modificar\n";
    echo "8 - Terminar y Salir\n \n";
    do{
		echo "\n" . "Seleccione su opcion: ";
		$selector = trim (fgets(STDIN));
			if($selector > 0 && $selector < 9){
				$retorno = $selector;
			}else{
				echo "la seleccion es invalida"."\n". 
                "Porfavor ingrese una opcion del 1 al 8." . "\n";
				$retorno = 0;
			}
	}while($selector > 9);		
		return ($retorno);
}

/* Opciones para modificar la capacidad maxima */
/* @param object $miViaje */
/* @return void */
function opcionesCapMax($miViaje){
    do{
        echo "\nLa cantidad Maxima de pasajeros es de ".$miViaje->getCantMaxPasajeros()." Personas.\n\n";
        echo "1 - reconfigurar la cantidad de pasajeros\n";
        echo "2 - volver al menu principal\n";
        $opc = trim(fgets(STDIN));
            if($opc == 1){
                echo "\ningrese la nueva capacidad maxima: ";
                $nuevaCapacidad = trim(fgets(STDIN));
                if ($miViaje->cambiarMaxDePasajeros($nuevaCapacidad)){
                    echo "se ha cambiado con exito el maximo de personas!\n";
                }else
                echo "No se puede modificar porque ya hay personas inscriptas que superan ese maximo! :(\n";

            }if($opc == 2){
                return 0;
            }
     }while(1);
}
/* ver la lista de todos los pasajeros */
/* @param object $miViaje */
/* @return void */
function visualizarListaPasajeros($miViaje){
    do{
        print_r($miViaje->listarPasajeros());
        echo "\n \n";
        echo "1 - salir\n";
        $opc = trim(fgets(STDIN));
        if($opc == 1){
            return 0;
        }
    }while (1);
}

/* funcion para agregar mas pasajeros */
/* @param object $miViaje */
/* @return void */
function agregarPasajerosAlViaje($miViaje){
    do{
        echo "Restan ".($miViaje->getCantMaxPasajeros()-count($miViaje->getObjPasajeros()))." Lugares\n";
        if(($miViaje->getCantMaxPasajeros()-count($miViaje->getObjPasajeros())) == 0){
            return 0;
        }
        echo "A continuacion se pediran los datos del pasajero\n";
        do{
            echo "DNI: ";
            $dni=trim(fgets(STDIN));
            if($miViaje->existePasajero($dni)){ //si el dni ya existe pedira otro
                echo "\n-- El pasajero que intenta cargar ya existe en la lista! --\n";
            }else{
                break;
            }
        }while (1);
        echo "Nombre: ";
        $nombre=trim(fgets(STDIN));
        echo "Apellido: ";
        $apellido=trim(fgets(STDIN));
        echo "nro Tel(sin 0 y 15): ";
        $nroTel=trim(fgets(STDIN));
        if ($miViaje->agregarPasajero(new Pasajero($nombre,$apellido,$dni,$nroTel))){
        }else{
            echo "Excede el maximo de personas a bordo\n";
            return 0;
        }
        echo "\nDesea seguir agregando mas pasajeros? (s/n) "; //no creo el if para la opcion s ya que seguira de todas formas el loop
        $sino = trim(fgets(STDIN));
        if($sino == "n"){
            return 0;
        }
    }while(1);
}
/* funcion para cambiar destino o responsable del viaje */
/* @param object $miViaje */
/* @return void */
function cambiarDestinoResponsable($miViaje){
    do{
        echo "\nEl destino actual es: ".$miViaje->getDestino()."\nEl encargado es:\n". 
        $miViaje->getObjResponsableV()."\n\n";
        echo "1 - Cambiar destino\n";
        echo "2 - Cambiar responsable\n";
        echo "3 - volver al menu principal\n";
        echo "Eleccion: ";
        $opc = trim(fgets(STDIN));
        if($opc == 1){
            echo "\nIngrese el nuevo destino: ";
            $nDestino = trim(fgets(STDIN));
            $miViaje->cambiarDestino($nDestino);
        }if($opc == 2){
            echo "\nNombre: ";
            $nombre = trim(fgets(STDIN));
            echo "\nApellido: ";
            $apellido = trim(fgets(STDIN));
            echo "\nNumero de Licencia: ";
            $nroLicencia = trim(fgets(STDIN));
            echo "\nNumero de Empleado: ";
            $nroEmpleado = trim(fgets(STDIN));
            $miViaje->cargarResponsable($nroEmpleado,$nroLicencia,$nombre,$apellido);
        }if($opc == 3){
            return 0;
        }

    }while(1);
}
/* funcion que modifica o quita pasajeros con verificadores incluidos */
/* @param object $miViaje */
/* @return void */
function modificarOQuitarPasajero($miViaje){
    do{
        print_r($miViaje->listarPasajeros());
        echo "\n";
        echo "1 - quitar pasajero\n";
        echo "2 - modificar pasajero\n";
        echo "3 - salir al menu principal\n";
        $opc = trim(fgets(STDIN));
        if($opc == 1){
            echo "Ingrese la posicion del pasajero a quitar: ";
            $quitar = trim(fgets(STDIN));
            if ($miViaje->quitarPasajero($quitar)){
            }else
            echo "esa posicion no existe \n";
        }
        if($opc == 2){
            echo "Ingrese la posicion del pasajero a modificar: ";
            $posicionPasajero = trim(fgets(STDIN));
            if ($posicionPasajero < count($miViaje->getObjPasajeros())+1){
                do{
                    echo "A continuacion se pedira la modificacion de los datos del pasajero\n";
                    do{
                        echo "\nDni actual: ".$miViaje->getObjPasajeros()[$posicionPasajero - 1]->getNroDoc();
                        echo "\nDNI: ";
                        $dni=trim(fgets(STDIN));
                        if($miViaje->existePasajero($dni)){ //si el dni ya existe pedira otro
                            echo "\nese dni ya existe\n";
                        }else{
                            break;
                        }
                    }while (1);
                    echo "\nNombre actual: ".$miViaje->getObjPasajeros()[$posicionPasajero - 1]->getNombre();
                    echo "\nNombre: ";
                    $nombre=trim(fgets(STDIN));
                    echo "\nApellido actual: ".$miViaje->getObjPasajeros()[$posicionPasajero - 1]->getApellido();
                    echo "\nApellido: ";
                    $apellido=trim(fgets(STDIN));
                    echo "\nTel actual: ".$miViaje->getObjPasajeros()[$posicionPasajero - 1]->getNroTel();
                    echo "\nnro Tel(sin 0 y 15): ";
                    $nroTel=trim(fgets(STDIN));
                    $miViaje->modificandoPasajero($posicionPasajero,$nombre,$apellido,$dni,$nroTel);
                    return 0;
                }while(1);
            }else
            echo "esa posicion no existe \n";
        }if($opc == 3){
            return 0;
        }
    }while(1);
}

/* funcion para cambiar codigo de viaje */
/* @param object $miViaje */
/* @return void */
function cambiarCodigoDeViaje($miViaje){
    do{
        echo "\nEl codigo de viaje actual es: ". $miViaje->getCodigoViaje(). "\n\n";
        echo "1 - Cambiar Codigo de viaje\n";
        echo "2 - volver al menu principal\n";
        echo "Eleccion: ";
        $opc = trim(fgets(STDIN));
        if($opc == 1){
            echo "\nIngrese el nuevo codigo de viaje: ";
            $nCodigo = trim(fgets(STDIN));
            $miViaje->cambiarCodigoViaje($nCodigo);
        }if($opc == 2){
            return 0;
        }
    }while(1);
}


/* ------------------------ FIN SECTOR DE FUNCIONES ---------------------------------- */


/* -------------inicio Menu Principal---------- */

do{
    $opcion = menuPrincipal();

    if ($opcion == 1){
        echo $miViaje;
    }
    if ($opcion == 2){
        cambiarDestinoResponsable($miViaje);
    }
    if ($opcion == 3){
        cambiarCodigoDeViaje($miViaje);
    }
    if ($opcion == 4){
        modificarOQuitarPasajero($miViaje);
    }
    if ($opcion == 5){
        agregarPasajerosAlViaje($miViaje);
    }
    if ($opcion == 6){
        visualizarListaPasajeros($miViaje);
    }
    if ($opcion == 7){
        opcionesCapMax($miViaje);
    }
    if ($opcion == 8){
        return 0;
    }

}while(1); 
?>