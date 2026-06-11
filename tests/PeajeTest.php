<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Peaje.php';

class PeajeTest extends PHPUnit\Framework\TestCase {
    
    private Peaje $peaje;

    public function test_comprobar_matricula_sin_descuento():void{
        
        //Arrange
        $servicioMock = $this->createMock(ServicioDGT::class);
        $servicioMock->method("obtenerTipoVehiculo")->willReturnCallback(function($matricula){
            if($matricula === "1234bbb"){

                return null;
            }
        });
        $this->peaje = new Peaje($servicioMock);
        //Act
        $resultado = $this->peaje->ejecutar("procesar 1234bbb");
        //Assert
        $this->assertEquals("Matricula: 1234bbb | Total: 5.00",$resultado);
    }

    
    public function test_comprobar_matricula_en_mayusculas():void{
        
        //Arrange
        $servicioMock = $this->createMock(ServicioDGT::class);
        $servicioMock->method("obtenerTipoVehiculo")->willReturnCallback(function($matricula){
            if($matricula === "1234bbb"){

                return null;
            }
        });
        $this->peaje = new Peaje($servicioMock);
        //Act
        $resultado = $this->peaje->ejecutar("procesar 1234BBB");
        //Assert
        $this->assertEquals("Matricula: 1234bbb | Total: 5.00",$resultado);
    }

    public function test_comprobar_accion_que_no_es_procesar():void{
        
        //Arrange
        $servicioMock = $this->createMock(ServicioDGT::class);
        $servicioMock->method("obtenerTipoVehiculo")->willReturnCallback(function($matricula){
            if($matricula === "1234bbb"){

                return null;
            }
        });
        $this->peaje = new Peaje($servicioMock);
        //Act
        $resultado = $this->peaje->ejecutar("comprobar 1234BBB");
        //Assert
        $this->assertEquals("Accion no reconocida",$resultado);
    }

}