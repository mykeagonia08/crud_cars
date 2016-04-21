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

  //if there's any user action
  $action = isset($_POST['action']) ? $_POST['action'] : '';

  if ($action == 'create') { //the the user submitted the form

  //include database connection
  include 'db_connect.php';

  //our insert query query
  $query = "insert into cars
  set
  car_name = '".$mysqli->real_escape_string($_POST['car_name'])."',
  color_id  = '".$mysqli->real_escape_string($_POST['color_id'])."'";

  //execute the query
  if ($mysqli->query($query)) {

  //if saving success
  echo '<p>Car was created.</p>';
  } else {

  //if unable to create new record
  echo '<p>Database Error: Unable to create record.</p>';
  }

  //close database connection
  $mysqli->close();
  }

  ?>

  <!--we have our html form here where user information will be entered-->
  <form action='#' method='post' border='0'>
    <table>
      <tr>
        <td>Car Name</td>
        <td><input type='text' name='car_name' /></td>
      </tr>
      <tr>
        <td>Car Color</td>
        <td><input type='number' name='color_id' /></td>
      </tr>
      <tr>
        <td></td>
        <td>
          <input type='hidden' name='action' value='create' />
          <input type='submit' value='Save' />
          <a href='index.php'>Back to index</a>
        </td>
      </tr>
    </table>
  </form>

  </body>
</html>
