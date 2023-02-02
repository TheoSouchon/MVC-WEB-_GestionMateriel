function check() {
    let firstName = document.getElementById("fn");
    let lastName = document.getElementById("ln");
    let email = document.getElementById("mail");
    let password = document.getElementById("pass");
    if (firstName.value != "" &&
        lastName.value != "" &&
        email.value != "" &&
        password.value != "") {

        var reg=/^[a-zàäâéèêëïîöôùüû\s]*$/i

        // Test la longueur du nom
        if (!(lastName.value.length > 0 && lastName.value.length < 30)) {
            alert("Le nom doit faire entre 2 et 29 caractères");
            return false;
        }

        // Le nom contient des caractères spéciaux
        if (!reg.test(lastName.value)) {
            alert("Le nom contient des caractères spéciaux");
            return false;
        }

        // Test la longueur du prénom
        if (!(firstName.value.length > 0 && firstName.value.length < 30)) {
            alert("Le prénom doit faire entre 2 et 29 caractères");
            return false;
        }

        // Le prénom contient des caractères spéciaux
        if (!reg.test(firstName.value)) {
            alert("Le prénom contient des caractères spéciaux");
            return false;
        }

        // Test la longueur du mail
        if (!(email.value.length > 0 && email.value.length < 30)) {
            alert("Le mail doit faire entre 2 et 29 caractères");
            return false;
        }

        // Le mail contient des caractères spéciaux
        if (!reg.test(email.value)) {
            alert("Le mail contient des caractères spéciaux");
            return false;
        }
        return true;
    } else {
        alert("Veuillez remplir tous les champs");
        return false;
    }
}
