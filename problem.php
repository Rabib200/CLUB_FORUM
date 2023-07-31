<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "uiuclub";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$con) {
    die("Failed to connect!");
}
if(!isset($_SESSION['email'])){
    header("Location: index.php");
}

$curr = $_GET['id'];

$query = "select * from problem_set where prblm_id = '$curr'";
$result = mysqli_query($con, $query);
$data = $result->fetch_assoc();
$title = $data['title'];
$question = $data['question'];
$date_time = $data['date_time'];
$inputs = $data['inputs'];
$outputs = $data['outputs'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/event_style.css">
    <link rel="stylesheet" href="assets/css/nav.css">
</head>

<body>
    <div class="w-50 m-auto text-center my-2 py-1"><a class="" href="mainpage.php">Close</a></div>
    <div class="bar2 mx-auto py-3 mb-2">
        <section>
            <div class="sec1">
                <h3 class="text-capitalize"><?php echo $title; ?></h3>
                <p><?php echo $question; ?></p>
                <h5 class="mb-1 fw-bold text-uppercase">inputs :</h5>
                <p class="ps-4"><?php echo nl2br($inputs); ?></p>
            </div>

            <h5 class="mb-1 fw-bold text-uppercase">outputs :</h5>
            <p class="ps-4"><?php echo nl2br($outputs); ?></p>

        </section>
    </div>

    <script src="assets/js/app.js"></script>
</body>

</html>