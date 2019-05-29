<?php 
require 'config.php';
require 'classes/carros.class.php';
require 'classes/reservas.class.php';

$carros = new Carros($pdo);
$reservas = new Reservas($pdo);


if(!empty($_POST['carro'])) {
    $carro = addslashes($_POST['carro']);
    $data_inicio = explode('/', addslashes($_POST['data_inicio']));
    $data_fim = explode('/', addslashes($_POST['data_fim']));
    $pessoa = addslashes($_POST['pessoa']);

    $data_inicio = $data_inicio[2].'-'.$data_inicio[1].'-'.$data_inicio[0];
    $data_fim = $data_fim[2].'-'.$data_fim[1].'-'.$data_fim[0];

    if($reservas->verificarDisponibilidade($carro, $data_inicio, $data_fim)) {
        $reservas->reservar($carro, $data_inicio, $data_fim, $pessoa);
        header("Location: index.php");
        exit;
    } else {
        echo "O Carro não está disponivel durante este periodo.";
    }

}


?>

<h1>Adicionar reserva</h1>

<form method="POST">
    Carro:
    <select name="carro">
    <?php
    $lista = $carros->getCarros();

    foreach($lista as $carro):
        ?>
        <Option value="<?php echo $carro['id']; ?>"><?php echo $carro['nome'];  ?></Option>
         <?php 
    endforeach;
    ?>
    </select><br><br>

    Data de inicio: <br>
    <input type="text" name="data_inicio" ><br><br>
    Data de Entrega: <br>
    <input type="text" name="data_fim"> <br><br>

    Nome da pessoa: <br>
    <input type="text" name="pessoa"> <br><br>

    <input type="submit" value="reservar">

</form>