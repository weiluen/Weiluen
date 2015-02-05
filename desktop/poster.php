<?php function IsInjected($str)
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

if(isset($_POST['submit']))
{
  $name = $_POST['inputName'];
  $visitor_email = $_POST['inputEmail'];
  $message = $_POST['inputMsg'];

if(empty($name)||empty($visitor_email)) 
{
  echo "<script>$('#myModalError').modal('toggle', 'keyboard: false')</script>";
  exit;
}

if(IsInjected($visitor_email))
{ 
  echo "<script>$('#myModalError').modal('toggle', 'keyboard: false')</script>";
  exit;
}

    $email_from = 'fyre182@gmail.com';
    $email_subject = "Weiluen.com Contact Form: $visitor_email";
    $email_body = "You have received a new message from the user $name. S/he can be reached at $visitor_email.\n".
    "S/he sent you the following message:\n $message ".
  
  $to = "fyre182@gmail.com";
  $headers = "From: $visitor_email \r\n";
  $headers .= "Reply-To: $visitor_email \r\n";
  mail($to, $email_subject, $email_body, $headers);
  echo "<script>$('#myModalPass').modal('toggle')</script>";
  exit;
}
else
  { 
    echo "<script>$('.modal').removeData('.modal').modal('hide', 'keyboard: false')</script>";
    exit;
}
?>