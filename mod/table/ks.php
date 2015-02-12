<?php 
 require "mod/keystone/constants.php";
require "mod/keystone/keystone.php"; 
require "mod/keystone/formatting.php"; 
    
      try {
        if (empty($_GET["token"]) && empty($_COOKIE["token"])) 
        {
          /* If no token has been found, just throw an exception. 
          We will take care of it later. */
          throw new Exception("You are not signed in.");
        }
        else 
        {
          $token_id = "";
          if (!empty($_GET["token"])) // Request parameter has precedence over cookies.
          {
            $token_id = $_GET["token"];
          }      
          else // if (!empty($_COOKIE["token"]))
          {
            $token_id = $_COOKIE["token"];
          }
          
     
          try 
          {
            $user_info = validate_token($token_id, get_service_token());
          }
          catch (Exception $e) 
          {
     
            setcookie("token", null, 0); 
            
            /* Rethrow the exception. Now it will only show the error message once.
            Reload the page to start again. */
            throw $e;
          }
          
      
          setcookie("token", $token_id, time() + 60*60*24); // Cookie expires in 1 day.
          show_user_info($token_id, $user_info);
          
          /* Also, add the "Sign Out" button. */
          echo "<input type="button" onclick="sign_out()" value="Sign Out"/>";
        }
      }
      catch (Exception $e) 
      {
        /* If something went wrong, display the error message and the "Sign In" button. */
        echo "<p>".$e->getMessage()."</p>";
        echo "<input type="button" onclick="sign_in()" value="Sign In" />";
      }
	  
	  ?>
    