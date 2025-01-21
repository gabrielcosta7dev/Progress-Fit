<?php
session_start();
include('conexao.php');

// Get the selected measurement type and date range from the POST data
$measurement = $_POST['measurement'];
$from_date = isset($_POST['fromDate']) ? $_POST['fromDate'] : '';
$to_date = isset($_POST['toDate']) ? $_POST['toDate'] : '';
$dadomedicao = "cm";

if($measurement == 'biceps'){
    $measurement = 'bicep';
}
if($measurement == 'peso'){
    $dadomedicao = "kg";
}
else if($measurement == 'pgordura'){
    $dadomedicao = '%';
}
$measurement_display = ucfirst($measurement); 

if($measurement_display == 'Pgordura'){
    $measurement_display = 'Percentagem de Gordura';
}
// Get the user's previous measurements for the selected type
$user_id = $_SESSION['iduser'];

// Build the SQL query to get the measurements and the oldest measurement date for the selected type
$sql = "SELECT idmedicao,data, $measurement FROM tblmedicoes WHERE iduser = $user_id";
$sql_oldest = "SELECT MIN(data) AS oldest_date FROM tblmedicoes WHERE iduser = $user_id AND $measurement IS NOT NULL";

// Add the date range condition to the SQL query if specified
if (!empty($from_date) && !empty($to_date)) {
    $sql .= " AND data BETWEEN '$from_date' AND '$to_date'";
    $sql_oldest .= " AND data BETWEEN '$from_date' AND '$to_date'";
} else {
    $sql_oldest .= " AND $measurement IS NOT NULL";
}
$sql .= " ORDER BY data DESC";

// Execute the SQL queries and get the results
$result = mysqli_query($conn, $sql);
$result_oldest = mysqli_query($conn, $sql_oldest);
$row_oldest = mysqli_fetch_assoc($result_oldest);

// Calculate the percentage increase for each measurement
$oldest_date = $row_oldest['oldest_date'];
$baseline = 0;
if ($oldest_date) {
    $baseline_result = mysqli_query($conn, "SELECT $measurement FROM tblmedicoes WHERE iduser = $user_id AND data = '$oldest_date'");
    $row_baseline = mysqli_fetch_assoc($baseline_result);
    $baseline = $row_baseline[$measurement];
}

$table = "<h2>Medidas: " . $measurement_display . "</h2>";
$table .= "<table class='table-striped table'>";
$table .= "<tr><th>Data</th><th>Medida(" . $dadomedicao . ")</th><th>Percentagem de Mudança</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    $measurement_value = $row[$measurement];
    $percentage_increase = "";
    if ($baseline != 0) {
        $percentage = ($measurement_value - $baseline) / $baseline * 100;
		$percentage_increase =  number_format($percentage, 2) . "%";
    }
	$cor = $percentage >= 0 ? 'text-success' : 'text-danger';
    $table .= "<tr class='medidas-row' data-toggle='modal' data-target='#editarmedidasmodal' data-idmedicao='{$row['idmedicao']}'><td>{$row['data']}</td><td>{$measurement_value}</td><td class='{$cor}'>{$percentage_increase}</td></tr>";
}
$table .= "</table>";

// Close the database connection
mysqli_close($conn);

// Return the HTML table
echo $table;
?>
