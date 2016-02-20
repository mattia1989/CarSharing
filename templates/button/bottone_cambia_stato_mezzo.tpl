<span>
    <form name="cambia_stato_mezzo_form" method="post" action="./index.php">
        <input type="hidden" name="controller" value="mezzo" />
        <input type="hidden" name="task" value="cambia_stato_mezzo" />
        <input type="hidden" name="id_mezzo" value="{$idMezzo}" />
        <input type="submit" name="change_state" value="CAMBIA STATO" />
    </form>
</span>