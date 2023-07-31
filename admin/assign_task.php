<?php
session_start();
if ($_SESSION['admin'] < '1') {
    header("Location: ../mainpage.php");
    exit();
}

include "../assets/connection.php";
$query = "select * from users";
$result = mysqli_query($con, $query);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $deadline = strtotime($_POST['deadline'] . " 23:59:59");
    $deadline_formatted = date("Y-m-d H:i:s", $deadline);
    $assign = $_POST['selected'];


    if (!isset($_SESSION['task_update'])) {
        $query = "INSERT INTO task (description, assigned_to, title, assigned_date, task_date, completed) 
              VALUES ('$desc', '$assign', '$title', CURRENT_TIMESTAMP, DATE_FORMAT('$deadline_formatted', '%Y-%m-%d %H:%i:%s'), 0)";
    } else {
        $task_id = $_SESSION['task_update'];
        unset($_SESSION['task_update']);
        $query = "UPDATE task SET 
            description = '$desc', 
            assigned_to = '$assign', 
            title = '$title', 
            assigned_date = CURRENT_TIMESTAMP, 
            task_date = '$deadline_formatted' 
          WHERE id = '$task_id'";
    }
    
    mysqli_query($con, $query);
    header("Location: adminTask.php");
}

if (isset($_GET['task'])) {
    $task_id = $_GET['task'];
    $g = "SELECT * FROM task WHERE id='$task_id'";
    $r = mysqli_query($con, $g);
    $task = mysqli_fetch_assoc($r);
    $_SESSION['task_update'] = $task_id;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Assign Tasks</title>
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="css/aTaskStyle.css">
</head>

<body>
    <main class="add">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method='POST'>
            <h4 class="text-uppercase text-center">Assign Task</h4>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="title" name="title" placeholder="name@example.com" value="<?= isset($task) ? $task['title'] : ''; ?>" required>
                <label for="title">Title</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="desc" name="desc" placeholder="Password" value="<?= isset($task) ? $task['description'] : ''; ?>" required>
                <label for="desc">Description</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="deadline" name="deadline" placeholder="deadline" value="<?= isset($task) ? date('Y-m-d', strtotime($task['task_date'])) : ''; ?>" required>
                <label for="deadline">Deadline</label>
            </div>
            <select class="form-select mb-3" aria-label="Default select example " name='selected' required>
                <option <?= isset($task) ? '' : 'selected'; ?>>Select</option>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <?php if ($_SESSION['admin'] > $row['admin_level']) : ?>
                        <option class="text-capitalize" value=<?= $row['email']; ?> <?= isset($task) && $task['assigned_to'] == $row['email'] ? 'selected' : ''; ?>><?= "{$row['st_id']} - {$row['name']} ({$row['position']})" ?></option>
                    <?php endif ?>
                <?php endwhile ?>
            </select>

            <div class="text-center">
                <input class="px-3 py-1" type="submit" value=<?= isset($task) ? 'Update' : 'Assign'; ?>>
                <a class="btn_c" href="adminTask.php">Back</a>
            </div>
        </form>
    </main>
</body>

</html>