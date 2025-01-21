<?php
session_start();
// Check if the date parameter is set
if (isset($_POST['date'])) {
  // Get the date value
  $date = $_POST['date'];
include('conexao.php');

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare the SQL statement to select the medicao values for the given date
  $stmt = $conn->prepare("SELECT idmedicao, peso, cintura, ancas, pgordura, bicep FROM tblmedicoes WHERE data = ?");

  // Bind the date parameter to the statement
  $stmt->bind_param("s", $date);

  // Execute the statement
  $stmt->execute();

  // Get the result of the statement
  $result = $stmt->get_result();

  // Check if there is a result
  if ($result->num_rows > 0) {
    // Fetch the values from the result
    $row = $result->fetch_assoc();
    $idmedicao = $row['idmedicao'];
    $peso = $row['peso'];
    $cintura = $row['cintura'];
    $ancas = $row['ancas'];
    $percentagem_gordura = $row['pgordura'];
    $bicep = $row['bicep'];

    // Create an array with the medicao values
    $medicao = array(
      "idmedicao" => $idmedicao,
      "peso" => $peso,
      "cintura" => $cintura,
      "ancas" => $ancas,
      "percentagem_gordura" => $percentagem_gordura,
      "bicep" => $bicep
    );

    // Convert the array to a JSON string
    $medicao_json = json_encode($medicao);

    // Send the JSON string back to the client
    echo $medicao_json;
  }
  else {
    // If there is no result, send false back to the client
    echo json_encode(false);
  }

  // Close the statement and the database connection
  $stmt->close();
  $conn->close();
}
?>