<?php
    $insert= false;

    $conn= mysqli_connect("localhost", "root", "", "trying");

    if(!$conn){
        echo ("the connection with database is not successful:". mysqli_connect_error());
    }
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $subject = $_POST['subject'];

        //executing query
        $sql = "INSERT INTO `trying` (`name`, `subject`) VALUES ('$name', '$subject')";
        $result = mysqli_query($conn, $sql);
    }
    // if($result){
    //     $insert =true;
    // }else{
    //     echo "the record has not been added successfully";
    // }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<!-- <?php 
    // if($insert){
    //     echo "alert('data added succesfully')";
    // }
?>   -->
<div class="container my-3">
<form method="POST" action="/php_crud/trying.php">
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name ="name" id="name" aria-describedby="emailHelp" placeholder="Enter your name">
  </div>
  <div class="form-group">
    <label for="subject">Hobby</label>
    <textarea type="text" class="form-control" name="subject" id="subject" placeholder="what is your hobby"></textarea>
  </div>
  <input type="submit" class="btn btn-primary" name="submit" value="Submit">
</form>
</div>
<div class="container my-3">
<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Name</th>
      <th scope="col">Subject</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $sql= "SELECT * FROM `trying`";
    $result = mysqli_query($conn, $sql);
    $sno =0;
    while($row= mysqli_fetch_assoc($result)){
        $sno = $sno + 1;
        echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td> ". $row['name'] . "</td>
            <td>" . $row['subject'] . "</td>
            <td>Action</td>
        </tr>";
    }
  ?>
  </tbody>
</table>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
</body>
</html>