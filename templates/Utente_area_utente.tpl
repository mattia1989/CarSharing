<div id="content">
    <form id="user_data_id" name="user_data" action="./index.php" method="get">
        <fieldset>
            <legend>DATI UTENTE</legend>
            <table align="center">
                <tr>
                    <td><label class="input_field">Email:</label></td>
                    <td><input class="input_field" type="text" name="email" value="{$user_data_email}" /></td>
                </tr>
                <tr>
                    <td><label class="input_field">Cambia password:</label></td>
                    <td>
                    <form id="form_user_psw_id" class="input_field" method="get" action="./index.php">
                        <input type="hidden" name="controller" value="utente" />
                        <input type="hidden" name="task" value="redirectpsw" />
                        <input type="hidden" name="email_recupero" value="{$user_data_email}" />
                        <input type="submit" name="changepsw" value="Cambia password" align="center" />
                    </form></td>
                </tr>
                <tr>
                    <td><label class="input_field" >Nome:</label></td>
                    <td><input class="input_field" type="text" name="nome" value="{$user_data_nome}" /></td>
                </tr>
                <tr>
                    <td><label class="input_field" >Numero documento:</label></td>
                    <td><input class="input_field" type="text" name="nDocumento" value="{$user_data_nDocumento}" /></td>
                </tr>
                <tr>
                    <td><label class="input_field" >Stato:</label></td>
                    <td><span class="input_field" >{$user_data_stato}</span></td>
                </tr>
                <tr>
                    <td><label class="input_field" >Amministratore:</label></td>
                    <td><input class="input_field" type="text" name="admin" value="{$user_data_admin}" /></td>
                </tr>
            </table>
        </fieldset>
    </form>
    <input type="button"class="input_field" name="user_button" id="user_button_id" value="Torna alla homepage" />
</div>
