<?php 
  session_start();
  if($_SESSION['admin'] < '1'){
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
  <link rel="stylesheet" href="css/adminStyle.css" />
  <link rel="stylesheet" href="../assets/css/nav.css">
  <title>Document</title>
</head>

<body>
  <?php include "../nav.php" ?>

  <section>
    <div>
      <div class="E"><button onclick="location.href = 'adminEvent.php'; return false;">EVENT</button></div>
      <div class="A"><button onclick="location.href = 'adminRmv.php'; return false;">MEMBERS</button></div>
      <div class="AT"><button onclick="location.href = 'adminTask.php'; return false;">ASSIGN TASK</button></div>
      <div class="comp"><button onclick="location.href = 'adminChall.php'; return false;">Challenges</button></div>
    </div>
  </section>

  <footer class="mt-auto">
    <p class="m-0">Students' International Affairs Society</p>
    <p class="m-0">Copyright 2003-2023 | All rights reserved</p>
  </footer>

  <script src="../assets/js/app.js"></script>
</body>

</html>