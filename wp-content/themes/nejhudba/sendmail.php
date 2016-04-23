<?php

$to = "nejhudba@nejhudba.cz";
$subject = "";
$txt = $_POST['text'];
$headers = "MIME-Version: 1.0". PHP_EOL;
$headers .= "Content-type:text/html;charset=UTF-8". PHP_EOL;
$headers .= "From: " . $_POST['name'] . "<" . $_POST['from'] . ">". PHP_EOL;

if(mail($to,$subject,$txt, $headers)){
    echo ' <div class="alert alert-warning" role="alert">Email byl úspěšně odeslán</div>';
}

else{
    echo ' <div class="alert alert-warning" role="alert">Email nemohl být odeslán</div>';
}
?>