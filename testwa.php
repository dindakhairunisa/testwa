<?php
function encrypt($text, $s) {
    $result = '';
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if (ctype_upper($char))
            $result .= chr(fmod((ord($char) - 65 + $s), 26) + 65);
        else
            $result .= chr(fmod((ord($char) - 97 + $s), 26) + 97);
    }
    return $result;
}

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function sendWhatsappMessage($phone, $message) {
    $phone = str_replace('+', '', $phone);
    $urlencoded_message = urlencode($message);
    $url = "https://api.whatsapp.com/send?phone={$phone}&text={$urlencoded_message}";
    header("Location: {$url}");
}

$phone = "6282178245633"; // phone number
$message = "Hello, World!"; // message
$shift = 3; // caesar cipher shift

$encrypted_message = encrypt($message, $shift);
$base64_encoded_message = base64url_encode($encrypted_message);

sendWhatsappMessage($phone, $base64_encoded_message);
?>
