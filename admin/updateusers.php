<?php
session_start();
if ($_SESSION['admin'] < '1') {
    header("Location: ../mainpage.php");
    exit();
}

include "../assets/connection.php";
$query = "select * from users where email='" . $_GET['email'] . "'";
$result = mysqli_query($con, $query);

$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $st_id = trim($_POST['st_id']);
    $name = trim($_POST['name']);
    $position = trim($_POST['position']);
    $dept = trim($_POST['dept']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $admin_level = trim($_POST['admin_level']);

    $query = "UPDATE users SET `name`='$name', `position`='$position', `dept`='$dept', `phone`='$phone', `address`='$address', `admin_level`=$admin_level WHERE `email`='" . $_POST['email'] . "'";

    mysqli_query($con, $query);
    $_SESSION['u_success'] = 1;
    header("Location: adminRmv.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="css/u_style.css">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center flex-column py-3">
        <div class="d-flex justify-content-evenly w-100">
            <a class="px-3 py-1" href="adminRmv.php">Close</a>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <input class="px-3 py-1" type="submit" value="Update" id="u_btn">
                <input type="hidden" name="st_id" value="">
                <input type="hidden" name="name" value="">
                <input type="hidden" name="position" value="">
                <input type="hidden" name="dept" value="">
                <input type="hidden" name="phone" value="">
                <input type="hidden" name="address" value="">
                <input type="hidden" name="admin_level" value="">
                <div>
                    <input type="hidden" name="email" value="<?= $_GET['email'] ?>">
                </div>
            </form>
        </div>
        <table class="table table-striped">
            <caption>Click to the field to start editing</caption>
            <tr>
                <th scope="row">Student id</th>
                <td contenteditable>
                    <?= $data['st_id'] ?>
                </td>
            </tr>
            <tr>
                <th scope="row">Name</th>
                <td contenteditable>
                    <?= $data['name'] ?>
                </td>
            </tr>
            <tr>
                <th scope="row">Position</th>
                <td contenteditable>
                    <?= $data['position'] ?>
                </td>
            </tr>
            <tr>
                <th scope="row">Department</th>
                <td contenteditable>
                    <?= $data['dept'] ?>
                </td>
            </tr>
            <tr>
                <th scope="row">Phone</th>
                <td contenteditable>
                    <?= $data['phone'] ?>
                </td>
            </tr>
            <tr>
                <th scope="row">Address</th>
                <td contenteditable>
                    <?= $data['address'] ?>
                </td>
            </tr>
            <tr>
                <th scope="row">Admin Level</th>
                <td contenteditable="">
                    <?= $data['admin_level'] ?>
                </td>
            </tr>
        </table>
    </div>

    <script>
        document.getElementById("u_btn").addEventListener("click", () => {
            const inputs = document.querySelectorAll('form > input:not(:first-child)');
            const tds = document.getElementsByTagName("td");

            inputs.forEach((e, i) => {
                e.value = tds[i].textContent;
            });
        })
    </script>
</body>

</html>