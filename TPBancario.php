<?php
class Banco {
    private $persona;
    public bool $seguiroperando = true;
    public bool $cajadeahorro = false;
    public bool $cuentacorriente = false;
    public $nombre;
    public $clientes=[];

    public function __construct() {
        $this->nombre = "Banco Galicia";  // Inicialización del nombre del banco
    }
    public function inicioBanco(){
     echo "Bienvenido, Usted es:\n 1)Administrador\n 2)Cliente\n 3)NuevoCliente\n ";
     $inicio = trim(fgets(STDIN));
     switch($inicio){
        case 1: $this-> administrador();
        break;
        case 2: $this-> clienteviejo();
        break;
        case 3: $cliente= new cliente(); 
        $cliente -> crearCliente();
        $this->cliente[]= $cliente;
        default: echo "Nos vemos luego." ;
        break;
     }
    }

    public function administrador(){
        echo "Ingrese contraseña (7777)";
        $confirmacion= trim(fgets(STDIN));
        if($confirmacion == "7777"){
            echo "Bienvenido Administrador\n Que tarea quiere realizar? \n 1)Consultar clientes con saldos negativos \n 2)Calcular balance (Suma de todos los activos de los clientes, restando el saldo negativo) \n 3)Volver al menu principal\n";
            $opcionadmin = trim(fgets(STDIN));
            switch($opcionadmin){
                case 1: $this->saldosNegativos(); break;
                case 2: break;
                case 3: 
                    $this->inicioBanco();
                break;
                default: echo "Opcion incorrecta, Disculpe";
                break;
            }
            }else{
                echo "Contraseña incorrecta";
                return;
            }
    }

    public function saldosNegativos(){
        $negativos = false;
        foreach($this->clientes as $cliente){
            if (($cliente->cajadeahorro && $cliente->caja < 0) || ($cliente->cuentacorriente && $cliente->cuenta < 0)) {
                $negativos = true;
                echo "Nombre: " . $cliente->persona . "\n";
                echo "Saldo: " . ($cliente->cuenta) . " pesos\n";
                echo "-------------------------\n";
            }
        }
        if (!$negativos) {
            echo "No hay clientes con saldos negativos.\n";
        }
    
}}

class Cliente extends Banco {
  public $caja = 0;  // Inicialización del saldo de la caja de ahorro
  public $cuenta = 0;  // Inicialización del saldo de la cuenta corriente
  public $nombrecliente ;
  public $cuentaposee;
  public $saldo;

    public function __construct(){
      
    }


  public function crearCliente() {
    echo "Escriba su nombre: \n";
    $decisionnombre = trim(fgets(STDIN));
    $this->persona = $decisionnombre;
    echo "Usted desea crear:\n1) Caja de ahorro \n2) Cuenta corriente\n";
    $decisioncuenta = trim(fgets(STDIN));
    
    
    if ($decisioncuenta == 1) {
        $this->cajadeahorro = true;
        echo "Bienvenido " . $this->persona . " usted ha creado una Caja de Ahorro satisfactoriamente \n";  // Mensaje corregido
    } else if ($decisioncuenta == 2) {
        $this->cuentacorriente = true;
        echo "Bienvenido " . $this->persona . " usted ha creado una Cuenta Corriente satisfactoriamente \n";  // Mensaje corregido
    } else {
        echo "Opción no válida";  // Corrección de la opción no válida
        return;
    }

    echo "¿Qué operación quiere realizar?:\n1) Consultar Saldo\n2) Extracción\n3) Depósito\n";
    $operacion = trim(fgets(STDIN));
    switch ($operacion) {
        case 1:
            $this->consultarSaldo();  // Corrección del nombre del método
            break;
        case 2:
            $this->extraerDinero();  // Corrección del nombre del método
            break;
        case 3:
            $this->depositarDinero();  // Corrección del nombre del método
            break;
        default:
            echo "Operación no válida\n";  // Mensaje corregido
            break;
    }
}
public function clienteviejo(){
    echo "¿Qué operación quiere realizar?:\n1) Consultar Saldo\n2) Extracción\n3) Depósito\n";
    $operacioncliente = trim(fgets(STDIN));
    switch ($operacioncliente) {
        case 1:
            $this->consultarSaldo();  // Corrección del nombre del método
            break;
        case 2:
            $this->extraerDinero();  // Corrección del nombre del método
            break;
        case 3:
            $this->depositarDinero();  // Corrección del nombre del método
            break;
        default:
            echo "Operación no válida\n";  // Mensaje corregido
            break;
    }
}

public function consultarSaldo() {
    if ($this->cajadeahorro) {  // Corrección del acceso a la propiedad
        echo "Su caja de ahorro posee " . $this->caja . " pesos\n";  // Mensaje corregido
    } else if ($this->cuentacorriente) {  // Corrección del acceso a la propiedad
        echo "Su cuenta corriente posee " . $this->cuenta . " pesos\n";  // Mensaje corregido
    }
}

public function extraerDinero() {
    echo "¿Cuánto dinero desea extraer?\n";
    $dinero = trim(fgets(STDIN));

    if ($this->cajadeahorro && $this->caja > 0) {  // Corrección de la comparación lógica
        $this->caja -= $dinero;  // Actualización correcta del saldo
        echo "Extracción lograda con éxito, su saldo es " . $this->caja . " pesos\n";  // Mensaje corregido
    } else if ($this->cuentacorriente == true) {  // Corrección de la comparación lógica
        $this->cuenta -= $dinero;  // Actualización correcta del saldo
        echo "Extracción lograda con éxito, su saldo es " . $this->cuenta . " pesos\n 1)Realizar otra operacion \n 2)Volver al menu principal";  // Mensaje corregido
        $otraoperacion = trim(fgets(STDIN));
        switch ($otraoperacion){
            case 1: $this->clienteviejo();
            break;
            case 2: $this->inicioBanco();
            break;
            default: echo "Opcion Incorrecta, el programa terminara, Hasta pronto";
        }

    } else {
        echo "Usted no posee saldo suficiente\n";  // Mensaje corregido
    }
}

public function depositarDinero() {
    echo "¿Dónde desea depositar el dinero?\n1) Mi cuenta corriente\n2) Mi caja de ahorro\n";
    $decisiondeposito = trim(fgets(STDIN));

    if ($decisiondeposito == 1 && $this->cuentacorriente) {  //
      echo "¿Cuánto dinero quiere depositar en su cuenta corriente?\n";
      $deposito = trim(fgets(STDIN));
      $this->cuenta += $deposito;  // Actualización correcta del saldo
      echo "Depósito realizado con éxito, su saldo en la cuenta corriente es " . $this->cuenta . " pesos\n";  // Mensaje corregido
  } else if ($decisiondeposito == 2 && $this->cajadeahorro) {  // Corrección del acceso a la propiedad
      echo "¿Cuánto dinero quiere depositar en su caja de ahorro?\n";
      $depositocaja = trim(fgets(STDIN));
      $this->caja += $depositocaja;  // Actualización correcta del saldo
      echo "Depósito realizado con éxito, su saldo en la caja de ahorro es " . $this->caja . " pesos\n";  // Mensaje corregido
  } else {
      echo "Operación no válida\n";  // Mensaje corregido
  }
}
}

// Crear instancia de Cliente y ejecutar el proceso
$cliente = new Banco();
$cliente->inicioBanco();
?>
