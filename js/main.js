// Mascara para cpf
function mascara(i){
    var v = i.value;
    if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
        i.value = v.substring(0, v.length-1);
        return;
    }
    i.setAttribute("maxlength", "14");
    if (v.length == 3 || v.length == 7) i.value += ".";
    if (v.length == 11) i.value += "-";
}


// Macara para Telefone
const handlePhone = (event) => {
  let input = event.target
  input.value = phoneMask(input.value)
}

const phoneMask = (value) => {
  if (!value) return ""
  value = value.replace(/\D/g,'')
  value = value.replace(/(\d{2})(\d)/,"($1) $2")
  value = value.replace(/(\d)(\d{4})$/,"$1-$2")
  return value
}

//Valiação de força da senha
function senhaForca(){
    const senha = document.getElementById('senhaforca').value;
    var forca = 0;
    // alert(senha);
    // document.getElementById('impsenha').innerHTML = "Senha: " + senha;

    if((senha.length >= 4) && (senha.length <= 7)){
        forca += 10;
    }else if(senha.length > 7){
        forca += 25;
    }

    if((senha.length >= 5) && (senha.match(/[a-z]+/))){
        forca += 10;
    }
    if((senha.length >= 6) && (senha.match(/[A-Z]+/))){
        forca += 20;
    }

    if((senha.length >= 7) && (senha.match(/[#@$!%&]/))){
        forca += 25;
    }

    mostrarForca(forca);
}
function mostrarForca(forca){
    // document.getElementById('impforcasenha').innerHTML = "Força: " + forca;

    if(forca < 4){
      document.getElementById('requisitosforca').innerHTML = "Insira pelo menos 4 numeros";
    }else if(forca < 20){
      document.getElementById('requisitosforca').innerHTML = "Insira pelo menos 1 minuscula";
    }else if(forca < 30){
      document.getElementById('requisitosforca').innerHTML = "Insira pelo menos 3 maiuscula";
    }else if(forca < 50){
      document.getElementById('requisitosforca').innerHTML = "Insira pelo menos 3 caracteres especiais";
    }else if(forca > 70){
      document.getElementById('requisitosforca').innerHTML = "ㅤ";
    }

    if(forca < 30){
        document.getElementById('errosenhaforca').innerHTML = "<div style='width: 38px; height: 20px; background-color: #FF0000; border-radius: 15px; color:white;'><center>Fraca</center></div>";
    }else if((forca >= 30) && (forca < 50)){
        document.getElementById('errosenhaforca').innerHTML = "<div style='width: 76px; height: 20px; background-color: #FFA500; border-radius: 15px; color:white;'><center>Media</center></div>";
    }else if((forca >= 50) && (forca < 70)){
        document.getElementById('errosenhaforca').innerHTML = "<div style='width: 114px; height: 20px; background-color: #FFFF00; border-radius: 15px; color:black;'><center>Intermediaria</center></div>";
    }else if((forca >= 70) && (forca < 100)){
        document.getElementById('errosenhaforca').innerHTML = "<div style='width: 150px; height: 20px; background-color: #00FF00; border-radius: 15px; color:white;'><center>Exelente</center></div>";
}
}

//validação cpf
function is_cpf (c) {

  if((c = c.replace(/[^\d]/g,"")).length != 11)
    return false;
    
    if (c.length != 11 ||
      c == "00000000000" ||
      c == "11111111111" ||
      c == "22222222222" ||
      c == "33333333333" ||
      c == "44444444444" ||
      c == "55555555555" ||
      c == "66666666666" ||
      c == "77777777777" ||
      c == "88888888888" ||
      c == "99999999999")
      return false;

  var r;
  var s = 0;

  for (i=1; i<=9; i++)
    s = s + parseInt(c[i-1]) * (11 - i);

  r = (s * 10) % 11;

  if ((r == 10) || (r == 11))
    r = 0;

  if (r != parseInt(c[9]))
    return false;

  s = 0;

  for (i = 1; i <= 10; i++)
    s = s + parseInt(c[i-1]) * (12 - i);

  r = (s * 10) % 11;

  if ((r == 10) || (r == 11))
    r = 0;

  if (r != parseInt(c[10]))
    return false;

  return true;
}


function fMasc(objeto,mascara) {
obj=objeto
masc=mascara
setTimeout("fMascEx()",1)
}

  function fMascEx() {
obj.value=masc(obj.value)
}

function mCPF(cpf){
cpf=cpf.replace(/\D/g,"")
cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
return cpf
}

cpfCheck = function (el) {
    document.getElementById('cpfResponse').innerHTML = is_cpf(el.value)? '<span style="color:green">válido</span>' : '<span style="color:red">inválido</span>' ;
    if(el.value=='') document.getElementById('cpfResponse').innerHTML = '';
}


// PREENCHER COMPO COM CEP
function limpa_formulário_cep() {
  //Limpa valores do formulário de cep.
  document.getElementById('rua').value=("");
  document.getElementById('bairro').value=("");
  document.getElementById('cidade').value=("");
  document.getElementById('uf').value=("");
}

function meu_callback(conteudo) {
if (!("erro" in conteudo)) {
  //Atualiza os campos com os valores.
  document.getElementById('rua').value=(conteudo.logradouro);
  document.getElementById('bairro').value=(conteudo.bairro);
  document.getElementById('cidade').value=(conteudo.localidade);
  document.getElementById('uf').value=(conteudo.uf);
} //end if.
else {
  //CEP não Encontrado.
  limpa_formulário_cep();
  alert("CEP não encontrado.");
}
}

function pesquisacep(valor) {

//Nova variável "cep" somente com dígitos.
var cep = valor.replace(/\D/g, '');

//Verifica se campo cep possui valor informado.
if (cep != "") {

  //Expressão regular para validar o CEP.
  var validacep = /^[0-9]{8}$/;

  //Valida o formato do CEP.
  if(validacep.test(cep)) {

      //Preenche os campos com "..." enquanto consulta webservice.
      document.getElementById('rua').value="...";
      document.getElementById('bairro').value="...";
      document.getElementById('cidade').value="...";
      document.getElementById('uf').value="...";

      //Cria um elemento javascript.
      var script = document.createElement('script');

      //Sincroniza com o callback.
      script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

      //Insere script no documento e carrega o conteúdo.
      document.body.appendChild(script);

  } //end if.
  else {
      //cep é inválido.
      limpa_formulário_cep();
      alert("Formato de CEP inválido.");
  }
} //end if.
else {
  //cep sem valor, limpa formulário.
  limpa_formulário_cep();
}
};

//Mascara para CEP
const handleZipCode = (event) => {
  let input = event.target
  input.value = zipCodeMask(input.value)
}

const zipCodeMask = (value) => {
  if (!value) return ""
  value = value.replace(/\D/g,'')
  value = value.replace(/(\d{5})(\d)/,'$1-$2')
  return value
}

//Sempre a primeira palavra ser maiuscula    
function converterPrimeiraLetraMaiuscula(input) {
  var palavras = input.value.split(" ");
  for (var i = 0; i < palavras.length; i++) {
      var palavra = palavras[i];
      palavras[i] = palavra.charAt(0).toUpperCase() + palavra.slice(1);
  }
  input.value = palavras.join(" ");
}

//Não inserir numero no nome
$('#nome_contacto').keypress(function(e) {
  var keyCode = (e.keyCode ? e.keyCode : e.which); // Variar a chamada do keyCode de acordo com o ambiente.
  if (keyCode > 47 && keyCode < 58) {
    e.preventDefault();
    alert("Apenas letras");
  }
});

//não inserir letra na idade
$('#nome_contacto').keypress(function(e) {
  var keyCode = (e.keyCode ? e.keyCode : e.which); // Variar a chamada do keyCode de acordo com o ambiente.
  if (keyCode > 47 && keyCode < 58) {
    e.preventDefault();
    alert("Apenas letras");
  }
});

