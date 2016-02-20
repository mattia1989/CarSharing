<?php

/**
 *
 * @author Mattia Di Luca
 */
class VMezzo extends View {

    private $_content;
    private $_layout = 'default';

    /* GETTER */

    public function getDatiMezzo() {

        $vmezzo = USingleton::getInstances('VMezzo');
        $datiinseriti = array('targa', 'modello', 'cilindrata', 'carburante', 'km', 'colore', 'prezzo_giornaliero', 'immagine', 'stato');
        $dati = array();

        foreach($datiinseriti as $elemento) {
            if(isset($_POST[$elemento])) {
                $dati[$elemento] = $_POST[$elemento];
            }
        }

        $dati['immagine'] = $this->getUploadImage();

        return $dati;

    }

    public function getMezzoId() {

        if (isset($_POST['id_mezzo'])){
            return $_POST['id_mezzo'];
        } else {
            return false;
        }

    }

    public function getUploadImage() {
        $result = @is_uploaded_file($_FILES['immagine']['tmp_name']);
        if (!$result) {
            echo "Impossibile eseguire l'upload.";
            return 'no_image';
        } else {
            $size = $_FILES['immagine']['size'];
            if ($size > $max_size = 16777215) {

                echo "Il file è||| troppo grande.";
                return 'overflow exception';

            }
            $type = $_FILES['immagine']['type'];
            $nome = $_FILES['immagine']['name'];
            $immagine = @file_get_contents($_FILES['immagine']['tmp_name']);
            $immagine = addslashes ($immagine);

            return $immagine;

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

    public function setElementoMezzo($paramMezzo, $paramElementType) {
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

    public function setErroreAggiungi($paramError) {
        $this->assign('var_error', $paramError);
    }

    public function setErrorList($paramError) {

        $this->assign('error_lista', $paramError);

        return $this->impostaTemplateLista('lista_mezzi_amministratore');
    }

    /* METHOD */

    public function impostaTemplateLista($paramType) {
        // costruisco la lista nella zona centrale
        $lista = array();
        // richiamo l'array dei mezzi dal db
        $fmezzo = new FMezzo();
        $mezzo_load = $fmezzo->getAllElement();

        if (count($mezzo_load) == 1) {
            $lista = $this->setElementoMezzo($mezzo_load, $paramType);
        } else {
            for ($i = 0; $i < count($mezzo_load); $i++) {
                $lista[$i] = $this->setElementoMezzo($mezzo_load[$i], $paramType);
            }
        }

        $this->assign('list', $lista);
        $template = $this->fetch('./templates/lista.tpl');

        return $this->impostaZonaCentraleTemplateMezzo($template, $paramType);

    }

    public function impostaTemplateSpecificheMezzo($paramMezzo) {
        // setto la view con le specifiche
        foreach ($paramMezzo as $key => $value) {
            if ($key != 'immagine' && $key != 'stato') $this->assign($key, $value);
        }
        // in questa if devo settare anche lo stato del bottone
        if ($paramMezzo['stato']) {
            $this->assign('stato', 'DISPONIBILE');
            $this->assign('prenota_ora', $this->fetch('./templates/button/bottone_prenota_ora.tpl'));
        } else {
            $this->assign('stato', 'NON DISPONIBILE');
        }

        $template = $this->processaTemplateMezzo('specifiche');

        return $this->impostaZonaCentraleTemplateMezzo($template, 'default');

    }

    public function processaTemplateMezzo($paramTemplate) {
        $this->setLayout($paramTemplate);
        return $this->fetch('./templates/Mezzo_'.$this->_layout.'.tpl');

    }

    private function impostaZonaCentraleTemplateMezzo($paramCenterZone, $paramType) {
        // assegno la barra laterale
        $this->impostaBarraLateraleTemplate($paramType);
        // riempio la zona centrale
        $this->assign('center_zone', $paramCenterZone);
        return $this->fetch('./templates/center_default.tpl');

    }

}
