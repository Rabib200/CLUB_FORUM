
<script>
<?php
    session_start();
    include("assets/connection.php");
    if(!isset($_SESSION['email'])){
        header("Location: index.php");
    }
    $email = $_SESSION['email'];
    $curr = $_GET['event'];

    $q2 = "INSERT INTO participents(user_email,event_id) VALUES ('$email' , '$curr')" ;
    mysqli_query($con,$q2);

    header("Location: event.php?event=".$curr);

?>

</script>