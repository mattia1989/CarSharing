<div id="content" xmlns="http://www.w3.org/1999/html">
    <form id="registration_form_id" name="registration_form" method="get" action="index.php" onsubmit="return onClickRegister();">
        <div>
            <label id="name_label">Nome: </label>
            <input type="text" class="input_reg" name="username" id="username_input" />
        </div>
        <div>
            <div>
                <label id="new_password_label">Nuova Passoword: </label>
                <input type="password" class="input_reg" name="password" id="password_id" />
            </div>
            <div>
                <label id="r_new_password_label">Re-inserire la nuova password: </label>
                <input type="password" class="input_reg" name="ripeti_password" id="r_password_id" />
            </div>
        </div>
        <div>
            <label id="new_email_label">E-mail: </label>
            <input type="email" class="input_reg" name="email" id="new_email_input">
        </div>
        <div>
            <label id="document_label">Numero del documento: </label>
            <input type="text" class="input_reg" name="n_documento" id="n_docuemnto_id">
        </div>
        <div>
            <input type="checkbox" class="input_reg" name="normative" id="normative_id">
                "Si accetta tutto il sacramento dell'altare maggiore e minore che sia."
            </input>
        </div>
        <div>
            <input type="submit" value="REGISTRATI" />
        </div>
    </form>
</div>

<script>
    function onClickRegister() {

        var myCheckBox = document.getElementById("normative_id");
        var tempTxt;
        var flag = false;
        if (myCheckBox.checked) {
            tempTxt = checkValue();
            flag = true;
        } else {
            tempTxt = "Not Checked";
        }
        alert(tempTxt);
        return flag;
    }

    function checkValue() {

        var alertString;
        if (document.getElementById("password_id").value == null || document.getElementById("password_id").value == "") {
            alertString = "Almeno un valore non è valido";
        } else {
            alertString = "true";
        }
        return alertString;
    }
</script>