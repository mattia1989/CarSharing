function validaForm() {

    var _psw = document.getElementById(['password_id']);
    if (_psw.value != '')  _psw.value = calcSHA1(_psw.value);

}
