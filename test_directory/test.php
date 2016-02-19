<?php
/**
 * Created by PhpStorm.
 * User: Mattia Di Luca
 * Date: 13/02/2016
 * Time: 22:08
 */

$futente = new FUtente();
$load = $futente->load('3');
header('Content-Type:  image/jpeg');
echo $load['immagine'];

?>

