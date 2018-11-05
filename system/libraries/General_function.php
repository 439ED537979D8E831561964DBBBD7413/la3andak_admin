<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

 * CodeIgniter

 *

 * An open source application development framework for PHP 5.1.6 or newer

 *

 * @package		CodeIgniter

 * @author		ExpressionEngine Dev Team

 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.

 * @license		http://codeigniter.com/user_guide/license.html

 * @link		http://codeigniter.com

 * @since		Version 1.0

 * @filesource

 */



// ------------------------------------------------------------------------



/**

 * GeoCoding Class

 *

 * @package		CodeIgniter

 * @subpackage	Libraries

 * @category	Pagination

 * @author		ExpressionEngine Dev Team

 * @link		http://codeigniter.com/user_guide/libraries/pagination.html

 */

 

Class CI_General_function

{

    /**

    * encript the password 

    * @return mixed

    */	

    public function __encrip_password($password) {

        return md5($password);

    }	

	



    public function isValidEmail($email){

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){

            return FALSE;

        }else{

            return TRUE;

        }

    }




	 public function showImage($imageName,$imageWithPath,$id=0)
    {
		$html = '<div class="form-group">
					<label class="control-label col-md-3">&nbsp;</label>
						<div class="profile-userpic  col-md-2">
							<input type="hidden" name="old_img" id="old_img" value="'.$imageName.'" >
							<img alt="" class="img-responsive" src="'.$imageWithPath.'">
						</div>
						<button class="btn btn-danger remove_image" id="'.$id.'" type="button">Remove Image</button>
				</div>';
		return $html;
	}


	 public function showImage_profile($imageName,$imageWithPath,$id=0)
    {
		$html = '<div class="form-group">
					<label class="control-label col-md-3">&nbsp;</label>
						<div class="profile-userpic  col-md-4">
							<input type="hidden" name="old_img" id="old_img" value="'.$imageName.'" >
							<img alt="" class="img-responsive" src="'.$imageWithPath.'" style="margin-left:-94%">
						</div>
						
				</div>';
		return $html;
	}

        public function showImage1($imageName,$imageWithPath)

    {

		$html = '<div class="form-group">

					<label class="control-label col-md-3">&nbsp;</label>

						<div class="profile-userpic  col-md-2">

							<input type="hidden" name="old_img" id="old_img" value="'.$imageName.'" >

							<img alt="" class="img-responsive" src="'.$imageWithPath.'">

						</div>

						

				</div>';

		return $html;

	}


   public function getRandomStringNumber($len = 30) {

        // $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $chars = "0123456789";

        $r_str = "";

        for ($i = 0; $i < $len; $i++)

            $r_str .= substr($chars, rand(0, strlen($chars)), 1);



        if (strlen($r_str) != $len) {

            $r_str .= $this->getRandomStringNumber($len - strlen($r_str));

        }



        return $r_str;

    }

    

   public function sendHtmlMail($array) {



    $headers = "Content-type: text/html; charset=iso-8859-1";

    

      $from = ' raghavendra@gymdeal.co';

      // if (isset($array['from'])) {

      $headers .= '\r\n From: ' . $from . '\r\n';

    



    @mail($array['to'], $array['subject'], $array['body'], $headers);

   }        











	//$db->send_push_notification(array($device_details['push_id']),

	//array("msg"=>"Someone request you to be his/her partner")); //Sending Push Notification

	

	public function send_android_push_notification($registatoin_ids, $message,$print=false)

	{

			// Set POST variables

			$url = 'https://android.googleapis.com/gcm/send';

	

			$fields = array(

				'registration_ids' => $registatoin_ids,

				'data' => $message,

			);

	

			$headers = array(

				'Authorization: key=' . ANDROID_PUSH_NOTIFICATION_KEY,

				'Content-Type: application/json'

			);

	

	

	

			//print_r($headers);

			// Open connection

			$ch = curl_init();

	

			// Set the url, number of POST vars, POST data

			curl_setopt($ch, CURLOPT_URL, $url);

	

			curl_setopt($ch, CURLOPT_POST, true);

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			// Disabling SSL Certificate support temporarly

			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

	

			// Execute post

			$result = curl_exec($ch);

			

			if($print==true)

			{

				print_r(json_decode($result));

			}

			

			if ($result === FALSE) {

				die('Curl failed: ' . curl_error($ch));

			}

	

			// Close connection

			curl_close($ch);

			//echo $result;

		}







	function ios_push($deviceToken, $message,$print=false)

	{

	

		// Put your private key's passphrase here:

		$passphrase = 1234;

		

		// Put your alert message here:

		//$message = 'Babaa Push notificatin Testig Message';

		

		////////////////////////////////////////////////////////////////////////////////

		

		$ctx = stream_context_create();

		//stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');

		stream_context_set_option($ctx, 'ssl', 'local_cert', 'http://mobilitytesting.com/zestful/ck.pem');

		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

		

		// Open a connection to the APNS server

		$fp = stream_socket_client(

			'ssl://gateway.sandbox.push.apple.com:2195', $err,

			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		

		if (!$fp)

			exit("Failed to connect: $err $errstr" . PHP_EOL);

	

		if($print==true)

		{

			echo 'Connected to APNS' . PHP_EOL;

		}

		

		// Create the payload body

		$body['aps'] = array(

			'alert' => $message,

			'sound' => 'default'

			);

		$body['message'] =$message;

		$body['id'] ="3"; //1 FOR ACTIVITY, 2 for order, 3 for chat.

		

		// Encode the payload as JSON

		$payload = json_encode($body);

		

		// Build the binary notification

		//$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

		$msg = chr(0) . pack('n', 32) . self::hex2bin($deviceToken) . pack('n', strlen($payload)) . $payload;

		

		

		// Send it to the server

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

		// Close the connection to the server

		fclose($fp);

		

	}





	function send_ios_notification_old($deviceToken, $message,$print=false)

	{

		define("IOS_PASSPHRASE", "");

	

		// Put your private key's passphrase here:

		$passphrase = IOS_PASSPHRASE;

		

		// Put your alert message here:

		//$message = 'My first push notification!';

		

		////////////////////////////////////////////////////////////////////////////////

		

		$ctx = stream_context_create();

		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');

		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

		

		// Open a connection to the APNS server

		$fp = stream_socket_client(

			'ssl://gateway.sandbox.push.apple.com:2195', $err,

			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		

		if (!$fp)

			exit("Failed to connect: $err $errstr" . PHP_EOL);

		

		//echo 'Connected to APNS' . PHP_EOL;

		

		// Create the payload body

		$body['aps'] = array(

			'alert' => $message,

			'sound' => 'default'

			);

		

		// Encode the payload as JSON

		$payload = json_encode($body);

		

		



		// Build the binary notification

		//$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

		$msg = chr(0) . pack('n', 32) . self::hex2bin($deviceToken) . pack('n', strlen($payload)) . $payload;

		

		// Send it to the server

		$result = fwrite($fp, $msg, strlen($msg));

		

		

		if (!$result)

		{

			if($print==true)

			{

				echo 'Message not delivered' . PHP_EOL;

				echo json_encode($result);

			}

			return false;

		}

		else

		{

			if($print==true)

			{

				echo json_encode($result);

				echo 'Message successfully delivered' . PHP_EOL;

			}	

			return true;

		}	

		// Close the connection to the server

		fclose($fp);

	}





	function hex2bin($hexdata) {

	   $bindata="";

	   for ($i=0;$i<strlen($hexdata);$i+=2) {

		  $bindata.=chr(hexdec(substr($hexdata,$i,2)));

	   }

	

	   return $bindata;

	}



	function isValidTimezone($timezone) {

	  return in_array($timezone, timezone_identifiers_list());

	}



	function get_distance_between_pincodes($pincode_default_country,$origins,$destinations)

	{

		$origins = str_replace(" ","%20",$origins);

		$destinations = str_replace(" ","%20",$destinations);

		

		$url = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$pincode_default_country."+".$origins."&destinations=".$pincode_default_country."+".$destinations."&mode=driving&language=en-EN&sensor=false";

		$data   = @file_get_contents($url);

		$result = json_decode($data, true);

		

		

		if($result["rows"][0]["elements"][0]["status"]=="OK")

		{

			$kilometers = $result["rows"][0]["elements"][0]["distance"]["value"] / 1000;

		}

		else

		{

			$kilometers = "";

		}



		return $kilometers;

	}





	function send_ios_notification($deviceToken, $message,$print=false)

	{

		// Put your device token here (without spaces):

		//$deviceToken = '772da543e90a5a36a2eea62782ef29a4a366a3b89471f4c8e131bf84951918b9';

		

		

		// Put your private key's passphrase here:

		$passphrase = 'pushchat';

		

		// Put your alert message here:

		//$message = 'My first push notification 1!';

		

		////////////////////////////////////////////////////////////////////////////////

		

		$ctx = stream_context_create();

		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ZestFulCertificate.pem');

		//stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

		

		// Open a connection to the APNS server

		$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err,

								   $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		

		if (!$fp)

		exit("Failed to connect: $err $errstr" . PHP_EOL);

		

		if($print==true)

		{

			echo 'Connected to APNS' . PHP_EOL;

		}

		

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

		// Close the connection to the server

		fclose($fp);

	

	}

 /**
   * Decode emoji in text
   * @param string $text text to decode
   */
  public static function Decode($text) {
    return self::convertEmoji($text,"DECODE");
  }

  public static function convertEmoji($text,$op) {
    if($op=="ENCODE"){
      return preg_replace_callback('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{1F000}-\x{1FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{1F000}-\x{1FEFF}]?/u',array('self',"encodeEmoji"),$text);
    }else{
      return preg_replace_callback('/(\\\u[0-9a-f]{4})+/',array('self',"decodeEmoji"),$text);
    }
  }

  public static function encodeEmoji($match) {
    return str_replace(array('[',']','"'),'',json_encode($match));
  }
  
  public static function decodeEmoji($text) {
    if(!$text) return '';
    $text = $text[0];
    $decode = json_decode($text,true);
    if($decode) return $decode;
    $text = '["' . $text . '"]';
    $decode = json_decode($text);
    if(count($decode) == 1){
       return $decode[0];
    }
    return $text;
  }

}

 

// END General_function Class