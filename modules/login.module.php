<?php

require_once '../scripts/autoloader.script.php';

?>

<link rel="stylesheet" href="../styles/main.style.css" type="text/css">

<form action="login.page.php" method="post" class="form-wrapper">
    <h>Log In</h>
    <input type="text" class="text-field" id="nameField" name="name" placeholder="username">
    <input type="password" class="text-field-pass" id="passField" name="password" placeholder="password">
    <input type="submit" class="action-btn" name="login" value = "Log In">
    <input type="submit" class="text-link" name="goto-signup" value = "Sign Up?">
</form>

<?php

    if(isset($_POST["login"])){

        if(!empty($_POST["name"]) and !empty($_POST["password"])){
            doLogIn($_POST["name"],$_POST["password"]);
        }

    }

    if(isset($_POST["goto-signup"])){

        $redirect = new Redirect("signup");
        $redirect->redirectPage();

    }

    function doLogIn($name, $password): void
    {
        $db = new DB();
        $user = $db->getUser($name, $password);

        ($user!=null) ? initValidUser($user) : doLogInFail();

    }

    function initValidUser($user): void
    {
        session_start();
        $_SESSION["LoggedUser"] = $user;
        $redirect = new Redirect("home");
        $redirect->redirectPage();
    }

    function doLogInFail(): void
    {
        ?>
            <div class="error-msg">Failed Log In</div>
            <script type="module" src="../js/FailedLogIn.js"/>
        <?php

    }
