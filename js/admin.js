$(document).ready(function () {
  var baseUrl = "";
  $('#save-article').click(function () {
    saveArticle();
  });
  /*
  $('#comment-text').keydown(function (e) {
    if (e.ctrlKey && e.keyCode == 13) {
      saveArticle();
    }
  });
  */
  function saveArticle (){
    if(!validArticleContent()){
      $('.alert').show();
      return;
    }
    var articleTitle = $('#article-title').val();
    var articleText = $('#article-text').val();
    var articleCtgId = $('#category_id').val();
    var articleId = window.article_id;
    console.log("articleID:"+ articleId);

    var data= { article_id: articleId ,title:articleTitle, text: articleText, category_id: articleCtgId, user_id : window.user_id };
    //console.log(data);
    $.post(baseUrl + 'saveArticle.php', data).then(function(response){
      //console.log(response);
      if(isEmpty(articleId)){

        $('#admin-user-posts-table > tbody > tr:first').after(response);
        clearFormData();
      }
      $('.alert').hide();

    }).fail(function(response){
      console.log("AJAX PUT failed! Could not save post! Response:"+response);
    });

  }
  function validArticleContent(){
    var val = $('#article-title').val();
    if(!val.length){  return false; }
    var val = $('#article-text').val();
    if(!val.length){  return false; }
    var val = $('#category_id').val();

    if(!val.length){  return false; }

    return true;
  }
  function clearFormData(){
    $('#article-title').val('');
    $('#article-text').val('');
    $('#category_id').val();
  }

  function makeComment(data) {
    console.log()
    var comment =  $('<span></span>').text(data.text);
    return comment;
  };



});
