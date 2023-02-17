<?php 
  //INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES ('1', 'today', 'today is thursday and the day where barcelona will loose to manchester united.', current_timestamp());
  $insert = false;
  //connect to the database

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "notes";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Die if connection was not successful
    if (!$conn){
        die("Sorry we failed to connect: ". mysqli_connect_error());
    }
    
    if (isset($_POST['submit'])){
      $title = $_POST["title"];
      $description = $_POST["description"];

      //sql query to be executed
      $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title' , '$description')";
      $result = mysqli_query($conn, $sql);
    
    //adding data to the table in the database
    if($result){
      // echo "the result has been sucessfully added to the database<br>";
      $insert = true;
    }else{
      echo " the record has not been added to the database due to --->" . mysqli_error($conn); 

    }
  }
        ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags --> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
                integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">

    <title>PHP CRUD</title>
  </head>
  <body>

    <div >
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="/crud/logo.svg" height="28px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <input class="btn btn-outline-success my-2 my-sm-0" type="submit">
      </form>
    </div>
  </nav>
        <?php
          if ($insert){
            echo "<div class='alert alert-success alert-dismissible fade show ' role='alert'>
            <strong>Success!    </strong> Your note has been added successfully.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
          }
        ?>
        <div class="container my-3">
          <form method="POST" action="/php_crud/index.php">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Enter a note">
              <small id="textHelp" class="form-text text-muted">Write a title of the note.</small>
            </div>

            <div class="form-group mb-3">
              <label for="description" class="mt-2">Note Description</label>
              <textarea  class="form-control" id="description" name="description" style=" height: 100px; " placeholder="Description"></textarea>
            </div>
            <input type="submit"  class="btn btn-primary mb-3" name="submit" value="Add Note">

          </form>
        
        <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">S.No</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
        <?php  
          $sql = "SELECT * FROM `notes`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row= mysqli_fetch_assoc($result)){
            $sno= $sno + 1;
           echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td>". $row['title'] . "</td>
            <td>" . $row['description'] . "</td>
            <td>Action</td>
          </tr>";
          }
        ?>
        </tbody>
      </table>
        </div>
    </div>
    <script
  src="https://code.jquery.com/jquery-3.6.3.js"
  integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"></script>
     <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
      $( document ).ready(function() {
        
        $('#myTable').DataTable();
      });
    </script>

    <!-- <script>
      $( document ).ready(function() {
    alert( "ready!" );
});
    </script> -->
  </body>
</html>