function validaFormRegistrazione() {

    var psw = document.getElementById(['password_id']);
    var rpsw = document.getElementById(['r_password_id']);
    var myCheckBox = document.getElementById("normative_id");

    function checkPassword(paramPsw, paramRpsw) {
        // controllo che i due campi sono uguali
        if (paramPsw.value != paramRpsw.value) {
            alert('Le due password non coincidono');
            return false;
        } else {
            return true;
        }

    }

    function calcolaHash(paramPsw) {
        // faccio l'hash della password
        var hash = calcSHA1(paramPsw.value);
        paramPsw.value = hash.toString();
        return true;

    }

    function checkNormative(paramCheckbox) {
        // controllo che abbia accettato le normative
        if (paramCheckbox.checked) {
            return true;
        } else {
            return false;
        }

    }

    function settaErrore(paramPsw, paramRpsw) {
        // errore
        alert('errore di registrazione');
        paramPsw.value = '';
        paramRpsw.value = '';
        return false;

    }

    check = new Array();
    check[0] = checkPassword(psw, rpsw);
    check[1] = calcolaHash(psw);
    check[2] = checkNormative(myCheckBox);

    var temp = true;

    for (i = 0; i < check.length; i++) {
        if (check[i] == false) {
            temp = settaErrore(psw, rpsw);
        }
    }

    return temp;

}
