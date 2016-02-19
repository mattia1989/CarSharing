<?php

/**
 * Created by PhpStorm.
 * User: Mattia Di Luca
 * Date: 19/02/2016
 * Time: 20:55
 */
class VPrenotazione extends View
{
    /* METHOD */

    public function processaTemplatePrenotazione($paramTemplate)
    {
        return $this->fetch('./templates/Prenotazione_'.$paramTemplate.'.tpl');
    }
}