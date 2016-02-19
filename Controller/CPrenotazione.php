<?php

/**
 * @author Mattia Di Luca
 */
class CPrenotazione
{

    public function smista() {

        $vprenotazione = USingleton::getInstances('VPrenotazione');

        switch ($vprenotazione->getTask()) {

            case 'aggiungi':
                return $vprenotazione->processaTemplatePrenotazione('aggiungi');
                break;

            case 'lista_admin':
                break;

            case 'cancella_prenotazione':
                break;

            case '':
                break;

        }
    }
}