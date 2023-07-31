<?php
session_start();
if ($_SESSION['admin'] < '1') {
    header("Location: ../mainpage.php");
    exit();
}

include "../assets/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $ques = $_POST["ques"];
    $input = $_POST["inputs"];
    $output = $_POST["outputs"];

    if (!isset($_SESSION['update'])) {
        $query = "INSERT INTO problem_set (title, question, inputs, outputs)
        VALUES ('$title', '$ques', '$input', '$output')";
    } else {
        $prblm_id = $_SESSION['update'];
        unset($_SESSION['update']);
        $query = "UPDATE problem_set
              SET title = '$title',
                  question = '$ques',
                  inputs = '$input',
                  outputs = '$output',
                  date_time = CURRENT_TIMESTAMP
              WHERE prblm_id = $prblm_id";
    }

    echo $query;

    mysqli_query($con, $query);
    header("Location: adminChall.php");
}


if (isset($_GET['prblm'])) {
    $prblm_id = $_GET['prblm'];
    $query = "SELECT * from problem_set where prblm_id = $prblm_id";
    $res = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($res);
    $_SESSION['update'] = $prblm_id;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create New Challenges</title>
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="css/comp_style.css">
</head>

<body>
    <main class="w-50 mt-5">
        <a class="btn_c btn_cancel" href="adminChall.php">Cancel</a>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <h4 class="text-uppercase text-center">Create Challenge</h4>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="title" name="title" placeholder="name@example.com" value="<?= isset($prblm_id) ? $data['title'] : ''; ?>" required>
                <label for="title">Title</label>
            </div>
            <div class="form-floating mb-3">
                <textarea name="ques" class="form-control" placeholder="ques" id="ques" required><?= isset($prblm_id) ? $data['question'] : ''; ?></textarea>
                <label for="ques">Question</label>
            </div>
            <div class="form-floating mb-3">
                <textarea name="inputs" class="form-control" placeholder="inputs" id="input" required><?= isset($prblm_id) ? $data['inputs'] : ''; ?></textarea>
                <label for="input">Inputs</label>
            </div>
            <div class="form-floating mb-3">
                <textarea name="outputs" class="form-control" placeholder="outputs" id="outputs" required><?= isset($prblm_id) ? $data['outputs'] : ''; ?></textarea>
                <label for="outputs">Outputs</label>
            </div>

            <input type="submit" value="<?= (isset($prblm_id)) ? "Update" : "Add" ?>" class="btn_c px-4 m-auto d-block">
        </form>
    </main>
</body>

</html>