<?php

/**
 * @author Mattia Di Luca
 */
class CParcheggio {

    /* METHOD */

    public function smista() {

        $vparcheggio = USingleton::getInstances('VParcheggio');

        switch ($vparcheggio->getTask()) {

            case 'lista_parcheggi_utente':
                echo 'sopno';
                return $vparcheggio->impostaTemplateLista('default');
                break;

            case 'aggiungi_parcheggio':
                return $vparcheggio->processaTemplateParcheggio('aggiungi');
                break;

            case 'lista_parcheggi_admin':
                return $vparcheggio->impostaTemplateLista('amministrazione');
                break;

            case 'salva':
                $temp = $this->salvaParcheggio();
                return $this->esitoSalva($temp);

            case 'cancella_parcheggio':
                $temp = $this->rimuoviParcheggio();
                echo $temp;
                return $this->esitoRimuovi($temp);
                break;

        }
    }

    private function salvaParcheggio()
    {
        // prendo i dati dalla view
        $vparcheggio = USingleton::getInstances('VParcheggio');
        $datiParcheggio = $vparcheggio->getDatiParcheggio();
        // aggiungo il parcheggio in memoria
        $fparcheggio = new FParcheggio();
        $esito = $fparcheggio->addRow($datiParcheggio);

        return $this->esitoSalva($esito);

    }

    private function esitoSalva($paramEsito)
    {
        $vparcheggio = USingleton::getInstances('VParcheggio');
        if ($paramEsito) {
            return $vparcheggio->setRedirectText('Operazione riuscita');
        } else {
            $vparcheggio->setErroreAggiungi('Operazione non riuscita');
            return $vparcheggio->processaTemplateParcheggio('aggiungi');
        }
    }

    private function rimuoviParcheggio()
    {
        $vparcheggio = USingleton::getInstances('VParcheggio');
        $idParcheggio = $vparcheggio->getParcheggioId();
        echo $idParcheggio;
        // cancello l'elemento
        $fparcheggio = new FParcheggio();
        if($fparcheggio->load($idParcheggio)) {
            $esito = $fparcheggio->deleteRow($idParcheggio);
        } else {
            $esito = 'Parcheggio non trovato';
        }

        return $esito;

    }

    private function esitoRimuovi($temp)
    {
        $vparcheggio = USingleton::getInstances('VParcheggio');

        if($temp == 1) {
            return $vparcheggio->setRedirectText('Parcheggio rimosso con successo');
        } else {
            return $vparcheggio->setRedirectText($temp);
        }
    }
}