<html>
    <form action="testemail.php" method="post">
        Send email: <input type="text" name="test" required>
        <input type="submit" value="submit" name="submit">
    </form>
</html>
<?php
// the message
$msg = $_POST['test']?? "";
$header =   "From: fypscom@fyp-22-s2-27.com" . "\r\n" . "Content-Type: text/plain; charset=utf-8";
$subject = "Hello World";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

if (!empty($msg)) {
// send email

    if (mail("youremailhere@mail.com",$subject,$msg, $header,"-ffypscom@fyp-22-s2-27.com"))
    {
      echo "email sent successfully";
    } else {
        echo "email send failed";
    }

    // if (mail("angjinghian@gmail.com","Test Subject",$msg,$headers)) {
    //     echo "email sent successfully";
    // } else {
    //     echo "email send failed";
    // }
}


// $receiver = "receiver email address here";
// $subject = "Email Test via PHP using Localhost";
// $body = "Hi, there...This is a test email send from Localhost.";
// $sender = "From:sender email address here";
// if(mail($receiver, $subject, $body, $sender)){
//     echo "Email sent successfully to $receiver";
// }else{
//     echo "Sorry, failed while sending mail!";
// }

?>
