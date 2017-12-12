<?php
$name = $_POST['text'];

$email = $_POST['email'];

$message = $_POST['message'];

$phone = $_POST['tel'];

$formcontent="From: $name \n Message: $message";

$recipient = 'cnc.postprocesory@gmail.com';

$subject = "Formularz kontaktowy POSPROCESOR";

$mailheader = "From: $email telefon kontaktowu \n $phone \r\n";


mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");

echo "Dzikękujemy!!! Niebawem się z Państwem skontaktujemy";

if(isset($_POST['sendMail'])) {
    //validate your inputs and submit the form here
}
?>