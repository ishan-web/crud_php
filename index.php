<?php 
  //INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES ('1', 'today', 'today is thursday and the day where barcelona will loose to manchester united.', current_timestamp());
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
    else{
      echo "Connection was successful<br>";
    }
        ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>PHP CRUD</title>
  </head>
  <body>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

    <div >
        <nav class="nav">
            <p> Navbar</p>
            <ul class="items">
                <li class="list"><a href="#"></a>Home</li >
                <li class="list"><a href="#"></a>Contact</li>
                <li class="list"><a href="#"></a>About</li>
                <input type="text" placeholder="search" class="search"/>
                <button class="button">Search</button>
            </ul>
        </nav>
        <div class="container my-3">
          <form method="post" action="/php_crud">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Enter a note">
              <small id="textHelp" class="form-text text-muted">Write a title of the note.</small>
            </div>

            <div class="form-group mb-3">
              <label for="desc" class="mt-2">Note Description</label>
              <textarea  class="form-control" id="desc" name="desc" style=" height: 100px; " placeholder="Description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
        
        <table class="table">
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
          while($row= mysqli_fetch_assoc($result)){
           echo "<tr>
            <th scope='row'>" . $row['sno'] . "</th>
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
  </body>
</html>