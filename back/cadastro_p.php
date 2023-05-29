<?php
require_once 'connect.php';

if ($_POST) {
    $nomed = $_POST['nome_dep'];


    $sql = "SELECT * FROM dep WHERE nome_dep = '$nomed'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($linha = $result->fetch_assoc()) {
            echo "Esse departamento já está cadastrado";
            echo "<a href='../cadastro_p.php'><Button type='button'>Voltar</Button></a>";
            echo "<a href='../admin.php'><Button type='button'>Inicio</Button></a>";
        }
    } else {
        $sql = "INSERT INTO dep VALUE (null,'$nomed')";
        if ($conn->query($sql) === TRUE) {
            echo "Cadastro feito com sucesso";
            echo "<a href='../cadastro_p.php'><Button type='button'>Voltar</Button></a>";
            echo "<a href='../admin.php'><Button type='button'>Inicio</Button></a>";
        }
    }
}
