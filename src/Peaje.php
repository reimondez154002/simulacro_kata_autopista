<?php
class Peaje{

    private ServicioDGT $servicio;

    public function __construct(ServicioDGT $servicio){
        $this->servicio = $servicio;
    }

    public function ejecutar(string $instruccion):string{
        $partesInstruccion = explode(" ",$instruccion);
        $accion  = strtolower($partesInstruccion[0] ?? " ");
        $matricula = strtolower($partesInstruccion[1] ?? " ");

        if($accion !== "procesar"){
            
            return "Accion no reconocida";
        }
        $tipo = $this->servicio->obtenerTipoVehiculo($matricula);
        
        switch ($tipo) {
            case null:
                $precio = 5.00;
        }
        
        $precioFormateado = number_format($precio, 2, '.', '');

        return "Matricula: $matricula | Total: $precioFormateado";
    }
}

interface ServicioDGT {
    public function obtenerTipoVehiculo(string $matricula): ?string; 
}