<div id="content">
    <form id="user_data_id" name="user_data" action="./index.php" method="get">
        <fieldset>
            <legend>DATI UTENTE</legend>
            <label>Email:</label>
            <input class="input_field" type="text" name="email" value="{$user_data_email}" />
            <br>
            <div>
                <form id="form_user_psw_id" class="input_field" method="get" action="./index.php">
                    <input type="hidden" name="controller" value="utente" />
                    <input type="hidden" name="task" value="redirectpsw" />
                    <input type="hidden" name="email_recupero" value="{$user_data_email}" />
                    <input type="submit" name="changepsw" value="Cambia password"/>
                </form>
            </div>
            <label class="input_field" >Nome:</label>
            <input class="input_field" type="text" name="nome" value="{$user_data_nome}" />
            <br>
            <label class="input_field" >Numero documento:</label>
            <input class="input_field" type="text" name="nDocumento" value="{$user_data_nDocumento}" />
            <br>
            <label class="input_field" >Stato:</label>
            <span class="input_field" >
                {$user_data_stato}
            </span>
            <br>
            <label class="input_field" >Amministratore:</label>
            <input class="input_field" type="text" name="admin" value="{$user_data_admin}" />
            <br>
            <div name="subit_user_button" id="subit_user_button_id" class="input_field" >
                <input type="submit" name="user_button" id="user_button_id" value="Torna alla homepage">
            </div>
            <br>
        </fieldset>
    </form>
</div>
