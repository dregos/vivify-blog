<div class="comment-form form-container">
  <h4>Comment on this post</h4>
  <form method="POST">
    <div class="form-control">
      <textarea rows="2" id="comment-text" name="text" placeholder="Type in your mind..." required></textarea>
    </div>
    <div class="action-container">
      <span id="post-comment" class="button">Post comment</span>
      <p class="alert" style="display: none;">Don't tell me you got nothing to say.</p>
    </div>
  </form>
</div>
<div class="comments-container">
  <?php
    $comments = $article->getArticleComments();
    //var_dump($comments);
    if(empty($comments)){echo("<label>Be the first to comment this post.</label>"); return; }

    foreach($comments as $comment){
      $comment->returnHTML();
    }

  ?>
</div>
<script src="js/comments.js"></script>
