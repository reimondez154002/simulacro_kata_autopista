<?php
class Peaje{

    private ServicioDGT $servicio;
    private float $precio = 5.00;
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
                break;

            case "electrico":
                $this->precio = $this->precio*0.5;
                break;
        }
        
        $precioFormateado = number_format($this->precio, 2, '.', '');

        return "Matricula: $matricula | Total: $precioFormateado";
    }
}

interface ServicioDGT {
    public function obtenerTipoVehiculo(string $matricula): ?string; 
}