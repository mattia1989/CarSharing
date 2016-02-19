<!-- CSS -->



<!-- TEMPLATE -->

<div id="content" xmlns="http://www.w3.org/1999/html">
    <form id="aggiungiparcheggio_id" name="aggiungiparcheggio" method="post" action="index.php" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <label  id="indirizzolabel_id" class="input_field">Indirizzo: </label>
                </td>
                <td>
                    <input type="text" name="indirizzo" id="indirizzo_id">
                </td>
            </tr>
            <tr>
                <td>
                    <label id="cittalabel_id" class="input_field">Citta: </label>
                </td>
                <td>
                    <input type="text"  class="input_field" name="citta" id="citta_id" />
                </td>
            </tr>
            <tr>
                <td>
                    <label id="provincialabel_id" class="input_field">Provincia: </label>
                </td>
                <td>
                    <input type="text" class="input_field" name="provincia" id="provincia_id" />
                </td>
            </tr>
        </table>
        <div id="aggiungi_parcheggio_error">
            <label class="error_field" id="registrazione_error_label">{$var_error}</label>
        </div>
        <input type="hidden" name="controller" value="parcheggio"/>
        <input type="hidden" name="task" value="salva"/>
        <div>
            <input type="submit" class="input_field" value="SALVA" />
        </div>
    </form>
    <form method="get" action="./index.php">
        <input type="hidden" name="controller" value="parcheggio" />
        <input type="hidden" name="task" value="lista_parcheggi_admin" />
        <input type="submit" class="input_field" name="return_button" value="Torna alla lista" />
    </form>
</div>
