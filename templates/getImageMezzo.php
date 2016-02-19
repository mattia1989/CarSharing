<?php

$id = $_GET['id'];

$fmezzo = new FMezzo();
$fmezzoload = $fmezzo->load($id);
header("Content-type: image/jpeg");
echo $fmezzoload['immagine'];

?>
