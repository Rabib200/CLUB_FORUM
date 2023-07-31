<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
if(!isset($_SESSION['email'])){
    header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Task</title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/task.css">
</head>

<body>
    <?php include "nav.php" ?>

    <main class="w-75 m-auto mt-5">
        <div>
            <h4 class="m-0 mb-2 text-center" >
                Club Tasks
            </h4>
        </div>
        <table class="table">
            <tr>
                <th class="text-center">Title</th>
                <th class="text-center">Description</th>
                <th class="text-center">Creation Date</th>
                <th class="text-center">Task Ending Date</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
            <?php
            if(isset($_GET['status'])){
                $query = "Update task set completed=1 where id = {$_GET['status']}";
                mysqli_query($con, $query);
                header("Location: task.php");
            }
            $query = "SELECT * FROM task WHERE assigned_to = '" . $_SESSION['email'] . "'";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) < 1):
            ?>
                <tr>
                    <td colspan="6" class="text-center">No tasks for you</td>
                </tr>
            <?php
                else:
            while ($row = mysqli_fetch_array($result)) :
            ?>
                <tr>
                    <td class="text-center"><?php echo $row['title']; ?></td>
                    <td class="text-center"><?php echo $row['description']; ?></td>
                    <td class="text-center">
                        <?php
                        $task_date_timestamp = strtotime($row['assigned_date']);
                        $task_date_formatted = date('d-m-Y h:i:s a', $task_date_timestamp);

                        echo $task_date_formatted;
                        ?>
                    </td>
                    <td class="text-center">
                        <?php
                        $task_date_timestamp = strtotime($row['task_date']);
                        $task_date_formatted = date('d-m-Y h:i:s a', $task_date_timestamp);

                        echo $task_date_formatted;
                        ?>
                    </td>
                    <?php
                    $task_date = strtotime($row["task_date"]);
                    $current_date = time();
                    $passed  = false;
                    if ($task_date < $current_date)
                        $passed = true;

                    if ($passed)
                        echo '<td class="text-center red">Expired</td>';
                    else {
                        if ($row['completed'] == 1)
                            echo '<td class="text-center green">Completed</td>';
                        else
                            echo '<td class="text-center grey">Incomplete</td>';
                    }
                    ?>
                    <td class="text-center">
                        <a href=<?= "task.php?status=" . $row['id'] ?>  
                            <?= $passed ? 'class="red" disabled' : '' ?>
                            <?= (!$passed && $row['completed'] == 0) ? 'class = "grey"':'' ?>
                            <?= (!$passed && $row['completed'] == 1) ? 'class = "green" disabled':'' ?>
                        >
                            <i class="fa-regular fa-circle-check"></i>
                        </a>
                    </td>
                </tr>

            <?php endwhile ?>
            <?php endif ?>

        </table>
    </main>

    <script src="assets/js/app.js"></script>
</body>

</html>