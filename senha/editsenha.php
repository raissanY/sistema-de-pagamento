<?php require_once '../back/connect.php';
if ($_POST) {
    $senha = $_POST['senha'];
    $id = $_POST['id_f'];
    $token = $_POST['token'];
    $sql2 = "UPDATE func SET pass = '$senha' WHERE id_f = '$id'";
    if ($conn->query($sql2) === TRUE) {
        echo "Senha atualizada com sucesso!<br><br>
            <a href='../index.php'><button type='button'>Voltar</button></a>";
        $sql3 = "DELETE FROM recu WHERE token = '$token'";
        if ($conn->query($sql3) == TRUE) {
        } else {
            echo 'erro';
        }
    } else {
        echo "Erro! Tente novamente.";
    }
}
