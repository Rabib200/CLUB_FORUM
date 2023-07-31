<?php
session_start();

include "assets/connection.php";
if(!isset($_SESSION['email'])){
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $form = $_POST['form_type'];

    if ($form == "other") {
        $github = $_POST['github'];
        $facebook = $_POST['facebook'];
        $linkedin = $_POST['linkedin'];

        $sql = "UPDATE users SET github='$github', linkedin='$linkedin', facebook='$facebook' WHERE email='" . $_SESSION['email'] . "'";

        mysqli_query($con, $sql);
        header("Location: profile.php");
    } else if ($form == "email") {
        $email = $_POST['email'];
        $query = "select * from users where email = '$email'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 0) {
            $current = $_SESSION['email'];
            $sql = "UPDATE users SET email='$email' WHERE email='$current'";
            mysqli_query($con, $sql);
            $_SESSION['email'] = $email;

            session_destroy();

            header("Location: login.php?alert=s");
        } else {
            $_SESSION['alert'] = "exists";
            header("Location: profile.php");
        }
    } else if ($form == "pass") {
        $current = md5($_POST['curr']);
        $n_pass = md5($_POST['n_pass']);

        $user_email = $_SESSION['email'];
        $query = "select * from users where email='$user_email'";
        $result = mysqli_query($con, $query);

        $data = mysqli_fetch_assoc($result);
        if ($data['password'] != $current) {
            $_SESSION['alert'] = "w_pass";
            header("Location: profile.php");
        } else {
            $query = "UPDATE users SET password='$n_pass' WHERE email='" . $_SESSION['email'] . "'";
            mysqli_query($con, $query);

            session_destroy();

            header("Location: login.php?alert=s");
        }
    }

}

if(isset($_GET['delete'])){
    $email = $_GET['delete'];
    $query = "DELETE FROM users WHERE email = '$email'";
    // echo $query;
    mysqli_query($con, $query);
    $_SESSION['delete'] = 1;

    header("Location: admin/adminRmv.php");
}
