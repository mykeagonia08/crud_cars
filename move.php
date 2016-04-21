<html>
  <head>
    <title>Cars</title>

    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  </head>

  <body>
  <?php

  //include database connection
  include 'db_connect.php';

  //check any user action
  $action = isset($_POST['action']) ? $_POST['action'] : '';

  if ($action == 'move') { //if the user hit the submit button

    // move procedure
    $newPos_car_id = $_POST['newPosition'];

    $mysqli->query("UPDATE cars SET car_id=9999
    WHERE car_id = '".$newPos_car_id."' ");

    $mysqli->query("UPDATE cars SET car_id='".$newPos_car_id."'
    WHERE car_id = '".$mysqli->real_escape_string($_REQUEST['car_id'])."'");

    $mysqli->query("UPDATE cars SET car_id='".$mysqli->real_escape_string($_REQUEST['car_id'])."'
    WHERE car_id = 9999");
  }

  //select the specific database record to update
  $query = "select car_id, car_name
  from cars
  where car_id='".$mysqli->real_escape_string($_REQUEST['car_id'])."'
  limit 0,1";

  //execute the query
  $result = $mysqli->query($query);
  //get the result
  $row = $result->fetch_assoc();
  //assign the result to certain variable so our html form will be filled up with values
  $car_id = $row['car_id'];
  $car_name = $row['car_name'];
  ?>

  <form action='#' method='post' border='0'>
    <table>
      <tr>
        <td>Car ID</td>
        <td><input type='number' name='car_id' value='<?php echo $car_id;  ?>' /></td>
      </tr>
      <tr>
        <td>Car Name</td>
        <td><input type='text' name='car_name' value='<?php echo $car_name;  ?>' /></td>
      </tr>
      <tr>
        <td>Move to Car ID</td>
        <td><input type='number' name='newPosition' value='<?php echo $newPosition;  ?>' /></td>
      </tr>
      <tr>
          <td></td>
          <td>
            <!-- so that we could car_identify what record is to be updated -->
            <input type='hidden' name='car_id' value='<?php echo $car_id ?>' />
            <!-- we will set the action to update -->
            <input type='hidden' name='action' value='move' />
            <input type='submit' value='Move' />
            <a href='index.php'>Back to index page</a>
          </td>
      </tr>
    </table>
  </form>

</body>
</html>
