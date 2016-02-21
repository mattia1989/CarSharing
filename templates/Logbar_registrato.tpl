<nav>
    <ul>
        <li>
            Benvenuto {$nome_utente}!
        </li>
        <li>
            <!-- qui invece devo inserire il template di registrazione -->
            <a href="?controller=utente&task=area_utente">AREA PERSONALE</a>
        </li>
        <li>
            <!-- il prossimo link deve settare il template di accesso -->
            <a href="?controller=utente&task=logout">ESCI</a>
        </li>
    </ul>
    <ul>
        <div id="navbar_search">
            <!-- vado alla pagina di ricerca -->
            <a href="?controller=prenotazione&task=lista_disponibilita">DEVI PARTIRE? CLICCA QUI!</a>
        </div>
    </ul>
</nav>