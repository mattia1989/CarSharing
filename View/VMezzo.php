<?php

/**
 *
 * @author Mattia Di Luca
 */
class VMezzo extends View {

    private $_content;
    private $_layout = 'default';

    /* GETTER */

    public function getTask()
    {

        if (isset($_REQUEST['task'])) {
            return $_REQUEST['task'];
        } else {
            return false;
        }

    }

    public function getController()
    {

        if (isset($_REQUEST['controller'])) {
            return $_REQUEST['controller'];
        } else {
            return false;
        }

    }


    /* SETTER */

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }

    /**
     * @param string $layout
     */
    public function setLayout($layout)
    {
        $this->_layout = $layout;
    }

    public function displayElementoMezzo($paramMezzo) {
        if (count($paramMezzo)>1) {

            foreach ($paramMezzo as $item) {
                echo $item;
            }
        } else {
            echo 'lol | ';
        }
    }

    public function setElementoMezzo($paramMezzo) {
        // ricreo l'elemento della lista
        $this->assign('idMezzo', $paramMezzo['id']);
        $this->assign('targaMezzo', $paramMezzo['targa']);
        $this->assign('modelloMezzo', $paramMezzo['modello']);
        $this->assign('carburanteMezzo', $paramMezzo['carburante']);
        $this->assign('prezzoMezzo', $paramMezzo['prezzo_giornaliero']);

        return $this->fetch('./templates/element.tpl');

    }

    /* METHOD */

    public function impostaTemplateLista() {
        // costruisco la lista nella zona centrale
        $lista = array();
        // richiamo l'array dei mezzi dal db
        $fmezzo = new FMezzo();
        $mezzo_load = $fmezzo->getAllElement();

        if (count($mezzo_load) == 1) {
            $lista = $this->setElementoMezzo($mezzo_load);
        } else {
            for ($i = 0; $i < count($mezzo_load); $i++) {
                $lista[$i] = $this->setElementoMezzo($mezzo_load[$i]);
            }
        }

        // assegno la barra laterale
        $this->impostaBarraLateraleTemplateMezzo();
        $this->assign('list', $lista);
        $template = $this->processaTemplateMezzo('lista');

        return $this->impostaZonaCentraleTemplateMezzo($template);

    }

    public function impostaTemplateSpecificheMezzo($paramMezzo) {
        // setto la view con le specifiche
        foreach ($paramMezzo as $key => $value) {
            echo $key.$value;
            if ($key != 'immagine') $this->assign($key, $value);
        }

        $template = $this->processaTemplateMezzo('specifiche');
        return $this->impostaZonaCentraleTemplateMezzo($template);

    }

    private function processaTemplateMezzo($paramTemplate) {
        $this->setLayout($paramTemplate);
        return $this->fetch('./templates/Mezzo_'.$this->_layout.'.tpl');

    }

    private function impostaZonaCentraleTemplateMezzo($paramCenterZone) {
        // riempio il template di base
        $this->assign('center_zone', $paramCenterZone);
        return $this->fetch('./templates/Mezzo_default.tpl');

    }

    private function impostaBarraLateraleTemplateMezzo() {
        // assegno la barra laterale
        $this->assign('left_zone', $this->processaTemplateMezzo('barralaterale'));
    }

}
