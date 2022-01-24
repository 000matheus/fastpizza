<?php

require_once "../class/Cliente.php";

$cliente = new Cliente();

if(isset($_GET['clienteId'])){
    $cliente->setId($_GET['clienteId']);
}

$consulta = $cliente->SelectCliente();

foreach ($consulta as $linha) {
    echo $linha['nome'].' | '.$linha['email'].'<br>';
}

?>