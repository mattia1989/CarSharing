<?php
/**
 * Created by PhpStorm.
 * User: Mattia Di Luca
 * Date: 13/02/2016
 * Time: 22:08
 */

$str = 'ciaoquestaeunastringadiprova';
echo $str[strlen($str)-1].'\n\n';
echo substr($str, 0, strlen($str)-1).'\n\n';
//echo substr(0, strlen($str)-2).'\n\n';
//echo substr($str, strlen($str)-2).'\n\n';
?>