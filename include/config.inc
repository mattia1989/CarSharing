<?php

/**
 * Configurazione generale
 * @author mdl
 */

global $configs;

// Smarty

$configs['smarty']['template_dir'] = './templates/';
$configs['smarty']['compiled_dir'] = './smarty-3.1.29/template_c';
$configs['smarty']['config_dir'] = './smarty-3.1.29/configs/';
$configs['smarty']['cache_dir'] = './smarty-3.1.29/cache/';
$configs['debug'] = false;

// Database

$configs['mysql']['localhost'] = '192.168.56.101';
$configs['mysql']['user'] = 'monty';
$configs['mysql']['password'] = 'ciaociao';
$configs['mysql']['database'] = 'carsharing';

// E-mail

$configs['webmaster_mail'] = 'matt.1989@yahoo.it';
$configs['site_url'] = '192.168.56.101/CarSharing';

?>
