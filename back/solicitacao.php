<?php
require_once 'connect.php';

if ($_POST) {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $tele = $_POST['telefone'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];
    $pass = $_POST['pass'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    function validaCPF($cpf)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
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

    $sql = "SELECT * FROM func WHERE cpf = '$cpf'"; //verifica a tabela do funcionario
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($linha = $result->fetch_assoc()) {
            echo "Esse cpf já foi cadastrado";
        }
    } else {
        $sql = "SELECT * FROM func WHERE email='$email'"; //verifica a tabela do funcionario
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($linha = $result->fetch_assoc()) {
                echo "Esse email ($email) já foi cadastrado<br>";
            }
        } else {
            $sql = "SELECT * FROM soli WHERE email = '$email'"; //verifica a tabela da solicitação
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($linha = $result->fetch_assoc()) {
                    echo "Esse email ($email) já foi cadastrado<br>
                    Verifique se seu cadastro já foi autorizado. Caso não, espere a aprovação que será enviado para seu email.";
                }
            } else {
                $sql = "SELECT * FROM soli WHERE cpf = '$cpf'"; //verifica a tabela da solicitação
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($linha = $result->fetch_assoc()) {
                        echo "Esse cpf já foi cadastrado<br>
                         Verifique se seu cadastro já foi autorizado. Caso não, espere a aprovação que será enviado para seu email.";
                    }
                } else {
                    if (validaCPF($cpf) == TRUE) {
                        $sql = "INSERT INTO soli VALUES(null,'$nome','$cpf','$email','$tele','$idade','$pass','$rua','$bairro','$cidade','$estado')";
                        if ($conn->query($sql) === TRUE) {
                            echo "Pedido de solicitação enviado com sucesso.<br>
                            Será enviado uma mensagem para o email salvo quando seu cadastro for atualizado.<br>
                            Aguarde até que seu cadastro seja autorizado.";
                            echo "<a href='../index.php'><button type='button'>Voltar</button></a>";
                        }
                    } else {
                        echo "Esse cpf não existe ou está escrito errado, reveja e tente novamente.<br>";
                        echo "<a href='../index.php'><button type='button'>Voltar</button></a>";
                        echo "<script>alert('CPF INVALIDO')</script>";
                    }
                }
            }
        }
    }
}
