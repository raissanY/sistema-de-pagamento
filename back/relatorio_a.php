<?php
require_once 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Document</title>
</head>
<body>
    <table border="1">
    <thead>
        <tr>
            <th>Horas trabalhadas</th>
            <th>Valor por horas</th>
            <th>Data pagamento</th>
            <th>Salario liquido</th>
            <th>IR</th>
            <th>FGTS</th>
            <th>INSS</th>
        </tr>
        <?php

        $func_anual = $_POST['func_anual'];

        $sql = "SELECT * from pag WHERE id_f = '$func_anual'";
        $result = $conn->query($sql);
        $total = 0.0;
        // $cont = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){
                $total+=$row['salario_l'];
                // @$media+=$row['salario_l'];
                // $cont+=1;
                $soma_total = number_format($total, 3, ',', '.');
                // $calc2 = $media / $cont;
                // $media_total = number_format($calc2, 3, ',', '.');
                echo "<tr>";
                echo "<td>" . $row['trabalhadas_h'] . "</td>";
                echo "<td>" . $row['valor_h'] . "</td>";
                echo "<td>" . $row['data_p'] . "</td>";
                echo "<td>" . $row['salario_l'] . "</td>";
                echo "<td>" . $row['IR'] . "</td>";
                echo "<td>" . $row['FGTS'] . "</td>";
                echo "<td>" . $row['INSS'] . "</td>";
                echo "</tr>";
            }
        }
    
        ?>
    </thead>
</table>
<h3>Valor total: <?php echo "R$ ".$soma_total; ?></h3>
<!-- <h3>Valor Media: </h3> -->
<p></p>
<a href='../relatorio_a.php'><button type='button'>Voltar</button></a>
<a href='../admin.php'><button type='button'>Inicio</button></a>
<div id="piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>

            