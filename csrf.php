
<?php

//start session
session_start();

  
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: success.php");
  }

  if (isset($_POST['submit']))
      {
          ob_end_clean();
          validation($_POST['token'],$_COOKIE['cookieUser2'],$_POST['username'],$_POST['password']);
      }  
  
   //validate login & tokens
      function validation($user_token,$user_sessionID,$user_name,$pwd)
      {
      if ( $user_sessionID ==session_id() && $user_name="user1" && $pwd="123") 
      {
         if (hash_equals($_COOKIE['csrf_token'], $user_token)) 
           {
            echo "<script> alert('Successful: Tokens Matched')</script>";
            echo $_SESSION['csrf_token']; echo " ";
            echo $user_token;
            $_SESSION['loggedin'] = true; 
              //apc_delete('csrfs');
            }
        else
        {
            $msg = "UnSuccessful: Tokens do not Match";
            echo "<script type='text/javascript'>alert('$msg')</script>";
        }
      }
      else
      {
      $msg = "UnSuccessful";
            echo "<script type='text/javascript'>alert('$msg')</script>";
      }
      }


  ?>


