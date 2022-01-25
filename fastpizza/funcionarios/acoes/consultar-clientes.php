<?php

require_once "../class/Cliente.php";

$cliente = new Cliente();

if(isset($_GET['clienteId'])){
    $cliente->setId($_GET['clienteId']);
}

$consulta = $cliente->SelectCliente();

foreach ($consulta as $linha) {
    echo '<tr>
        <td><a href="tela-editar-clientes.php?id='.$linha['id'].'">'.$linha['nome'].'</a></td>
        <td>'.$linha['email'].'</td>
        <td>'.$linha['tel'].'</td>
    </tr>';
}

?>