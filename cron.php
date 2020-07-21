<?php

//Recipient
$to = 'tsotoul@hotmail.com';

//Subject
$subject = "Test Message";

//Message
$msg = "This is a test email";
$msg = wordwrap($msg, 70);

//Headers
$headers = "From: MapTheFood.com <info@mapthefood.com>\r\n";


mail($to, $subject, $msg, $headers);

?>