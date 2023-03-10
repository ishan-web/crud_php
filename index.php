<?php 
  //INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES ('1', 'today', 'today is thursday and the day where barcelona will loose to manchester united.', current_timestamp());
  $insert = false;
  $update = false;
  $delete= false;
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
    if (isset($_GET['delete'])){
      $sno = $_GET['delete'];
      $delete = true;
      $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
      $result = mysqli_query($conn, $sql);
    }
    if (isset($_POST['submit'])){
      if (isset($_POST['snoEdit'])){
          //update the record
        $sno =$_POST['snoEdit'];
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];

        //sql query to be executed
        $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        
      if($result){
        $update=true;
      }else{
        echo "We could not update the record sucessfully!";
      }
         
      } 
      else{
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
        <!-- edit modal
    <button type="button" class="btn btn-primary" data-toggle="modal">
      Edit
    </button> -->

    <!-- edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editLabel" >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editLabel"> the selected Note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" >
          <form method="POST" action="/php_crud/index.php">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp" placeholder="Enter a note">
              <small id="textHelp" class="form-text text-muted">Write a title of the subject.</small>
            </div>

            <div class="form-group mb-3">
              <label for="description" class="mt-2">Note Description</label>
              <textarea  class="form-control" id="descriptionEdit" name="descriptionEdit" style=" height: 100px; " placeholder="Description"></textarea>
            </div>
            <input type="submit"  class="btn btn-primary mb-3" name="submit" value="Update Note">

          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
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
        <?php
          if ($update){
            echo "<div class='alert alert-success alert-dismissible fade show ' role='alert'>
            <strong>Success!    </strong> Your note has been updated successfully.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
          }
        ?>
        <?php
          if ($delete){
            echo "<div class='alert alert-success alert-dismissible fade show ' role='alert'>
            <strong>Success!    </strong> Your note has been deleted successfully.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
          }
        ?>
        <div class="container my-3">
          <form method="POST" action="/php_crud/index.php?update=true">
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
            <td scope='row'>" . $sno . "</td>
            <td>". $row['title'] . "</td>
            <td>" . $row['description'] . "</td>
            <td><button class='edit btn btn-sm btn-primary' id=". $row['sno'] . ">Edit</button> 
            <button class='delete btn btn-sm btn-danger' id=d". $row['sno'] . ">Delete</button></td>
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
    <script>
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e)=>{
          console.log("edit", );
          tr =  e.target.parentNode.parentNode;
          title = tr.getElementsByTagName("td")[1].innerText;
          description = tr.getElementsByTagName("td")[2].innerText;
          console.log(title, description);
          titleEdit.value = title;
          descriptionEdit.value = description;
          snoEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle');
        })
      })
    </script>

<script>
      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e)=>{
          console.log("edit", );
          sno = e.target.id.substr(1,);
         if(confirm("Are you sure you want to delete this note!")){
          console.log("yes");
          window.location = `/php_crud/index.php?delete=${sno}`;
         }
         else{
          console.log("no");
         }
        })
      })
    </script>
  </body>
</html>