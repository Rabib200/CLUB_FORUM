<?php
session_start();
if ($_SESSION['admin'] < '1') {
  header("Location: ../mainpage.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/aRmvStyle.css" />
  <link rel="stylesheet" href="../assets/css/nav.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <title>Document</title>
</head>

<body>

  <?php include "../nav.php" ?>


  <div class="middle1">
    <div class="d-flex justify-content-center mt-2  mb-4">
      <input type="text" class="px-3 py-2" name="" id="" placeholder="Enter Student Id" value="" />
    </div>

    <div class="inner">
      <table class="table table-striped m-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php $count = 1;
          $query = "select * from users where admin_level < " . $_SESSION['admin'];
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_assoc($result)) :
          ?>
            <tr>
              <td><?= $count ?></td>
              <td><?= $row['st_id'] ?></td>
              <td><?= $row['name'] ?></td>
              <td><?= $row['position'] ?></td>
              <td>
                <div class="d-flex justify-content-center align-items-center">
                  <a <?= 'href="../update.php?delete='.$row['email'].'"' ?> onclick='return confirm("Are you sure you want to delete this user?")'><i class="fa-solid fa-trash fa-xl"></i></a>
                  <a <?= 'href="updateusers.php?email='.$row['email'].'"' ?>><i class="fa-solid fa-pen fa-xl"></i></i></a>
                </div>
              </td>
            </tr>
          <?php $count++;
          endwhile ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php include "../footer.php" ?>
  <script src=" ../assets/js/app.js"></script>
  <script>
    <?php 
      if(isset($_SESSION['delete']) && $_SESSION['delete'] == 1){
        echo "alert('Deleted user successfully')";
        unset($_SESSION['delete']);
      }

      if(isset($_SESSION["u_success"]) && $_SESSION['u_success'] == 1){
        echo "alert('Updated successfully')";
        unset($_SESSION['u_success']);
      }
    ?>
  </script>
</body>

</html>