<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Recuperação de Senha</title>
    <a href="../index.php"><button>Cancelar</button></a>
</head>
<body>   
    <h2>Redefinição de senha</h2>
    <code>Verifique seu email e digite o código enviado para continuar.</code><br><br>
        <form method="post">
        <input type="text" name="token" placeholder="Código Recebido" required><br><br>
        <input type = "submit" value="Prosseguir">
</form>
<a href="../index.php"><button>Cancelar</button></a>
<?php require_once '../back/connect.php';
if($_POST){
$token = $_POST['token'];
$sql = "SELECT * FROM recu WHERE token = '$token'";
$result = $conn->query($sql);
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
            if($row['data'] > date('Y-m-d')){?>
            <br><br><fieldset>
                <legend>Editar Senha</legend>
                <form action="editsenha.php" method="post">
                    
                        <br>Digite Sua Nova Senha
                           <input type="password" name="senha" placeholder="Nova Senha">
                            <input type="hidden" name="id_f" value="<?php echo $row['id_f'] ?>"/><br><br>
                           <button type="submit" name="qualquer">Salvar Alterações</button>
                         <input type="hidden" name="token" value="<?php echo $token ?>">
                 </form> </fieldset>
    <?php
     }else{
            echo "Tempo para redefinição de senha expirado. Tente novamente.
            <br><a href='../index.php'><button type='button'>Tentar Novamente.</button></a>";
            $sql4 = "DELETE FROM recu WHERE token = '$token'";
            if($conn -> query($sql4) == TRUE){}else{echo 'erro';}
            }
        }}else{
            echo "Digite o token corretamente!";
        }
    }
        
            ?>
