<?php
require_once 'connect.php';
if ($_POST) {
    $pass = $_POST['pass'];
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $email =  $_POST['email'];
    $tel =  $_POST['telefone'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $Sdepartamento = $_POST['departamento'];
    $idsol = $_POST['idsol'];

    function validaCPF($cpf)
    {
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    $sql = "SELECT * FROM func WHERE  email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($linha = $result->fetch_assoc()) {
            echo "Esse nome de usuario($email) já foi cadastrado<br>";
            echo "<a href='../admin.php'><button type='button'>Voltar</button></a>";
            echo "<script>alert('Erro ao cadastrar o EMAIL')</script>";
        }
    } else {
        $sql = "SELECT * FROM func WHERE cpf = '$cpf'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($linha = $result->fetch_assoc()) {
                echo "Esse cpf já foi cadastrado";
                echo "<a href='../admin.php'><button type='button'>Voltar</button></a>";
                echo "<script>alert('Erro ao cadastrar o CPF')</script>";
            }
        } else {
            if (validaCPF($cpf) == TRUE) {
                $sql = "INSERT INTO func VALUES(null,'$Sdepartamento',0,'$nome','$pass','$cpf','$idade','$email','$tel','$rua','$bairro','$cidade','$estado')";
                if ($conn->query($sql) === TRUE) {
                    echo "Cadastro feito com sucesso";
                    echo "<a href='../admin.php'><button type='button'>Voltar</button></a>";
                    $sql2 = "DELETE FROM soli WHERE idsol = {$idsol}";
                    if ($conn->query($sql2) === TRUE) {
                        echo "<p>Solicitação foi feita com sucesso!</p>";
                    }
                } else {
                    echo "CPF inva";
                }
            }
        }
    }
}
