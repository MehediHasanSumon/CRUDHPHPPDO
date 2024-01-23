<?php
include('config.php');
//Insert Data.........
if (isset($_REQUEST['submit'])) {
  if(($_REQUEST['name'] == '') && ($_REQUEST['roll'] == '') && ($_REQUEST['department'] == '') && ($_REQUEST['address'] == '')){
    $msg = '<div class="wraning">All fields are required</div>';
  }elseif (($_REQUEST['name']) == '') {
    $msg = '<div class="wraning">The Name field is required</div>';
  }elseif (($_REQUEST['roll'] == '')) {
    $msg = '<div class="wraning">The Roll field is required</div>';
  }elseif (($_REQUEST['department']) == '') {
    $msg = '<div class="wraning">The Department field is required</div>';
  }elseif (($_REQUEST['address']) == '') {
    $msg = '<div class="wraning">The Address field is required</div>';
  }else{
    $id = $_REQUEST['stu_id'];
    $name = $_REQUEST['name'];
    $roll = $_REQUEST['roll'];
    $department = $_REQUEST['department'];
    $address = $_REQUEST['address'];
    $sql = "INSERT INTO `students`(`id`, `name`, `roll`, `department`, `address`) VALUES (:id, :name, :roll, :department, :address) ON DUPLICATE KEY UPDATE `name` = VALUES(`name`), `department` = VALUES(`department`), `address` = VALUES(`address`)";
    // echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bindParam('id', $id);
    $stmt->bindParam('name', $name);
    $stmt->bindParam('roll', $roll);
    $stmt->bindParam('department', $department);
    $stmt->bindParam('address', $address);
    if ($stmt->execute()) {
      $msg = '<div class="success">Student information added.</div>';
    }else{
      $msg = '<div class="wraning">Student information added failed.</div>';
    }
    header('location: http://localhost/pdo_project');
  }
}
if (isset($_REQUEST['edit'])) {
  $id = $_REQUEST['student_id'];
  $sql = "SELECT * FROM `students` WHERE `id` = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam('id', $id);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
}
if (isset($_REQUEST['delete'])) {
  $id = $_REQUEST['student_id'];
  $sql = "DELETE FROM `students` WHERE `id` = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam('id', $id);
  $stmt->execute();
  header('location: http://localhost/pdo_project');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <title>CRUD - PHP</title>
  </head>
  <body>
    <div class="container">
      <div class="page_title">CRUD - PHP(PDO)</div>
      <div class="wrapper">
      <?php if(isset($msg)){echo $msg;}?>
        <!-- <div class="success">Operatoin Success</div> -->
        <div class="form-sec">
          <form action="#" method="post">
            <label for="name">Name</label>
            <input
              type="text"
              id="name"
              name="name"
              placeholder="Enter Name"
              autocomplete="off"
              value="<?php if(isset($data['name'])){echo $data['name'];}?>"
              required
            />

            <label for="roll">Roll</label>
            <input
              type="text"
              id="roll"
              name="roll"
              placeholder="Enter Roll"
              autocomplete="off"
              value="<?php if(isset($data['roll'])){echo $data['roll'];}?>"
              required
            />
            <label for="department">Department</label>
            <input
              type="text"
              id="department"
              name="department"
              placeholder="Enter Department"
              autocomplete="off"
              value="<?php if(isset($data['department'])){echo $data['department'];}?>"
              required
            />
            <label for="address">Address</label>
            <input
              type="text"
              id="address"
              name="address"
              placeholder="Enter Address"
              autocomplete="off"
              value="<?php if(isset($data['address'])){echo $data['address'];}?>"
              required
            />
            <input type="hidden" name="stu_id" value="<?php if(isset($data['roll'])){echo $data['id'];}?>">
            <input type="submit" value="Save" name="submit" />
          </form>
        </div>
        <div class="table-sec">
          <?php 
          //Fetch Data............
          $sql = "SELECT * FROM `students`";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          if ($stmt->rowCount()>0) {
            echo '<table id="customers">
            <tr>
              <th>Roll</th>
              <th>Name</th>
              <th>Department</th>
              <th>Address</th>
              <th>Action</th>
            </tr>';
            while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
              echo ' <tr>
              <td>'. $data['roll'] .'</td>
              <td>'. $data['name'] .'</td>
              <td>'. $data['department'] .'</td>
              <td>'. $data['address'] .'</td>
              <td>
                <form action="#" method="post">
                  <input type="hidden" name="student_id" value="'. $data['id'] .'">
                  <input type="submit" id="btn-edit" value="Edit" name="edit">
                  <input type="submit" id="btn-delete" value="Delete" name="delete">
                </form>
              </td>
            </tr>';
            }
            echo '</table>';
          }else{
            echo '<div class="nodata">No data found</div>';
          }

          ?>
        </div>
      </div>
    </div>
  </body>
</html>
