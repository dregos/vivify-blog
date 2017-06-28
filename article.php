<?php include 'header.php' ?>

  <content>
    <div class="article-container">

      <?php

        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if($id==null){ echo("<h2>Ups!:( I guess this post wasn't written yet.</h2>"); return; }

        $article = $dbBlog->getArticleById($id);
        if($article==null){ echo("<h2>Ups!:( I guess this post wasn't written yet.</h2>"); return; }


        echo("<h2>".$article->title."</h2>");
        echo("<h4>".$article->category->getName()."</h4>");
        echo("<label>".$article->getCreatedDate(). " by ". $article->getAuthor() ."</label>");
        echo("<p>".$article->text."</p>");

      ?>

    </div>
    <script> window.article_id = <?php echo($article->getId()) ?>;</script>
    
    <?php include 'comments.php' ?>

  </content>
<?php include 'footer.php' ?>
