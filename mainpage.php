<?php
date_default_timezone_set('Asia/Dhaka');
session_start();
include("assets/connection.php");
if(!isset($_SESSION['email'])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Main Page</title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <?php include "nav.php" ?>

    <div id="carouselExampleIndicators" class="carousel slide col-lg-5 mw-100 px-0 mx-auto" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/img/im1.png" class="d-block w-100 img-fluid" alt="...">
            </div>
            <div class="carousel-item">
                <img src="assets/img/im2.png" class="d-block w-100 img-fluid" alt="...">
            </div>
        </div>
    </div>

    </div>

    <section class="row m-0 px-2 mt-3 pb-4" id="main">
        <aside class="col-lg-4 pt-4">
            <h2 class="text-capitalize text-center">Challenges</h2>
            <?php
            $query = "select * from problem_set";
            $res = mysqli_query($con, $query);

            if (mysqli_num_rows($res) < 1) :
            ?>
                <h4 class="text-center mt-5">No Challenges have been created yet</h4>

            <?php else : ?>
                <ol>
                    <?php while ($row = mysqli_fetch_assoc($res)) : ?>
                        <li>
                            <?php if (!((time() - strtotime($row['date_time'])) >= 24 * 60 * 60)) : ?>
                                <span class="text-uppercase me-2">
                                    recent
                                </span>
                            <?php endif ?>
                            <?= $row['title'] ?>
                            <a class="ms-2" href="problem.php?id=<?= $row['prblm_id'] ?>"> Check out</a>
                        </li>
                    <?php endwhile ?>
                </ol>
            <?php endif ?>
        </aside>


        <div class="col-lg-8" id="news">
            <h2 class="text-capitalize text-center">News and events</h2>

            <?php
            $query = "select * from club_event limit 10";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) < 1) :
            ?>

                <h4 class="text-center mt-5">No events or news have been posted yet</h4>
            <?php else : ?>
                <ol class="p-0">
                    <?php
                    $query = "select * from club_event limit 10";
                    $result = mysqli_query($con, $query);

                    while ($row = $result->fetch_assoc()) {
                        $title = $row['title'];
                        $date_time = strtotime($row['date_time']);
                        $formatted_date_time = date("j M Y g:i A", $date_time);
                        $event_id = $row['event_id'];
                    ?>

                        <li class="events mb-3 py-3">
                            <a class="mb-1 text-uppercase" href="event.php?event=<?php echo $event_id ?>"><?php echo $title ?></a>
                            <p class="mb-1"><?php echo $formatted_date_time ?></p>
                        </li>

                    <?php } ?>
                <?php endif ?>
                </ol>
        </div>
    </section>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        <?php 
            if(isset($_SESSION['contact'])){
                unset($_SESSION['contact']);
                echo "alert('Thank you for contacting us. Our admins will contact you via email')";
            }
        ?>
    </script>
</body>

</html>