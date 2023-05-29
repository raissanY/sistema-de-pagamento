<?Php require_once 'back/connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tela cadastro</title>
  <link rel="stylesheet" href="css/barra_senha.css">
  <link rel="stylesheet" href="css/solicitacao.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</head>

<body>
  <div class="form-container">
    <h2>Solicitação de Cadastro</h2>
    <h2><img src="img/logo.png" alt="Logo" class="logo"></h2>
    <form action="back/solicitacao.php" method="POST">
      <div class="all">

        <div class="form-row">
          <label>Nome Completo</label>
          <input type="text" name="nome" placeholder="Nome Completo" maxlength="50" minlength="2" placeholder="Nome Completo" id="nome_contacto" oninput="converterPrimeiraLetraMaiuscula(this)" required>
        </div>

        <div class="form-row">
          <label>Cep:</label>
          <input name="cep" type="text" id="cep" value="" maxlength="9" onblur="pesquisacep(this.value);" onkeyup="handleZipCode(event)" placeholder="Ex.xxxxx-xxx" required>
        </div>

        <div class="form-row">
          <label>Idade</label>
          <input type="number" name="idade" min="1" placeholder="Idade" required>
        </div>

        <div class="form-row">
          <label>Rua:</label>
          <input name="rua" type="text" id="rua" placeholder="Rua" readonly required>
        </div>

        <div class="form-row">
          <label>CPF</label>
          <input id="cpf" name="cpf" type="text" onkeyup="cpfCheck(this)" placeholder="Ex.xxx.xxx.xxx-xx" maxlength="14" minlength="5" onkeydown="javascript: fMasc( this, mCPF );" required>
          <span id="cpfResponse"></span>
        </div>

        <div class="form-row">
          <label>Bairro:</label>
          <input name="bairro" type="text" id="bairro" placeholder="bairro" readonly required>
        </div>

        <div class="form-row">
          <label for="telefone">Telefone</label>
          <input type="text" id="telefone" name="telefone" onkeyup="handlePhone(event)" placeholder="Ex.(xx) xxxx-xxxx " maxlength="15" minlength="5" required>
        </div>

        <div class="form-row">
          <label>Cidade:</label>
          <input name="cidade" type="text" id="cidade" placeholder="Cidade" readonly required>
        </div>

        <div class="form-row">
          <label>Email</label>
          <input type="email" name="email" placeholder="Ex.funcionario@email.com" maxlength="50" minlength="2" required>
        </div>

        <div class="form-row">
          <label>Estado:</label>
          <input name="estado" type="text" id="uf" placeholder="UF" readonly required>
        </div>


        <div class="form-row">
          <label>Senha</label>
          <div id="impsenha"></div>
          <div id="impforcasenha"></div>
          <div id="requisitosforca"></div>
          <input type="password" name="pass" placeholder="Máximo 16 caracteres" maxlength="50" minlength="6" id="senhaforca" onclick="senhaForca()" required><p></p>
          <button type="button" onclick="gerarSenha()">Gerar Senha Forte</button><p></p>
          <div id="errosenhaforca"></div>
        </div>

        <div class="form-row-senha">
          <input type="submit" value="Enviar">
          <a href="admin.php"><button type="button">Voltar</button></a>
        </div>
        <p></p>

      </div>
      <footer>
        <p>&copy; 2023 Cloud Finance. Todos os direitos reservados.</p>
      </footer>
    </form>
  </div>

</body>

</html>
<script src="js/main.js"></script>
<script>
  function gerarSenhaForte() {
    var caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+~`|}{[]:;?><,./-=";
    var senha = "";
    var comprimento = 16; // Comprimento da senha desejada

    for (var i = 0; i < comprimento; i++) {
      var randomIndex = Math.floor(Math.random() * caracteres.length);
      senha += caracteres.charAt(randomIndex);
    }

    return senha;
  }

  function gerarSenha() {
    var senhaGerada = gerarSenhaForte();
    document.getElementById("senhaforca").value = senhaGerada;
  }
</script>
<script>
  function avaliarForcaSenha() {
    var senha = document.getElementById("senhaforca").value;

    // Defina suas regras de avaliação de senha aqui
    var requisitosForca = {
      comprimentoMinimo: 8,
      possuiLetraMinuscula: /[a-z]/.test(senha),
      possuiLetraMaiuscula: /[A-Z]/.test(senha),
      possuiNumero: /[0-9]/.test(senha),
      possuiCaractereEspecial: /[^a-zA-Z0-9]/.test(senha)
    };

    var forca = 0;

    // Avalie cada requisito de força da senha
    if (senha.length >= requisitosForca.comprimentoMinimo) {
      forca++;
    }

    if (requisitosForca.possuiLetraMinuscula) {
      forca++;
    }

    if (requisitosForca.possuiLetraMaiuscula) {
      forca++;
    }

    if (requisitosForca.possuiNumero) {
      forca++;
    }

    if (requisitosForca.possuiCaractereEspecial) {
      forca++;
    }

    // Exiba a força da senha
    var forcaSenhaElement = document.getElementById("impforcasenha");
    forcaSenhaElement.innerHTML = "Força da Senha: " + forca + "/5";

    // Exiba os requisitos de força da senha
    var requisitosForcaElement = document.getElementById("requisitosforca");
    requisitosForcaElement.innerHTML = "Requisitos de Força: ";

    if (requisitosForca.comprimentoMinimo) {
      requisitosForcaElement.innerHTML += "Comprimento mínimo de " + requisitosForca.comprimentoMinimo + " caracteres. ";
    }

    if (!requisitosForca.possuiLetraMinuscula) {
      requisitosForcaElement.innerHTML += "Pelo menos uma letra minúscula. ";
    }

    if (!requisitosForca.possuiLetraMaiuscula) {
      requisitosForcaElement.innerHTML += "Pelo menos uma letra maiúscula. ";
    }

    if (!requisitosForca.possuiNumero) {
      requisitosForcaElement.innerHTML += "Pelo menos um número. ";
    }

    if (!requisitosForca.possuiCaractereEspecial) {
      requisitosForcaElement.innerHTML += "Pelo menos um caractere especial. ";
    }
  }
</script>