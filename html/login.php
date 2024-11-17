<?php 
require_once '../classes/usuarios.php';
$u = new Usuario;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="NUTRILIFE" content="width=device-width, initial-scale=1.0">
    <title>NutriLife</title>
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    <div id="dov">
        <img src="../assets/img/Logan.png" alt="Imagem de Logotipo">
    </div>

    <h1>Bem-vindo</h1>
    <h3>Acessar sua conta?</h3>
    
    <div class="quadrado">
        <div class="input-container">
            <i class="fas fa-user icon"></i>
            <input type="email" placeholder="E-mail" required>
        </div>

        <div class="input-container">
            <i class="fas fa-lock icon"></i>
            <input type="password" id="senha" placeholder="Senha" required>
            <i class="fas fa-eye eye-icon" id="toggleSenha" onclick="toggleSenha()"></i>
        </div>

        <div class="lembrar-senha">
            <label>
                <input type="checkbox" id="lembrarSenha"> 
                Lembrar a senha?
            </label>
            <span class="esqueci-senha">Esqueceu a senha?</span>
        </div>

        <button type="submit">Entrar</button>
    </div>

    <script>
        function toggleSenha() {
            const senhaInput = document.getElementById('senha');
            const eyeIcon = document.getElementById('toggleSenha');
            if (senhaInput.type === 'password') {
                senhaInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                senhaInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>

    <?php
          if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $senha = $_POST['senha'];
    
            echo "Nome: " . $nome . "<br>";
            echo "Email: " . $email . "<br>";
            echo "Senha: " . $senha . "<br>";
            echo "Confirmação de Senha: " . $confirmacao_senha . "<br>"; }
    
            if (!empty($email) && !empty($senha)) {
                $u->conectar("nutrilife", "localhost", "root", "");
                if($u->msgErro == "")
                {
                    if($u->logar($email,$senha))
                    {
                        header("location: AreaPrivada.php");
                    }else{
                        ?>
                        <div class="msg-erro">
                        Email e/ou senha estão incorretos!
                        </div>
                        <?php
                }
                }
                else{
                    ?>
                    <div class="msg-erro">
                    <?php echo "Erro: ".$u->msgErro; ?>
                    </div>
                    <?php
                }
            }else{
                ?>
                <div class="msg-erro">
                Preencha todos os campos!
                </div>
                <?php
            }
    ?>
</body>
</html>