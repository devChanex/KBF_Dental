<?php


$mailerSnippet = new emailSnippet();
//USE THIS AS YOUR BASIS
class emailSnippet
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
