<?php 
    session_start();
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "uiuclub";

    $con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    if(!$con){
        die("Failed to connect!");
    }
    if($_SESSION['admin'] < '1'){
      header("Location: ../mainpage.php");
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $description = mysqli_real_escape_string($con, $description);
        $eligibility = $_POST['eligibility'];
        $date_time = $_POST['date'];
        $location = $_POST['location'];
        $rand = rand(1,10000);

        $file = $_FILES['fileToUpload']['name'];
        $target_dir = "../assets/uploads/".$file;
        $dst_db = $file;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir);

        $q ="insert into club_event(event_id,title,heading,benefit,locations,image,article,eligibility,date_time) values ('$rand','$title','$title','h','$location','$dst_db','$description','$eligibility','$date_time')";
        
        $result = mysqli_query($con,$q);

        if(!$result){
          die("ERROR".mysqli_error($con));
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/aPost.css" />
  <link rel="stylesheet" href="../assets/css/main.css">
  <link rel="stylesheet" href="../assets/css/nav.css">
  <title>Document</title>
</head>

<body>
  <?php include "../nav.php" ?>
  
  <form class="mx-auto mt-5" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method ="POST" enctype="multipart/form-data">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="title" name="title" placeholder="title">
      <label for="title">Event Title</label>
    </div>

    <div class="mb-3">
      <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description" style="height: 200px;"></textarea>
    </div>

    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="eligibility" name="eligibility" placeholder="eigibility">
      <label for="eigibility">Eligibility</label>
    </div>

    <div class="row g-2 mb-3">
      <div class="col-md">
        <div class="form-floating">
          <input type="datetime-local" class="form-control" id="date" name="date">
          <label for="date">Date</label>
        </div>
      </div>

      <div class="col-md">
        <div class="form-floating">
          <input type="text" class="form-control" id="location" name="location" placeholder="location">
          <label for="location">Location</label>
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label for="formFileSm" class="form-label">Choose an image</label>
      <input class="form-control form-control-sm" id="formFileSm" name="fileToUpload" type="file" accept=".jpg, .jpeg, .png">
    </div>

    <input type="submit" value="Post" name="submit">
  </form>

  <script src="../assets/js/app.js"></script>
</body>

</html>