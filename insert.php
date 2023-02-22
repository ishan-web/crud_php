
<?php
    $insert= false;
    $update= false;

    $conn= mysqli_connect("localhost", "root", "", "trying");

    if(!$conn){
        echo ("the connection with database is not successful:". mysqli_connect_error());
    }
    if(isset($_POST['submit'])){
      if(isset($_POST['snoEdit'])){
        $sno = $_POST['snoEdit'];
        $name = $_POST['nameEdit'];
        $subject = $_POST['subjectEdit'];
        $sql = "UPDATE `trying` SET `name` = '$name', `subject` = '$subject' WHERE `trying`.`sno` = $sno";
        $result= mysqli_query($conn, $sql);
      
      if($result){
        $update= true;
      }
      else{
        echo "we could not update the form: ";
      }
    }
    else{
        $name = $_POST['name'];
        $subject = $_POST['subject'];

        //executing query
        $sql = "INSERT INTO `trying` (`name`, `subject`) VALUES ('$name', '$subject')";
        $result = mysqli_query($conn, $sql);
   
    if($result){
        $insert =true;
    }else{
        echo "the record has not been added successfully";
    }
  }
}
$sql= "SELECT * FROM `trying`";
$result = mysqli_query($conn, $sql);
// $sno =0;
while($row= mysqli_fetch_assoc($result)){
    // $sno = $sno + 1;
    echo "<tr>
        <td scope='row'>" . $row['sno'] . "</td>
        <td> ". $row['name'] . "</td>
        <td>" . $row['subject'] . "</td>
        <td><button class='edit btn btn-primary'>Edit</button> 
        <button class='delete btn btn-danger'>Delete</button> </td>
    </tr>";
}
?>
<?php 
    if($insert){
      echo "<div class='alert alert-success alert-dismissible fade show ' role='alert'>
      <strong>Success!    </strong> Your note has been inserted successfully.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";    }
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
