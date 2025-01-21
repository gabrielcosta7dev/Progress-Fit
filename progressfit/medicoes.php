<!DOCTYPE html>
<html lang="en">
<?php include('conexao.php'); ?>
<?php session_start();
 ?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Progress Fit - Medições</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/ionicons.css" rel="stylesheet" type="text/css">
	<link href="assets/css/simple-line-icons.css" rel="stylesheet" type="text/css">
	<link href="assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
	<link href="assets/css/weather-icons.min.css" rel="stylesheet">
	<!--Morris Chart -->
	<link rel="stylesheet" href="assets/js/index/morris-chart/morris.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/responsive.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	
<script>
    $(document).ready(function() {
		var today = new Date().toISOString().substr(0, 10);
 		 $("#toDate").attr("max", today);
		  $("#edit-data").attr("max", today);
		  $("#data-criar").attr("max", today);
        // Function to fetch measurements for a given type and date range
        function fetchMeasurements(measurement, fromDate, toDate) {
            // Make an AJAX request to fetch the measurements for the selected type and date range
            $.ajax({
                url: 'cdgetmedidas.php',
                type: 'post',
                data: { 
                    measurement: measurement,
                    fromDate: fromDate,
                    toDate: toDate
                },
                success: function(response) {
                    $('#measurement-table').html(response);

                    
                }
            });
        }

        // Call the function to fetch the initial table on page load
        fetchMeasurements('peso');

        // Listen for changes to the select element
        $('#measurements').on('change', function() {
            // Get the selected measurement type
            var measurement = $(this).val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            // Call the function to fetch the table for the selected type
            fetchMeasurements(measurement, fromDate, toDate);
        });

        // Listen for changes to the date range
        $('#fromDate, #toDate').on('change', function() {
            // Get the selected measurement type
            var measurement = $('#measurements').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            // Call the function to fetch the table for the selected type and date range
            fetchMeasurements(measurement, fromDate, toDate);
        });

		$('#editarmedidasmodal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var idmedicao = button.data('idmedicao'); // Extract idmedicao from data-* attributes
    var modal = $(this);

    // Make an AJAX request to fetch the measurement data for the specified idmedicao
    $.ajax({
      type: "post",
      url: "obterdadosmedicao.php",
      data: {idmedicao: idmedicao},
      dataType: "json",
      success: function(response) {
        // Set the value of the inputs in the modal
                 modal.find('#edit-peso').val(response.peso);
				 modal.find('#edit-idmedicao').val(response.idmedicao);
				 modal.find('#edit-data').val(response.data);
				 modal.find('#edit-pgordura').val(response.pgordura);
                 modal.find('#edit-cintura').val(response.cintura);
                 modal.find('#edit-ancas').val(response.ancas);
                 modal.find('#edit-bicep').val(response.bicep);
      }
    });
  });


  document.getElementById('edit-data').addEventListener('change', function() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      if (response) {
        document.getElementById('edit-idmedicao').value = response.idmedicao;
        document.getElementById('edit-peso').value = response.peso;
        document.getElementById('edit-cintura').value = response.cintura;
        document.getElementById('edit-ancas').value = response.ancas;
        document.getElementById('edit-pgordura').value = response.percentagem_gordura;
        document.getElementById('edit-bicep').value = response.bicep;
      }
    }
  };
  xhr.open('post', 'check_data.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send('date=' + this.value);
});


    });
</script>

	<div class="wrapper">
		<!-- header -->
		<?php include('theader.php'); ?>
		<!-- header_End -->
		<!-- Content_right -->
		<div class="container_full">

			<?php include('sidebar.php'); ?>
			<div class="content_wrapper">
				<div class="container-fluid">
					<!-- breadcrumb -->
					<div class="page-heading">
						<div class="row d-flex align-items-center">
							<div class="col-12">
								<div class="page-breadcrumb">
									<h1>Medições</h1>
								</div>
							</div>
							<div class="col-12  d-md-flex">
								<div class="breadcrumb_nav">
									
								</div>
							</div>
						</div>
					</div>
				<?php
				$iduser = $_SESSION['iduser'];
					$sql = "SELECT * FROM tblmedicoes WHERE iduser = $iduser";
					$result = $conn->query($sql);

					$data = array();

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$data[] = $row;
						}
					} else {
						echo "<h3>No measurements found.</h3>";
					}
				?>

				

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalmedicoes">
  Adicionar Medições
</button>


<div class="modal fade" id="modalmedicoes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Adicionar Medições</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="" method="post">
		<?php include('cdmedicoes.php'); ?>
      <label for="data">Data</label>
      <input type="date" id="data-criar" name="data" class="form-control">
      <label for="weight">Peso(kg)</label>
      <input type="number" step=".01" id="weight" name="peso" class="form-control">
	  <label for="gordura">Percentagem de Gordura(%)</label>
      <input type="number" step=".01" id="weight" name="pgordura" class="form-control">
      <label for="cintura">Cintura(cm)</label>
      <input type="number" step=".01" id="cintura" name="cintura" class="form-control">
      <label for="anca">Anca(cm)</label>
      <input type="number" step=".01" id="anca" name="anca" class="form-control">
      <label for="biceps">Biceps(cm)</label>
      <input type="number" step=".01" id="biceps" name="biceps" class="form-control">
      
	  <script>
  		document.getElementById("data").valueAsDate = new Date();
	  </script>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" name="btninserir" class="btn btn-primary">Guardar</button>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="form-group mt-3" >


				</div>
				<div class="form-group form-inline">
        <label for="fromDate">De:</label>
        <input type="date" class="form-control" name="fromDate" id="fromDate">
        <label for="toDate">Até:</label>
        <input type="date" class="form-control" name="toDate" id="toDate">
		
    </div>
		<div class="form-group mt-3" >
			
<label for="measurements"  >Selecionar Medidas:</label>
	<select name="measurements" id="measurements" class="form-control">
		<option value="peso">Peso</option>
		<option value="cintura">Cintura</option>
		<option value="ancas">Ancas</option>
		<option value="pgordura">Percentagem de Gordura</option>
		<option value="biceps">Biceps</option>
		
	</select>

	<!-- Display table of previous measurements for the selected type -->


	<div id="measurement-table"></div>
				

				</div>
			</div>
		</div>


		<div class="modal fade" id="editarmedidasmodal" tabindex="-1" role="dialog" aria-labelledby="editarmedidasmodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarmedidasmodalLabel">Editar Medidas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editarmedidasform" action="cdeditarmedidas.php" method="post">
		
		
			<input type="hidden" id="edit-idmedicao" name="pidmedicao">
			<div class="form-group">
			<label for="peso">Data:</label>
          	<input class="form-control" type="date" id="edit-data" name="data">
		  </div>
          <div class="form-group">
            <label for="peso">Peso (kg):</label>
            <input type="number" step="0.01" class="form-control" id="edit-peso" name="peso">
          </div>
          <div class="form-group">
            <label for="cintura">Cintura (cm):</label>
            <input type="number" step="0.01" class="form-control" id="edit-cintura" name="cintura">
          </div>
          <div class="form-group">
            <label for="ancas">Ancas (cm):</label>
            <input type="number" step="0.01" class="form-control" id="edit-ancas" name="ancas">
          </div>
          <div class="form-group">
            <label for="percentagem-gordura">Percentagem de Gordura (%):</label>
            <input type="number" step="0.01" class="form-control" id="edit-pgordura" name="percentagem-gordura">
          </div>
          <div class="form-group">
            <label for="bicep">Bicep (cm):</label>
            <input type="number" step="0.01" class="form-control" id="edit-bicep" name="bicep">
          </div>
          <button type="submit"  class="btn btn-primary">Guardar Alterações</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
		<!-- Content_right_End -->
		<!-- Footer -->
		<?php include('footer.php'); ?>
		<!-- Footer_End -->
	</div>
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/popper.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
	
	<!--Morris Chart-->
	<script src="assets/js/index/morris-chart/morris.js"></script>
	<script src="assets/js/index/morris-chart/raphael-min.js"></script>
	<!--morris chart initialization-->
	<script src="assets/js/index/morris-chart/morris-init.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

	<!--chartjs Total Profit,New Orders,Yearly Revineue,New Users-->
	<script src="assets/js/Chart.min.js"></script>
	<script src="assets/js/chartjs-init.js"></script>

	<script type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="assets/js/custom.js" type="text/javascript"></script>

</body>

</html>
