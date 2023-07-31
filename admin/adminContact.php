<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
if ($_SESSION['admin'] < '1') {
    header("Location: ../mainpage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Check contact</title>
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="css/contact.css">
</head>

<body>
    <?php include "../nav.php"; ?>

    <main class="w-75 m-auto mt-4">
        <table class="table">
            <thead>
                <th class="text-center">#</th>
                <th class="text-center">Time</th>
                <th class="text-center">Name</th>
                <th class="text-center">Subject</th>
                <th class="text-center">Query</th>
                <th class="text-center">Email</th>
            </thead>
            <tbody>
                <?php
                $query = "SELECT contact.id, contact.subject, contact.msg, contact.created_at, users.name, users.email , users.admin_level
                    FROM contact
                    INNER JOIN users ON contact.email = users.email";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) < 1) :
                ?>
                    <tr>
                        <td class="text-center" colspan="6">No one has contacted yet</td>
                    </tr>

                <?php else : ?>    
                    <?php $cn = 1;
                    while ($row = mysqli_fetch_assoc($result)) : ?>
                        <?php if ($row['admin_level'] < $_SESSION['admin']) : ?>
                            <tr>
                                <td class="text-center">
                                    <?= $cn ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    $time = date("d-M-Y  h:i a", strtotime($row['created_at']));
                                    echo $time;
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['name'] ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['subject'] ?>
                                </td>
                                <td class="text-center">
                                    <?= $row['msg'] ?>
                                </td>
                                <td class="text-center">
                                    <a href="mailto:<?= $row['email'] ?>" title="Click to send email"><?= $row['email'] ?></a>
                                </td>
                            </tr>
                        <?php endif ?>
                <?php $cn++; endwhile; ?>
                <?php endif ?>
            </tbody>
        </table>
    </main>

    <script src="../assets/js/app.js"></script>
    <script>
        // var links = document.querySelectorAll("main table tr td a");
        // for (var i = 0; i < links.length; i++) {
        //     var link = links[i];
        //     var href = link.getAttribute("href");
        //     if (href && href.indexOf("mailto:") != -1) {
        //         var email = href.substring(7);
        //         link.addEventListener("click", function(event) {
        //             event.preventDefault();
        //             window.location.href = "https://mail.google.com/mail/?view=cm&to=" + email;
        //         });
        //     }
        // }
    </script>
</body>

</html>