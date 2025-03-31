<!DOCTYPE html>
<html id="home">

<?php
require_once '../scripts/autoloader.script.php';
session_start();

//redirect to portal if not logged in
if(empty($_SESSION["LoggedUser"])){
    $redirect = new Redirect("login");
    $redirect->redirectPage();
}
?>

<meta charset="utf-8">

<head>

    <title>ChatRoom</title>

    <link rel="icon" href="assets/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/main.style.css" type="text/css">


</head>

<body id="home-wrapper">

    <?php include_once '../modules/logout.module.php'; ?>

    <div class="new-post-container">
        <?php include_once '../modules/newpost.module.php'; ?>
    </div>

    <div class="posts-container">
        <?php include_once '../modules/posts.module.php'; ?>
    </div>



</body>

</html>
