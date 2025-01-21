<?php
if(isset($_POST['btninserir'])) {
    $iduser = $_SESSION['iduser'];
    $data = mysqli_real_escape_string($conn, $_POST['data']);
    $peso = mysqli_real_escape_string($conn, $_POST['peso']);
    $cintura = mysqli_real_escape_string($conn, $_POST['cintura']);
    $anca = mysqli_real_escape_string($conn, $_POST['anca']);
    $biceps = mysqli_real_escape_string($conn, $_POST['biceps']);
    $pgordura = mysqli_real_escape_string($conn, $_POST['pgordura']);
    
    // Verificar se ja existe algum registo com esta data
    $sql = "SELECT * FROM tblmedicoes WHERE iduser = '$iduser' AND data = '$data'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      // Guardar valores nas variaveis
      $existingPeso = $row['peso'];
      $existingCintura = $row['cintura'];
      $existingAnca = $row['ancas'];
      $existingBiceps = $row['bicep'];
      $existingGordura = $row['pgordura'];
  
      // Atualizar o registo
      $sql = "UPDATE tblmedicoes SET peso = '" . ($peso ? $peso : $existingPeso) . "', cintura = '" . ($cintura ? $cintura : $existingCintura) . "', ancas = '" . ($anca ? $anca : $existingAnca) . "', bicep = '" . ($biceps ? $biceps : $existingBiceps) . "', pgordura = '" . ($pgordura ? $pgordura : $existingGordura) . "' WHERE iduser = '$iduser' AND data = '$data'";
    } else {
      // Inserir um novo registo
      $sql = "INSERT INTO tblmedicoes (iduser, data, peso, cintura, ancas, bicep, pgordura) VALUES ('$iduser', '$data', '$peso', '$cintura', '$anca', '$biceps', '$pgordura')";
    }
  
    // Execute the query
    if (mysqli_query($conn, $sql)) {
      echo "Sucesso";
    } else {
      echo "Erro " . mysqli_error($conn);
    }
  }
?>