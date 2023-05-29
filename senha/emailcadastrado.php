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
    <a href="funcionario.php">Tela Inicial</a> >> <a href="redefinir.php">Redefinição de senha</a>
    <h2>Redefinição de senha</h2>
        <form method="post" action="recuperar.php">
        <code>Insira o Email Cadastrado para redefinir a senha:</code><br><br>
        <input type="email" name="email" placeholder="Email Válido Cadastrado" required>
        <input type = "submit" value="Enviar">
</form>
