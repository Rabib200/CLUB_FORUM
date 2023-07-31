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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/css/nav.css">
  <link rel="stylesheet" href="css/aTaskStyle.css" />
  <title>Document</title>
</head>

<body>
  <?php include "../nav.php" ?>
  <main>
    <section>
      <div>
        <a class="px-3 py-2" href="assign_task.php" title='Assign tasks'>Assign</a>
      </div>
      <?php
      if (isset($_GET['task'])) {
        $task_id = $_GET['task'];

        $query = "delete from task where id='$task_id'";
        mysqli_query($con, $query);
        $_SESSION['task_del'] = 1;
        header("Location: adminTask.php");
        exit();
      }

      $query = "select * from task";
      $result = mysqli_query($con, $query);

      if (mysqli_num_rows($result) == 0) :
      ?>
        <h1 class="text-center m-0">No tasks have been assigned to anyone yet</h1>
      <?php else : ?>
        <table class="table">
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Assigned to</th>
            <th>Assigned date</th>
            <th>Task Deadline</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          <?php
          while ($row = mysqli_fetch_assoc($result)) :
          ?>
            <tr>
              <td>
                <?= $row['title'] ?>
              </td>
              <td>
                <?= $row['description'] ?>
              </td>
              <td>
                <?= $row['assigned_to'] ?>
              </td>
              <td>
                <?php
                $task_date_timestamp = strtotime($row['assigned_date']);
                $task_date_formatted = date('d-m-Y h:i:s a', $task_date_timestamp);

                echo $task_date_formatted;
                ?>
              </td>
              <td>
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
                echo '<td class="red">Expired</td>';
              else {
                if ($row['completed'] == 1)
                  echo '<td class="green">Completed</td>';
                else
                  echo '<td class="grey">Incomplete</td>';
              }
              ?>

              <td>
                <div class="d-flex justify-content-center">
                  <a class="red" href=<?php
                                      echo 'adminTask.php?task=' . $row['id'];
                                      ?> onclick="return confirm('Are you sure you want to delete this task?');">
                    <i class="fa-regular fa-trash-can"></i>
                  </a>
                  <a class="green" href=<?php
                                        echo 'assign_task.php?task=' . $row['id'];
                                        ?> onclick="return confirm('Are you sure you want to update this task?');">
                    <i class="fa-solid fa-pencil"></i>
                  </a>
                </div>
              </td>
            </tr>
          <?php endwhile ?>
        </table>
      <?php endif ?>
    </section>
  </main>

  <script src="../assets/js/app.js"></script>
  <script>
    <?php
    if (isset($_SESSION['task_del'])) {
      unset($_SESSION['task_del']);
      echo "alert('Task deleted successfully')";
    }
    ?>
  </script>
</body>

</html>