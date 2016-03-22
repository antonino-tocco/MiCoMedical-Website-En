<?php
/**
 * Created by PhpStorm.
 * User: entony
 * Date: 14/03/16
 * Time: 09:11
 */
require_once '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
function validateCodFisc ($codFisc) {
    $pattern = '/([A-Z]{6})([0-9]{2})[A-Z]([0-9]{2})[A-Z]([0-9]{3})[A-Z]/i';
    return preg_match($pattern, $codFisc) ? true : false;
}

function validateVat ($vat) {
    $pattern = '/([0-9]{11})/';
    return preg_match($pattern, $vat) ? true : false;
}
function validateEmail ($email) {
    $pattern = '/([^@]+)[@]([\S]+)/i';
    return preg_match($pattern, $email) ? true : false;

}
$assistanceRequest = $_POST['assistanceRequest'];
$name = isset($assistanceRequest['name']) ? $assistanceRequest['name'] : '';
$region = isset($assistanceRequest['selectedRegion']) ? $assistanceRequest['selectedRegion'] : '';
$province = isset($assistanceRequest['selectedProvince']) ? $assistanceRequest['selectedProvince']: '';
$town = isset($assistanceRequest['selectedTown']) ? $assistanceRequest['selectedTown'] : '';
$postCode = isset($assistanceRequest['postCode']) ? $assistanceRequest['postCode'] : '';
$address = isset($assistanceRequest['address']) ? $assistanceRequest['address'] : '';
$codFisc = isset($assistanceRequest['codFisc']) ? $assistanceRequest['codFisc'] : '';
$vat = isset($assistanceRequest['vat']) ? $assistanceRequest['vat'] : '';
$email = isset($assistanceRequest['email']) ? $assistanceRequest['email'] : '';
$mobile = isset($assistanceRequest['mobile']) ? $assistanceRequest['mobile'] : '';
$tool = isset($assistanceRequest['tool']) ? $assistanceRequest['tool'] : '';
$intervention = isset($assistanceRequest['intervention']) ? $assistanceRequest['intervention'] : '';
$brand = isset($assistanceRequest['brand']) ? $assistanceRequest['brand'] : '';
$number = isset($assistanceRequest['number']) ? $assistanceRequest['number'] : '';
$originalPackaging = isset($assistanceRequest['originalPackaging']) ? $assistanceRequest['originalPackaging'] : '';
$description = isset($assistanceRequest['description']) ? $assistanceRequest['description'] : '';
if($name !== '' && $region !== '' && $province !== '' && $town !== '' && $postCode !== '' && $address !== ''
    && $codFisc !== '' && validateCodFisc($codFisc) && $vat !== '' && validateVat($vat) && $email !== '' && validateEmail($email) && $mobile !== '' && $tool !== '' && $intervention !== ''
    && $brand !== '' && $number !== '' && $description !== '') {

    echo "Campi validi...";
    echo "Creo email ...";

    $mailTemplate = file_get_contents('../email/base.email.html');

    $message = <<<EOT
    <p>Hai ricevuto una richiesta di assistenza da $name.</p>
    Ecco i dettagli:
    <div class="table-responsive">
        <table class="table">
        <th role="row">
            Nome
        </th>
        <td>
            $nome
        </td>
        <th role="row">
        </th>
        </table>
    </div>
EOT;

    $mailBody = preg_replace('__MESSAGE__', $message, $mailTemplate);
    $mailBody = preg_replace('__TITLE__', 'Richiesta assitenza', $mailBody);


    //region Mi.Co.Medical Mail
    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtps.aruba.it';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@micomedical.it';              // SMTP username
    $mail->Password = 'Cvgdvd83l22g273l';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->setFrom('info@micomedical.it', 'Mi.Co.Medical S.r.l');
    $mail->addAddress('info@micomedical.it', 'Mi.Co.Medical S.r.l');     // Add a recipient
    $mail->addAddress('entonytocco@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'Richiesta di assistenza';
    $mail->Body = $mailBody;
    if(!$mail->send()) {
        echo json_encode(array('errorCode' => 'KO', 'message' => 'Si è verificato un errore nell\'invio della mail'));
    } else {
        echo json_encode(array('errorCode' => 'OK', 'message' => 'Richiesta inviata correttamente'));
    }


} else {
    echo json_encode(array('errorCode' => 'KO', 'message' => 'Verifica i dati inseriti...'));
}
?>