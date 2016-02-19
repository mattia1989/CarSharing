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

    public function getDatiMezzo() {

        $vmezzo = USingleton::getInstances('VMezzo');
        $datiinseriti = array('targa', 'modello', 'cilindrata', 'carburante', 'km', 'colore', 'prezzo_giornaliero', 'immagine');
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

//        if( ( !empty( $_FILES["immagine"] ) ) && ( $_FILES['immagine']['error'] == 0 ) ) {
//
//            $path = 'tmp/' . basename( $_FILES['immagine']['name'] );
//
//            if( move_uploaded_file($_FILES['immagine']['tmp_name'], $path) ){
//                print_r( $_FILES['immagine'] ); /* File salvato correttamente */
//                return $_FILES['immagine'];
//            }else{
//                print "Impossibile salvare il file: " . $_FILES['my_file']['error'];
//                return 'caricamento non riuscito';
//            }
//
//        }else{
//            return 'no value';
//        }




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

    public function setElementoMezzo($paramMezzo, $paramEmementType) {
        // ricreo l'elemento della lista
        $this->assign('idMezzo', $paramMezzo['id']);
        $this->assign('targaMezzo', $paramMezzo['targa']);
        $this->assign('modelloMezzo', $paramMezzo['modello']);
        $this->assign('carburanteMezzo', $paramMezzo['carburante']);
        $this->assign('prezzoMezzo', $paramMezzo['prezzo_giornaliero']);
        $this->assign('immagineMezzo', $paramMezzo['immagine']);

        return $this->fetch('./templates/list_element/Mezzo_list_'.$paramEmementType.'.tpl');

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

        return $this->impostaZonaCentraleTemplateMezzo($template);

    }

    public function impostaTemplateSpecificheMezzo($paramMezzo) {
        // setto la view con le specifiche
        foreach ($paramMezzo as $key => $value) {
            $this->assign($key, $value);
        }

        $template = $this->processaTemplateMezzo('specifiche');
        return $this->impostaZonaCentraleTemplateMezzo($template);

    }

    public function processaTemplateMezzo($paramTemplate) {
        $this->setLayout($paramTemplate);
        return $this->fetch('./templates/Mezzo_'.$this->_layout.'.tpl');

    }

    private function impostaZonaCentraleTemplateMezzo($paramCenterZone) {
        // assegno la barra laterale
        $this->impostaBarraLateraleTemplateMezzo();
        // riempio la zona centrale
        $this->assign('center_zone', $paramCenterZone);
        return $this->fetch('./templates/Mezzo_default.tpl');

    }

    private function impostaBarraLateraleTemplateMezzo() {
        // assegno la barra laterale
        $this->assign('left_zone', $this->processaTemplateMezzo('barralaterale'));
    }

}
