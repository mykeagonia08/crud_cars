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
      ini_set('display_errors', 1);
      error_reporting(~0);

      $strKeyword = null;

      if (isset($_POST['txtKeyword'])) {
          $strKeyword = $_POST['txtKeyword'];
      }
  ?>

  <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
    <table width="599" border="1">
      <tr>
        <th>Keyword
        <input name="txtKeyword" placeholder="car color" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>">
        <input type="submit" value="Search"></th>
      </tr>
    </table>
  </form>

  <?php
  //include database connection
  include_once 'db_connect.php';

  $action = isset($_GET['action']) ? $_GET['action'] : '';

  if ($action == 'delete') { //if the user clicked ok, run our delete query

  //$mysqli->real_escape_string() function helps us prevent attacks such as SQL injection
  $query = 'DELETE FROM cars WHERE car_id = '.$mysqli->real_escape_string($_GET['car_id']).'';

    //execute query
    if ($mysqli->query($query)) {
    //if successful deletion
      echo '<p>Car was deleted.</p>';
    } else {
    //if there's a database problem
    echo '<p>Database Error: Unable to delete record.</p>';
    }
  }

  //query all records from the database
  $query = "SELECT cars.car_id, cars.car_name, car_color.color
  FROM cars LEFT JOIN car_color on cars.color_id=car_color.color_id
  WHERE (cars.car_name LIKE '".$strKeyword."%' or car_color.color LIKE '".$strKeyword."%')
  ORDER BY cars.car_id,cars.car_name,cars.color_id";

  //execute the query
  $result = $mysqli->query($query);

  //get number of rows returned
  $num_results = $result->num_rows;

  //this will link us to our add.php to create new record
  echo "<div><a href='add.php'>Create New Record</a></div>";

  if ($num_results > 0) { //it means there's already a database record

  echo "<table border='1'>";//start table

  //creating our table heading
      echo '<tr>';
      echo '<th>Car Name</th>';
      echo '<th>Car Color</th>';
      echo '</tr>';

  //loop to show each records
  while ($row = $result->fetch_assoc()) {

  //extract row
  //this will make $row['car_name'] to
  //just {$car_name} only
  extract($row);

    //creating new table row per record
    echo '<tr>';
      echo "<td>{$car_name}</td>";
      echo "<td>{$color}</td>";
      echo '<td>';

      //just preparing the edit link to edit the record
      echo "<a href='edit.php?car_id={$car_id}'>Edit</a>";
      echo ' / ';
      //just preparing the move link to move the record
      echo "<a href='move.php?car_id={$car_id}'>Move</a>";
      echo ' / ';
      //just preparing the delete link to delete the record
      echo "<a href='#' onclick='delete_car( {$car_id} );'>Delete</a>";
      echo '</td>';
    echo '</tr>';
  }

  echo '</table>';//end table
  } else {

  //if database table is empty
  echo '<p>No records found.</p>';
  }

  //disconnect from database
  $result->free();
  $mysqli->close();
  ?>

  <script type='text/javascript'>

  function delete_car( car_id ){
  //prompt the user
  var answer = confirm('Do you want to delete this record? ' );

    if ( answer ){ //if user clicked ok
    //redirect to url with action as delete and id of the record to be deleted
    window.location = 'index.php?action=delete&car_id=' + car_id;
    }
  }

  </script>

</body>
</html>
