<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "uiuclub";
if(!isset($_SESSION['email'])){
    header("Location: index.php");
}
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$con) {
    die("Failed to connect!");
}


$curr = (int)$_GET['event'];

$query = "select * from club_event where event_id = '$curr'";
$result = mysqli_query($con, $query);

$data = $result->fetch_assoc();
$title = $data['title'];
$article = $data['article'];
$eligibility = $data['eligibility'];
$locations = $data['locations'];
$img = $data['image'];


$q1 = "SELECT * from participents Where event_id = '$curr' ";

$result2 = mysqli_query($con, $q1);
$count = mysqli_num_rows($result2);

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
    <div class="w-50 m-auto text-center my-2 py-1"><a class="" href="mainpage.php">Back</a></div>
    <div class="bar2 mx-auto py-3 mb-2">
        <div class="cover text-center mb-3">
            <?php echo "<img src='assets/uploads/" . $img . "' alt='' class='mx-auto'>"; ?>
        </div>

        <section>
            <div class="sec1">
                <h3 class="text-capitalize"><?php echo $title; ?></h3>
                <p><?php echo $article; ?></p>
                <p><span>Eligibility : </span><?php echo $eligibility ?></p>
            </div>

            <div class="benefits">
                <h5>Location :</h5>
                <p><?php echo $locations; ?></p>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="total d-flex align-items-center">
                    <h5 class="m-0">Total Participation: </h5>
                    <h5 class="m-0"> <?php echo $count ?></h5>
                </div>

                <?php
                $email = $_SESSION['email'];
                $curr = $_GET['event'];
                $query = "select * from participents where user_email = '$email' and event_id = $curr";
                $res = mysqli_query($con, $query);

                if (mysqli_num_rows($res) == 1)
                    $exists = true;
                else
                    $exists = false;
                ?>

                <a class="btn_c" href="<?= ($exists === true) ? "javascript:void(0)" : "registerAPI.php?event=$curr" ?>" <?= ($exists === true) ? "disabled" : ""; ?>>
                <?= ($exists === true) ? "You are registered" : "Register" ?>
            </a>
            </div>
        </section>
    </div>

    <script src="assets/js/app.js"></script>
    <script>
        var myButton = document.querySelector(".btn_c");

        if (myButton.hasAttribute("disabled")) {
            myButton.classList.remove("btn_c");
            myButton.classList.add("btn_d");
        }
    </script>
</body>

</html>