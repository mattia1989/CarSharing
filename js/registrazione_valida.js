function validaFormRegistrazione() {

    var _psw = document.getElementById(['password_id']);
    var _rpsw = document.getElementById(['r_password_id']);
    if (_psw.value != '')  _psw.value = calcSHA1(_psw.value);
    if (_rpsw.value != '') _rpsw.value = calcSHA1(_rpsw.value);

}
