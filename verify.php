<?php
if(!isset($_POST['submit']))
{

}
  $name = $_POST['inputName'];
  $visitor_email = $_POST['inputEmail'];
  $message = $_POST['inputMsg'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    header('location: error.php');
	exit;
}

if(IsInjected($visitor_email))
{	
	header('location: error.php');
	exit;
}

    $email_from = 'fyre182@gmail.com';
    $email_subject = "New Form From Personal Site";
    $email_body = "You have received a new message from the user $name.\n".
    "Here is the message:\n $message  ".
	
  $to = "fyre182@gmail.com";
  $headers = "From: $email_from \r\n";
  $headers .= "Reply-To: $visitor_email \r\n";
  mail($to,$email_subject,$email_body,$headers);
  header('location: sent.php');
  
  // Function to validate against any email injection attempts
  function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>