function validaForm() {

    //var _email = document.getElementById(['email_utente_id']).value;
    //var _psw = document.getElementById(['password_utente_id']).value;

    var tagForm = document.forms(["login"]);
    var _email = tagForm["email_utente"].value;
    var _psw = tagForm["password_utente"].value;

    alert(_email + '   ' + _psw);

    if (_email.value == "" || _psw.value == "") {
        alert('good value');
        return true
    } else {
        alert('invalid value');
        return false;
    }
}