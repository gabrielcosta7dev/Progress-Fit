<?php


if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $sql = "SELECT * FROM tblusers WHERE username='$username'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['iduser'] = $row['iduser'];
        
        header("Location: index.php");
      } else {
        echo '<div class="alert alert-danger border-0" role="alert">
                <i class="ti-na pr-2"></i> Nome de usuário ou senha inválidos
              </div>';
      }
    }
  } else {
    echo '<div class="alert alert-danger border-0" role="alert">
            <i class="ti-na pr-2"></i> Nome de usuário ou senha inválidos
          </div>';
  }
}
?>