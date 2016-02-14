function validaForm() {

    function isEmpy(varEmail, varPsw) {

        if (varEmail.value != "" && varPsw.value != "") {
            alert('good value');
            return true
        } else {
            alert('invalid value');
            return false;
        }
    }

    function settaErrore(varPsw) {
        // setto la label spopra al form (o sotto, poi vedo dove metterla)
        alert('errore dati');
        varPsw.value = '';
        return false;
    }

    function calcolaHash(varPsw) {
        // faccio l'hash della password
        var hash = calcSHA1(varPsw.value);
        varPsw.value = hash.toString();
        return true;

    }

    var _email = document.getElementById(['email_utente_id']);
    var _psw = document.getElementById(['password_utente_id']);

    check = new Array();
    check[0] = isEmpy(_email, _psw);
    check[1] = calcolaHash(_psw);
    //check[2] = $().form(); // check con jquery

    for (i = 0; i < check.length; i++) {
        if (check[i] == false) {
            return settaErrore(_psw);
        }
    }

    return true;

}
