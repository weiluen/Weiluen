<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
  $name = $_POST['inputName'];
  $visitor_email = $_POST['inputEmail'];
  $message = $_POST['inputMsg'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo 'Name and email are mandatory!';
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
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
  echo '<	div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" data-target="#myModal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Message Sent</h3>
	</div>
	<div class="modal-body">
		<p>Thank you for your submission.</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" data-target="#myModal" aria-hidden="true">Close</button>
    </div>
</div>';
  
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
