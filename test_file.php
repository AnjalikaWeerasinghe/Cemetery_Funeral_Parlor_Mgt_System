<?php

include_once('lib/functions/mailController.php');

generateMail(
    "your_real_email@gmail.com",
    "Test",
    "Testing",
    "<h1>Test</h1>"
);

?>