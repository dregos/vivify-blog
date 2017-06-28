$(document).ready(function () {
  var baseUrl = "";
  $('#post-comment').click(function () {
    postComment();
  });
  $('#comment-text').keydown(function (e) {
    if (e.ctrlKey && e.keyCode == 13) {
      postComment();
    }
  });

  function postComment (){
    var val = $('#comment-text').val();
    if(!val.length){
      $('.alert').show();
      return;
    };

    var data= { text: val, user_id : window.user_id, article_id : window.article_id };
    $.post(baseUrl + 'addComment.php', data).then(function(response){
      //console.log(response);
      $('.comments-container').prepend(response);
      $('#comment-text').val('');
      $('.alert').hide();
    }).fail(function(response){
      console.log("AJAX PUT failed! Can not add comment! Response:"+response);
    });

  }

  function makeComment(data) {
    console.log()
    var comment =  $('<span></span>').text(data.text);
    return comment;
  };



});
