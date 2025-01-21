<?php
session_start();

include 'conexao.php';

// Get the measurement data based on the selected option
if (isset($_GET['measurement_option'])) {
  $measurement_option = $POST['measurement_option'];
  $iduser = $_SESSION['iduser'];
  $sql = "SELECT data, $measurement_option FROM tblmedicoes WHERE iduser = '$iduser' ORDER BY data DESC";
  $result = mysqli_query($conn, $sql);

  $dates = array();
  $measurements = array();

  while($row = mysqli_fetch_assoc($result)) {
    $dates[] = $row['data'];
    $measurements[] = $row[$measurement_option];
  }

  echo json_encode(array("dates" => $dates, "measurements" => $measurements));
}

mysqli_close($conn);
?>