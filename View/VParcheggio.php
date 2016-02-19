<?php

/**
 * Created by PhpStorm.
 * User: Mattia Di Luca
 * Date: 19/02/2016
 * Time: 19:20
 */
class VParcheggio extends View {

    private $_content;
    private $_layout = 'default';

    /* GETTER */

    public function getDatiParcheggio()
    {
        $vmezzo = USingleton::getInstances('VParcheggio');
        $datiinseriti = array('id', 'indirizzo', 'citta', 'provincia');
        $dati = array();

        foreach($datiinseriti as $elemento) {
            if(isset($_POST[$elemento])) {
                $dati[$elemento] = $_POST[$elemento];
            }
        }

        return $dati;
    }

    public function getParcheggioId()
    {
        if(isset($_GET['id_parcheggio'])) {
            return $_GET['id_parcheggio'];
        } else {
            return false;
        }
    }

    /* SETTER */

    public function setErroreAggiungi($paramError) {
        $this->assign('var_error', $paramError);
    }

    private function setElementoParcheggio($paramParcheggio, $paramType)
    {
        foreach($paramParcheggio as $key => $value) {
            $this->assign($key, $value);
        }

        return $this->fetch('./templates/list_element/Parcheggio_list_'.$paramType.'.tpl');

    }

    /* METHOD */

    public function impostaTemplateLista($paramType) {
        // costruisco la lista nella zona centrale
        $lista = array();
        // richiamo l'array dei mezzi dal db
        $fparcheggio = new FParcheggio();
        $fparcheggioload = $fparcheggio->getAllElement();

        if (count($fparcheggioload) == 1) {
            $lista = $this->setElementoParcheggio($fparcheggioload, $paramType);
        } else {
            for ($i = 0; $i < count($fparcheggioload); $i++) {
                $lista[$i] = $this->setElementoParcheggio($fparcheggioload[$i], $paramType);
            }
        }

        $this->assign('list', $lista);
        $template = $this->fetch('./templates/lista.tpl');

        return $this->impostaZonaCentraleTemplateParcheggio($template, $paramType);

    }

    public function processaTemplateParcheggio($paramTemplate) {
        $this->_layout = $paramTemplate;
        return $this->fetch('./templates/Parcheggio_'.$paramTemplate.'.tpl');
    }

    private function impostaZonaCentraleTemplateParcheggio($paramTemplate, $paramType)
    {
        $this->impostaBarraLateraleTemplate($paramType);
        $this->assign('center_zone', $paramTemplate);

        return $this->fetch('./templates/center_default.tpl');

    }

}