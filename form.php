<?php
if (!empty($_POST['submit']))
    $c_name =$_POST['c_name'];
    $email =$_POST['email'];
$machine=$_POST['machine'];
$controler=$_POST['controler'];
$controler=$_POST['controler'];
$sterowaneosie=$_POST['sterowaneosie'];

require("fpdf.php");
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);
$pdf->Cell(0,10,"Firma: ",1,1);
$pdf->Cell(0,10,c_name,1,1);
$pdf->Cell(50,10,"Nazwa maszyny: ",1,0);
$pdf->Cell(50,10,$machine,1,1);
$pdf->Cell(50,10,"Nazwa sterowania",1,0);
$pdf->Cell(50,10,$controler,1,1);
$pdf->Cell(50,10,"Ilosc osi:",1,0);
$pdf->Cell(50,10,$sterowaneosie,1,0);

/*$pdf->output();*/



// email stuff (change data below)
$to = "jdziewulsky@gmail.com"; 
$from = $email; 
$subject = "Zapytanie ofertowe $c_name"; 
$message = "<p>Zapytanie ofertowe.</p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "test.pdf";

// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));

// main header
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
$body .= "This is a MIME encoded message.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

// attachment
$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

// send message
mail($to, $subject, $body, $headers);

?>