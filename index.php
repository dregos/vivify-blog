<?php include 'header.php' ?>

  <content>
    <div class="article-container">

      <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        //$numOfArticles = isset($_SESSION['articleCount']) ? $_SESSION['articleCount'] : 0;

        //$offset = $numOfArticles ? $numOfArticles/$page : 0;
        $offset = $articleCount/$page;
        var_dump($offset);
        $sql = "SELECT * FROM articles ORDER BY created DESC LIMIT ". $offset.",1";
        $articles = $dbBlog->fetchData($sql);
        $_SESSION['articleCount'] = isset($articles) ? count($articles):0;
        foreach ($articles as $record) {

          $article = new Article($dbBlog, $record);
          //var_dump($article->created);
          echo("<h2>".$article->title."</h2>");
          echo("<label>".$article->getCreatedDate(). " by ". $article->getAuthor() ."</label>");
          echo("<p>".$article->text."</p>");
        }

      ?>

    </div>
    <div class="action-container pager">

      <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        $next = $page + 1;
        $previous = $page - 1;
        if($page == 0){

          echo("<a href=\"index.php?page=$next\" class=\"link-button\">Newer</a>");

        }else{
          echo("<a href=\"index.php?page=$previous\" class=\"link-button\">Older</a>");
          echo("<a href=\"index.php?page=$next\" class=\"link-button\">Newer</a>");
        };
      ?>


    </div>
  </content>
<?php include 'footer.php' ?>
