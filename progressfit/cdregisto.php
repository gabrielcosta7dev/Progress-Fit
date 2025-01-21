<?php
  if (isset($_POST['submit'])) {
    $error = false;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmapass = $_POST['confirmapass'];
    $termos = $_POST['termos'];
    $nome = $_POST['nome'];
    $cargo = 0;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = true;
      echo '<div class="alert alert-danger border-0" role="alert">
              <i class="  ti-na  pr-2"></i> Email inválido!
            </div>';
    }

    if (empty($username) || empty($email) || empty($password) || empty($confirmapass)) {
      $error = true;
      echo '<div class="alert alert-danger border-0" role="alert">
              <i class="  ti-na  pr-2"></i> Preencha todos os campos!
            </div>';
    }

    if ($password !== $confirmapass) {
      $error = true;
      echo '<div class="alert alert-danger border-0" role="alert">
              <i class="  ti-na  pr-2"></i> As passwords não coincidem!
            </div>';
    }
    if(!(isset($termos))){
        $error = true;
        echo '<div class="alert alert-danger border-0" role="alert">
              <i class="  ti-na  pr-2"></i> Por favor aceite os Termos de Política e Privacidade!
            </div>';
    }

    if (!$error) {
                $verify_username = "SELECT * FROM tblusers WHERE username=?";
        $stmt = mysqli_prepare($conn, $verify_username);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
        echo '<div class="alert alert-danger border-0" role="alert">
                <i class="ti-na pr-2"></i> O nome de usuário já existe!
                </div>';
        } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $cargos = 0;
        $sql = "INSERT INTO tblusers (username, password, email, cargos)
                VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $username, $hashed_password, $email, $cargos);
        
        if (mysqli_stmt_execute($stmt)) {
            echo '<div class="alert alert-success border-0" role="alert">
                    <i class="ti-check pr-2"></i> Sucesso ao Registar!
                </div>';
                
           
            $insert_perfil = "INSERT INTO tblperfil (nome) VALUES (?)";
            $stmt = mysqli_prepare($conn, $insert_perfil);
            mysqli_stmt_bind_param($stmt, "s", $nome);
            
            if (mysqli_stmt_execute($stmt)) {
            $_SESSION['username'] = $username;
            $_SESSION['idsessao'] = session_id();
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $nome;
            $_SESSION['cargo'] = $cargo;
            } else {
            echo '<div class="alert alert-danger border-0" role="alert">
                    <i class="ti-na pr-2"></i> Erro ao inserir no perfil!
                    </div>';
            }
        } else {
            echo '<div class="alert alert-danger border-0" role="alert">
                    <i class="ti-na pr-2"></i> Erro ao registrar!
                </div>';
        }
        }
  }
}
  ?>