<?php echo "Testing ...<br>";
//http://codular.com/sending-ios-push-notifications-with-php
echo $deviceToken="9d70552c0df056b782a3be2e5b8d56573c6edde9603314b686167ef6651882ef";
//$deviceToken=$order_deatils[0]['fcmid'];
echo $message="<br>hello";
$filename='myst_user.pem';
// Put your private key's passphrase here:
$passphrase = '1234';
// Put your alert message here:
$message = 'Welcome in testing';
$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', $filename);
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
// Open a connection to the APNS server
$fp = stream_socket_client(
    'ssl://gateway.sandbox.push.apple.com:2195', $err,
    $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
if (!$fp)
    exit("Failed to connect: $err $errstr" . PHP_EOL);
echo 'Connected to APNS' . PHP_EOL;
// Create the payload body
$body['aps'] = array(
    'alert' => $message,
    'sound' => 'default'
    );
// Encode the payload as JSON
$payload = json_encode($body);
// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));
if (!$result)
    echo 'Message not delivered' . PHP_EOL;
else
    echo 'Message successfully delivered' . PHP_EOL;
// Close the connection to the server
fclose($fp);

//ios_push($deviceToken,$message,false);

function ios_push($deviceToken,$message,$print=false)
    {



        $passphrase = '1234';
        $print=true;
        $filename='myst_user.pem';
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        stream_context_set_option($ctx, 'ssl', 'local_cert', $filename);

        
        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp){
        echo "<pre>";print_r($fp);echo "</pre>";
        exit("Failed to connect: $err $errstr" . PHP_EOL);
        }
        if($print==true)
        {
        echo 'Connected to APNS' . PHP_EOL;
        }
        $message1=array('title'=>$message ,'type'=>1,'body'=>$message);
        $body['aps'] = array(
            'alert' =>array('title'=>$message ,'type'=>1,'body'=>$message),
            'sound' => 'default.mp3',
            'content_available'=>1,
            'badge'=>1,
            'priority'=>'high'
        );
       //var_dump($body['aps']);
        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        $result = fwrite($fp, $msg, strlen($msg));
        if (!$result)
        {
            if($print==true)
            {
                echo 'Message not delivered' . PHP_EOL;
            }   
        }   
        else
        {
            if($print==true)
            {
                echo 'Message successfully delivered' . PHP_EOL;
            }
        }       
        fclose($fp);
    }
?>