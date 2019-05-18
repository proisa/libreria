<?php 
require('inc/conexion.php');
require('inc/funciones.php');
require('clases/Auth.php');
require('vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// $file =  file_get_contents('paginas/registro.html',true);

// $file = str_replace('Correo','Mail',$file);

// echo $file;
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
$cliente = 'Junior Suarez';
$mensaje = 'Recuerde pagar su cuenta a tiempo';
$balance = 'RD$'.number_format(120000,2);
// Load Composer's autoloader
$template =  file_get_contents('email_templates/main.html',true);
$template = str_replace('{{cliente}}',$cliente,$template);
$template = str_replace('{{cuerpo}}',$mensaje,$template);
$template = str_replace('{{balance}}',$balance,$template);

$reporte_estado_cuenta = file_get_contents(url_base().'/reportes/estado_cuenta.php?codigo=000001',true);
// Instantiation and passing `true` enables exceptions
// PDF
// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;
$options = new Options();
$options->set('isRemoteEnabled', true);
// instantiate and use the dompdf class
$dompdf = new Dompdf($options);
$dompdf->set_base_path('./assets/css/');
$dompdf->loadHtml($reporte_estado_cuenta);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'landscape');
// Render the HTML as PDF
$dompdf->render();


$pdf ="files/".time().".pdf";
file_put_contents($pdf, $dompdf->output());
// Output the generated PDF to Browser
//$dompdf->stream();
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'proisasoft@gmail.com';                     // SMTP username
    $mail->Password   = 'pr0i$$a1068';                               // SMTP password
    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('proisasoft@gmail.com', 'Proisa');
    $mail->addAddress('juniorsuarez@gmail.com', 'Junior Suarez');     // Add a recipient
    $mail->addAddress('wilrafa@hotmail.com', 'Wilson');     // Add a recipient
    // Attachments
    $mail->addAttachment($pdf);         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = $template;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}





