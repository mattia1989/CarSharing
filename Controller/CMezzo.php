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
                return $vmezzo->impostaTemplateLista('default');

            case 'specifiche_mezzo':
                $tempMezzo = $this->getMezzoFromRequest();
                return $vmezzo->impostaTemplateSpecificheMezzo($tempMezzo);
                break;

            case 'lista_mezzi_amministrazione';
                return $vmezzo->impostaTemplateLista('amministrazione');
                break;

            case 'aggiungi':
                // devo tornare al pannello d'amministrazione
                return $vmezzo->processaTemplateMezzo('aggiungi');
                break;

            case 'salva':
                // aggiungo il mezzo al db
                $esito = $this->richiestaAggiungi();
                return $this->esitoAggiungi($esito);

            case 'cambia_stato_mezzo':
                // cambio lo stato del mezzo tramite pannello amministrato
                return $vmezzo->setRedirectText($this->richiestaCambioStato());

            case 'cancella_mezzo':
                // devo tornare al pannello d'amministrazione
                $esito = $this->richiestaRimuovi();
                return $this->esitoRimuovi($esito);
                break;

            case 'modifica_mezzo':
                // devo tornare al pannello d'amministrazione
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

    private function richiestaAggiungi() {

        $vmezzo = USingleton::getInstances('VMezzo');
        $mezzo = $vmezzo->getDatiMezzo();
        if ($mezzo['immagine'] != 'no_image' && $mezzo['immagine'] != 'overflow exception') {
            $fmezzo = new FMezzo();
            return $fmezzo->addRow($mezzo);
        } else {
            return $mezzo['immagine'];
        }

    }

    private function esitoAggiungi($paramEsito) {

        $vmezzo = USingleton::getInstances('VMezzo');
        $result = '';

        if ($paramEsito == 1) {
            $result = $vmezzo->setRedirectText('Upload completato');
        } else {
            if ($paramEsito == 'no_image') {
                $vmezzo->setErroreAggiungi('Nessuna immagine selezionata');
                $result = $vmezzo->processaTemplateMezzo('aggiungi');
            } else {
                if ($paramEsito == 'overflow exception') {
                    $vmezzo->setErroreAggiungi('Dimensioni dell\'immagine elevate');
                    $result = $vmezzo->processaTemplateMezzo('aggiungi');
                } else {
                    $vmezzo->setErroreAggiungi('Upload non riuscito');
                    $result = $vmezzo->processaTemplateMezzo('aggiungi');
                }

            }

        }

        return $result;

    }

    private function richiestaRimuovi() {
        // prendo l'elemento dalla view
        $vmezzo = USingleton::getInstances('VMezzo');
        $idmezzo = $vmezzo->getMezzoId();
        // cancello l'elemento
        $fmezzo = new FMezzo();
        $esito = $fmezzo->deleteRow($idmezzo);

        return $esito;

    }

    private function esitoRimuovi($flag) {

        $vmezzo = USingleton::getInstances('VMezzo');

        if ($flag) {
            return $vmezzo->setRedirectText('Mezzo rimosso');
        } else {
            return $vmezzo->setRedirectText('Operazione non riuscita');
        }
    }

    private function richiestaCambioStato()
    {
        $vmezzo = USingleton::getInstances('VMezzo');
        $idMezzo = $vmezzo->getMezzoId();
        $fmezzo = new FMezzo();
        $fmezzoload = $fmezzo->load($idMezzo);

        if (!$fmezzoload) {
            return 'Mezzo non trovato';
        } else {
            $fmezzoload = $fmezzo->setStatus($fmezzoload['id'], !$fmezzoload['stato']);
            if (!$fmezzoload) {
                return 'Impossibile cambiare lo stato';
            } else {
                return 'Operazione effettuata con successo';
            }
        }

    }

}