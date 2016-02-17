<script type="text/javascript" src="./js/Calcola_sha1.js"></script>

<form id="cambiapsw_form" method="post" onsubmit="return checkPassword();">
    <div>
        <label class="input_field">Inserisci la nuova password:</label>
        <input type="password" name="new_password" id="new_password_id"/>
    </div>
    <div>
        <label class="input_field">Re-inserisci la nuova password:</label>
        <input type="password" name="rnew_password" id="rnew_password_id"/>
    </div>
    <input type="hidden" name="controller" value="utente" />
    <input type="hidden" name="task" value="submit_new_psw" />
    <input type="hidden" name="email_recupero" />
    <div>
        <input type="submit" value="Cambia password" />
    </div>
</form>

<script>

    function getURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [, ""])[1].replace(/\+/g, '%20')) || null
    }

    function checkPassword() {
        var npsw = document.getElementById(['new_password_id']);
        var rnpsw = document.getElementById(['rnew_password_id']);
        var mEmail = getURLParameter('email_recupero');
        var email = document.getElementById('email_recupero');

        if (npsw.value == rnpsw.value) {
            npsw.value = calcSHA1(npsw.value);
            rnpsw.value = calcSHA1(rnpsw.value);
            email.value = mEmail;
            return true;
        } else {
            npsw.value = '';
            rnpsw.value = '';
            alert('I due campi non coincidoco');
            return false;
        }
    }
</script>