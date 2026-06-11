<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Peaje.php';

class PeajeTest extends PHPUnit\Framework\TestCase {
    
    private Peaje $peaje;

    public function setUp():void{
        //Arrange
        $servicioMock = $this->createMock(ServicioDGT::class);
        $servicioMock->method("obtenerTipoVehiculo")->willReturnCallback(function($matricula){
            if($matricula === "1234bbb"){

                return null;
            }
        });
        $this->peaje = new Peaje($servicioMock);
    }

    public function test_comprobar_matricula_sin_descuento():void{
        //Ejecutar accion
        $resultado = $this->peaje->ejecutar("procesar 1234bbb");
        //Comprobar
        $this->assertEquals("Matricula: 1234bbb | Total: 5.00",$resultado);
    }

    public function test_comprobar_matricula_en_mayusculas():void{
        //Ejecutar accion
        $resultado = $this->peaje->ejecutar("procesar 1234BBB");
        //Comprobar
        $this->assertEquals("Matricula: 1234bbb | Total: 5.00",$resultado);
    }

    public function test_comprobar_accion_que_no_es_procesar():void{
        //Ejecutar accion
        $resultado = $this->peaje->ejecutar("comprobar 1234BBB");
        //Comprobar
        $this->assertEquals("Accion no reconocida",$resultado);
    }
}