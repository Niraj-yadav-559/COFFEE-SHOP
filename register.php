<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <script>
           

            $(document).ready(function(){
                $('#name').hide();
                $('#email').hide();
                $('#password').hide();
                $('#cpassword').hide();
                
                var name_err = true;
                var email_err = true;
                var pass_err = true;
                var cpass_err = true;
                  

                $('#uname').keyup(function(){
                    name_check();
                });

                function name_check(){
                    var user_val = $('#uname').val();
                    
                    if(user_val.length == ''){
                        $('#name').show();
                        $('#name').html('*please fill the name');
                        $('#name').focus();
                        $('#name').css('color', 'red');
                        name_err = false;
                        return false;
                    }else{
                        $('#name').hide();
                    }

                    if((user_val.length < 3 ) || (user_val.length > 10)){
                        $('#name').show();
                        $('#name').html('*please fill the name between 3 to 10 charactor');
                        $('#name').focus();
                        $('#name').css('color', 'red');
                        name_err = false;
                        return false;
                    }else{
                        $('#name').hide();
                    }

                }


                $('#uemail').keyup(function(){
                    email_check();
                });

                function email_check(){
                   var emailStr = $('#uemail').val();
                   var specialChar = '/[!@#$%^&*(),.?":{}|<>]/';

                   if(emailStr.length == ""){
                        $('#email').show();
                        $('#email').html('*please fill the email');
                        $('#email').focus();
                        $('#email').css('color', 'red');
                        email_err = false;
                        return false;
                    }else{
                        $('#email').hide();
                    }

                    if((emailStr.length < 3 ) || (emailStr.length > 10) || (emailStr ==specialChar.length)){
                        $('#email').show();
                        $('#email').html('*please fill the username between 3 to 20 & must be spacial charactor');
                        $('#email').focus();
                        $('#email').css('color', 'red');
                        email_err = false;
                        return false;
                    }else{
                        $('#email').hide();
                    }

                }


               //  $('#email').keyup(function(){
               //      email_check();
               //  });

               //  function email_check(){
               //     var emailStr = $('#email').val();

               //     if(emailStr.length == ""){
               //          $('#emailcheck').show();
               //          $('#emailcheck').html('*please fill the email');
               //          $('#emailcheck').focus();
               //          $('#emailcheck').css('color', 'red');
               //          username_err = false;
               //          return false;
               //      }else{
               //          $('#emailcheck').hide();
               //      }

               //      if((emailStr.length < 3 ) || (emailStr.length > 20)){
               //          $('#emailcheck').show();
               //          $('#emailcheck').html('*please fill the username between 3 to 20 charactor');
               //          $('#emailcheck').focus();
               //          $('#emailcheck').css('color', 'red');
               //          email_err = false;
               //          return false;
               //      }else{
               //          $('#emailcheck').hide();
               //      }
               //  }


               $('#upassword').keyup(function(){
                    password_check();
                });

                function password_check(){
                   var upasswordStr = $('#upassword').val();
                  //  alert(upasswordStr)

                   if(upasswordStr.length == ""){
                        $('#password').show();
                        $('#password').html('*please fill the password');
                        $('#password').focus();
                        $('#password').css('color', 'red');
                        pass_err = false;
                        return false;
                    }else{
                        $('#password').hide();
                    }

                    if((passwordStr.length < 3 ) || (passwordStr.length > 10) || (passwordStr == "")){
                        $('#password').show();
                        $('#password').html('*please fill the username between 3 to 10 charactor');
                        $('#password').focus();
                        $('#password').css('color', 'red');
                        pass_err = false;
                        return false;
                    }else{
                        $('#password').hide();
                    }

                }
               
            





                $('#ucpassword').keyup(function(){
                    ucpassword_check();
                });

                function ucpassword_check(){
                   var ucpasswordStr = $('#ucpassword').val();
                  //  alert(ucpasswordStr)
                   

                   if(ucpasswordStr.length == ""){
                        $('#cpassword').show();
                        $('#cpassword').html('*please fill the confirm password');
                        $('#cpassword').focus();
                        $('#cpassword').css('color', 'red');
                        cpass_err = false;
                        return false;
                    }else{
                        $('#cpassword').hide();
                    }

                    if((ucpasswordStr.length < 3 ) || (ucpasswordStr.length > 10) || (ucpasswordStr == "")){
                        $('#cpassword').show();
                        $('#cpassword').html('*please fill the username between 3 to 10 charactor');
                        $('#cpassword').focus();
                        $('#cpassword').css('color', 'red');
                        cpass_err = false;
                        return false;
                    }else{
                        $('#cpassword').hide();
                    }

                }
               
            });
        </script>


</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <h1 id="name"></h1>
      <input type="text" name="name" id="uname" placeholder="enter your name" required class="box">
      <h1 id="email"></h1>
      <input type="email" name="email" id="uemail" placeholder="enter your email" required class="box">
      <h1 id="password"></h1>
      <input type="password" name="password" id="upassword" placeholder="enter your password" required class="box">
      <h1 id="cpassword"></h1>
      <input type="password" name="cpassword" id="ucpassword" placeholder="confirm your password" required class="box">
      <select name="user_type" class="box">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>