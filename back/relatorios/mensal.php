<?php
require_once '../connect.php';
?>
<table>
    <thead>
        <tr>
            <th>Horas trabalhadas</th>
            <th>Valor por horas</th>
            <th>Data pagamento</th>
            <th>Salario liquido</th>
        </tr>
        <?php
        $mes = $_POST['mes'];

        $sql = "SELECT * from pag WHERE id_p = '$mes'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['trabalhadas_h'] . "</td>";
                echo "<td>" . $row['valor_h'] . "</td>";
                echo "<td>" . $row['data_p'] . "</td>";
                echo "<td>" . $row['salario_l'] . "</td>";
                echo "</tr>";
                echo "<a href='../../relatorio_m.php'><button type='button'>Voltar</button></a>";
                echo "<a href='../../admin.php'><button type='button'>Inicio</button></a>";
            }
        }

        ?>
    </thead>
</table>