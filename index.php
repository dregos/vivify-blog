<?php include 'header.php' ?>

  <content>
    <div class="article-container">

      <?php
        $rec_limit = 3;
        $page = isset($_GET['page']) ? $_GET['page'] : 0;

        //$offset = $page==0 ? 0 : ($page+1)+$rec_limit;
        if($page==0){
          $offset = 0;
        }else{
          $offset = ($rec_limit*$page);
        }
        //echo("limit:".$rec_limit."</br>");
        //echo("page:".$page."</br>");
        //echo("offset:".$offset."</br>");

        $sql = "SELECT COUNT(id) FROM articles;";
        $retVal = $dbBlog->fetchData($sql);
        $articleCount = $retVal[0]["COUNT(id)"];
        //echo("articleCount:$articleCount");
        //echo("</br>");

        $sql = "SELECT * FROM articles ORDER BY id ASC LIMIT ". $offset.",".$rec_limit;
        $articles = $dbBlog->fetchData($sql);

        foreach ($articles as $record) {

          $article = new Article($dbBlog, $record);
          echo("<h2><a href=\"article.php?id=".$article->getId()."\">".$article->title."</a></h2>");
          echo("<h4>".$article->category->getName()."</h4>");
          echo("<label>".$article->getCreatedDate(). " by ". $article->getAuthor() ."</label>");
          echo("<p>".$article->text."</p>");
        }

      ?>

    </div>
    <div class="action-container pager">

      <?php
        $max_pages = floor($articleCount/$rec_limit);
        //echo("max_pages:".$max_pages."</br>");
        $next = $page + 1;
        $previous = $page - 1;
        if($page == 0){
          echo("<a href=\"index.php?page=$next\" class=\"link-button\">Newer</a>");
        }elseif($page >= $max_pages){
          echo("<a href=\"index.php?page=$previous\" class=\"link-button\">Older</a>");
        }else{
          echo("<a href=\"index.php?page=$previous\" class=\"link-button\">Older</a>");
          echo("<a href=\"index.php?page=$next\" class=\"link-button\">Newer</a>");
        };
      ?>


    </div>
  </content>
<?php include 'footer.php' ?>
