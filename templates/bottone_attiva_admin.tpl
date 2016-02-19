<span>
    <form name="activation_user_form" method="get" action="./index.php">
        <input type="hidden" name="controller" value="utente" />
        <input type="hidden" name="task" value="attiva_admin_interface" />
        <input type="hidden" name="email" value="{$emailUtente}" />
        <input type="submit" name="active_button" value="ATTIVA ACCOUNT" />
    </form>
</span>