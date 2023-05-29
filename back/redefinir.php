<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Recuperação de Senha</title>
</head>

<body>

    <h2>Redefinição de senha</h2>
    <form method="post">
        <input type="text" name="token" placeholder="Código Recebido" required>
        <input type="submit" value="Enviar">
    </form>
    <?php
    if ($_POST) {
        $token = $_POST['token'];
        $sql = "SELECT * FROM recu WHERE token = '$token'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            }
        }
    }
    ?>