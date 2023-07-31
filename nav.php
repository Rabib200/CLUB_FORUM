<?php
include "assets/connection.php";

$query = "select * from users where email = '" . $_SESSION['email'] . "'";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);

if (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false) {
    $c_ex = '';
    $url_ex = '../';
    $ad = '';
} else {
    $c_ex = 'admin/';
    $url_ex = '';
    $ad = 'admin/';
}

?>

<div id="overlay" class="">
    <menu class="">
        <ol class="px-0" id="list_menu">
            <li class="">
                <a <?= 'href="' . $url_ex . 'mainpage.php"'  ?> class="d-flex align-items-center justify-content-start">
                    <p class="m-0"><i class="fa-solid fa-newspaper fa-xl"></i></p>
                    <h5 class="text-capitalize m-0">news feed</h5>
                </a>
            </li>
            <li>
                <a <?= 'href="' . $url_ex . 'profile.php"'  ?> class="d-flex align-items-center justify-content-start">
                    <p class="m-0"><i class="fa-solid fa-user fa-xl rounded-circle"></i></p>
                    <h5 class="text-capitalize m-0">profile</h5>
                </a>
            </li>
            <?php if ($data['admin_level'] < 2) : ?>
                <li>
                    <a <?= 'href="' . $url_ex . 'task.php"'  ?> class="d-flex align-items-center justify-content-start">
                        <p class="m-0"><i class="fa-solid fa-list-check fa-xl"></i></p>
                        <h5 class="text-capitalize m-0">tasks</h5>
                    </a>
                </li>

                <li>
                    <a <?= 'href="' . $url_ex . 'contact.php"'  ?> class="d-flex align-items-center justify-content-start">
                        <p class="m-0"><i class="fa-solid fa-address-card fa-xl"></i></p>
                        <h5 class="text-capitalize m-0">contact us</h5>
                    </a>
                </li>
            <?php endif ?>
            <?php if ($data['admin_level'] > 0) : ?>
                <li>
                    <a <?= 'href="' . $c_ex . 'adminContact.php"'  ?> class="d-flex align-items-center justify-content-start">
                        <p class="m-0"><i class="fa-solid fa-address-card fa-xl"></i></p>
                        <h5 class="text-capitalize m-0">User's msg</h5>
                    </a>
                </li>
            <?php endif ?>
        </ol>

        <div class="text-center mt-5">
            <span><i class="fa-solid fa-xmark fa-2xl"></i></span>
        </div>
    </menu>
</div>

<nav class="row py-1 px-4 container-fluid mx-0">
    <div id="profile" class="col-4 d-flex">
        <div class="d-flex align-items-center">
            <div class="user rounded-circle" style="background-image: url('<?php echo $url_ex . $data['image_path']; ?>')"></div>
            <div class="ms-2">
                <h5 class="m-0">
                    <?php echo $data['name'] ?>
                </h5>
                <p class="m-0">
                    <?php echo $data['position'] ?>
                </p>
            </div>
        </div>
    </div>

    <div class="col-4 container-fluid text-center" onclick="window.location.href='/uiuclub'" style="cursor: pointer;">
        <h2 class="text-uppercase fw-bold m-0">s<span class="orange">ia</span>s</h2>
        <p class="mb-0">Students' International Affairs Society</p>
    </div>

    <!-- <div id="search" class="col-4 d-flex align-items-center">
        <form action="#" class="input-group">
            <span class="input-group-text" id="basic-addon1">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
        </form>
    </div> -->

    <div id="notification" class="col-4 d-flex justify-content-end">
        <div class="d-flex justify-content-center align-items-center">
            <?php
            if ($_SESSION['admin'] > 0 && strpos($_SERVER['REQUEST_URI'], '/admin/adminHome.php') === false) :
            ?>
                <a href=<?= $ad . 'adminHome.php' ?> class="m-0 px-3 py-1 me-4">ADMIN</a>
            <?php endif ?>
            <a <?= 'href="' . $url_ex . 'logout.php?logout"'  ?> class="px-4 py-1">Logout</a>
        </div>
    </div>
</nav>