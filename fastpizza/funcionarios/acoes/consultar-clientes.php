<?php

require_once "../class/Cliente.php";

$cliente = new Cliente();

if(isset($_GET['clienteId'])){
    $cliente->setId($_GET['clienteId']);
    //setar objeto cliente (Alterar função "SelectCliente" na classe retornando os dados no construtor)
}

$consultaCliente = $cliente->SelectCliente();

?>