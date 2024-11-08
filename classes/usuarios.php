<?php

class Usuario
{
  private $pdo;
  public $msgErro = "";

  public function conectar($nome, $host, $usuario, $senha)
  {
    try {
      $this->pdo = new PDO("mysql:dbname=" . $nome . ";host=" . $host, $usuario, $senha);
    } catch (PDOException $e) {
      $this->msgErro = "Erro de conexão". $e->getMessage();
    }
  }

  public function cadastrar($nome, $email, $senha)
  {
    $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
    $sql->bindValue(":e", $email);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      return false;
    } else {
      $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:n, :e, :s)");
      $sql->bindValue(":n", $nome);
      $sql->bindValue(":e", $email);
      $sql->bindValue(":s", $senha); 
      $sql->execute();
      return true;
    }
  }

  public function logar($email, $senha)
  {
    $sql = $this->pdo->prepare("SELECT id_usuario, senha FROM usuarios WHERE email = :e");
    $sql->bindValue(":e", $email);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $dado = $sql->fetch();
      if ($senha == $dado['senha']) {
        session_start();
        $_SESSION['id_usuario'] = $dado['id_usuario'];
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
}

?>
