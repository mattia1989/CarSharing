<!-- CSS -->

<link rel="stylesheet" type="text/css" href="./css/barra_laterale_admin.css">

<!-- TEMPLATE -->

<h1>Area amministrativa</h1>
<div id="barra_laterale_amministrazione">
    <span>
        <span>
            <form id="form_aggiungi_parcheggio_id" name="aggiungi_parcheggio" method="get" action="./index.php">
                <input type="hidden" name="controller" value="parcheggio" />
                <input type="hidden" name="task" value="aggiungi_parcheggio" />
                <input type="submit" name="aggiungi_parcheggio_botton" id="aggiungi_parcheggio_button_id" value="Aggiungi Parcheggio" />
            </form>
        </span>
        <span>
            <form id="form_aggiungi_mezzo_id" name="aggiungi_mezzo" method="get" action="./index.php">
                <input type="hidden" name="controller" value="mezzo" />
                <input type="hidden" name="task" value="aggiungi" />
                <input type="submit" name="aggiungi_mezzo_botton" id="aggiungi_mezzo_button_id" value="Aggiungi Mezzo" />
            </form>
        </span>
        <span>
            <form id="form_lista_mezzo_id" name="lista_mezzo" method="get" action="./index.php">
                <input type="hidden" name="controller" value="mezzo" />
                <input type="hidden" name="task" value="lista_mezzi_amministrazione" />
                <input type="submit" name="lista_mezzo_botton" id="lista_mezzo_button_id" value="Lista Mezzi" />
            </form>
        </span>
        <span>
            <form id="form_lista_utenti_id" name="lista_utenti" method="get" action="./index.php">
                <input type="hidden" name="controller" value="utente" />
                <input type="hidden" name="task" value="lista_utenti" />
                <input type="submit" name="lista_utenti_botton" id="lista_utenti_button_id" value="Lista Utenti" />
            </form>
        </span>
        <span>
            <form id="form_lista_parcheggi_id" name="lista_parcheggi" method="get" action="./index.php">
                <input type="hidden" name="controller" value="parcheggio" />
                <input type="hidden" name="task" value="lista_parcheggi_admin" />
                <input type="submit" name="lista_parcheggi_botton" id="lista_parcheggi_button_id" value="Lista Parcheggi" />
            </form>
        </span>
    </span>
</div>