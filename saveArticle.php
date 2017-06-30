<?php include 'db.php' ?>
<?php



  if(isset($_POST)){

    if(isset($_POST['article_id'])){

      $dbBlog->log->writeLog("zovem update article", null);
      $tmpArticle = new Article($dbBlog, $_POST);
      var_dump($tmpArticle);
      $dbBlog->updateArticle($tmpArticle);

    }else{
      $response = $dbBlog->createArticle($_POST);
      //echo($response);
      $article = $dbBlog->getArticleById($response);
      //$arcticle = new Article($dbBlog, $response);
      //echo $article->title;
      echo("<tr>");
        echo("<td class=\"table-cell\">".$article->title."</td>");
        echo("<td class=\"table-cell\">".$article->category->getName()."</td>");
        echo("<td class=\"table-cell action-cell\">");
          echo("<div class=\"action-container\">");
            echo("<a class=\"button\" href=\"?did=".$article->getId()."\">Delete</a><a class=\"button\" href=\"?eid=".$article->getId()."\">Edit</a>");
          echo("</div>");
        echo("</td>");
      echo("</tr>");
      //echo $arcticle->returnHTML();
    }

  }
?>
