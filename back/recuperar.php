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
        <input type="email" name="email" placeholder="Email Válido Cadastrado" required>
        <input type = "submit" value="Enviar">
</form>

<?php
date_default_timezone_set('America/Sao_Paulo');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once 'connect.php';
require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  // Escapa o e-mail para evitar SQL injection
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $data = strtotime("+ 1 day");
  $dataf = date("Y-m-d", $data);

  // Verifica se o e-mail existe no banco de dados
  $sql = "SELECT * FROM func WHERE email = '$email'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // Gera um token de redefinição de senha
    $token = rand(1,99999999);
    while($row = $result->fetch_assoc()){
          $idf = $row['id_f'];
    }


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_OFF;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->SMTPAuth = true;
$mail->Username = 'financecloudd@gmail.com';
$mail->Password = 'otnttzbwaxfrnpxt';
$mail->setFrom('financecloudd@gmail.com', 'Cloud Finance');
$mail->addAddress($email, 'Destinatário');
$mail->addReplyTo('financecloudd@gmail.com', 'Cloud Finance');
$mail->addCC('financecloudd@gmail.com', 'Cloud Finance');
$mail->addBCC('financecloudd@gmail.com', 'Cloud Finance');

$mail->isHTML(true); 
$mail->Subject = 'Recuperação de Senha';
$mail->Body = "Código para redefinir sua senha:<br>".$token;
$mail->AltBody = 'Recuperção de Senha';

if($mail->send()){
    echo '<br>Um email com as instruções para redefinir sua senha foi enviado para '.$email.'<br>
    Clique em prosseguir para continuar o processo.<br><br>
    <a href="redefinir"><button type="button">Prosseguir</button></a>';


  }
    echo "<a href='../index.php'><button>Voltar</button></a>";

$sql = "INSERT INTO recu VALUES(null,'$token','$idf','$email','$dataf')";
    $conn->query($sql);

  // Fecha a conexão com o banco de dados
  unset($mail);
  }else{
    echo "Email não encontrado em nossa base de dados.<br>
    Insira um email cadastrado.";
  }
}else{
    echo "<br><code>Insira o Email Cadastrado para redefinir a senha.</code>";
  }


?>

