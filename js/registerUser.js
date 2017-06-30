$(document).ready(function () {
  var baseUrl = "";


  $('#email').blur(function () {
    $('#mail-check-error').hide();
    var email = $('#email').val();
    if(!email.length){
      $('#form-data-check').show();
      return;
    }

    var data= { justCheckEmail: true, email: email };
    $.post(baseUrl + 'registerUser.php', data).then(function(response){
      //console.log("response from registerUser emailexists:");
      //console.log(response);
      if(response=="true"){
        console.log("emailexists(): true");
        $('#mail-check-error').show();

      }else{
        console.log("emailexists(): false");
        $('#mail-check-error').hide();
      }

    }).fail(function(response){
      console.log("AJAX PUT failed! Could not check email! Response:"+response);
    });

  });

  $('#btnSignUp').click(function () {
    registerUser();
  });
  /*
  $('#btnSignUp').keydown(function (e) {
    if (e.ctrlKey && e.keyCode == 13) {
      registerUser();
    }
  });
  */
  function registerUser (){

    if($('#mail-check-error').css('display')!="none"){
      $('#mail-check-error').show();
      console.log("registerUser/mail nije ok");
      return;
    }

    $('#mail-check-error').hide();

    if(!validRegistrationForm()){
      $('#form-data-check').show();
      return;
    }


    console.log("creating new user...");

    var firstName = $('#first_name').val();
    var lastName = $('#last_name').val();
    var valEmail = $('#email').val();
    var valPassword = $('#password').val();

    var data= { first_name: firstName ,last_name:lastName, email: valEmail, password: valPassword };
    //console.log(data);
    $.post(baseUrl + 'registerUser.php', data).then(function(response){
      //console.log("response from registerUser.php:");
      //console.log(response);
      if(response!=""){
        window.location.href = 'index.php';
      }


    }).fail(function(response){
      console.log("AJAX PUT failed! Could not register user! Response:"+response);
    });

  }


  function validRegistrationForm(){
    var val = $('#first_name').val();
    if(!val.length){  return false; }
    var val = $('#last_name').val();
    if(!val.length){  return false; }
    var val = $('#email').val();
    if(!val.length){  return false; }
    var val = $('#password').val();
    if(!val.length){  return false; }

    return true;
  }
  function clearFormData(){
    $('#first_name').val('');
    $('#last_name').val('');
    $('#email').val('');
    $('#password').val('');
  }



});
