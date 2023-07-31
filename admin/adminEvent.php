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
        <a class="px-3 py-2" href="adminPost.php" title='Admin POST'>POST</a>
      </div>
      <?php
      if (isset($_GET['task'])) {
        $task_id = $_GET['task'];

        $query = "delete from club_event where event_id='$task_id'";
        mysqli_query($con, $query);
        $_SESSION['task_del'] = 1;
        header("Location: adminEvent.php");
        exit();
      }

      $query = "select * from club_event";
      $result = mysqli_query($con, $query);

      if (mysqli_num_rows($result) == 0) :
      ?>
        <h1 class="text-center m-0">No events have been created yet yet</h1>
      <?php else : ?>
        <table class="table">
          <tr>
            <th>Title</th>
            <th>heading</th>
            <th>location</th>
            <th>article</th>
            <th>eligibility</th>
            <th>date_time</th>
          </tr>
          <?php
          while ($row = mysqli_fetch_assoc($result)) :
          ?>
            <tr>
              <td>
                <?= $row['title'] ?>
              </td>
              <td>
                <?= $row['heading'] ?>
              </td>
              <td>
                <?= $row['locations'] ?>
              </td>
              <td>
                <?= $row['article'] ?>
              </td>
              <td>
                <?= $row['eligibility'] ?>
              </td>
              <td>
                <?php
                $task_date_timestamp = strtotime($row['date_time']);
                $task_date_formatted = date('d-m-Y h:i:s a', $task_date_timestamp);

                echo $task_date_formatted;
                ?>
              </td>
              

              <td>
                <div class="d-flex justify-content-center">
                  <a class="red" href=<?php
                                      echo 'adminEvent.php?task=' . $row['event_id'];
                                      ?> onclick="return confirm('Are you sure you want to delete this task?');">
                    <i class="fa-regular fa-trash-can"></i>
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