<?php

  
  //Email information
  $admin_email = "abcdr2328@gmail.com";
  $email = $_POST['email'];
  $name = $_POST['name'];
  $message = $_POST['message'];
  
  $email_from = $email;
 
    $subject = "New Form submission";
 
    $email_body = "You have received a new message from the user $name.\n".
                            "Here is the message:\n $message".
  
   $headers = "From: $email \r\n";
 
  $headers .= "Reply-To: $admin_email \r\n";
  //send email
  mail($admin_email, $subject, $email_body,$headers);
  
  echo "Thank you for your email!";
  
  //Email response
 
  
  
  //if "email" variable is not filled out, display the form
  


?>