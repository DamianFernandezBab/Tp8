<?php

class Diagrama {
    public $figuras = [];
    
    public function __construct() {
        // La inicialización de $figuras ya se hace en la declaración de la propiedad
    }

    public function add($figura) {
        $this->figuras[] = $figura;
    }

    public function sumarAreas() {
        $suma = 0;
        foreach ($this->figuras as $figura) {
            $suma += $figura->area;
        }
        return $suma;
    }
}

class Circulo {
    public $radio;
    public $area;
    public $nombre = "Circulo";

    public function __construct($radio) {
        $this->radio = $radio;
        $this->calcularArea();
    }

    public function calcularArea() {
        $this->area = M_PI * pow($this->radio, 2);
    }
}

class Cuadrado {
    public $largo;
    public $ancho;
    public $area;

    public function __construct($largo, $ancho) {
        $this->largo = $largo;
        $this->ancho = $ancho;
        $this->calcularArea();
    }

    public function calcularArea() {
        $this->area = $this->largo * $this->ancho;
    }
}

// Ejemplo de uso:
$diagrama = new Diagrama();

$circulo = new Circulo(100);
$cuadrado = new Cuadrado(2, 5);

$diagrama->add($circulo);
$diagrama->add($cuadrado);

echo "La suma de las áreas es: " . $diagrama->sumarAreas();
?>
