<?php 
class Agencia {
    public $stock = [];
    public $valortotal=0;
    
    public function AgregarAuto($ingreso) {
        $this->stock[] = $ingreso;
    }

    public function getInventario() {
        return $this->stock;
    }

    public function VenderAuto($autovendido) {
        foreach ($this->stock as $key => $auto) {
            if ($auto->modelo == $autovendido->modelo && $auto->marca == $autovendido->marca && $auto->precio == $autovendido->precio) {
                unset($this->stock[$key]); // Elimina el auto del inventario
                break; // Sal del bucle después de encontrar y eliminar el auto
            }
        }
    }

    public function ValorTotal(){
        $this -> ValorTotal= 0;
        foreach($this->stock as $auto){
            $this->valortotal += $auto->precio;
        }
        return $this->valortotal;
    }
}

class Auto {
    public $modelo;
    public $marca;
    public $precio;

    public function __construct($modelo, $marca, $precio) {
        $this->modelo = $modelo;
        $this->marca = $marca;
        $this->precio = $precio;
    }
}

$auto1 = new Auto(1997, "Ford", 4000);
$auto2 = new Auto(1990, "Chevrolet", 24000);

$agencia = new Agencia();
$agencia->AgregarAuto($auto1);
$agencia->AgregarAuto($auto2);

$inventario = $agencia->getInventario();

foreach ($inventario as $auto) {
    echo "Auto modelo: " . $auto->modelo . ", Marca: " . $auto->marca . ", Precio: " . $auto->precio . "\n";
}

// Vender un auto
$autoVendido = new Auto(1997, "Ford", 4000);
$agencia->VenderAuto($autoVendido);

// Mostrar inventario después de la venta
$inventario = $agencia->getInventario();

foreach ($inventario as $auto) {
    echo "Auto modelo: " . $auto->modelo . ", Marca: " . $auto->marca . ", Precio: " . $auto->precio . "\n";
}

echo "el valor total de los autos en la agencia es igual a = ". $agencia->ValorTotal()
?>
