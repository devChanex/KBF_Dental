<?php

$to = urldecode($_POST['to']);
$subject = urldecode($_POST['subject']);
$greetings = urldecode($_POST['greetings']);
$msg= urldecode($_POST['msg']);
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();

$message ="<html>
<body>
<p>".$greetings.",</p>
<p>".$msg."</p>
</body>
</html>";

$email = $service->sendEmail($to,$subject,$message);

//USE THIS AS YOUR BASIS
class ServiceClass
{
	
    public function sendEmail($to,$subject,$msg){
	   $msg = wordwrap($msg,70);
	   $msg = $msg."\r\nTHIS IS AUTOMATED EMAIL, PLEASE DO NOT REPLY.";
       $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	   $headers .= 'From: <ServiceBot@kbfdentalcare.com>' . "\r\n";
	   mail($to,$subject,$msg,$headers);
    }
	//UNTIL THIS CODE

}
//UNTIL HERE COPY



?>
