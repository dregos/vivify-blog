<?php include 'header.php' ?>
<?php
  $user = new User($dbBlog, 2);
?>
  <content>


    <div id="admin-user-posts" class="admin-user-posts-container">
      <table class="admin-user-posts-table">
        <tr>
          <th class="header-column first-column">Name</th>
          <th class="header-column">Options</th>
        <tr>
        <?php

          $articles = $dbBlog->getAllUserArticles($user);
          //var_dump($articles);
          if(empty($articles)){
            echo("<td>No posts yet.</td><td></td>");
          }else{
            foreach($articles as $article){
              echo("<tr>");
                echo("<td class=\"table-cell\">".$article->title."</td>");
                echo("<td class=\"table-cell\">");
                  echo("<span>Delete</span><span>Edit</span>");
                echo("</td>");
              echo("</tr>");
            }
          }
        ?>
      </table>
    </div>

    <div class="form-container">
      <h1>Add new post</h1>
      <form method="POST">
        <div class="form-control">
          <label>Post title</label>
          <input type="text" name="title"></input>
        </div>
        <div class="form-control">
          <label>Post content</label>
          <textarea rows="10" name="text" placeholder="Type in your mind..." required></textarea>
        </div>
        <div class="action-container">
          <button type="submit" name="save">Save</button>

        </div>
      </form>
    </div>
  </content>
<?php include 'footer.php' ?>
