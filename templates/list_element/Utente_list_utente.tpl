<!-- CSS -->

<link rel="stylesheet" type="text/css" href="./css/utente_element.css">

<!-- TEMPLATE -->

<div id="element_id">
    <div class="utente_element">
        <div>
            Email: {$user_data_email}
        </div>
        <div>
            nome: {$user_data_nome}
        </div>
        <div>
            nDocumento: {$user_data_nDocumento}
        </div>
        <div>
            stato: {$user_data_stato}
        </div>
        <div>
            admni: {$user_data_admin}
        </div>
    </div>
    <span>
        <form name="specifiche_mezzo_form" method="post">
            <input type="hidden" name="controller" value="utente" />
            <input type="hidden" name="task" value="cancella" />
            <input type="hidden" name="email" value="{$user_data_email}" />
            <input type="submit" name="cancella_utente" id="cancella_utente_id" value="Cancella" />
        </form>
    </span>
</div>
