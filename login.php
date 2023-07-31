<?php
session_start();

if(isset($_SESSION['email'])){
    header("Location: mainpage.php");
    exit();
}

include("assets/connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    if (!empty($email) && !empty($password)) {
        $query = "select * from users where email = '" . $email . "' AND password = '" . $password . "' limit 1";
        $result = mysqli_query($con, $query);
        if ($result === false) {
            die("Error executing query: " . mysqli_error($con));
        }

        $data = mysqli_fetch_assoc($result);

        if ($data !== null) {
            $_SESSION['email'] = $data['email'];
            $_SESSION['student_id'] = $data['student_id'];
            $_SESSION['id'] = $data['id'];
            $_SESSION['admin'] = $data['admin_level'];
            if(isset($_SESSION['l_error']))
                unset($_SESSION['l_error']);
            header("Location: mainpage.php");
        } else {
            $_SESSION['l_error'] = "wrong";
            header("Location: login.php");
        }
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <h1 class="m-0 text-center mb-4" onclick="window.location.href='/uiuclub'" style="cursor: pointer;" >S<span class="color-accent">IA</span>S</h1>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" value="Log in">
        </div>
        <h3 class="my-3 text-center">or</h3>
        <div class="d-flex justify-content-center">
            <a href="signup.php" class="s_btn">Sign up</a>
        </div>
    </form>

    <script src="assets/js/jquery-3.6.4.min.js"></script>
    <script>
        <?php 
            if(isset($_SESSION['l_error']) && $_SESSION['l_error'] == "wrong"){
                echo "alert('Wrong email or password')";
                unset($_SESSION['l_error']);
            }
            else if(isset($_SESSION['created'])){
                unset($_SESSION['created']);
                echo "alert('Account created')";
            }
            else if($_GET['alert']){
                if($_GET['alert'] == "s"){
                    echo "alert('Update successfull')";
                }
            }
        ?>
    </script>
</body>

</html>