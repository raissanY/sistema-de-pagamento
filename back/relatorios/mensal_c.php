<?php
require_once '../connect.php';

if ($_POST) {
    $mensal = $_POST['mensal'];
}
?>

<form action="mensal.php" method="POST">
    <label>Selecione o mes referente</label>
    <select name='mes'>
        <?php
        $sql = "SELECT * FROM pag WHERE id_f = '$mensal'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value=" . $row['id_p'] . ">" . $row['data_p'] . "</option>";
            }
        }
        ?>
    </select>
    <button type="submit">Consultar</button>
    <a href="../../relatorio_m.php"><button type="button">Voltar</button></a>
</form>