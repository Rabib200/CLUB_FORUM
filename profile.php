<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: index.php");
}
header("Cache-Control: no-store");
include "assets/connection.php";
$email = $_SESSION['email'];
$query = "select * from users where email = '$email'";

$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile name</title>
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/profile.css">
</head>

<body>
    <?php include "nav.php"; ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_SESSION['email'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $extension = pathinfo($image, PATHINFO_EXTENSION);

            $new_name = $email . '.' . $extension;
            $target_dir = "assets/uploads/";
            $target_file = $target_dir . basename($new_name);

            $existing_file = glob($target_dir . $email . ".*");
            if (!empty($existing_file)) {
                $existing_file_name = basename($existing_file[0], '.' . pathinfo($existing_file[0], PATHINFO_EXTENSION));
                if ($existing_file_name == $email) {
                    unlink($existing_file[0]);
                }
            }

            move_uploaded_file($tmp_name, $target_file);
        }
        header("Location: profile.php");
        exit();
    }
    ?>

    <main class=" mx-auto my-5 px-4 py-3">
        <section class="mb-3" id="personal">
            <figure>
                <div>
                    <div id="edit-btn">
                        <div class="p-1"><span class="me-1">Change Profile Picture</span><i class="fa-regular fa-circle-up fa-xl" title="Edit Image"></i></div>
                        <form action=<?= htmlspecialchars($_SERVER['PHP_SELF'])  ?> enctype="multipart/form-data" class="w-100 d-none" method="POST">
                            <div>
                                <input class="form-control form-control-sm" id="formFileSm" type="file" name="image" accept=".jpg" required>
                            </div>
                            <input class="px-3 py-1" type="submit" value="Update">
                        </form>
                    </div>
                    <img src=<?= $data['image_path'] ?> alt="figure" class="rounded-img">
                </div>
                <figcaption>
                    <h3 class="m-0 mt-2"><?php echo $data['name']; ?></h3>
                    <p class="m-0 mt-1 text-uppercase"><?php echo $data['position']; ?></p>
                    <p class="m-0 mt-1"><?php echo $data['st_id']; ?></p>
                </figcaption>
            </figure>
        </section>
        <section class="mb-3" id="gen-info ">
            <h3 class="mb-4">General Informations</h3>
            <p class="mb-3 px-3"><span>Email:</span> <?php echo $data['email']; ?></p>
            <p class="mb-3 px-3"><span>Phone No:</span> <?php echo $data['phone']; ?> </p>
            <p class="mb-3 px-3"><span>Address:</span> <?php echo $data['address']; ?></p>
        </section>
        <section id="credentials" class="mb-3">
            <h3 class="mb-4">Settings</h3>
            <div class="d-flex justify-content-between align-items-center px-3 mb-3">
                <p class="m-0"><span>Change current email</span></p>
                <!-- Button trigger modal -->
                <button type="button" class="px-3 py-2" data-bs-toggle="modal" data-bs-target="#exampleModal" id="e_change">
                    Change
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change Email</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="update.php" method="POST" id="changeCred">
                                <input type="hidden" name="form_type" value="email">
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email" id="newemail" placeholder="name@example.com" value="">
                                        <label for="floatingInput">New Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="confirmemail" placeholder="name@example.com" value="">
                                        <label for="floatingInput">Confirm Email address</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="px-2 py-2" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="px-3 py-2" value="Save Changes" disabled id="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center px-3">
                <p class="m-0"><span>Change current password</span></p>

                <button type="button" class="px-3 py-2" data-bs-toggle="modal" data-bs-target="#passchange" id="p_change">
                    Change
                </button>

                <!-- Modal -->
                <div class="modal fade" id="passchange" tabindex="-1" aria-labelledby="passchange" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="passchange">Change Password</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="update.php" id="changePass" method="POST">
                                <input type="hidden" name="form_type" value="pass">
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="curr" id="curr_pass" placeholder="name@example.com" value="">
                                        <label for="floatingInput">Current Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="n_pass" id="n_pass" placeholder="name@example.com" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,32}$" minlength="6" maxlength="32" autocomplete="off" value="">
                                        <label for="floatingInput">New Password</label>
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
                                        <input type="text" class="form-control" id="c_pass" placeholder="name@example.com" value="" autocomplete="off">
                                        <label for="floatingInput">Confirm Password</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="px-2 py-2" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="px-3 py-2" value="Save Changes" disabled id="submit2">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="other">
            <h3 class="mb-4">Other Informations</h3>
            <form action="update.php" method="POST" id="other">
                <input type="hidden" name="form_type" value="other">
                <p><span>Github: </span><span contenteditable="true"><?php echo $data['github']; ?></span></p>
                <input type="hidden" name="github" value="">
                <p><span>Linkedin: </span><span contenteditable="true"><?php echo $data['linkedin']; ?></span></p>
                <input type="hidden" name="linkedin" value="">
                <p><span>Facebook: </span><span contenteditable="true"><?php echo $data['facebook']; ?></span></p>
                <input type="hidden" name="facebook" value="">

                <input type="submit" value="Update" class="px-3 py-2">
            </form>

        </section>
    </main>


    <?php include "footer.php"; ?>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.4.min.js"></script>
    <script>
        const git_pat = new RegExp("^(https:\\/\\/)?(www\\.)?github\\.com\\/[a-zA-Z0-9_-]+$");
        const fac_pat = new RegExp("^(https:\\/\\/)?(www\\.)?facebook\\.com\\/[a-zA-Z0-9\\.]+$");
        const linked_pat = new RegExp("^(https:\\/\\/)?(www\\.)?linkedin\\.com\\/in\\/[a-zA-Z0-9_-]+$");

        document.querySelector("#other > input[type='submit']").addEventListener("click", (event) => {
            github = document.querySelectorAll("#other > p")[0].querySelectorAll("span")[1].textContent;
            linkedin = document.querySelectorAll("#other > p")[1].querySelectorAll("span")[1].textContent;
            facebook = document.querySelectorAll("#other > p")[2].querySelectorAll("span")[1].textContent;

            if (git_pat.test(github) && fac_pat.test(facebook) && linked_pat.test(linkedin)) {
                document.querySelectorAll("#other > input")[1].value = github;
                document.querySelectorAll("#other > input")[2].value = linkedin;
                document.querySelectorAll("#other > input")[3].value = facebook;
            } else {
                event.preventDefault()
                alert("Enter valid links before submiting");
            }
        });


        const passwordInput = document.getElementById("n_pass");
        passwordInput.addEventListener("input", function(event) {
            if (passwordInput.validity.patternMismatch) {
                event.preventDefault();
                div = document.getElementById("pass_val");
                div.className = "d-block";
            }
        });

        <?php
        if (isset($_SESSION['alert'])) {
            if ($_SESSION['alert'] == "exists") {
                echo "alert('Email already exists')";
                unset($_SESSION['alert']);
            } else if ($_SESSION['alert'] == "w_pass") {
                echo "alert('Wrong password')";
                unset($_SESSION['alert']);
            }
        }
        ?>
    </script>
</body>

</html>