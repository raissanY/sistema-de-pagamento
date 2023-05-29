<?php
session_start();
require_once 'back/connect.php';
$user = $_SESSION['email'];
$pass = $_SESSION['pass'];
$tipo = $_SESSION['tipo'];
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['pass']) == true) and $tipo == 1) {
    header('location:admin.php');
} else if ($tipo != 1) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatorio Mensal</title>
</head>

<body>
    <form action="back/relatorios/mensal_c.php" method="POST">
        <label>Nome do funcionario </label><br>
        <select name="mensal">
            <?php
            $sql = "SELECT * FROM func WHERE tipo = 0";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=" . $row['id_f'] . ">" . $row['nome'] . "</option>";
                }
            }
            ?>
        </select>
        <p></p>
        <button type="submit">Consultar</button>
        <a href="admin.php"><button type="button">Voltar</button></a>
    </form>
</body>

</html>