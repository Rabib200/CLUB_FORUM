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
    <?php include "nav.php" ?>
    <div class="bar2 mx-auto py-3 mb-2">
        

        <section>
            <div class="sec1">
                <h3 class="text-capitalize"><?php echo $title; ?></h3>
                <p><?php echo $question; ?></p>
                <p><span>INPUTS : </span><?php echo $inputs ?></p>
            </div>

            <div class="benefits">
                <h5>OUTPUTS :</h5>
                <p><?php echo $outputs; ?></p>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="total d-flex align-items-center">
                    <h5 class="m-0">DATE TIME : </h5>
                    <h5 class="m-0"> <?php echo $date_time ?></h5>
                </div>
                <!-- <button class="py-2 px-3" ><a href="registerAPI.php?event=<?php echo $curr?>">Click Here To Register</button> -->
            </div>
        </section>
    </div>

    <script src="assets/js/app.js"></script>
</body>

</html>