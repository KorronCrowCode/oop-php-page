<?php
require_once '../scripts/autoloader.script.php';
?>

<link rel="stylesheet" href="../styles/main.style.css" type="text/css">

<form action="signup.page.php" method="post" class="form-wrapper">
    <h>Sign Up</h>
    <input type="text" class="text-field" id="nameField" name="name" placeholder="username">
    <input type="password" class="text-field-pass" id="passField" name="password" placeholder="password">
    <input type="submit" class="action-btn" name="signup" value = "Sign Up">
    <input type="submit" class="text-link" name="goto-login" value="Go To Log In">
</form>
<?php
    if(isset($_POST["signup"])){

        if(!empty($_POST["name"]) and !empty($_POST["password"])){
            doSignUp($_POST["name"],$_POST["password"]);
        }

    }

    if(isset($_POST["goto-login"])){
        $redirect = new Redirect("login");
        $redirect->redirectPage();
    }
    function doSignUp($name, $password): void
    {
        $db = new DB();
        $user = $db->addUser($name, $password);

        ($user!=false) ? initUser($user) : doSignUpFail();

    }

    function initUser($user): void
    {
        session_start();
        $_SESSION["LoggedUser"] = $user;
        $redirect = new Redirect("home");
        $redirect->redirectPage();
    }

    function doSignUpFail(): void
    {
        ?>
        <div class="error-msg">Failed Sign Up</div>
        <script type="module" src="../js/FailedSignUp.js"/>
        <?php

    }
