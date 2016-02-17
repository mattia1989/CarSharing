<?php

/**
 * @author Mattia Di Luca
 */
class CMezzo {

    /* METHOD */

    public function smista() {

        $vmezzo = USingleton::getInstances('VMezzo');

        switch ($vmezzo->getTask()) {

            case 'lista_mezzi':
                return $vmezzo->impostaTemplateLista();

            case 'specifiche_mezzo':
                $tempMezzo = $this->getMezzoFromRequest();
                return $vmezzo->impostaTemplateSpecificheMezzo($tempMezzo);
                break;
        }

    }

    private function getMezzoFromRequest() {

        $id_mezzo = '';
        if (isset($_GET['id_mezzo'])) {
            $id_mezzo = $_GET['id_mezzo'];
        } else {
            return false;
        }

        if ($id_mezzo) {
            $fmezzo = new FMezzo();
            $mezzo_load = $fmezzo->load($id_mezzo);

            return $mezzo_load;

        }

    }

}