<?php
date_default_timezone_set('Asia/Dhaka');
// echo date("d-M-Y h:i a", time());
session_start();

if(!isset($_SESSION['email'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/contact.css">
</head>

<body>
    <?php 
    include "nav.php";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $subject = $_POST['subject'];
            $msg = $_POST['msg'];
            $email = $_SESSION['email'];
            
            $query = "INSERT INTO `contact` (`id`, `subject`, `msg`, `email`) VALUES (NULL, '$subject', '$msg', '$email');";
            // echo $query;
            mysqli_query($con, $query);
            $_SESSION['contact'] = true;
            header("Location: mainpage.php");
        }
        
    ?>

    <main class="w-50 mt-5">
        <h4 class="text-center pb-2 mb-1" >Let us know if you have any types of queries</h4>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="subject" required>
                <label for="subject">Subject</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" name="msg" id="msg" placeholder="msg" required></textarea>
                <label for="msg">Message</label>
            </div>
            <input class="px-4 py-0 ms-auto" type="submit" value="Send" style="display: inherit;">
        </form>
    </main>

    <script src="assets/js/app.js"></script>
</body>

</html>