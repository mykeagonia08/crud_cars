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

  if ($action == 'update') { //if the user hit the submit button

  //write our update query
  $query = "update cars
  set
  car_name = '".$mysqli->real_escape_string($_POST['car_name'])."',
  color_id = '".$mysqli->real_escape_string($_POST['color_id'])."'
  where car_id='".$mysqli->real_escape_string($_REQUEST['car_id'])."'";

  //execute the query
  if ($mysqli->query($query)) {
      //if updating the record was successful
    echo '<p>Car was updated.</p>';
  } else {
      //if unable to update new record
    echo '<p>Database Error: Unable to update record.</p>';
  }
  }

  //select the specific database record to update
  $query = "select car_id, car_name, color_id
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
  $color_id = $row['color_id'];
  ?>

  <!--we have our html form here where new user information will be entered-->
  <form action='#' method='post' border='0'>
    <table>
      <tr>
        <td>Car Name</td>
        <td><input type='text' name='car_name' value='<?php echo $car_name;  ?>' /></td>
      </tr>
      <tr>
        <td>Car Color</td>
        <td><input type='number' name='color_id' value='<?php echo $color_id;  ?>' /></td>
      </tr>
      <tr>
          <td></td>
          <td>
            <!-- so that we could identify what record is to be updated -->
            <input type='hidden' name='car_id' value='<?php echo $car_id ?>' />
            <!-- we will set the action to update -->
            <input type='hidden' name='action' value='update' />
            <input type='submit' value='Edit' />
            <a href='index.php'>Back to index page</a>
          </td>
      </tr>
    </table>
  </form>

</body>
</html>
