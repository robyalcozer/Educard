<?php
include "../shared/connect.php";

if (isset($_POST['quiz_number'])) {
   $quiz_Number = $_POST['quiz_number'];

   $deleteQuery = "DELETE FROM math_quiz WHERE quiz_number = $quiz_Number";
   if (mysqli_query($conn, $deleteQuery)) {
      echo "Quiz deleted successfully";
   } else {
      echo "Error deleting quiz: " . mysqli_error($conn);
   }
} else {
   echo "Invalid request";
}

