<?php

session_start();
if(isset($_SESSION['email'])){
    header("Location: mainpage.php");
    exit();
}

include("assets/connection.php");


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $dept = $_POST['dept'];
    $s_id = $_POST['id'];
    $email = $_POST['email'];
    $github = $_POST['github'];
    $facebook = $_POST['facebook'];
    $linkedin = $_POST['linkedin'];
    $address = $_POST['address'];
    $phn = $_POST['phone'];
    $password = $_POST['password'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $extension = pathinfo($image, PATHINFO_EXTENSION);

        $new_name = $email . '.' . $extension;
        $target_dir = "assets/uploads/";
        $target_file = $target_dir . basename($new_name);

        move_uploaded_file($tmp_name, $target_file);

        $image_path = $target_file;
    } else {
        $image_path = "";
    }

    $checkuser = "select * from users where email = '" . $email . "' limit 1";
    $result = mysqli_query($con, $checkuser);
    $c = mysqli_num_rows($result);
    if ($c > 0) {
        $_SESSION['exists'] = true;
        header("Location: signup.php");
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $md5password = md5($password);

            $query = "INSERT INTO `users` (`st_id`, `name`, `position`, `dept`, `password`, `email`, `phone`, `image_path`, `address`, `github`, `facebook`, `linkedin`, `admin_level`) VALUES ('$s_id', '$fname $lname', 'general', '$dept', '$md5password', '$email', '$phn', '$image_path', '$address', '$github', '$facebook', '$linkedin', '0')";
            
            // echo $query;
            mysqli_query($con, $query);
            $_SESSION['created'] = true;
            header("Location: login.php");
        }
    }
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>
    <form id="sform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="m-5" style="width: 600px;" enctype="multipart/form-data">
        <h1 class="text-center mb-3">Sign <span class="color-accent">Up</span></h1>
        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="first_name" id="f-name" placeholder="first name" required>
                    <label for="f-name">First Name</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="last_name" id="l-name" placeholder="last name" required>
                    <label for="l-name">Last Name</label>
                </div>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="github" id="github" pattern="^(https:\/\/)?(www\.)?github\.com\/[a-zA-Z0-9_-]+$" placeholder="github" required>
            <label for="github">Github</label>
        </div>
        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" pattern="^(https:\/\/)?(www\.)?facebook\.com\/[a-zA-Z0-9\.]+$" name="facebook" id="facebook" placeholder="facebook" required>
                    <label for="facebook">Facebook</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="linkedin" pattern="^(https:\/\/)?(www\.)?linkedin\.com\/in\/[a-zA-Z0-9_-]+$" id="linkedin" placeholder="last name" required>
                    <label for="linkedin">Linkedin</label>
                </div>
            </div>
        </div>

        <div class="row g-2">
            <div class="col-md-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="dept" id="dept" placeholder="department" required>
                    <label for="dept">Department</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="phone" required>
                    <label for="phone">Phone Number</label>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="id" id="id" placeholder="id" required>
                    <label for="id">Student Id</label>
                </div>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="address" id="address" placeholder="address" required>
            <label for="address">Address</label>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Provide an image</label>
            <input class="form-control" type="file" id="image" name="image" accept=".jpg, .jpeg, .png" required>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
            <label for="email">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,32}$" minlength="6" maxlength="32" required value="" required>
            <label for="password">Password</label>
        </div>

        <div class="mb-3 d-none" id="pass_val">
            <p class="m-0">Your password should be at 8 to 32 character</p>
            <p class="m-0">Password should contain</p>
            <ul type="square">
                <li>An uppercase</li>
                <li>A lowercase</li>
                <li>A special character</li>
                <li>A number</li>
            </ul>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="c_password" id="c_password" placeholder="Password" value="" required>
            <label for="c_ password">Confirm Password</label>
        </div>

        <div class="d-flex justify-content-center mb-3" id="signup-div">
            <input type="submit" value="Sign up">
        </div>

        <h4 class="mb-3 text-uppercase text-center">or</h4>

        <div class="d-flex justify-content-center">
            <a href="login.php" class="s_btn">Login</a>
        </div>

    </form>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/jquery-3.6.4.min.js"></script>
    <script>
        const passwordInput = document.getElementById("password");
        passwordInput.addEventListener("input", function(event) {
            if (passwordInput.validity.patternMismatch) {
                event.preventDefault();
                div = document.getElementById("pass_val");
                div.className = "d-block";
            }
        });

        <?php 
            if(isset($_SESSION['exists'])) {
                unset($_SESSION['exists']);
                echo "alert('Email already exists')";
            }
        ?>
    </script>
</body>

</html>