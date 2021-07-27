<!--
 POST request to this file with the following information
 $_REQUEST["to"] with the email address of the receiver
 $_REQUEST["message"] with the HTML email message body
 $_REQUEST["subject"] with the subject line of the email to be sent
 --> 
 <!-- Source: https://www.tutorialspoint.com/php/php_sending_emails.htm -->
<html>
   <head>
      <title>Email Verification</title>
   </head>
   
   <body>
      <?php
         $to = $_REQUEST["to"];
         $subject = $_REQUEST["subject"];
         
         $message = $_REQUEST["message"];
         // $message .= "<h1>This is headline.</h1>";
         
         $header = "From:dsingh@ihu.edu.gr \r\n";
        //  $header .= "Cc:afgh@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Please check your inbox for an email from us";
         }else {
            echo "Email could not be sent. Please try again.";
         }
      ?>
      
   </body>
</html>