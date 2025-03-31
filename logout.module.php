<form method="post" class="form-btn">
    <input type="submit" class="action-btn" name="logout-btn" value="Log Out" />
</form>
<?php
    if(isset($_POST["logout-btn"])){
        session_destroy();
        $redirect = new Redirect("login");
        $redirect->redirectPage();
    }