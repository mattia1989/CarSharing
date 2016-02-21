<?php

/**
 * Created by PhpStorm.
 * User: Mattia Di Luca
 * Date: 19/02/2016
 * Time: 20:55
 */
class VPrenotazione extends View
{

    /* GETTER */

    public function getIdMezzo()
    {
        if(isset($_REQUEST['id_mezzo'])) {
            return $_REQUEST['id_mezzo'];
        } else {
            return false;
        }
    }

    public function getDatiPrenotazione() {
        $dati['id_mezzo'] = $this->getIdMezzo();
        $dati['id_park'] = $this->getIdParcheggio();

        return $dati;
    }

    public function getIdParcheggio() {

        if(isset($_GET['id_park'])) {
            return $_GET['id_park'];
        } else {
            return false;
        }

    }

    public function getIdPrenotazione() {

        if(isset($_GET['prenotazione_in_corso'])) {
            return $_GET['prenotazione_in_corso'];
        } else {
            return false;
        }

    }

    /* SETTER */

    private function setSpecifiche($paramFmezzoload, $paramFparcheggioload)
    {
        foreach ($paramFmezzoload as $key => $value) {
            // riempio col ciclo le informazioni sul mezzo
            $this->assign($key, $value);
        }
        foreach ($paramFparcheggioload as $key => $value) {
            // concateno le stringhe
            $this->assign($key.'_park', $value);
        }
        // assegno la posizione del parcheggio
        $template = $this->processaTemplatePrenotazione('specifiche');

        return $this->impostaZonaCentraleTemplatePrenotazione($template, 'default');

    }

    /* METHOD */

    public function processaTemplatePrenotazione($paramTemplate)
    {
        return $this->fetch('./templates/Prenotazione_'.$paramTemplate.'.tpl');
    }

    public function impostaTemplateSpecifichePrenotazione()
    {
        // prendo l'id dalla richiesta e faccio la load dal db
        $idMezzo = $this->getIdMezzo();
        $fmezzo = new FMezzo();
        $fmezzoload = $fmezzo->load($idMezzo);
        // recupero l'ultimo parcheggio del mezzo
        $fprenotazione_pracheggio = new FPrenotazione_Parcheggio();
        $fprenotazione_pracheggioload = $fprenotazione_pracheggio->getLastParcheggio($idMezzo);
        $fparcheggio = new FParcheggio();
        $fparcheggioload = $fparcheggio->load($fprenotazione_pracheggioload['id_parcheggio']);
        if($fmezzoload && $fparcheggioload) {
            // inserisco i dati nella view
            return $this->setSpecifiche($fmezzoload, $fparcheggioload);
        } else {
            return $this->setRedirectText('Qualcosa è andato storto, stai per essere reindirizzato alla home');
        }

    }

    public function impostaTemplateLista($paramType) {
        // costruisco la lista nella zona centrale
        $lista = array();
        // richiamo l'array dei mezzi dal db
        $fmezzo = new FMezzo();
        $fmezzoload = $fmezzo->mezziDisponibili();

        if (count($fmezzoload) == 1) {
            $lista = $this->setElementoMezzoDisponibile($fmezzoload, $paramType);
        } else {
            for ($i = 0; $i < count($fmezzoload); $i++) {
                $lista[$i] = $this->setElementoMezzoDisponibile($fmezzoload[$i], $paramType);
            }
        }

        $this->assign('list', $lista);
        $template = $this->fetch('./templates/lista.tpl');

        return $this->impostaZonaCentraleTemplatePrenotazione($template, $paramType);

    }

    private function impostaZonaCentraleTemplatePrenotazione($paramCenterZone, $paramType) {
        // assegno la barra laterale
        $this->impostaBarraLateraleTemplate($paramType);
        // riempio la zona centrale
        $this->assign('center_zone', $paramCenterZone);
        return $this->fetch('./templates/center_default.tpl');

    }

    public function setElementoMezzoDisponibile($paramMezzo, $paramElementType) {
        // ricreo l'elemento della lista
        $this->assign('idMezzo', $paramMezzo['id']);
        $this->assign('targaMezzo', $paramMezzo['targa']);
        $this->assign('modelloMezzo', $paramMezzo['modello']);
        $this->assign('carburanteMezzo', $paramMezzo['carburante']);
        $this->assign('prezzoMezzo', $paramMezzo['prezzo_giornaliero']);
        $this->assign('immagineMezzo', $paramMezzo['immagine']);
        $this->assign('statoMezzo', $paramMezzo['stato'] ? 'DISPONIBILE' : 'NON DISPONIBILE');

        if ($paramElementType != 'default') {
            // setto il bottone per l'admin
            $this->assign('cambiaStatoMezzo', $this->fetch('./templates/button/bottone_cambia_stato_mezzo.tpl'));
            $this->assign('id_mezzo', $paramMezzo['id']);
        }

        return $this->fetch('./templates/list_element/Mezzo_list_'.$paramElementType.'.tpl');

    }

}