<!DOCTYPE html>
<html>
  <head>
    <?php include('conexao.php'); ?>
    <title>Dynamic Workout Planner</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add a new exercise when the "+" button is clicked
            $("#addExercise").click(function() {
                var exerciseHTML = '<div class="exercise"><label for="exercises">Select Exercises</label><select name="exercises[]" id="exercises"><?php $db_connection = mysqli_connect("localhost", "root", "", "dynamic_workout_planner"); $result = mysqli_query($db_connection, "SELECT * FROM exercises"); while($row = mysqli_fetch_array($result)) {echo "<option value='" . $row['exercise_id'] . "'>" . $row['exercise_name'] . "</option>";} ?></select><label for="sets">Sets</label><input type="number" name="sets[]" id="sets"><label for="reps">Reps</label><input type="number" name="reps[]" id="reps"><label for="weight">Weight</label><input type="number" name="weight[]" id="weight"><button type="button" name="removeExercise" class="removeExercise">-</button></div>';
                $("#exercisesContainer").append(exerciseHTML);
            });
            // Remove an exercise when the "-" button is clicked
            $(document).on('click', '.removeExercise', function() {
                $(this).parent().remove();
            });
        });
    </script>
  </head>
  <body>
    <h1>Dynamic Workout Planner</h1>
    <form action="" method="post">
      <div id="exercisesContainer">
        <div class="exercise">
            <label for="exercises">Select Exercises</label>
            <select name="exercises[]" id="exercises">
            <?php
                //Connect to the database
             
                //Query the database to retrieve the exercises
                $result = mysqli_query($conn, "SELECT * FROM tblexercicios");
                //Loop through the results
                while($row = mysqli_fetch_array($result)) {
                    //Display the exercises as options in the select field
                    echo "<option value='" . $row['idexercicio'] . "'>" . $row['nomeeexercicio'] . "</option>";
                }
            ?>
            </select>
            <label for="sets">Sets</label>
            <input type="number" name="sets[]" id="sets">
            <label for="reps">Reps</label>
            <input type="number" name="reps[]" id="reps">
            <label for="weight">Weight</label>
            <input type="number" name="weight[]"id="weight">
            </div>
      </div>
      <button type="button" name="addExercise" id="addExercise">+</button>
      <br><br>
      <input type="submit" value="Save Workout">
    </form>
  </body>
</html>

<?php

?>