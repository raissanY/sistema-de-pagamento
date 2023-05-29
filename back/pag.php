<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="../css/contra.css">
<style>
  #box_form {
    display: flex;
    justify-content: center;
    align-items: center;

  }
</style>
<?php
require_once 'connect.php';

$data_p = $_POST['data_p'];
$horastrabalhadas = $_POST['trabalhadas_h'];
$valorhora = $_POST['valor_h'];
$Snome = $_POST['nome'];
$ano = $_POST['ano'];


$sql = "SELECT f.nome, d.nome_dep
FROM func as f, dep as d
WHERE tipo = 0 and id_f = '$Snome' and d.id_dep = f.id_d ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($linha = $result->fetch_assoc()) {
    $nominho = $linha['nome'];
    $d = $linha['nome_dep'];
  }
}


$salarioBruto = 0;
$iR = 0;
$iNSS = 0;
$fGTS = 0;
$salarioLiquido = 0;
$valeTransporte = 0;

if (empty($_POST['nome']) || empty($_POST['trabalhadas_h']) || empty($_POST['valor_h']) || empty($_POST['data_p'])) {
  echo "<div class='alert alert-danger' role='alert'>Há campos em branco. Insira novamente as informações.</div>";
} else {


  //calc salario bruto
  $salarioBruto = $horastrabalhadas * $valorhora;

  //calc IR
  if ($salarioBruto >= 2743.25) {
    $iR = $salarioBruto * 27.5 / 100;
  } elseif ($salarioBruto >= 1372.25) {
    $iR = $salarioBruto * 15 / 100;
  } else {
    $iR = 0;
  }

  //calc vale transporte

  // $valeTransporte = $salarioBruto * 0.06;
  // if($valeTransporte > 192){
  //     $valeTransporte = 192;
  // }else{
  //     $valeTransporte = $salarioBruto * 0.06;
  // }

  //calc INSS
  if ($salarioBruto >= 2894.28) {
    $iNSS = $salarioBruto - ($salarioBruto - 318.37);
  } elseif ($salarioBruto >= 1447.15) {
    $iNSS = $salarioBruto * 11 / 100;
  } elseif ($salarioBruto >= 868.30) {
    $iNSS = $salarioBruto * 9 / 100;
  } elseif ($salarioBruto <= 868.29) {
    $iNSS = $salarioBruto * 8 / 100;
  }

  //calc FGTS
  $fGTS = $salarioBruto * 8 / 100;

  //calc salario liquido
  $salarioLiquido = $salarioBruto - $iR - $iNSS;

  $sql = "SELECT * FROM pag WHERE data_p = '$data_p' and id_f = '$Snome'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($linha = $result->fetch_assoc()) {
      echo "Você já fez o pagamento esse mês<p></p>";
      echo "<a href='../pag.php'><button type='button'>Voltar</button></a>";
      echo "<a href='../admin.php'><button type='button'>Inicio</button></a>";
    }
  } else {
    $sql = "INSERT INTO pag VALUES(null,'$Snome','$salarioBruto','$iR','$iNSS','$fGTS','$valeTransporte','$salarioLiquido','$horastrabalhadas','$valorhora','$data_p','$ano')";
    if ($conn->query($sql) === TRUE){
      echo "
            <body>
  <div class='container'>
    <h1>Demonstrativo de Pagamento</h1>
    
    <table class='info-table'>
      <tr>
        <th>Nome: </th>
        <td>$nominho</td>
      </tr>

      <tr>
        <th>Departamento:</th>
        <td>$d</td>
      </tr>

      <tr>
      <th>Horas trabalhadas:</th>
      <td>$horastrabalhadas hora(s)</td>
      </tr>

      <tr>
      <th>Valor Hora:</th>
      <td>R$ $valorhora </td>
      </tr>
      
      <tr>
      <th>Mês referente:</th>
      <td>" . $data_p . "</td>
      </tr>

    </table>";

      //organizar valores
      $salarioBruto = number_format($salarioBruto, 2, ',', '.');
      $salarioLiquido = number_format($salarioLiquido, 2, ',', '.');
      $horastrabalhadas = number_format($horastrabalhadas, 2, ',', '.');
      $valeTransporte = number_format($valeTransporte, 2, ',', '.');
      $iR = number_format($iR, 2, ',', '.');
      $fGTS = number_format($fGTS, 2, ',', '.');
      $iNSS = number_format($iNSS, 2, ',', '.');

      echo "
    <h2>Detalhes do Pagamento</h2>
    
    <table class='payment-table'>
      <tr>
        <th>Descrição</th>
        <th>Valor</th>
      </tr>

      <tr>
        <td>Salário Bruto:</td>
        <td> R$ $salarioBruto</td>
      </tr>

      <tr>
        <td>Desconto IR:</td>
        <td> R$ $iR</td>
      </tr>

      <tr>
        <td>Desconto INSS:</td>
        <td> R$ $iNSS </td>
      </tr>

      <tr>
      <td>Desconto FGTS:</td>
      <td> R$ $fGTS </td>
      </tr>
      
      <tr class='total-row'>
        <td>Total a Receber</td>
        <td> R$ $salarioLiquido </td>
      </tr>
    </table>

    <div class='button-container'>
    <a href='../pag.php'><button type='button'>Voltar</button></a>
    <a href='../admin.php'><button type='button'>Inicio</button></a>
    <button onclick='window.print()'>Imprimir</button>
  </div>
  </div>
</body>
</html>
            ";
    }
  }
}

?>