<?php
$to      = 'guigur13@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: guigur@tes-bo.com' . "\r\n" .
    'Reply-To: guigur@tes-bo.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?> 