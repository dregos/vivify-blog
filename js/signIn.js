$(document).ready(function () {
  var baseUrl = "";


  $('#btnSignIn').click(function () {
    login();
  });

  $('#btnSignIn').keydown(function (e) {
    if (e.ctrlKey && e.keyCode == 13) {
      login();
    }
  });
  function login (){

    if(!validSignInForm()){
      $('#form-data-check').show();
      return;
    }


    console.log("loging in...");

    var valEmail = $('#email').val();
    var valPassword = $('#password').val();

    var data= { email: valEmail, password: valPassword };
    //console.log(data);
    $.post(baseUrl + 'loginUser.php', data).then(function(response){
      //console.log("response from loginUser.php:");
      //console.log(response);
      if(response!=""){

        //console.log("good email and passw");
        window.location.href = 'index.php';
      }else{
        $('#form-wrong-login').show();
      }



    }).fail(function(response){
      console.log("AJAX PUT failed! Could not signin user! Response:"+response);
    });

  }


  function validSignInForm(){
    var val = $('#email').val();
    if(!val.length){  return false; }
    var val = $('#password').val();
    if(!val.length){  return false; }

    return true;
  }
  function clearFormData(){
    $('#email').val('');
    $('#password').val('');
  }



});
