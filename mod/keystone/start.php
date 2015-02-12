<?php

elgg_register_event_handler('init', 'system', 'keystone_init');


function keystone_init() {



	
	elgg_register_page_handler('keystone', 'keystone_handler');




	
}



function keystone_handler() {
	
		 






$params = array(
        'title' => 'Keystone',
        'content' => '
		<script type="text/javascript">
      function sign_in()
      {
       
        window.location.href = "<?php echo PORTAL_URL; ?>/?callbackUrl=" 
          + encodeURIComponent(document.URL.replace(/token=[a-z0-9]*/g,""));
      }
      
      function sign_out()
      {
      
        document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
        window.location.href = "<?php echo PORTAL_URL; ?>/?logout=true";
      }
    </script>
		
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
          
   
          echo "<input type="button" onclick="sign_out()" value="Sign Out"/>";
        }
      }
      catch (Exception $e) 
      {
   
        echo  "<p>".$e->getMessage()."</p>";
        echo  "<input type="button" onclick="sign_in()" value="Sign In" />";
      }
	  
	  ?>
    
		
		
		',
		
		
        'filter' => '',
    );
		
 
	
	
	$body = elgg_view_layout('content',$params);

	echo elgg_view_page($params['title'], $body);
	return true;
}


?>





