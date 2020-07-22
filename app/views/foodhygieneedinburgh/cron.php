<?php

//Recipient
$to = 'tsotoul@hotmail.com';

//Subject
$subject = "Test Message";

//Count the number of entries in the database
$counter = 0;
foreach($data['ratings'] as $rating) {
    $counter++;
} 

//Message
$msg = "The database has been updated. ".$counter." entries was inserted in the database";
$msg = wordwrap($msg, 70);

//Headers
$headers = "From: MapTheFood.com <info@mapthefood.com>\r\n";


mail($to, $subject, $msg, $headers);

?>