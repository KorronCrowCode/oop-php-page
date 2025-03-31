<h class="new-post-header">Write Post</h>
<form action="home.page.php" method="post">
    <textarea type="text" class="post-text-field"id="new-post-text" name="new-post-text" placeholder="Write here..."></textarea>
    <input type="submit" class="action-btn" name="new-post-btn" value="Post"/>
</form>
    <?php
    if(isset($_POST["new-post-btn"]) and !empty($_POST["new-post-text"])){
        doPost($_POST["new-post-text"]);
    }

    function doPost($content): void{
        $db = new DB();
        $user = $_SESSION["LoggedUser"];
        $isPosted = $db->sendPost($user->getName(), $user->getPassword(), $content);
        onPost($isPosted);
    }
    function onPost($isPosted): void
    {
        if($isPosted){
            $redirect = new Redirect("home");
            $redirect->redirectPage();
        }else{
            ?>
            <div class="error-msg">Failed Post In</div>
            <script type="module" src="../js/FailedPost.js"/>
            <?php
        }
    }
    ?>
