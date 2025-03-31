 <?php
    //load all posts
    $db = new DB();
    $posts = $db->getAllPosts();
    foreach($posts as $p){
        $ownerName = $p->getOwnerName();
        $content = $p->getContent();
        ?>
        <div class="post-container">
            <h1 class="post-header"><?php echo $ownerName ?></h1>
            <p class="post-comment"><?php echo $content ?></p>
        </div>
        <?php
    }
    ?>

