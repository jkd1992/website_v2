<?php


if (!empty($_POST['submit']));



$cname =$_POST['cname'];
$email =$_POST['email'];
$phone1=$_POST['phone1'];
$machine=$_POST['machine'];
$controler=$_POST['controler'];
$sterowaneosie=$_POST['sterowaneosie'];
$wiadomosc=$_POST['wiadomosc'];


// attachment name

$filename_header = "Zapytanie ofertowe: ".$cname;

$data_header = date("F j, Y, g:i a");     



/*
$header1 = $data_header ." ".$c_name;
*/
/*
define('FPDF_FONTPATH','pdfGenerator/font/unifont');  //definiuje katalog z czcionkami komponentu
*/

/*require("pdfGenerator/fpdf.php");*/
require("pdfGenerator/tfpdf.php");
$pdf=new tFPDF();
/*DODANIE CZCIONKI OBSLUGUJACEJ POLSKIE ZNAKI*/
$pdf->AddPage();
/*
$pdf->AddFont('arial','','arial.php');

$pdf->SetFont('arial','',16);

*/
// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',16);
/*

$pdf->AddPage();
$pdf->SetFont('Calligrapher','',35);
*/




// Move to the right
/*  $pdf->Cell(300);*/
// Framed title
$pdf->Cell(190,10,$filename_header,1,0,'C');
$pdf->Ln(10);
$pdf->Cell(190,10,$data_header,1,0,'C');
// Line break
$pdf->Ln(20);

$pdf->Cell(60,10,"Firma: ",1,0);
$pdf->Cell(130,10,$cname,1,1);
$pdf->Cell(60,10,"Telefon: ",1,0);
$pdf->Cell(130,10,$phone1,1,1);
$pdf->Cell(60,10,"Email: ",1,0);
$pdf->Cell(130,10,$email,1,1);
$pdf->Cell(60,10,"Nazwa maszyny: ",1,0);
$pdf->Cell(130,10,$machine,1,1);
$pdf->Cell(60,10,"Nazwa sterowania:",1,0);
$pdf->Cell(130,10,$controler,1,1);
$pdf->Cell(60,10,"Ilość osi:",1,0);
$pdf->Cell(130,10,$sterowaneosie,1,1);
$pdf->Ln(20);
$pdf->Cell(190,10,"Wiadomość: ",1,0,'C');
$pdf->Ln(10);
/*zawijanie tekstu do kolejnego wiersza*/
$pdf->MultiCell(0, 6, $wiadomosc,1, 'J',0);




// email stuff (change data below)
$to = "cnc.postprocesory@gmail.com"; 
$from = $email; 
$subject = "Zapytanie ofertowe $c_name"; 
$message = "<p>Zapytanie ofertowe.</p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$dzisiaj = date("m.d.y"); 
$filename = "Zapytanie ofertowe_".$dzisiaj."_.pdf";

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
if(mail($to, $subject, $body, $headers))
{


    $message2 = iconv("utf-8", "iso-8859-2", "Wiadomość została wysłana, dziękujemy!!!!");

    /*$message2 = "Wiadomość została wysłana, dziękujemy!!!!";*/
    //wykonanie skryptu w php za pomoca atrybutu echo
    echo "<script type='text/javascript'>alert('$message2');</script>";




    //cofnięcie się do strony index.html #offer po upływie 1500ms
    /*
header("location:javascript://history.go(-1)");  */ 

}
$loc = "location.href = 'http://cnc-post.pl/index.html#offer'";
echo "<script type='text/javascript'>setTimeout($loc,1500);</script>";
?>