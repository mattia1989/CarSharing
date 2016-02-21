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
                // qui devo effettuare l'ordine
                return $this->proceduraPrenotazione();
                break;

            case 'riconsegna':
                // qui invece devo effettuare la riconsegna
                return $this->proceduraRiconsegna();
                break;

            case 'specifiche':
                return $vprenotazione->impostaTemplateSpecifichePrenotazione();
                break;

            case 'lista_disponibilita':
                return $vprenotazione->impostaTemplateLista('default');
                break;

            case 'lista_admin':
                break;

            case 'cancella_prenotazione':
                break;

        }
    }

    private function proceduraPrenotazione()
    {
        // controllo se è loggato
        $vprenotazione = USingleton::getInstances('VPrenotazione');
        $cutente = USingleton::getInstances('CUtente');
        $mCookie = $cutente->getCookie();
        if($mCookie['email'] == '') {
            return $vprenotazione->setRedirectText('Non sei autenticato, devi prima autenticarti per poter continuare');
        } else {
            if($mCookie['stato'] == 0) {
                return $vprenotazione->setRedirectText('Non sei attivo, devi completare la procedura d\'attivazione prima');
            } else {
                // procedo con l'effettuare la prenotazione
                $datiPrenotazione = $vprenotazione->getDatiPrenotazione();
                return $this->effettuaPrenotazione($mCookie, $datiPrenotazione);
            }

        }

    }

    private function effettuaPrenotazione($paramCookie, $paramDatiPrenotazione)
    {
        // preparo gli array da aggiungere al db
        $mEmail = $paramCookie['email'];
        $mIdParcheggio = $paramDatiPrenotazione['id_park'];
        $mIdMezzo = $paramDatiPrenotazione['id_mezzo'];
        $mDay = date('Y-m-d');
        $newRowPrenotazione = array('user_email' => $mEmail,
            'mezzo_id' => $mIdMezzo,
            'data_prelievo' => $mDay,
            'data_consegna' => null);
        // aggiungo le riga al db
        $fprenotazione = new FPrenotazione();
        $esito1 = $fprenotazione->addRow($newRowPrenotazione);
        $ultimaPrenotazione = $fprenotazione->getLastRow();
        $newRowPrenotazione_Parcheggio = array('id_prenotazione' => $ultimaPrenotazione['id'],
            'id_parcheggio' => $mIdParcheggio);
        $fprenotazione_parcheggio = new FPrenotazione_Parcheggio();
        $esito2 = $fprenotazione_parcheggio->addRow($newRowPrenotazione_Parcheggio);
        $vprenotazione = USingleton::getInstances('VPrenotazione');

        if($esito1 && $esito2) {
            return $vprenotazione->setRedirectText('Operazione effettuata, quando hai finito vai nell\'area utente per effettuare la riconsegna');
        } else {
            return $vprenotazione->setRedirectText('Operazione non riuscita');
        }

    }

    private function proceduraRiconsegna()
    {
        // recupero i dati dalla view
        $vprenotazione = USingleton::getInstances('VPrenotazione');
        $idPrenotazione = $vprenotazione->getIdPrenotazione();
        $idParcheggio = $vprenotazione->getIdParcheggio();

        return $vprenotazione->setRedirectText($this->chiudiPrenotazione($idPrenotazione, $idParcheggio));

    }

    private function chiudiPrenotazione($paramIdPrenotazione, $paramIdParcheggio) {
        // qui effettuo le varie procedure
        $fprenotazione = new FPrenotazione();
        $esito = $fprenotazione->chiudiPrenotazione($paramIdPrenotazione);

        if($esito) {
            $prenotazione = array('id_prenotazione' => $paramIdPrenotazione,
                    'id_parcheggio' => $paramIdParcheggio);
            $fprenotazione_parcheggio = new FPrenotazione_Parcheggio();
            $esito = $fprenotazione_parcheggio->addRow($prenotazione);
            if($esito) {
                return 'Operazione andata a buon fine, grazie per aver utilizzato il nostro servizio';
            } else {
                return 'Operazione non completata, riprovare';
            }
        } else {
            return 'Operazione non completata, riprovare';
        }

    }

}