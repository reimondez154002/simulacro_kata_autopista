<?php
class Peaje{

    private ServicioDGT $servicio;

    public function __construct(ServicioDGT $servicio){
        $this->servicio = $servicio;
    }

    public function ejecutar(string $instruccion):string{
        
        return " ";
    }
}

interface ServicioDGT {
    public function obtenerTipoVehiculo(string $matricula): ?string; 
}