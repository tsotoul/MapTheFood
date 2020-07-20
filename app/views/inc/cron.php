<?php
// the message
$msg = "This a test to check the email";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("tsotoul@hotmail.com","My subject",$msg);
?>