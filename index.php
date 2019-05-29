<?php 
require 'config.php';
require 'classes/reservas.class.php';


$reservas = new Reservas($pdo);
?>

<a href="reservar.php">Adicionar reserva</a>


<h1>Reservas</h1>
<?php
$lista = $reservas->getReservas();
foreach($lista as $item) {
    $data1 = date('d/m/Y', strtotime($item['data_inicio']));
    $data2 = date('d/m/Y', strtotime($item['data_fim']));
    echo $item['pessoa'].' Reservou o carro '.$item['id_carro'].' entre '.$data1.' e '.$data2.'</br>';
}
?>

<hr>
<?php 
require 'calendario.php';
?>