<?php require_once '../connect.php'; ?>
<table border="1">

    <th>Nome</th>
    <th>Departamento</th>
    <th>Salario Liquido</th>
    <?php

    $dep = $_POST['departamento'];

    $sql = "SELECT f.nome, d.nome_dep, p.salario_l
    FROM dep as d, func as f, pag as p
    WHERE f.id_d = $dep and d.id_dep = $dep and f.id_f = p.id_f";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($linha = $result->fetch_assoc()) {

            echo "<tr>";
            echo "<td>" . $linha['nome'] . "</td>";
            echo "<td>" . $linha['nome_dep'] . "</td>";
            echo "<td>" . $linha['salario_l'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td>Sem dados para apresentar<p></p></td></tr>";
    }
    ?>
</table>
<a href='../../relatorio_d.php'><button type='button'>Voltar</button></a>
<a href='../../admin.php'><button type='button'>Inicio</button></a>