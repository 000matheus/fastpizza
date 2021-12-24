<?php

require_once "../../class/Cliente.php";

$cliente = new Cliente();

$cliente->Login($_POST['email'], $_POST['senha'], "../");

?>