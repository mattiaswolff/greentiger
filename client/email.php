<?php
require "../AWSSDKforPHP/sdk.class.php";
// Instantiate the class
$email = new AmazonSES();
$email->setRegion(AmazonSES::REGION_US_E1);
$response = $email->send_email(
    'no-replay@zowgle.com', // Source (aka From)
    array('ToAddresses' => 'mattias.wolff@gmail.com'), // Destination (aka To)
    array( // Message (short form)
        'Subject.Data' => 'Email Test ' . time(),
        'Body.Text.Data' => 'This is a simple test message ' . time()
    )
);
 
// Success?
var_dump($response->isOK());

?>