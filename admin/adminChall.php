<?php
ob_start();
session_start();
if ($_SESSION['admin'] < '1') {
  header("Location: ../mainpage.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Compitition Control</title>
  <link rel="stylesheet" href="../assets/css/nav.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link rel="stylesheet" href="css/comp_style.css">
</head>

<body>
  <?php include "../nav.php";
  if (isset($_GET['prblm'])) {
    $p_id = $_GET['prblm'];
    $query = "DELETE from problem_set where prblm_id = $p_id";

    mysqli_query($con, $query);
    $_SESSION['p_del'] = 1;
    header("Location: adminChall.php");
    exit();
  }
  ?>
  <main>
    <div>
      <a class="btn_c text-capitalize hover_tilt" href="challenge.php">Create new Challenges</a>
    </div>
    <table class="table">
      <thead>
        <th class="text-center">#</th>
        <th class="text-center">Title</th>
        <th class="text-center">Questions</th>
        <th class="text-center">Created</th>
        <th class="text-center">Action</th>
      </thead>
      <tbody>
        <?php
        $query = "select * from problem_set";
        $res = mysqli_query($con, $query);

        $count = 1;
        while ($row = mysqli_fetch_assoc($res)) :
        ?>
          <tr>
            <td><?= $count ?></td>
            <th><?= $row['title'] ?></th>
            <td><?= $row['question'] ?></td>
            <td style="white-space: nowrap;"><?php
                                              $timestamp = strtotime($row['date_time']);
                                              $formatted_date_time = date("j M Y g:i A", $timestamp);

                                              echo $formatted_date_time;
                                              ?></td>
            <td>
              <div class="d-flex justify-content-center">
                <a class="red" href=<?php
                                    echo 'adminChall.php?prblm=' . $row['prblm_id'];
                                    ?> onclick="return confirm('Are you sure you want to delete this task?');">
                  <i class="fa-regular fa-trash-can fa-xl"></i>
                </a>
                <a class="green" href=<?php
                                      echo 'challenge.php?prblm=' . $row['prblm_id'];
                                      ?> onclick="return confirm('Are you sure you want to update this task?');">
                  <i class="fa-solid fa-pencil fa-xl"></i>
                </a>
              </div>
            </td>
          </tr>
        <?php $count++;
        endwhile ?>
      </tbody>
    </table>
  </main>

  <script>
    <?php
    if (isset($_SESSION['p_del'])) {
      unset($_SESSION['p_del']);
      echo "alert('Deleted successfully')";
    }
    ?>
  </script>
</body>

</html>