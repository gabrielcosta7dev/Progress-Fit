<!DOCTYPE html>
<html lang="en">
<?php include('conexao.php'); ?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Progress Fit - Home</title>
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
</head>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<div id="loader_wrpper">
		<div class="loader_style"></div>
	</div>

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
									<h1>Início Rápido</h1>
								</div>
							</div>
							<div class="col-12  d-md-flex">
								<div class="breadcrumb_nav">
									
								</div>
							</div>
						</div>
					</div>
					<!-- breadcrumb_End -->
					
					<!-- Section -->
					<section class="chart_section">
					

						<div class="row">
								<div class="col-12 ">
									<a href="estatisticas.php">
									<div class="card text-center " style="background-color:black;"> 
									
									<div class="card-body">
											
										
       									 <h5 class="card-title text-white ml-2">Iniciar Treino Vazio</h5>
									</div>
								</div>
									</a>
							</div>
							
					    </div>
                        <div class="page-heading">
						<div class="row d-flex align-items-center">
							<div class="col-12">
								<div class="page-breadcrumb">
									<h1>Planos de Treino</h1>
								</div>
							</div>
							<div class="col-12  d-md-flex">
								<div class="breadcrumb_nav">
									
								</div>
							</div>
						</div>
					</div>

					<div class="modal fade" id="createWorkoutModal" tabindex="-1" role="dialog" aria-labelledby="createWorkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createWorkoutModalLabel">Create Workout Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="insert_workout.php" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="workoutName">Workout Plan Name:</label>
            <input type="text" class="form-control" id="workoutName" name="workoutName" required>
          </div>
          <div class="form-group">
            <label for="exerciseName">Exercise:</label>
            <select class="form-control" id="exerciseName" name="exerciseName[]" required>
              <?php
                // Query to retrieve exercise names from the tblexercicios table
                $sql = "SELECT nomeexercicio FROM tblexercicios";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="'.$row['nomeexercicio'].'">'.$row['nomeexercicio'].'</option>';
                }
              ?>
            </select>
          </div>
          <div id="exerciseContainer"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="addExercise">Add Another Exercise</button>
          <button type="submit" class="btn btn-success">Save Workout</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
var exerciseCounter = 0;
var setCounter = 0;

$("#addExercise").click(function() {
  exerciseCounter++;
  $("#exerciseContainer").append(
    '<div class="form-group" id="exerciseDiv' + exerciseCounter + '">' +
      '<label for="exerciseName">Exercise Name:</label>' +
      '<select class="form-control" id="exerciseName" name="exerciseName[]" required>' +
        '<option value="">Select an exercise</option>' +
        '<?php
          $sql = "SELECT nomeexercicio FROM tblexercicios";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="'.$row['nomeexercicio'].'">'.$row['nomeexercicio'].'</option>';
          }
        ?>
      </select>' +
      '<div id="setContainer' + exerciseCounter + '"></div>' +
      '<button type="button" class="btn btn-primary mt-2" id="addSet' + exerciseCounter + '">Add Set</button>' +
    '</div>'
  );

  $("#addSet" + exerciseCounter).click(function() {
    setCounter++;
    $("#setContainer" + exerciseCounter).append(
      '<div class="form-group" id="setDiv' + exerciseCounter + '_' + setCounter + '">' +
        '<label for="weight">Weight:</label>' +
        '<input type="number" class="form-control" id="weight" name="weight' + exerciseCounter + '[]" required>' +
        '<label for="reps">Reps:</label>' +
        '<input type="number" class="form-control" id="reps" name="reps' + exerciseCounter + '[]" required>' +
      '</div>'
    );
  });
});

$("#saveWorkout").click(function() {
  var workoutName = $("#workoutName").val();
  var exerciseNames = [];
  var weights = [];
  var reps = [];

  for (var i = 1; i <= exerciseCounter; i++) {
    exerciseNames.push($("#exerciseName" + i).val());
    var currentWeights = [];
    var currentReps = [];
    for (var j = 1; j <= setCounter; j++) {
      currentWeights.push($("#weight" + i + "_" + j).val());
      currentReps.push($("#reps" + i + "_" + j).val());
    }
    weights.push(currentWeights);
    reps.push(currentReps);
  }
}

</script>


                            <div class="row">
								<div class="col-6 ">
									
									<div class="card text-center btnNovoPlano" style="background-color:black;"> 
									
									<div class="card-body">
											
										
       									 <h5 class="card-title text-white ml-2 ">Criar Plano</h5>
									</div>
								</div>
									
							</div>
							
					    </div>
                         </div>
                        </div>
						
                        <script>
                            $('.btnNovoPlano').click(function () {
                                $('#createWorkoutModal').modal('show')
                            })
                        </script>



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
	<!--chartjs Total Profit,New Orders,Yearly Revineue,New Users-->
	<script src="assets/js/Chart.min.js"></script>
	<script src="assets/js/chartjs-init.js"></script>

	<script type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
	<script src="assets/js/custom.js" type="text/javascript"></script>

</body>

</html>
