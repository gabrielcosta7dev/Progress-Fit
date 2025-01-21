<?php
session_start();
include('conexao.php');

// Get the selected measurement type and date range from the POST data
$idmedicao = $_POST['idmedicao'];

// Get the measurement data for the specified idmedicao
$sql = "SELECT data, peso, cintura, ancas, bicep, pgordura FROM tblmedicoes WHERE idmedicao = $idmedicao";
$result = mysqli_query($conn, $sql);

// Build an array with the measurement data
$data = array();
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $data['peso'] = $row['peso'];
    $data['pgordura'] = $row['pgordura'];
    $data['data'] = $row['data'];
    $data['cintura'] = $row['cintura'];
    $data['ancas'] = $row['ancas'];
    $data['bicep'] = $row['bicep'];
    $data['idmedicao'] = $idmedicao;
  }

// Close the database connection
mysqli_close($conn);

// Return the measurement data as a JSON object
echo json_encode($data);
?>
