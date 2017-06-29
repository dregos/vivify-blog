<?php include 'header.php' ?>
<?php
  $user = new User($dbBlog, 1);
  $allCategories = $dbBlog->getAllCategories();

  if(isset($_GET)){
    if(isset($_GET['did'])){
      $dbBlog->deleteArticle($_GET['did']);
      header ('Location: admin.php');
    }
    if(isset($_GET['eid'])){
      $article = $dbBlog->getArticleById($_GET['eid']);
      echo ("<script>window.article_id=".$article->getId()."</script>");
    }
  }

?>
  <content>


    <div id="admin-user-posts" class="admin-user-posts-container">
      <table class="admin-user-posts-table" id="admin-user-posts-table">
        <tr>
          <th class="header-column first-column">Name</th>
          <th class="header-column">Category</th>
          <th class="header-column">Options</th>
        <tr>
        <?php

          $articles = $dbBlog->getAllUserArticles($user);
          //var_dump($articles);
          if(empty($articles)){
            echo("<td>No posts yet.</td><td></td>");
          }else{
            foreach($articles as $article_post){
              echo("<tr>");
                echo("<td class=\"table-cell\">".$article_post->title."</td>");
                echo("<td class=\"table-cell\">".$article_post->category->getName()."</td>");
                echo("<td class=\"table-cell action-cell\">");
                  echo("<div class=\"action-container\">");
                  echo("<a class=\"button\" href=\"?did=".$article_post->getId()."\">Delete</a><a class=\"button\" href=\"?eid=".$article_post->getId()."\">Edit</a>");
                  echo("</div>");
                echo("</td>");
              echo("</tr>");
            }
          }
        ?>
      </table>
    </div>

    <div class="form-container">
      <?php
        $formTitle = isset($article) ? "Edit post" : "Add new post";
        echo("<h1>$formTitle</h1>");
       ?>

      <form method="POST">
        <div class="form-control">
          <label>Post title</label>
          <input type="text" name="title" id="article-title" value="<?php if(isset($article)){ echo($article->title); } ?>" required></input>
        </div>
        <div class="form-control">
          <label>Category</label>
          <select id="category_id">
            <?php
              $tmp = "<option value=\"\"";
              $tmp2 =!isset($article) ? " selected></option>" : "></option>";
              echo $tmp.$tmp2;

              foreach ($allCategories as $category){
                $tmp = "<option value=\"".$category->getId(). "\"";
                if(isset($article)){
                  if($category->getId()==$article->category->getId()){
                    $tmp = $tmp. " selected";
                  }
                }
                //$dbBlog->log->writeLog($tmp,null);
                $tmp =  $tmp. ">". $category->getName() . "</option>";
                echo($tmp);
              }
            ?>
          </select>
        </div>
        <div class="form-control">
          <label>Post content</label>
          <textarea rows="10" name="text" id="article-text" placeholder="Type in your mind..." required>
            <?php if(isset($article)){ echo($article->text); } ?>
          </textarea>
        </div>
        <div class="action-container">
          <a href="admin.php" class="button">Create new</a>
          <span id="save-article" class="button">Save</span>
          <p class="alert" style="display: none;">Please fill out all fields.</p>
        </div>
      </form>
    </div>
  </content>
  <script src="js/admin.js"></script>
<?php include 'footer.php' ?>
