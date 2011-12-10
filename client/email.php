require "../AWSSDKforPHP/sdk.class.php";
// Instantiate the class
$email = new AmazonSES();
 
$response = $email->send_email(
    'no-reply@amazon.com', // Source (aka From)
    array( // Destination (aka To)
        'ToAddresses' => array(
            'mattias.wolff@gmail.com',
        ),
        'CcAddresses' => 'mattias.wolff@medius.se'
    ),
    array( // Message (long form)
        'Subject' => array(
            'Data' => 'émåîl tést ' . time(),
            'Charset' => 'UTF-8'
        ),
        'Body' => array(
            'Text' => array(
                'Data' => 'Thîs îs å plåîn téxt, ünîcødé tést méssåge ' . time(),
                'Charset' => 'UTF-8'
            ),
            'Html' => array(
                'Data' => '<p><strong>Thîs îs ån HTML, ünîcødé tést méssåge ' . time() . '</strong></p>',
                'Charset' => 'UTF-8'
            )
        )
    ),
    array( // Optional parameters
        'ReplyToAddresses' => array('no-reply@amazon.com', 'nobody@amazon.com')
    )
);
 
// Success?
var_dump($response->isOK());