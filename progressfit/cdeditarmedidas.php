<?php
session_start();
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idmedicao = $_POST["pidmedicao"];
  $data = $_POST["data"];
  $peso = $_POST["peso"];
  $cintura = $_POST["cintura"];
  $ancas = $_POST["ancas"];
  $percentagem_gordura = $_POST["percentagem-gordura"];
  $bicep = $_POST["bicep"];

  // Check if the user has set at least one input and the date is filled
  if (!empty($data) && (!empty($peso) || !empty($cintura) || !empty($ancas) || !empty($percentagem_gordura) || !empty($bicep))) {
    // Check if the user has selected an already used date
    $stmt = $conn->prepare("SELECT * FROM tblmedicoes WHERE data = ? AND iduser = ?");
    $stmt->bind_param("si", $data, $_SESSION["iduser"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      // If the user has selected an already used date, update the values and the idmedicao
      $row = $result->fetch_assoc();
      $idmedicao = $row["idmedicao"];
    }

    // Update the values in tblmedicoes
    $stmt = $conn->prepare("UPDATE tblmedicoes SET data=?, peso=?, cintura=?, ancas=?, pgordura=?, bicep=? WHERE idmedicao=? AND iduser=?");
    $stmt->bind_param("sdddddii", $data, $peso, $cintura, $ancas, $percentagem_gordura, $bicep, $idmedicao, $_SESSION["iduser"]);
    $stmt->execute();

    // Redirect to the user's profile page
    header('Location: medicoes.php');
    exit();
  } else {
    // If the user has not set at least one input or the date is not filled, show an error message
    echo "Please fill in the date and at least one input.";
  }
}