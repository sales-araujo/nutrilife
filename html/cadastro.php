<?php
require_once '../classes/usuarios.php';
$u = new Usuario;

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmacao_senha = $_POST['confirmacao_senha'];

    if (!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmacao_senha)) {
        $u->conectar("nutrilife", "localhost", "root", "");

        if ($u->msgErro == "") {
            if ($senha == $confirmacao_senha) {
                if ($u->cadastrar($nome, $email, $senha)) { 
                    $_SESSION['msg-sucesso'] = "Cadastrado com sucesso! Acesse para entrar.";
                    header("Location: cadastro.php"); 
                    exit();
                } else {
                    $_SESSION['msg-erro'] = "Email já cadastrado!";
                    header("Location: cadastro.php");
                    exit();
                }
            } else {
                $_SESSION['msg-erro'] = "Senha e confirmação de senha não correspondem!";
                header("Location: cadastro.php");
                exit();
            }
        }
    } else {
        $_SESSION['msg-erro'] = "Preencha todos os campos!";
        header("Location: cadastro.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Cadastro - NutriLife</title>
  </head>
  <body>
      <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
          <div class="vw-plugin-top-wrapper"></div>
        </div>
      </div>
      <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
      <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
      </script>

      <section class="wrapper-register">
        <img class="image-element-top" src="../assets/images/image-element-top.svg" alt="Image" />
        <div class="container-register">
          <div class="top-container">
            <img src="../assets/icon/icon-logo-nutrilife.svg" alt="Logo pequena da NutriLife" />
            <h2>CADASTRA-SE:</h2>
            <p>Crie sua conta</p>
          </div>
          <form class="middle-container" action="cadastro.php" method="POST">
            <div class="wrapper-input-register">
              <img src="../assets/icon/icon-input01.svg" alt="Icone do input"/>
              <input name="nome" type="text" required placeholder="Digite seu nome" maxlength="30"/>
            </div>
            <div class="wrapper-input-register">
              <img src="../assets/icon/icon-input02.svg" alt="Icone do input"/>
              <input name="email" type="email" required placeholder="Digite seu e-mail" maxlength="40"/>
            </div>
            <div class="wrapper-input-register">
              <img src="../assets/icon/icon-input03.svg" alt="Icone do input"/>
              <input name="senha" type="password" required placeholder="Digite sua senha" maxlength="15"/>
            </div>
            <div class="wrapper-input-register">
              <img src="../assets/icon/icon-input04.svg" alt="Icone do input"/>
              <input name="confirmacao_senha" type="password" required placeholder="Confirme sua senha" maxlength="15"/>
            </div>
            <div class="wrapper-check-register"> 
              <input name="check" type="checkbox" id="check" />
              <label for="check">Mantenha-me informado</label>
            </div>
            <button class="button-submit-form" type="submit">CADASTRAR</button>
          </form>
          <div class="bottom-container">
            <span>Ou continue com</span>
            <div class="container-social-media">
              <a href="https://www.facebook.com/?locale=pt_BR" title="Facebook" target="_blank">
                <img src="../assets/icon/icon-logo-facebook.svg" alt="Icone do Facebook" />
              </a>
              <a href="https://www.google.com.br/" title="Google" target="_blank">
                <img src="../assets/icon/icon-logo-google.svg" alt="Icone do Google" />
              </a>
            </div>
          </div>
        </div>
      </section> 
  </body>
</html>
